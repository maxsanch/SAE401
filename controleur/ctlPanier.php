<?php

require_once "modeles/panier.class.php";
require_once "modeles/utilisateurs.class.php";
require_once "modeles/Objectshop.class.php";
require_once "controleur/ctlShop.php";
require_once "controleur/ctlUser.php";
require_once "controleur/ctlPage.php";
require_once "controleur/ctlJeux.php";

class ctlPanier
{
    private $panier;

    private $user;

    private $date;
    private $jeux;

    public function __construct()
    {
        // instancier les classes nécéssaires
        $this->panier = new panier;
        $this->user = new utilisateurs;
        $this->date = new DateTime();
        $this->jeux = new ctlJeux();
    }

    public function getGlobalPanier()
    {
        // récupérer le panier d'un utilisateur de manière global, pour l'avoir sur toute les pages
        if (isset($_SESSION['acces'])) {
            $user = $this->user->GetUser($_SESSION['acces']);
            $panierUtilisateur = $this->panier->MesRéservations($user[0]['Id_utilisateur']);
            $SouvenirsUtilisateur = $this->panier->MesSouvenirs($user[0]['Id_utilisateur']);

            return array($panierUtilisateur, $SouvenirsUtilisateur);
        }
    }
    public function getValidPaniers($id)
    {
        // obtenir les paniers valides
        $paniers = $this->panier->getValidPanierUser($id);
        return $paniers;
    }

    public function ajouterpanier($idobjet, $qtd)
    {
        // ajouter un élément au panier
        $shop = new CtlShop;
        if ($qtd > 0) {
            // récupérer le bon utilisateur pour ajouter dans le bon panier
            $utilisateur = $this->user->GetUser($_SESSION['acces']);

            // récupérer son panier
            $panier = $this->panier->getPanierUser($utilisateur[0]['Id_utilisateur']);

            // regarder si l'utilisateur n'a pas déja l'élément dans son panier, si c'est le cas, on ajoute juste la valeur à la ligne déja présente.
            $try = $this->panier->checkexist($idobjet, $panier);
            // récupérer le stock actuel
            $stock = $this->panier->stockactuel($idobjet);
            // réduire le stock
            $reduce = $stock[0]['stock'] - $qtd;

            // si try est vide, on ajoute une nouvelle ligne a la bdd, sinon, on ajoute la valeur a la ligne déjà présente

            if (empty($try)) {
                $this->panier->addLineObj($idobjet, $panier, $qtd);
            } else {
                $nombre = $try[0]['quantitée'] + $qtd;
                $this->panier->addOne($idobjet, $panier, $nombre);
            }

            // réduire le stock

            $this->panier->reduce($reduce, $idobjet);

            // update la date de modification du panier
            $heure = $this->date->format('Y-m-d H-i-s');
            $this->panier->updateHorraire($panier, $heure);
        }

        // retourner au niveau de la page de vente
        $shop->objetsshop();
    }

    public function EnregReservation($idjeu, $jour, $nombre, $heure)
    {
        // vérifier si la réservation est pas déjà prise
        $verifReservation = $this->panier->checkReservation($idjeu, $jour, $heure);

        if (empty($verifReservation)) {
            // ajouter la réservation en récupérant le bon panier
            $getUser = $this->user->GetUser($_SESSION['acces']);
            $getPanier = $this->panier->getPanierUser($getUser[0]['Id_utilisateur']);

            // ajout de la réservation
            $this->panier->Reserver($idjeu, $jour, $nombre, $heure, $getPanier);
            // mise a jours du panier
            $heure = $this->date->format('Y-m-d H-i-s');
            $this->panier->updateHorraire($getPanier, $heure);
            $this->jeux->alljeux('<span id="reservation-added">La réservation a été ajoutée à votre panier.</span>');
        } else {
            // si le jeu a été réservé, renvoyer vers la page d'erreur
            $erreur = new ctlPage;
            $erreur->erreur("<span id='game-already-added'>Ce jeu à déjà été réservé.<span>");
        }

    }

    // suppression d'un objet du panier et remise en stock

