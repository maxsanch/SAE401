<?php

require_once "modeles/database.class.php";

class utilisateurs extends database {
    public function GetUser($iduser)
    {
        // Création d'un tableau de données avec l'ID de l'utilisateur
        $data = array($iduser);

        // Requête SQL pour sélectionner tous les champs de l'utilisateur avec un email spécifique
        $req = 'SELECT * from utilisateurs WHERE mail = ?';

        // Exécution de la requête préparée
        $user = $this->execReqPrep($req, $data);

        // Retourne l'utilisateur trouvé
        return $user;
    }

    
}