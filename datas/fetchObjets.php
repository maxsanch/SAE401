<?php

// récupérer les objets

require_once $_SERVER['DOCUMENT_ROOT']."/config/config.class.php";

$conf = new Config();

require_once $_SERVER['DOCUMENT_ROOT']."/modeles/Objectshop.class.php";

$jeu = new shop;

$datas = $jeu->récupérerobj();

$json = json_encode($datas);

echo $json;

?>