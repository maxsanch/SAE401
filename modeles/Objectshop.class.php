<?php


require_once $_SERVER['DOCUMENT_ROOT']."/modeles/database.class.php";


class shop extends database {
    // récupérer les objets du shop
    public function récupérerobj(){
        $req = "SELECT * FROM objet_shop";

        return $this->execReq($req);
    }
}