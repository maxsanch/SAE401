<?php 

require_once "config/config.class.php";

$conf = new Config();

require_once "controleur/routeur.class.php";

$accesrouteur = new routeur();
$accesrouteur->routerRequete();

