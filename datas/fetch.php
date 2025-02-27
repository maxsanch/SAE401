<?php

require_once $_SERVER['DOCUMENT_ROOT']."/config/config.class.php";

$conf = new Config();

require_once $_SERVER['DOCUMENT_ROOT']."/modeles/jeux.class.php";

$jeu = new jeux;

$datas = $jeu->getReservation();

$json = json_encode($datas);

echo $json;

?>