<?php

require_once "modeles/database.class.php";

class employes extends database{

    public function getEmployes(){
        $req = "SELECT * FROM employés";

        return $this->execReq($req);
    }
}