<?php

require_once "modeles/database.class.php";

class panier extends database
{
    public function getallpanier()
    {
        $req = "SELECT * FROM panier WHERE statut = 'validé'";

        return $this->execReq($req);
    }

    public function getheureJourPanier(){
        $req = "SELECT * FROM panier";

        return $this->execReq($req);
    }

    public function getValidPanierUser($id)
    {
        $data = array($id);
        $req = "SELECT * FROM panier WHERE id_utilisateur = ? AND statut = 'validé';";

        return $this->execReqPrep($req, $data);
    }

    public function getPanierUser($iduser)
    {
        $data = array($iduser);
        $req = "SELECT id_panier FROM panier WHERE id_utilisateur = ? AND statut = 'en cours';";


        $panier = $this->execReqPrep($req, $data);
        return $panier[0]['id_panier'];
    }

    public function getPaniers($iduser)
    {
        $data = array($iduser);
        $req = "SELECT id_panier FROM panier WHERE id_utilisateur = ?;";


        $panier = $this->execReqPrep($req, $data);
        return $panier;
    }

    public function deletContenir($id)
    {
        $data = array($id);

        $req = "DELETE FROM contenir WHERE `contenir`.`id_panier` = ?;";

        $this->execReqPrep($req, $data);
    }


    public function deletReserver($id)
    {
        $data = array($id);

        $req = "DELETE FROM réserver WHERE `réserver`.`id_panier` = ?;";

        $this->execReqPrep($req, $data);
    }

    public function checkexist($idobj, $idpanier)
    {
        $data = array($idobj, $idpanier);

        $req = "SELECT * FROM contenir WHERE id_objet_shop = ? AND id_panier = ?;";

        return $this->execReqPrep($req, $data);
    }

    public function addLineObj($idobjet, $panier, $qtd)
    {
        $data = array($idobjet, $panier, $qtd);

        $req = "INSERT INTO `contenir` (`id_objet_shop`, `id_panier`, `quantitée`) VALUES (?, ?, ?);";

        return $this->execReqPrep($req, $data);
    }

    public function addOne($idobjet, $panier, $nombre)
    {
        $data = array($nombre, $idobjet, $panier);

        $req = "UPDATE `contenir` SET `quantitée` = ? WHERE `contenir`.`id_objet_shop` = ? AND `contenir`.`id_panier` = ?;";

        return $this->execReqPrep($req, $data);
    }

    public function stockactuel($idobjet)
    {
        $data = array($idobjet);

        $req = "SELECT stock FROM objet_shop WHERE id_objet_shop = ?";

        return $this->execReqPrep($req, $data);
    }

    public function reduce($reduce, $idobj)
    {
        $data = array($reduce, $idobj);

        $req = "UPDATE `objet_shop` SET `stock` = ? WHERE `objet_shop`.`id_objet_shop` = ?";

        return $this->execReqPrep($req, $data);
    }

    public function Reserver($idjeu, $jour, $nombre, $heure, $idpanier)
    {
        $data = array($idjeu, $idpanier, $jour, $heure, $nombre);

        $req = "INSERT INTO `réserver` (`ID_jeu`, `id_panier`, `jour_reservation`, `heure_reservation`, `nombre_personnes`) VALUES (?, ?, ?, ?, ?);";

        return $this->execReqPrep($req, $data);
    }

    public function MesRéservations($idUser)
    {
        $data = array($idUser);

        $req = "SELECT réserver.ID_jeu, panier.id_panier as 'panier', nombre_personnes, jeux.Titre, jeux.prix, jeux.description, réserver.jour_reservation, réserver.heure_reservation FROM panier INNER JOIN réserver ON réserver.id_panier=panier.id_panier INNER JOIN jeux ON jeux.ID_jeu = réserver.ID_jeu WHERE panier.id_utilisateur = ? AND panier.statut='en cours';";

        return $this->execReqPrep($req, $data);
    }

    public function MesSouvenirs($idUser)
    {
        $data = array($idUser);

        $req = "SELECT contenir.id_panier, contenir.id_objet_shop, nom, description, prix, quantitée FROM panier INNER JOIN contenir ON contenir.id_panier=panier.id_panier INNER JOIN objet_shop ON objet_shop.id_objet_shop = contenir.id_objet_shop WHERE panier.id_utilisateur = ? AND panier.statut='en cours';";

        return $this->execReqPrep($req, $data);
    }

    public function LastReservations($idpanier)
    {
        $data = array($idpanier);

        $req = "SELECT réserver.ID_jeu, panier.id_panier as 'panier', nombre_personnes, jeux.Titre, jeux.prix, jeux.description, réserver.jour_reservation, réserver.heure_reservation FROM panier INNER JOIN réserver ON réserver.id_panier=panier.id_panier INNER JOIN jeux ON jeux.ID_jeu = réserver.ID_jeu WHERE panier.id_panier = ?;";

        return $this->execReqPrep($req, $data);
    }

