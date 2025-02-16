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
}