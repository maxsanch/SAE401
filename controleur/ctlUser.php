<?php

require_once "modeles/utilisateurs.class.php";
require_once "vues/vue.class.php";

class ctlUser{

    private $users;

    public function __construct(){
        $this->users = new utilisateurs;
    }

    public function users(){
        $userget = $this->users->GetUser($_SESSION['acces']);

        return $userget;
    }
}