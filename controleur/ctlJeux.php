<?php

require_once 'modeles/jeux.class.php';
require_once 'modeles/lieux.class.php';
require_once 'vues/vue.class.php';


class ctlJeux{
    private $jeu;

    private $ville;

    public function __construct(){
        $this->jeu = new jeux;
        $this->ville = new ville;
    }

    public function ajouterjeu($titre, $lieu, $mail, $link, $desc, $min, $max, $adresse, $postale){
        $this->jeu->ajouterBDD($titre, $lieu, $mail, $link, $desc);
        $idjeu = $this->jeu->recupJeu();
        $this->jeu->enregjeuphoto($idjeu);
        header('Location: index.php');
    }
}