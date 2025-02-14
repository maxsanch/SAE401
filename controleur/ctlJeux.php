<?php

require_once 'modeles/jeux.class.php';

require_once 'vues/vue.class.php';


class ctlJeux{
    private $jeu;

    public function __construct(){
        $this->jeu = new jeux();
    }
}