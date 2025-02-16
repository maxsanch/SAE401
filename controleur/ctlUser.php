<?php

require_once "modeles/utilisateurs.class.php";
require_once "modeles/panier.class.php";
require_once "vues/vue.class.php";

class ctlUser{

    private $users;

    private $panierUser;

    public function __construct(){
        $this->users = new utilisateurs;
        $this->panierUser = new panier;
    }

    public function users(){
        $userget = $this->users->GetUser($_SESSION['acces']);

        return $userget;
    }

    public function checkusers(){
        $Inscr = $this->users->getallUser();
        $compteInscr = count($Inscr);

        // récupérer les paniers validés
        $paniers = $this->panierUser->getallpanier();
        $comptepanier = count($paniers);

        $vue = new vue('dashboard');
        $vue->afficher(array('comptepanier' => $comptepanier, 'compteinscrit' => $compteInscr, 'users' => $Inscr));
    }

    public function modifuser($id){
        $userchoose = $this->users->GetUserbyID($id);

        $vue = new vue('modifuser');
        $vue->afficher(array('user' => $userchoose));
    }

    
    public function EnregPhotoUser($idUser)
    {
        $this->users->updateUserPhoto($idUser);
        $usersingle = "";

        $this->checkusers();
    }    

}