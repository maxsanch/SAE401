<?php

require_once "modeles/utilisateurs.class.php";
require_once "modeles/panier.class.php";
require_once "vues/vue.class.php";

class ctlUser
{

    private $users;

    private $panierUser;

    public function __construct()
    {
        $this->users = new utilisateurs;
        $this->panierUser = new panier;
    }

    public function users()
    {
        $userget = $this->users->GetUser($_SESSION['acces']);

        return $userget;
    }

    public function checkusers()
    {
        $Inscr = $this->users->getallUser();
        $compteInscr = count($Inscr);

        // récupérer les paniers validés
        $paniers = $this->panierUser->getallpanier();
        $comptepanier = count($paniers);

        $vue = new vue('dashboard');
        $vue->afficher(array('comptepanier' => $comptepanier, 'compteinscrit' => $compteInscr, 'users' => $Inscr));
    }

    public function modifuser($id, $message)
    {
        $userchoose = $this->users->GetUserbyID($id);

        $vue = new vue('modifuser');
        $vue->afficher(array('user' => $userchoose, 'message' => $message));
    }


    public function EnregPhotoUser($idUser)
    {
        $this->users->updateUserPhoto($idUser);
        $this->checkusers();
    }

    public function changerpdp()
    {
        $user = $this->users->GetUser($_SESSION['acces']);
        $this->users->updateUserPhoto($user[0]['Id_utilisateur']);
        $this->infoperso();
    }


    public function supprimerCompte($id)
    {
        $this->users->deletuser($id);
        $this->users->deletpanier($id);
        $this->checkusers();
    }

    public function modifiermdp($id, $mdp1, $mdp2)
    {
        if (!empty($mdp1) && !empty($mdp2)) {
            if ($mdp1 == $mdp2) {
                // nouveau mot de passe
                $mdphash = password_hash($mdp1, PASSWORD_DEFAULT);
                // edit password de l'utilisateur
                $this->users->changepasswordadmin($id, $mdphash);
                $message = "Le mot de passe à bien été modifié";
            } else {
                // erreur si les deux mots de passe (les nouveaux) ne sont pas les mêmes
                $message = "Les mots de passes ne correspondent pas.";
            }

        } else {
            // erreur
            $message = "Le mot de passe entré est vide";
        }

        $this->modifuser($id, $message);
    }

    public function infoperso()
    {
        $infouser = $this->users->GetUser($_SESSION['acces']);

        $vue = new vue('infos_perso');

        $vue->afficher(array('user' => $infouser[0]));
    }

    public function deletMyAccount()
    {
        $id = $this->users->GetUser($_SESSION['acces']);
        $this->users->deletuser($id[0]['Id_utilisateur']);
        $this->users->deletpanier($id[0]['Id_utilisateur']);

        // suppression de la session et des cookies de ce dernier
        session_destroy();
        setcookie(session_name(), '', time() - 1, "/");
        header('Location: index.php');
    }
}