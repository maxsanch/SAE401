<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/modeles/jeux.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/vues/vue.class.php';


class ctlJeux{
    private $jeu;


    public function __construct(){
        $this->jeu = new jeux;
    }

    public function ajouterjeu($titre, $ville, $link, $desc, $min, $max, $age, $adresse, $postale, $prix, $pays, $coX, $coY){
        $this->jeu->ajouterjeuBDD($titre, $ville, $link, $desc, $min, $max, $age, $adresse, $postale, $prix, $pays, $coX, $coY);
        $idjeu = $this->jeu->recupJeu();
        $this->jeu->enregjeuphoto($idjeu);
        $this->ajoutjeux("le jeu à bien été ajouté.");
    }

    public function alljeux(): void{
        $jeux = $this->jeu->getjeux();
        $vue = new vue('games');
        $vue->afficher(array("jeux" => $jeux));
    }

    public function ajoutjeux($erreur){
        $jeux = $this->jeu->getjeux();
        $vue = new vue('ajoutjeu');
        $vue->afficher(array('erreur' => $erreur, 'jeux' => $jeux));
    }

    public function supprimerjeu($jeu){
        $this->jeu->supprjeu($jeu);
        $this->ajoutjeux("le jeu à bien été supprimé");
    }

    public function modifjeu($idjeu){
        $jeu = $this->jeu->getJeuSingle($idjeu);
        $vue = new vue('modifjeu');
        $vue->afficher(array("jeu" => $jeu));
    }

    public function enregistrerModif($id, $titre, $ville, $mail, $link, $description, $min, $max, $age, $adresse, $postale){
        $this->jeu->enregModifJeu($id, $titre, $ville, $mail, $link, $description, $min, $max, $age, $adresse, $postale);
        $this->jeu->enregjeuphoto($id);
        $this->ajoutjeux("le jeu à bien été modifié.");
    }

    public function jeuxsingle($idjeu){
        $jeu = $this->jeu->getjeu($idjeu);
        $recup = $this->jeu->getReservation();

        $vue = new vue('jeusolo');
        $vue->afficher(array('jeu' => $jeu, 'recup' => $recup));
    }

    public function spots(){
        $vue = new vue('carte');
        $vue->afficher(array());
    }
}