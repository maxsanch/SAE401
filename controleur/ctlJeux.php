<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/modeles/jeux.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vues/vue.class.php';


class ctlJeux
{
    private $jeu;


    public function __construct()
    {
        $this->jeu = new jeux;
    }

    public function ajouterjeu($titre, $ville, $link, $desc, $min, $max, $age, $adresse, $postale, $prix, $pays, $coX, $coY, $region, $titreanglais, $descriptionanglais)
    {
        if($age >= 0){
            if($min >= 0){
                if($postale >= 0){
                    if($min < $max){
                        $this->jeu->ajouterjeuBDD($titre, $ville, $link, $desc, $min, $max, $age, $adresse, $postale, $prix, $pays, $coX, $coY, $region, $titreanglais, $descriptionanglais);
        
                        $idjeu = $this->jeu->recupJeu();
                        
                        if (isset($_FILES['photoGame'])) {
                            // Vérification si le fichier ne contient pas d'erreur
                            if ($_FILES['photoGame']["error"] == 0) {
                                // Si le transfert a réussi avec une image transférée
                                $erreur = $this->jeu->enregjeuphoto($idjeu);
                                if(empty($erreur)){
                                    $this->ajoutjeux('<div class="err">le jeu a bien été ajouté.</div>');
                                }
                                else{
                                    $this->ajoutjeux($erreur);
                                }
                            } else if ($_FILES['photoGame']["error"] == 4) {
                                // Si le transfert a  réussi sasn image.
                                $this->ajoutjeux("<div class='err'>le jeu à bien été ajouté, sans image d'illustration.</div>");
                            } else {
                                if ($_FILES['photoGame']["size"] <= 500000) {
                                    // Si le transfert a échoué avec un code d'erreur
                                    $erreur1 = "<div class='err'>Fichier trop volumineux pour enregistrer l'image, jeu ajouté.</div>";
                                    $this->ajoutjeux($erreur1);
                                } else {
                                    // Si le transfert a échoué avec un code d'erreur
                                    $erreur1 = "<div class='err'>Une erreur est survenue pour l'image, jeu ajouté.</div>";
                                    $this->ajoutjeux($erreur1);
                                }
                            }
                        } else {
                            $this->ajoutjeux("<div class='err'>le jeu à bien été ajouté, sans image d'illustration.</div>");
                        }
                    }
                    else{
                        $this->ajoutjeux("<div class='err'>Vous ne pouvez pas mettre un minimum plus petit ou égal à un maximum.</div>");
                    }   
                }
                else{
                    $this->ajoutjeux("<div class='err'>Le code postal ne peut pas être négatif.</div>");
                }         
            }
            else{
                $this->ajoutjeux("<div class='err'>Le minimum ne peut pas être négatif.</div>");
            }
        }
        else{
            $this->ajoutjeux("<div class='err'>Vous ne pouvez pas entrer une valeur négative pour l'age.</div>");
        }
        
    }

    public function alljeux($erreur = ""): void
    {
        $jeux = $this->jeu->getjeux();
        $vue = new vue('games');
        $vue->afficher(array("jeux" => $jeux, "erreur" => $erreur));
    }

    public function ajoutjeux($erreur)
    {
        $jeux = $this->jeu->getjeux();
        $vue = new vue('ajoutjeu');
        $vue->afficher(array('erreur' => $erreur, 'jeux' => $jeux));
    }

    public function supprimerjeu($jeu)
    {
        $this->jeu->supprjeu($jeu);
        $this->ajoutjeux("le jeu à bien été supprimé");
    }

    public function modifjeu($idjeu)
    {
        $jeu = $this->jeu->getJeuSingle($idjeu);
        $vue = new vue('modifjeu');
        $vue->afficher(array("jeu" => $jeu));
    }

    public function enregistrerModif($id, $titre, $link, $min, $max, $age, $prix, $description, $ville, $region, $adresse, $postale, $pays, $coX, $coy, $titreanglais, $descriptionanglais)
    {
        $this->jeu->enregModifJeu($id, $titre, $link, $min, $max, $age, $prix, $description, $ville, $region, $adresse, $postale, $pays, $coX, $coy, $titreanglais, $descriptionanglais);
        if (isset($_FILES['photoGame'])) {
            // Vérification si le fichier ne contient pas d'erreur
            if ($_FILES['photoGame']["error"] == 0) {
                // Si le transfert a réussi avec une image transférée
                $erreur = $this->jeu->enregjeuphoto($id);
                if(empty($erreur)){
                    $this->ajoutjeux('le jeu a bien été modifié');
                }
                else{
                    $this->ajoutjeux($erreur);
                }

                $this->ajoutjeux("le jeu à bien été ajouté.");
            } else if ($_FILES['photoGame']["error"] == 4) {
                // Si le transfert a  réussi sasn image.
                $this->ajoutjeux("le jeu à bien été modifié.");
            } else {
                if ($_FILES['photoGame']["size"] <= 500000) {
                    // Si le transfert a échoué avec un code d'erreur
                    $erreur1 = "Fichier trop volumineux pour enregistrer l'image, jeu modifié.";
                    $this->ajoutjeux($erreur1);
                } else {
                    // Si le transfert a échoué avec un code d'erreur
                    $erreur1 = "Une erreur est survenue pour l'image, jeu modifié.";
                    $this->ajoutjeux($erreur1);
                }
            }
        } else {
            $this->ajoutjeux("le jeu à bien été modifié.");
        }
    }

    public function jeuxsingle($idjeu)
    {
        $jeu = $this->jeu->getjeu($idjeu);
        $recup = $this->jeu->getReservation();

        $vue = new vue('jeusolo');
        $vue->afficher(array('jeu' => $jeu, 'recup' => $recup));
    }

    public function spots()
    {
        $jeux = $this->jeu->getjeux();
        $regions = $this->jeu->getVilles();

        $vue = new vue('carte');
        $vue->afficher(array('jeux' => $jeux, 'regions' => $regions));
    }
}