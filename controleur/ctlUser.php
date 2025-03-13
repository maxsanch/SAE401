<?php

require_once "modeles/utilisateurs.class.php";
require_once "modeles/panier.class.php";
require_once "modeles/inscription.class.php";
require_once "vues/vue.class.php";

class ctlUser
{

    private $users;

    private $panierUser;
    private $inscription;

    public function __construct()
    {
        $this->users = new utilisateurs;
        $this->panierUser = new panier;
        $this->inscription = new inscription;
    }

    public function users()
    {
        $userget = $this->users->GetUser($_SESSION['acces']);
        return $userget;
    }

    public function RecupererUser()
    {
        return $this->users->GetUser($_SESSION['acces'])[0];
    }

    public function checkusers($erreur = "")
    {
        $Inscr = $this->users->getallUser();
        $compteInscr = count($Inscr);

        // récupérer les paniers validés
        $paniers = $this->panierUser->getallpanier();
        $comptepanier = count($paniers);
        $nombreparmois = $this->inscription->getallmois();

        $meilleurRes = $this->panierUser->getBestRes();
        $meilleurSouv = $this->panierUser->getBestSouv();

        $vue = new vue('dashboard');
        $vue->afficher(array('comptepanier' => $comptepanier, 'compteinscrit' => $compteInscr, 'users' => $Inscr, 'nombreparmois' => $nombreparmois, 'meilleurRes' => $meilleurRes, 'meilleurSouv' => $meilleurSouv, 'erreur' => $erreur));
    }

    public function modifuser($id, $message)
    {
        $userchoose = $this->users->GetUserbyID($id);
        $anciensPaniers = $this->panierUser->getValidPanierUser($id);

        $vue = new vue('modifuser');
        $vue->afficher(array('user' => $userchoose, 'message' => $message, 'anciensPaniers' => $anciensPaniers));
    }


    public function EnregPhotoUser($idUser)
    {
        $erreur = "";
        if (isset($_FILES['photoUser'])) {
            // Vérification si le fichier ne contient pas d'erreur
            if ($_FILES['photoUser']["error"] == 0) {
                $erreur = $this->users->updateUserPhoto($idUser);
                if (empty($erreur)) {
                    $erreur = "<div class='err' id='modified-profil-picture'>Photo de profil modifiée.</div>";
                }
            } else if ($_FILES['photoUser']["error"] == 4) {
                // Si le transfert a  réussi sasn image.
                $erreur = "<div class='err' id='no-images-selected-profil'>Aucune image selectionée.</div>";
            } else {
                if ($_FILES['photoUser']["size"] <= 500000) {
                    // Si le transfert a échoué avec un code d'erreur
                    $erreur = "<div class='err' id='File-to-large-profil'>Fichier trop volumineux pour enregistrer l'image.</div>";
                } else {
                    // Si le transfert a échoué avec un code d'erreur
                    $erreur = "<div class='err' id='an-error-occurred'>Une erreur est survenue.</div>";
                }
            }
        } else {
            $erreur = "<div class='err' id='no-images-selected-profil'>Aucune image n'a été selectionnée.</div>";
        }

        $this->checkusers($erreur);
    }

    public function changerpdp()
    {
        $user = $this->users->GetUser($_SESSION['acces']);

        $erreur = "";
        if (isset($_FILES['photoUser'])) {
            // Vérification si le fichier ne contient pas d'erreur
            if ($_FILES['photoUser']["error"] == 0) {
                $erreur = $this->users->updateUserPhoto($user[0]['Id_utilisateur']);
                if (empty($erreur)) {
                    $erreur = "<div class='err' id='modified-profil-picture'>photo de profil modifiée.</div>";
                }
            } else if ($_FILES['photoUser']["error"] == 4) {
                // Si le transfert a  réussi sasn image.
                $erreur = "<div class='err' id='no-images-selected-profil'>Aucune image selectionée.</div>";
            } else {
                if ($_FILES['photoUser']["size"] <= 500000) {
                    // Si le transfert a échoué avec un code d'erreur
                    $erreur = "<div class='err' id='File-to-large-profil'>Fichier trop volumineux pour enregistrer l'image.</div>";
                } else {
                    // Si le transfert a échoué avec un code d'erreur
                    $erreur = "<div class='err' id='an-error-occurred'>Une erreur est survenue.</div>";
                }
            }
        } else {
            $erreur = "<div class='err' id='no-images-selected-profil'>Aucune image n'a été selectionnée.</div>";
        }

        $this->infoperso($erreur);
    }


    public function supprimerCompte($id)
    {
        $this->users->deletuser($id);
        $panier = $this->panierUser->getPaniers($id);
        // supprimer les liaisons dans les tables contenir et réserver.
        foreach ($panier as $ligne) {
            $this->panierUser->deletContenir($ligne['id_panier']);
            $this->panierUser->deletReserver($ligne['id_panier']);
        }

        $this->users->deletpanier($id);

        $this->checkusers("<div class='err' id='deleted-user-success'>L'utilisateur à bien été supprimé.</div>");
    }

