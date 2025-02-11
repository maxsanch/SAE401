<?php

require_once "modeles/database.class.php";


class inscription extends database {
    public function inscrire($prenom, $nom, $email, $adresse, $mdpgood)
    {

        $data = array($nom, $prenom, $email, $mdpgood, $adresse);
        // Requête SQL pour insérer un nouvel utilisateur dans la base de données
        $req = "INSERT INTO `utilisateurs` (`Id_utilisateur`, `nom`, `prenom`, `mail`, `mdp`, `adresse`, `id_panier`) VALUES (NULL, ?, ?, ?, ?, ?, '2');";

        // Exécution de la requête
        $this->execReqPrep($req, $data);
    }
}