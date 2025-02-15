<?php

require_once "modeles/database.class.php";

class jeux extends database {
    
    public function ajouterBDD($titre, $lieu, $mail, $link, $desc){
        // Création d'un tableau de données avec l'ID de l'utilisateur
        $data = array($lieu, $mail, $link, $desc, $titre);

        $req = "INSERT INTO `jeux` (`ID_jeu`, `id_lieu`, `mail`, `lien_video`, `description`, `Titre`) VALUES (NULL, ?, ?, ?, ?, ?);";

        // Exécution de la requête préparée
        $this->execReqPrep($req, $data);
    }
}