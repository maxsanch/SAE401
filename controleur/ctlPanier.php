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
        $this->panier = new panier;
        $this->user = new utilisateurs;
        $this->date = new DateTime();
        $this->jeux = new ctlJeux();
    }

    public function getGlobalPanier()
    {
        if (isset($_SESSION['acces'])) {
            $user = $this->user->GetUser($_SESSION['acces']);
            $panierUtilisateur = $this->panier->MesRéservations($user[0]['Id_utilisateur']);
            $SouvenirsUtilisateur = $this->panier->MesSouvenirs($user[0]['Id_utilisateur']);

            return array($panierUtilisateur, $SouvenirsUtilisateur);
        }
    }
    public function getValidPaniers($id)
    {
        $paniers = $this->panier->getValidPanierUser($id);
        return $paniers;
    }

    public function ajouterpanier($idobjet, $qtd)
    {
        $shop = new CtlShop;
        if ($qtd > 0) {
            $utilisateur = $this->user->GetUser($_SESSION['acces']);

            $panier = $this->panier->getPanierUser($utilisateur[0]['Id_utilisateur']);

            $try = $this->panier->checkexist($idobjet, $panier);
            $stock = $this->panier->stockactuel($idobjet);
            $reduce = $stock[0]['stock'] - $qtd;


            if (empty($try)) {
                $this->panier->addLineObj($idobjet, $panier, $qtd);
            } else {
                $nombre = $try[0]['quantitée'] + $qtd;
                $this->panier->addOne($idobjet, $panier, $nombre);
            }

            $this->panier->reduce($reduce, $idobjet);

            $heure = $this->date->format('Y-m-d H-i-s');
            $this->panier->updateHorraire($panier, $heure);
        }


        $shop->objetsshop();
    }

    public function EnregReservation($idjeu, $jour, $nombre, $heure)
    {
        $verifReservation = $this->panier->checkReservation($idjeu, $jour, $heure);

        if (empty($verifReservation)) {
            $getUser = $this->user->GetUser($_SESSION['acces']);
            $getPanier = $this->panier->getPanierUser($getUser[0]['Id_utilisateur']);

            $this->panier->Reserver($idjeu, $jour, $nombre, $heure, $getPanier);
            $heure = $this->date->format('Y-m-d H-i-s');
            $this->panier->updateHorraire($getPanier, $heure);
            $this->jeux->alljeux('<span id="reservation-added">La réservation a été ajoutée à votre panier.</span>');
        } else {
            $erreur = new ctlPage;
            $erreur->erreur("<span id='game-already-added'>Ce jeu à déjà été réservé.<span>");
        }

    }

    public function supprimerSouvenir($idobj, $idpanier, $nombredelet)
    {
        // prendre le stock et re remplir le stock faire également en sorte que si on supprime pas toute la quantitée, ca supprime pas tout ?
        $panierContent = $this->panier->getstockContIDobj($idobj, $idpanier);
        $user = new ctlUser;
        if (!empty($panierContent)) {
            $stock = $this->panier->stockactuel($idobj);

            if ($nombredelet != '') {
                if ($panierContent[0]['quantitée'] > $nombredelet) {
                    $newstock = $stock[0]['stock'] + $nombredelet;
                    $nombreadelet = $panierContent[0]['quantitée'] - $nombredelet;
                    $this->panier->reduce($newstock, $idobj);
                    $this->panier->editersouv($idobj, $idpanier, $nombreadelet);
                } else {
                    $newstock = $panierContent[0]['quantitée'] + $stock[0]['stock'];
                    $this->panier->reduce($newstock, $idobj);
                    $this->panier->supprimersouv($idobj, $idpanier);
                }
                // reset tu timer panier lors de l'action utilisateur

                $heure = $this->date->format('Y-m-d H-i-s');
                $this->panier->updateHorraire($idpanier, $heure);

                $user->infoperso("<div class='err' id='deleted-cart-element'>L'élément a été supprimé du panier.</div>");
            }
            else {
                $user->infoperso("<div class='err' id='an-error-occurred'>une erreur est survenue.</div>");
            }
        }
        else {
            $user->infoperso("<div class='err' id='an-error-occurred'>une erreur est survenue.</div>");
        }
    }

    public function supprimerReservation($idobj, $heure, $jour)
    {
        // reset tu timer panier lors de l'action utilisateur
        $user = new ctlUser;
        $panier = $this->panier->GetPanierParRes($idobj, $heure, $jour);

        if (!empty($panier)) {
            $this->panier->supprimerres($idobj, $heure, $jour);
            $heure = $this->date->format('Y-m-d H-i-s');
            $this->panier->updateHorraire($panier[0]['id_panier'], $heure);
            $user->infoperso("<div class='err' id='reservation-deleted-cart'>La réservation a été supprimée du panier.</div>");
        } else {
            $user->infoperso("<div class='err' id='no-reservation-in-cart'>Vous n'avez pas cette réservation dans votre panier.</div>");
        }
    }

    public function reglement($erreur)
    {
        $infouser = $this->user->GetUser($_SESSION['acces']);
        $panierUtilisateur = $this->panier->MesRéservations($infouser[0]['Id_utilisateur']);
        $SouvenirsUtilisateur = $this->panier->MesSouvenirs($infouser[0]['Id_utilisateur']);

        $vue = new vue('reglement');
        $vue->afficher(array('user' => $infouser[0], 'panier' => $panierUtilisateur, 'souvenirs' => $SouvenirsUtilisateur, 'erreur' => $erreur));
    }


    public function validerpanierall()
    {
        extract($_POST);

        $infouser = $this->user->GetUser($_SESSION['acces']);
        $panierUtilisateur = $this->panier->MesRéservations($infouser[0]['Id_utilisateur']);
        $SouvenirsUtilisateur = $this->panier->MesSouvenirs($infouser[0]['Id_utilisateur']);

        $nombre_num = strlen($numéro_carte);
        if ($nombre_num <= 20 && $nombre_num >= 19 && preg_match("/^(0[1-9]|1[0-2])\/\d{2}$/", $expiration) && !empty($nomUser) && preg_match("/^\d{3}$/", $numéro_de_sécurité)) {

            $random = random_int(1, 100);

            if (!empty($panierUtilisateur) || !empty($SouvenirsUtilisateur)) {
                if ($random >= 10) {
                    $this->panier->validerPanier($infouser[0]['Id_utilisateur']);
                    $date = new DateTime();
                    $heure = $date->format('Y-m-d H-i-s');
                    $this->panier->creerNewPanier($infouser[0]['Id_utilisateur'], $heure);
                    $this->reglement('<div class="fixedError" id="it-work">Validation prise en compte.</div>');
                } else {
                    $this->reglement('<div class="fixedError" id="an-error-occurred">Une erreur est survenue.</div>');
                }
            } else {
                $this->reglement('<div class="fixedError" id="your-cart-is-empty">Votre panier est vide.</div>');
            }
        } else {
            $this->reglement('<div class="fixedError" id="wrong-informations-payement">Vos informations ne sont pas correctes.</div>');
        }
    }
}

