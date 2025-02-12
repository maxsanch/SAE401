<?php

require_once "modeles/database.class.php";


class inscription extends database {
    public function inscrire($prenom, $nom, $email, $adresse, $mdpgood)
    {
        $data = array($nom, $prenom, $email, $mdpgood, $adresse);
        // Requête SQL pour insérer un nouvel utilisateur dans la base de données
        $req = "INSERT INTO `utilisateurs` (`Id_utilisateur`, `nom`, `prenom`, `mail`, `mdp`, `adresse`, `niveau`) VALUES (NULL, ?, ?, ?, ?, ?, `user`);";

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