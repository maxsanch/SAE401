<?php

require_once "modeles/panier.class.php";

$styles = "../styles/style_jeusolo.css";

$librairie = '';

if (file_exists('img/photojeu/' . $_GET['idjeu'] . '.jpg')) {
    $phototest = 'img/photojeu/' . $_GET['idjeu'] . '.jpg';
    // Si l'image existe, l'affiche
} else if (file_exists('img/photojeu/' . $_GET['idjeu'] . '.png')) {
    $phototest = 'img/photojeu/' . $_GET['idjeu'] . '.png';
} else {
    // Sinon, affiche une image par défaut
    $phototest = 'img/objets/no_image.jpg';
}

if ($jeu[0]['lien_video'] == "") {
    $video = "";
} else {
    $video = $jeu[0]['lien_video'];
}

$paniers = new panier;

$script = "<script src='../js/script_jeusolo.js'></script>";
    ?>

<div class="jeutop">
    <div class="image">
        <img src="<?= $phototest ?>" alt="photo_de_l'escape-game">
    </div>
    <div class="infos">
        <div class="titre">
            <h1><?= $jeu[0]['Titre'] ?></h1>
        </div>
        <div class="description">
            <?= $jeu[0]['description'] ?>
        </div>
        <div class="autre">
            <div class="age">
                Age minimum : <?= $jeu[0]['age'] ?>
            </div>
            <div class="nombre">
                De <?= $jeu[0]['nombre_min'] ?> à <?= $jeu[0]['nombre_max'] ?> participants.es
            </div>
        </div>
    </div>
</div>
<div class="video">
    <?= $video ?>
</div>
<div class="fleches">
    <div class="gauche">
        gauche
    </div>
    <div class="droite">
        Droite
    </div>
</div>
<div class="calendrier">
</div>

<div class="cache">
    <!-- div cachée, sert juste à avoir le min et le max en js -->
     <div class="min" id="<?= $jeu[0]['nombre_min'] ?>"></div>
     <div class="max" id="<?= $jeu[0]['nombre_max'] ?>"></div>
</div>
