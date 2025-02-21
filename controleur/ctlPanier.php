<?php

require_once "modeles/panier.class.php";
require_once "modeles/utilisateurs.class.php";
require_once "modeles/Objectshop.class.php";
require_once "controleur/ctlShop.php";

class ctlPanier
{
    private $panier;

    private $user;

    public function __construct()
    {
        $this->panier = new panier;
        $this->user = new utilisateurs;
    }

    public function getGlobalPanier(){
        if(isset($_SESSION['acces'])){
            $user = $this->user->GetUser($_SESSION['acces']);
            $panierUtilisateur = $this->panier->MesRéservations($user[0]['Id_utilisateur']);
            $SouvenirsUtilisateur = $this->panier->MesSouvenirs($user[0]['Id_utilisateur']);

            return array($panierUtilisateur, $SouvenirsUtilisateur);
        }
    }
    public function getValidPaniers($id)
    {
        $paniers = $this->panier->getValidPanierUser($id);
        return $paniers;
    }

    public function ajouterpanier($idobjet, $qtd)
    {
        $utilisateur = $this->user->GetUser($_SESSION['acces']);

        $panier = $this->panier->getPanierUser($utilisateur[0]['Id_utilisateur']);

        $try = $this->panier->checkexist($idobjet, $panier);
        $stock = $this->panier->stockactuel($idobjet);
        $reduce = $stock[0]['stock'] - $qtd;

        $shop = new CtlShop;
        if (empty($try)) {
            $this->panier->addLineObj($idobjet, $panier, $qtd);
        } else {
            $nombre = $try[0]['quantitée'] + $qtd;
            $this->panier->addOne($idobjet, $panier, $nombre);
        }

        $this->panier->reduce($reduce, $idobjet);

        $shop->objetsshop();
    }

    public function EnregReservation($idjeu, $jour, $nombre, $heure){
        $getUser = $this->user->GetUser($_SESSION['acces']);
        $getPanier = $this->panier->getPanierUser($getUser[0]['Id_utilisateur']);
        var_dump($getPanier);
        $this->panier->Reserver($idjeu, $jour, $nombre, $heure, $getPanier);
        
        header('Location: index.php?page=remerciements');
    }

    public function supprimerSouvenir($idobj, $idpanier){
        $this->panier->supprimersouv($idobj, $idpanier);

        header('Location: index.php?page=informationmyuser');
    }

    public function supprimerReservation($idobj, $heure, $jour){
        $this->panier->supprimerres($idobj, $heure, $jour);
        header('Location: index.php?page=informationmyuser');
    }
}