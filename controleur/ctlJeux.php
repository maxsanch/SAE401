<?php

require_once 'modeles/jeux.class.php';
require_once 'vues/vue.class.php';


class ctlJeux{
    private $jeu;


    public function __construct(){
        $this->jeu = new jeux;
    }

    public function ajouterjeu($titre, $ville, $mail, $link, $desc, $min, $max, $age, $adresse, $postale){
        $this->jeu->ajouterjeuBDD($titre, $ville, $mail, $link, $desc, $min, $max, $age, $adresse, $postale);
        $idjeu = $this->jeu->recupJeu();
        $this->jeu->enregjeuphoto($idjeu);
        header('Location: index.php');
    }

    public function alljeux(): void{
        $jeux = $this->jeu->getjeux();
        $vue = new vue('games');
        $vue->afficher(array("jeux" => $jeux));
    }
}