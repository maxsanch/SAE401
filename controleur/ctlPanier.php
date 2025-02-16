<?php

require_once "modeles/panier.class.php";


class ctlPanier{
    private $panier;

    public function __construct(){
        $this->panier = new panier;
    }
    public function getValidPaniers($id){
        $paniers = $this->panier->getValidPanierUser($id);

        return $paniers;
    }
}