<?php

require_once "vues/vue.class.php";
require_once "modeles/Objectshop.class.php";


class CtlShop
{
    private $ctlshop;

    public function __construct()
    {
        $this->ctlshop = new shop;
    }

    public function objetsshop()
    {
        $objets = $this->ctlshop->récupérerobj();
        $vue = new vue('shop');
        $vue->afficher(array('objets' => $objets));
    }
}