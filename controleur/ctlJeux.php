<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/modeles/jeux.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/vues/vue.class.php';


class ctlJeux
{
    // définir une clé privée
    private $jeu;


    public function __construct()
    {
        $this->jeu = new jeux;
    }

    // fonction poru ajouter un jeu avec tout les parametres de l'enfer 
    public function ajouterjeu($titre, $ville, $link, $desc, $min, $max, $age, $adresse, $postale, $prix, $pays, $coX, $coY, $region, $titreanglais, $descriptionanglais)
    {
        // si l'age est positif, c'est bon
        if ($age >= 0) {
            if ($min >= 0) {
                if ($postale >= 0) {
                    if ($min < $max) {
                        // si toute les conditions sont bonnes, ajouter le jeu
                        $this->jeu->ajouterjeuBDD($titre, $ville, $link, $desc, $min, $max, $age, $adresse, $postale, $prix, $pays, $coX, $coY, $region, $titreanglais, $descriptionanglais);

                        $idjeu = $this->jeu->recupJeu();

                        // ajout de la photo pour le jeu, si une image a été transmise
                        if (isset($_FILES['photoGame'])) {
                            // Vérification si le fichier ne contient pas d'erreur
                            if ($_FILES['photoGame']["error"] == 0) {
                                // Si le transfert a réussi avec une image transférée
                                $erreur = $this->jeu->enregjeuphoto($idjeu);
                                if (empty($erreur)) {
                                    $this->ajoutjeux('<div class="err" id="game-added-succes">Le jeu a bien été ajouté.</div>');
                                } else {
                                    $this->ajoutjeux($erreur);
                                }
                            } else if ($_FILES['photoGame']["error"] == 4) {
                                // Si le transfert a  réussi sans image.
                                $this->ajoutjeux("<div class='err' id='game-added-no-pics'>Le jeu à bien été ajouté, sans image d'illustration.</div>");
                            } else {
                                if ($_FILES['photoGame']["size"] <= 500000) {
                                    // Si le transfert a échoué avec un code d'erreur
                                    $erreur1 = "<div class='err' id='large-file-game-create'>Fichier trop volumineux pour enregistrer l'image, jeu ajouté.</div>";
                                    $this->ajoutjeux($erreur1);
                                } else {
                                    // Si le transfert a échoué avec un code d'erreur
                                    $erreur1 = "<div class='err' id='error-image-game-create'>Une erreur est survenue pour l'image, jeu ajouté.</div>";
                                    $this->ajoutjeux($erreur1);
                                }
                            }
                        } else {
                            // jeu ajouté sans photo
                            $this->ajoutjeux("<div class='err' id='game-added-no-pics'>le jeu à bien été ajouté, sans image d'illustration.</div>");
                        }
                    } else {
                        // pas de minimum plsu petit que le max, ou égal
                        $this->ajoutjeux("<div class='err' id='dumb-error'>Vous ne pouvez pas mettre un minimum plus petit ou égal à un maximum.</div>");
                    }
                } else {
                    // code postal non négatif
                    $this->ajoutjeux("<div class='err' id='code-postal-wrong'>Le code postal ne peut pas être négatif.</div>");
                }
            } else {
                // pas de minimum négatif
                $this->ajoutjeux("<div class='err' id='wrong-minimum'>Le minimum ne peut pas être négatif.</div>");
            }
        } else {
            // sinon, message erreur
            $this->ajoutjeux("<div class='err' id='wrong-age'>Vous ne pouvez pas entrer une valeur négative pour l'age.</div>");
        }
    }

    // récupérer tout les jeux et les afficher sur la page des jeux.
    public function alljeux($erreur = ""): void
    {
        $jeux = $this->jeu->getjeux();
        $vue = new vue('games');
        $vue->afficher(array("jeux" => $jeux, "erreur" => $erreur));
    }

    // page d'ajout de jeu

    public function ajoutjeux($erreur)
    {
        $jeux = $this->jeu->getjeux();
        $vue = new vue('ajoutjeu');
        $vue->afficher(array('erreur' => $erreur, 'jeux' => $jeux));
    }

    // fonction pour supprimer un jeu

