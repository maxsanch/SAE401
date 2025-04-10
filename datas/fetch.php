<?php

// page pour récupérer les datas qui concernent réservations des jeux en général pour la traduction

require_once $_SERVER['DOCUMENT_ROOT']."/config/config.class.php";

$conf = new Config();

require_once $_SERVER['DOCUMENT_ROOT']."/modeles/jeux.class.php";

$jeu = new jeux;

$datas = $jeu->getReservation();
$json = json_encode($datas);

echo $json;

?>