    public function supprimerSouvenir($idobj, $idpanier, $nombredelet)
    {
        // prendre le stock et re remplir le stock faire également en sorte que si on supprime pas toute la quantitée, ca supprime pas tout ?
        $panierContent = $this->panier->getstockContIDobj($idobj, $idpanier);
        $user = new ctlUser;
        if (!empty($panierContent)) {
            // récupérer le stock actuel
            $stock = $this->panier->stockactuel($idobj);

            if ($nombredelet != '') {
                if ($panierContent[0]['quantitée'] > $nombredelet) {
                    // le nouveau stock est le stock actuel + ce que l'utilisateur avait dans le panier
                    $newstock = $stock[0]['stock'] + $nombredelet;
                    // enlever du panier le nombre supprimé 
                    $nombreadelet = $panierContent[0]['quantitée'] - $nombredelet;
                    $this->panier->reduce($newstock, $idobj);
                    $this->panier->editersouv($idobj, $idpanier, $nombreadelet);
                } else {
                    // si le nombre que l'utilisateur veut supprimer est plsu que ce qu'il a dans le panier, ca supprime juste le tout
                    $newstock = $panierContent[0]['quantitée'] + $stock[0]['stock'];
                    $this->panier->reduce($newstock, $idobj);
                    $this->panier->supprimersouv($idobj, $idpanier);
                }
                // reset tu timer panier lors de l'action utilisateur

                $heure = $this->date->format('Y-m-d H-i-s');
                $this->panier->updateHorraire($idpanier, $heure);
                // message de suppression et redirection vers les informations personelles
                $user->infoperso("<div class='err' id='deleted-cart-element'>L'élément a été supprimé du panier.</div>");
            }
            else {
                // message d'erreur
                $user->infoperso("<div class='err' id='an-error-occurred'>une erreur est survenue.</div>");
            }
        }
        else {
            // message d'erreur
            $user->infoperso("<div class='err' id='an-error-occurred'>une erreur est survenue.</div>");
        }
    }

    public function supprimerReservation($idobj, $heure, $jour)
    {
        // reset tu timer panier lors de l'action utilisateur
        $user = new ctlUser;
        $panier = $this->panier->GetPanierParRes($idobj, $heure, $jour);

        // suppriemr la reservation
        if (!empty($panier)) {
            // si elle est dans le panier, on supprime
            $this->panier->supprimerres($idobj, $heure, $jour);
            $heure = $this->date->format('Y-m-d H-i-s');
            $this->panier->updateHorraire($panier[0]['id_panier'], $heure);
            $user->infoperso("<div class='err' id='reservation-deleted-cart'>La réservation a été supprimée du panier.</div>");
        }
        else {
            // si elle y est pas, on informe l'utilisateur
            $user->infoperso("<div class='err' id='no-reservation-in-cart'>Vous n'avez pas cette réservation dans votre panier.</div>");
        }
    }

    public function reglement($erreur)
    {
        // récupérer les informations de l'utilisateur
        $infouser = $this->user->GetUser($_SESSION['acces']);
        // afficher le panier
        $panierUtilisateur = $this->panier->MesRéservations($infouser[0]['Id_utilisateur']);
        $SouvenirsUtilisateur = $this->panier->MesSouvenirs($infouser[0]['Id_utilisateur']);

        // affichage de la vue
        $vue = new vue('reglement');
        $vue->afficher(array('user' => $infouser[0], 'panier' => $panierUtilisateur, 'souvenirs' => $SouvenirsUtilisateur, 'erreur' => $erreur));
    }


    public function validerpanierall()
    {
        // récupérer les posts
        extract($_POST);

        // récupérer les informations de l'utilisateur et ses paniers
        $infouser = $this->user->GetUser($_SESSION['acces']);
        $panierUtilisateur = $this->panier->MesRéservations($infouser[0]['Id_utilisateur']);
        $SouvenirsUtilisateur = $this->panier->MesSouvenirs($infouser[0]['Id_utilisateur']);

        // récuêrer le numéro de carte et vérifier si les informations sont justes
        $nombre_num = strlen($numéro_carte);
        if ($nombre_num <= 20 && $nombre_num >= 19 && preg_match("/^(0[1-9]|1[0-2])\/\d{2}$/", $expiration) && !empty($nomUser) && preg_match("/^\d{3}$/", $numéro_de_sécurité)) {
            // math random poru savoir si on dit que y a une erreur ou pas lol
            $random = random_int(1, 100);

            if (!empty($panierUtilisateur) || !empty($SouvenirsUtilisateur)) {
                // si le panier est pas vide, on continue
                if ($random >= 10) {
                    $this->panier->validerPanier($infouser[0]['Id_utilisateur']);
                    $date = new DateTime();
                    $heure = $date->format('Y-m-d H-i-s');
                    $this->panier->creerNewPanier($infouser[0]['Id_utilisateur'], $heure);
                    $this->reglement('<div class="fixedError" id="it-work">Validation prise en compte.</div>');
                } else {
                    // une erreur survient une fois sur 10
                    $this->reglement('<div class="fixedError" id="an-error-occurred">Une erreur est survenue.</div>');
                }
            } else {
                // panier vide
                $this->reglement('<div class="fixedError" id="your-cart-is-empty">Votre panier est vide.</div>');
            }
        } else {
            // mauvaises informations rentrées
            $this->reglement('<div class="fixedError" id="wrong-informations-payement">Vos informations ne sont pas correctes.</div>');
        }
    }
}

