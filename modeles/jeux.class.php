<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/modeles/database.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/controleur/ctlJeux.php";

class jeux extends database
{
    public function ajouterjeuBDD($titre, $lieu, $link, $desc, $min, $max, $age, $adresse, $postale, $prix, $pays, $coX, $coY, $region, $titreanglais, $descriptionanglais)
    {
        // Création d'un tableau de données avec l'ID de l'utilisateur
        $data = array($lieu, $link, $desc, $titre, $min, $max, $age, $adresse, $postale, $prix, $pays, $coX, $coY, $region, $titreanglais, $descriptionanglais);

        $req = "INSERT INTO `jeux` (`ID_jeu`, `ville`, `lien_video`, `description`, `Titre`, `nombre_min`, `nombre_max`, `age`, `adresse`, `postale`, `prix`, `pays`, `coX`, `coY`, `region`, `Titre_anglais`, `Description_anglais`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        // Exécution de la requête préparée
        $this->execReqPrep($req, $data);
    }

    public function enregModifJeu($id, $titre, $link, $min, $max, $age, $prix, $description, $ville, $region, $adresse, $postale, $pays, $coX, $coy, $titreanglais, $descriptionanglais)
    {
        $data = array($titre, $link, $min, $max, $age, $prix, $description, $ville, $region, $adresse, $postale, $pays, $coX, $coy, $titreanglais, $descriptionanglais, $id);

        $req = "UPDATE `jeux` SET `Titre` = ?, `lien_video` = ?, `nombre_min` = ?, `nombre_max` = ?, `age` = ?, `prix` = ?, `description` = ?, `ville` = ?, `region` = ?, `adresse` = ?, `postale` = ?, `pays` = ?, `coX` = ?, `coY` = ?, `Titre_anglais` = ?, `Description_anglais` = ? WHERE `jeux`.`ID_jeu` = ?;";

        // Exécution de la requête préparée
        $this->execReqPrep($req, $data);
    }
    public function recupJeu()
    {
        $req = 'SELECT ID_jeu FROM `jeux` ORDER BY ID_jeu DESC LIMIT 1';

        $result = $this->execReq($req);

        return $result[0]['ID_jeu'];
    }
    public function enregjeuphoto($idJeu)
    {
        $page = new ctlJeux();
        // Récupération de l'extension du fichier
        $infosfichier = new SplFileInfo($_FILES['photoGame']['name']);
        $extension_upload = $infosfichier->getExtension();

        // Liste des extensions autorisées
        $extensions_autorisees = array('jpg', 'png');

        // Vérification si l'extension du fichier est autorisée
        if (in_array($extension_upload, $extensions_autorisees)) {
            foreach ($extensions_autorisees as $test) {
                $exister = 'img/photojeu/' . $idJeu . '.' . $test;

                if (file_exists($exister)) {
                    unlink($exister);
                }
            }

            // Vérification si le dossier 'img/photojeu' existe
            if (is_dir('img/photojeu')) {

                // Déplacement du fichier vers le dossier "img/photojeu" avec un nom basé sur l'ID de l'article
                move_uploaded_file(
                    $_FILES['photoGame']['tmp_name'],
                    'img/photojeu/' . $idJeu . "." . $extension_upload
                );
                // $erreur = "Transfert du fichier <b> " . $_FILES['photoGame']['name'] . " </b> effectué !";
                // return $erreur;

            } else {
                // Si le dossier n'existe pas, on le crée et on déplace le fichier
                mkdir('img/photojeu');
                move_uploaded_file(
                    $_FILES['photoGame']['tmp_name'],
                    'img/photojeu/' . $idJeu . "." . $extension_upload
                );
                // $erreur = "Transfert du fichier <b> " . $_FILES['photoGame']['name'] . " </b> effectué !";
                // return $erreur;
            }

        }
        else {
            // Si l'extension du fichier n'est pas autorisée
            return "Fichier non autorisé";
        }
    }
    public function getjeux()
    {
        $req = "SELECT * FROM jeux";
        $jeux = $this->execReq($req);
        return $jeux;
    }
    public function supprjeu($jeu)
    {
        $data = array($jeu);

        $req = "DELETE FROM jeux WHERE `jeux`.`ID_jeu` = ?";

        $this->execReqPrep($req, $data);
    }

    public function getJeuSingle($idjeu)
    {
        $data = array($idjeu);

        $req = "SELECT * FROM jeux WHERE ID_jeu = ?";

        $jeusolo = $this->execReqPrep($req, $data);

        return $jeusolo[0];
    }


    public function getjeu($id)
    {
        $data = array($id);

        $req = "SELECT * FROM jeux WHERE ID_jeu = ?";

        return $this->execReqPrep($req, $data);
    }


    public function getReservation()
    {
        $req = "SELECT ID_jeu, jour_reservation, heure_reservation FROM réserver";

        return $this->execReq($req);
    }

    public function getVilles(){
        $req = "SELECT region FROM `jeux` GROUP BY region";

        return $this->execReq($req);
    }
}