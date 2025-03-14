<?php

// récupérer les employés

require_once $_SERVER['DOCUMENT_ROOT']."/config/config.class.php";

$conf = new Config();

require_once $_SERVER['DOCUMENT_ROOT']."/modeles/employés.class.php";

$jeu = new employes;

$datas = $jeu->getEmployes();

$json = json_encode($datas);

echo $json;

?>