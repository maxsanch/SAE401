<?php

require_once "modeles/database.class.php";

class utilisateurs extends database
{
    public function GetUser($mail)
    {
        // Création d'un tableau de données avec l'ID de l'utilisateur
        $data = array($mail);

        // Requête SQL pour sélectionner tous les champs de l'utilisateur avec un email spécifique
        $req = 'SELECT * from utilisateurs WHERE mail = ?';

        // Exécution de la requête préparée
        $user = $this->execReqPrep($req, $data);

        // Retourne l'utilisateur trouvé
        return $user;
    }

    public function GetUserbyID($mail)
    {
        // Création d'un tableau de données avec l'ID de l'utilisateur
        $data = array($mail);

        // Requête SQL pour sélectionner tous les champs de l'utilisateur avec un email spécifique
        $req = 'SELECT * from utilisateurs WHERE Id_utilisateur = ?';

        // Exécution de la requête préparée
        $user = $this->execReqPrep($req, $data);

        // Retourne l'utilisateur trouvé
        return $user[0];
    }

    // obtenir toute les informations sur les utilisateurs

    public function getallUser()
    {
        $req = "SELECT * FROM utilisateurs";

        return $this->execReq($req);
    }

    // update la photo d'un utilisateur

    public function updateUserPhoto($idArt)
    {

        // si l'image existe, on la supprime

        if (file_exists('img/user/' . $idArt . '.jpg')) {
            unlink('img/user/' . $idArt . '.jpg');
        }
        if (file_exists('img/user/' . $idArt . '.png')) {
            unlink('img/user/' . $idArt . '.png');
        }

        $infosfichier = new SplFileInfo($_FILES['photoUser']['name']);
        $extension_upload = $infosfichier->getExtension();

        // Liste des extensions autorisées
        $extensions_autorisees = array('jpg', 'png');

        // Vérification si l'extension du fichier est autorisée
        if (in_array($extension_upload, $extensions_autorisees)) {

            foreach ($extensions_autorisees as $test) {
                $exister = 'img/user/' . $idArt . '.' . $test;

                if (file_exists($test)) {
                    unlink($test);
                }
            }
            // Vérification si le dossier 'img/user' existe
            if (is_dir('img/user')) {
                // Déplacement du fichier vers le dossier "img/user" avec un nom basé sur l'ID de l'article
                move_uploaded_file(
                    $_FILES['photoUser']['tmp_name'],
                    'img/user/' . $idArt . "." . $extension_upload
                );
            } else {
                // Si le dossier n'existe pas, le créer et déplacer le fichier
                mkdir('img/user');
                move_uploaded_file(
                    $_FILES['photoUser']['tmp_name'],
                    'img/user/' . $idArt . "." . $extension_upload
                );
            }
        } else {
            // l'extension est pas acceptée
            $erreur = "<div class='err' id='not-allowed-extension'>Cette extension n'est pas acceptée.</div>";
            return $erreur;
        }
    }

    // supprimer un utilisateur

    public function deletuser($id)
    {
        $data = array($id);

        $req = "DELETE FROM utilisateurs WHERE `utilisateurs`.`Id_utilisateur` = ?;";

        $this->execReqPrep($req, $data);
    }

    // suppriemr un panier

    public function deletpanier($id)
    {
        $data = array($id);

        $req = "DELETE FROM panier WHERE `panier`.`id_utilisateur` = ?;";

        $this->execReqPrep($req, $data);
    }

    // chanegr le password admin
    public function changepasswordadmin($id, $mdphash)
    {
        $data = array($mdphash, $id);
        // Requête SQL pour mettre à jour le mot de passe d'un utilisateur
        $req = "UPDATE `utilisateurs` SET `mdp` = ? WHERE `utilisateurs`.`Id_utilisateur` = ?;";

        // Exécution de la requête
        $this->execReqPrep($req, $data);
    }

    // Fonction pour modifier les informations d'un utilisateur avec changement de mot de passe
    public function edituserwithpdw($nom, $prenom, $adresse, $mdpgood, $iduser)
    {
        $data = array($prenom, $nom, $adresse, $mdpgood, $iduser);
        // Requête SQL pour mettre à jour les informations d'un utilisateur
        $req = "UPDATE `utilisateurs` SET `Prenom` = ?, `Nom` = ?, `adresse` = ?, `mdp` = ? WHERE `utilisateurs`.`Id_utilisateur` = ?;";

        // Exécution de la requête
        $this->execReqPrep($req, $data);
    }

    // Fonction pour modifier les informations d'un utilisateur sans changer le mot de passe
    public function editusernopdw($nom, $prenom, $adresse, $iduser)
    {

        $data = array($prenom, $nom, $adresse, $iduser);
        // Requête SQL pour mettre à jour les informations d'un utilisateur
        $req = "UPDATE `utilisateurs` SET `prenom` = ?, `nom` = ?, `adresse` = ? WHERE `utilisateurs`.`Id_utilisateur` = ?;";

        // Exécution de la requête
        $this->execReqPrep($req, $data);
    }

}