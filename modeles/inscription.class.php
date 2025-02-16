<?php

require_once "modeles/database.class.php";


class inscription extends database {
    public function inscrire($prenom, $nom, $email, $adresse, $mdpgood)
    {
        $data = array($nom, $prenom, $email, $mdpgood, $adresse);
        // Requête SQL pour insérer un nouvel utilisateur dans la base de données
        $req = "INSERT INTO `utilisateurs` (`Id_utilisateur`, `nom`, `prenom`, `mail`, `mdp`, `adresse`, `niveau`, `connexion`, `inscription`) VALUES (NULL, ?, ?, ?, ?, ?, 'user',  '" . date('Y-m-d') . "', '" . date('Y-m-d') . "');";

        // Exécution de la requête
        $this->execReqPrep($req, $data);
    }

    public function updatedate($id)
    {
        $data = array($id);
        // Requête SQL pour mettre à jour la date de connexion de l'utilisateur avec l'ID spécifié
        $req = "UPDATE `utilisateurs` SET `connexion` = '" . date('Y-m-d') . "' WHERE `utilisateurs`.`Id_utilisateur` = ?;";

        // Exécution de la requête
        $this->execReqPrep($req, $data);
    }

    public function créerPanier($id){
        $data = array($id);
        // Requête SQL pour insérer un panier lié à un utilisateur dans la base de données
        $req = "INSERT INTO `panier` (`id_panier`, `id_utilisateur`, `statut`) VALUES (NULL, ?, 'en cours')";
        // Exécution de la requête
        $this->execReqPrep($req, $data);
    }
}