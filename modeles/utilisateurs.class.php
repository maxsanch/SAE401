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

    public function getallUser()
    {
        $req = "SELECT * FROM utilisateurs";

        return $this->execReq($req);
    }


    public function updateUserPhoto($idArt)
    {
        // Vérification si un fichier photo a été envoyé
        if (isset($_FILES['photoUser'])) {
            // Vérification si le fichier n'a pas d'erreur
            if ($_FILES['photoUser']["error"] == 0) {
                // Vérification si la taille du fichier est inférieure à 20 Mo
                if ($_FILES['photoUser']["size"] <= 500000) {
                    // Récupération de l'extension du fichier
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
                            $erreur = "Transfert du fichier : " . ' ' . $_FILES['photoUser']['name'] . ' ' . " effectué !";
                            return $erreur;
                        } else {
                            // Si le dossier n'existe pas, le créer et déplacer le fichier
                            mkdir('img/user');
                            move_uploaded_file(
                                $_FILES['photoUser']['tmp_name'],
                                'img/user/' . $idArt . "." . $extension_upload
                            );
                            $erreur = "Transfert du fichier " . $_FILES['photoUser']['name'] . " effectué !";
                            return $erreur;
                        }
                    } else {
                        $erreur = "Cette extension n'est pas acceptée.";
                        return $erreur;
                    }
                } else {
                    $erreur = "Ce fichier est trop volumineux.";
                    return $erreur;
                }
            } else {
                if($_FILES['photoUser']["size"] <= 500000){
                    $erreur = "Ce fichier est trop volumineux.";
                    return $erreur;
                }
                else{
                    $erreur = "Mauvaise extension de fichier.";
                    return $erreur;
                }
            }
        }
    }

    public function deletuser($id)
    {
        $data = array($id);

        $req = "DELETE FROM utilisateurs WHERE `utilisateurs`.`Id_utilisateur` = ?;";

        $this->execReqPrep($req, $data);
    }

    public function deletpanier($id)
    {
        $data = array($id);

        $req = "DELETE FROM panier WHERE `panier`.`id_utilisateur` = ?;";

        $this->execReqPrep($req, $data);
    }

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