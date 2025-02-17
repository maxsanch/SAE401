<?php


require_once "modeles/database.class.php";


class shop extends database {
    public function récupérerobj(){
        $req = "SELECT * FROM objet_shop";

        return $this->execReq($req);
    }
}