    public function modifiermdp($id, $mdp1, $mdp2)
    {
        if (!empty($mdp1) && !empty($mdp2)) {
            if ($mdp1 == $mdp2) {
                // nouveau mot de passe
                $mdphash = password_hash($mdp1, PASSWORD_DEFAULT);
                // edit password de l'utilisateur
                $this->users->changepasswordadmin($id, $mdphash);
                $message = "<div class='err' id='success-edited-pwd'>Le mot de passe à bien été modifié.</div>";
            } else {
                // erreur si les deux mots de passe (les nouveaux) ne sont pas les mêmes
                $message = "<div class='err' id='doesnt-match-pwd'>Les mots de passes ne correspondent pas.</div>";
            }

        } else {
            // erreur
            $message = "<div class='err' id='null-pwd'>Le mot de passe entré est vide.</div>";
        }

        $this->modifuser($id, $message);
    }

    public function infoperso($e)
    {
        $infouser = $this->users->GetUser($_SESSION['acces']);
        $panierUtilisateur = $this->panierUser->MesRéservations($infouser[0]['Id_utilisateur']);
        $SouvenirsUtilisateur = $this->panierUser->MesSouvenirs($infouser[0]['Id_utilisateur']);
        $anciensPaniers = $this->panierUser->getValidPanierUser($infouser[0]['Id_utilisateur']);

        $vue = new vue('infos_perso');
        $vue->afficher(array('user' => $infouser[0], 'panier' => $panierUtilisateur, 'souvenirs' => $SouvenirsUtilisateur, 'erreur' => $e, 'anciensPaniers' => $anciensPaniers));
    }

    public function deletMyAccount()
    {
        $id = $this->users->GetUser($_SESSION['acces']);
        $this->users->deletuser($id[0]['Id_utilisateur']);
        $panier = $this->panierUser->getPaniers($id[0]['Id_utilisateur']);
        // supprimer les liaisons dans les tables contenir et réserver.
        foreach ($panier as $ligne) {
            $this->panierUser->deletContenir($ligne['id_panier']);
            $this->panierUser->deletReserver($ligne['id_panier']);
        }

        $this->users->deletpanier($id[0]['Id_utilisateur']);

        // suppression de la session et des cookies de ce dernier
        session_destroy();
        setcookie(session_name(), '', time() - 1, "/");
        header('Location: index.php');
    }

    public function editprofil($nom, $prenom, $adresse, $newpassword, $confirm, $ancienpdw)
    {
        $user = $this->users->GetUser($_SESSION['acces']);

        if (!empty($user)) {
            // regarder si le password est juste pour changer les infos
            if (password_verify($ancienpdw, $user[0]['mdp'])) {
                // regarder si le nom change ou le mot de passe ou les deux
                if (!empty($newpassword) && !empty($confirm)) {
                    if ($newpassword == $confirm) {
                        if (!empty($nom) && !empty($prenom) && !empty($adresse)) {
                            $mdpgood = password_hash($newpassword, PASSWORD_DEFAULT);
                            // changer le nom de l'utilisateur 
                            $this->users->edituserwithpdw($nom, $prenom, $adresse, $mdpgood, $user[0]['Id_utilisateur']);
                            $erreur = "<div class='err' id='edited-info-user'>Vos informations ont été mises à jour.</div>";
                            $this->infoperso($erreur);
                        } else {
                            // erreur
                            $erreur = '<div class="err" id="empty-inputs">Veuillez remplir tout les champs pour modifier.</div>';
                            $this->infoperso($erreur);
                        }
                    } else {
                        // erreur
                        $erreur = "<div class='err' id='doesnt-match-pwd'>les mots de passes ne correspondent pas.</div>";
                        $this->infoperso($erreur);
                    }
                } else {

                    if (!empty($nom) && !empty($prenom)) {
                        // changer le mot de passe
                        $mdpgood = password_hash($newpassword, PASSWORD_DEFAULT);
                        $this->users->editusernopdw($nom, $prenom, $adresse, $user[0]['Id_utilisateur']);
                        $erreur = "<div class='err' id='edited-info-user'>vos informations ont été mises à jour.</div>";
                        $this->infoperso($erreur);
                    } else {
                        $erreur = '<div class="err" id="empty-inputs">veuillez remplir tout les champs pour modifier.</div>';
                        $this->infoperso($erreur);
                    }
                }
            } else {
                $erreur = '<div class="err" id="wrong-pwd">Mot de passe incorrecte.</div>';
                $this->infoperso($erreur);
            }
        } else {
            $erreur = '<div class="err" id="user-cant-be-found">Impossible de trouver cet utilisateur.</div>';
            $this->infoperso($erreur);
        }
    }
}