    public function LastSouvenirs($idPanier)
    {
        $data = array($idPanier);

        $req = "SELECT contenir.id_panier, contenir.id_objet_shop, nom, description, prix, quantitée FROM panier INNER JOIN contenir ON contenir.id_panier=panier.id_panier INNER JOIN objet_shop ON objet_shop.id_objet_shop = contenir.id_objet_shop WHERE panier.id_panier = ?;";

        return $this->execReqPrep($req, $data);
    }

    public function supprimersouv($idobj, $idpanier)
    {
        $data = array($idobj, $idpanier);

        $req = "DELETE FROM contenir WHERE `contenir`.`id_objet_shop` = ? AND `contenir`.`id_panier` = ?;";

        return $this->execReqPrep($req, $data);
    }

    public function supprimerres($idobj, $heure, $jour)
    {
        $data = array($idobj, $heure, $jour);

        $req = "DELETE FROM réserver WHERE `réserver`.`ID_jeu` = ? AND `réserver`.`heure_reservation` = ? AND `réserver`.`jour_reservation` = ?;";

        return $this->execReqPrep($req, $data);
    }

    public function GetPanierParRes($idobj, $heure, $jour)
    {
        $data = array($idobj, $heure, $jour);

        $req = "SELECT id_panier FROM réserver WHERE `réserver`.`ID_jeu` = ? AND `réserver`.`heure_reservation` = ? AND `réserver`.`jour_reservation` = ?;";

        return $this->execReqPrep($req, $data);
    }

    public function getBestRes(){
        $req = "SELECT jeux.Titre, SUM(réserver.nombre_personnes) AS 'total' FROM réserver INNER JOIN jeux ON réserver.ID_jeu = jeux.ID_jeu INNER JOIN panier ON réserver.id_panier = panier.id_panier WHERE panier.statut = 'valide' GROUP BY jeux.Titre ORDER BY `total` DESC";

        return $this->execReq($req);
    }

    public function getBestSouv(){
        $req = "SELECT objet_shop.nom, SUM(contenir.quantitée) AS 'total' FROM contenir INNER JOIN objet_shop ON contenir.id_objet_shop = objet_shop.id_objet_shop INNER JOIN panier ON contenir.id_panier = panier.id_panier WHERE panier.statut = 'valide' GROUP BY objet_shop.nom ORDER BY `total` DESC;";

        return $this->execReq($req);
    }

    public function validerPanier($id){
        $data = array($id);
        $req = "UPDATE `panier` SET `statut` = 'valide' WHERE `panier`.`id_utilisateur` = ? AND `panier`.`statut` = 'en cours'";
        $this->execReqPrep($req, $data);
    }
    public function creerNewPanier($id){
        $data = array($id);
        $req = "INSERT INTO `panier` (`id_panier`, `id_utilisateur`, `statut`) VALUES (NULL, ?, 'en cours');";
        $this->execReqPrep($req, $data);
    }

    public function supprimerPanierValide($idpanier){
        $data = array($idpanier);
        $req = 'DELETE FROM panier WHERE `panier`.`id_panier` = ?;';
        $this->execReqPrep($req, $data);
    }
    public function supprimerReservationValide($idpanier){
        $data = array($idpanier);
        $req = 'DELETE FROM réserver WHERE `réserver`.`id_panier` = ?;';
        $this->execReqPrep($req, $data);
    }
    public function supprimerSouvenirValide($idpanier){
        $data = array($idpanier);
        $req = 'DELETE FROM contenir WHERE `contenir`.`id_panier` = ?;';
        $this->execReqPrep($req, $data);
    }

    public function getstockCont($idpanier){
        $data = array($idpanier);
        $req = 'SELECT quantitée, id_objet_shop FROM contenir WHERE id_panier = ?;';
        return $this->execReqPrep($req, $data);
    }

    public function getstockContIDobj($idobj, $idpanier){
        $data = array($idobj, $idpanier);
        $req = 'SELECT quantitée, id_objet_shop FROM contenir WHERE id_objet_shop = ? AND id_panier = ?;';
        return $this->execReqPrep($req, $data);
    }

    public function updateHorraire($idpanier, $heure){
        $data = array($heure, $idpanier);
        $req = "UPDATE `panier` SET `derniere_modification` = ? WHERE `panier`.`id_panier` = ?";
        return $this->execReqPrep($req, $data);
    }

    public function editersouv($idobj, $idpanier, $nombredelet){
        $data = array($nombredelet, $idpanier, $idobj);
        $req = "UPDATE `contenir` SET `quantitée` = ? WHERE `contenir`.`id_panier` = ? AND `contenir`.`id_objet_shop` = ?";
        $this->execReqPrep($req, $data);
    }
}