    public function supprimerjeu($jeu)
    {
        $this->jeu->supprjeu($jeu);
        $this->ajoutjeux("<div class='err' id='deleted-game'>Le jeu a bien été supprimé.</div>");
    }

    // page de modification jeu jeu avec en parametre l'id du jeu choisi à afficher
    public function modifjeu($idjeu)
    {
        $jeu = $this->jeu->getJeuSingle($idjeu);
        $vue = new vue('modifjeu');
        $vue->afficher(array("jeu" => $jeu));
    }

    // enregistre les modifications que l'utilisateur souhaite apporter, puis les enregistre.

    public function enregistrerModif($id, $titre, $link, $min, $max, $age, $prix, $description, $ville, $region, $adresse, $postale, $pays, $coX, $coy, $titreanglais, $descriptionanglais)
    {
        // si l'age est positif, c'est bon
        if ($age >= 0) {
            if ($min >= 0) {
                if ($postale >= 0) {
                    if ($min < $max) {
                        $this->jeu->enregModifJeu($id, $titre, $link, $min, $max, $age, $prix, $description, $ville, $region, $adresse, $postale, $pays, $coX, $coy, $titreanglais, $descriptionanglais);
                        if (isset($_FILES['photoGame'])) {
                            // Vérification si le fichier ne contient pas d'erreur
                            if ($_FILES['photoGame']["error"] == 0) {
                                // Si le transfert a réussi avec une image transférée
                                $erreur = $this->jeu->enregjeuphoto($id);
                                if (empty($erreur)) {
                                    $this->ajoutjeux("<div class='err'><span id='edited-game'>Le jeu à bien été modifié.</span></div>");
                                } else {
                                    $this->ajoutjeux($erreur);
                                }
                            } else if ($_FILES['photoGame']["error"] == 4) {
                                // Si le transfert a  réussi sans image.
                                $this->ajoutjeux("<div class='err'><span id='edited-game'>le jeu à bien été modifié.</span></div>");
                            } else {
                                if ($_FILES['photoGame']["size"] <= 500000) {
                                    // Si le transfert a échoué avec un code d'erreur
                                    $erreur1 = "<div class='err'><span id='file-to-large-game-edited'>Fichier trop volumineux pour enregistrer l'image, jeu modifié.</span></div>";
                                    $this->ajoutjeux($erreur1);
                                } else {
                                    // Si le transfert a échoué avec un code d'erreur
                                    $erreur1 = "<div class='err'><span id='error-only-image'>Une erreur est survenue pour l'image, jeu modifié.</span></div>";
                                    $this->ajoutjeux($erreur1);
                                }
                            }
                        } else {
                            $this->ajoutjeux("<div class='err'><span id='edited-game'>le jeu à bien été modifié.</span></div>");
                        }
                    } else {
                        // pas de minimum plsu petit que le max, ou égal
                        $this->ajoutjeux("<div class='err' id='dumb-error'>Vous ne pouvez pas mettre un minimum plus petit ou égal à un maximum.</div>");
                    }
                } else {
                    // code postal non négatif
                    $this->ajoutjeux("<div class='err' id='code-postal-wrong'>Le code postal ne peut pas être négatif.</div>");
                }
            } else {
                // pas de minimum négatif
                $this->ajoutjeux("<div class='err' id='wrong-minimum'>Le minimum ne peut pas être négatif.</div>");
            }
        } else {
            // sinon, message erreur
            $this->ajoutjeux("<div class='err' id='wrong-age'>Vous ne pouvez pas entrer une valeur négative pour l'age.</div>");
        }
    }


    // obtenir le jeu individuellement 
    public function jeuxsingle($idjeu)
    {
        $jeu = $this->jeu->getjeu($idjeu);
        $recup = $this->jeu->getReservation();

        $vue = new vue('jeusolo');
        $vue->afficher(array('jeu' => $jeu, 'recup' => $recup));
    }

    // afficher la carte et récupérer les lieux

    public function spots()
    {
        // avoir les lieux et les villes pour afficher les lieux sur la carte et par régions
        $jeux = $this->jeu->getjeux();
        $regions = $this->jeu->getVilles();

        $vue = new vue('carte');
        $vue->afficher(array('jeux' => $jeux, 'regions' => $regions));
    }
}