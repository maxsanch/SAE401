<?php

require_once "modeles/database.class.php";

class panier extends database {

    public function getallpanier(){
        $req = "SELECT * FROM panier WHERE statut = 'validé'";

        return $this->execReq($req);
    }

    public function getValidPanierUser($id){
        $data = array($id);
        $req = "SELECT * FROM panier WHERE id_utilisateur = ? AND statut = 'validé';";

        return $this->execReqPrep($req, $data);
    }

    public function getPanierUser($iduser){
        $data = array($iduser);
        $req = "SELECT id_panier FROM panier WHERE id_utilisateur = ? AND statut = 'en cours';";


        $panier = $this->execReqPrep($req, $data);
        return $panier[0]['id_panier'];
    }


    public function checkexist($idobj, $idpanier){
        $data = array($idobj, $idpanier);

        $req = "SELECT * FROM contenir WHERE id_objet_shop = ? AND id_panier = ?;";
        
        return $this->execReqPrep($req, $data);
    }

    public function addLineObj($idobjet, $panier, $qtd){
        $data = array($idobjet, $panier, $qtd);

        $req = "INSERT INTO `contenir` (`id_objet_shop`, `id_panier`, `quantitée`) VALUES (?, ?, ?);";
        
        return $this->execReqPrep($req, $data);
    }

    public function addOne($idobjet, $panier, $nombre){
        $data = array($nombre, $idobjet, $panier);

        $req = "UPDATE `contenir` SET `quantitée` = ? WHERE `contenir`.`id_objet_shop` = ? AND `contenir`.`id_panier` = ?;";
        
        return $this->execReqPrep($req, $data);
    }

    public function stockactuel($idobjet){
        $data = array($idobjet);

        $req = "SELECT stock FROM objet_shop WHERE id_objet_shop = ?";
        
        return $this->execReqPrep($req, $data);
    }

    public function reduce($reduce, $idobj){
        $data = array($reduce, $idobj);

        $req = "UPDATE `objet_shop` SET `stock` = ? WHERE `objet_shop`.`id_objet_shop` = ?";
        
        return $this->execReqPrep($req, $data);
    }

    public function Reserver($idjeu, $jour, $nombre, $heure, $idpanier){
        $data = array($idjeu, $idpanier, $jour, $heure, $nombre);

        $req = "INSERT INTO `réserver` (`ID_jeu`, `id_panier`, `jour_reservation`, `heure_reservation`, `nombre_personnes`) VALUES (?, ?, ?, ?, ?);";
        
        return $this->execReqPrep($req, $data);
    }

    public function MesRéservations($idUser){
        $data = array($idUser);

        $req = "SELECT panier.id_panier as 'panier', nombre_personnes, jeux.Titre, jeux.prix, jeux.description, réserver.jour_reservation, réserver.heure_reservation FROM panier INNER JOIN réserver ON réserver.id_panier=panier.id_panier INNER JOIN jeux ON jeux.ID_jeu = réserver.ID_jeu WHERE panier.id_utilisateur = ?;";

        return $this->execReqPrep($req, $data);
    }
}