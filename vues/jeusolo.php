<?php

require_once "modeles/panier.class.php";

$styles = "../styles/style_jeusolo.css";

$librairie = '';

// existence de la photo du jeu et affichage des infos

if (file_exists('img/photojeu/' . $_GET['idjeu'] . '.jpg')) {
    $phototest = 'img/photojeu/' . $_GET['idjeu'] . '.jpg';
    // Si l'image existe, l'affiche
} else if (file_exists('img/photojeu/' . $_GET['idjeu'] . '.png')) {
    $phototest = 'img/photojeu/' . $_GET['idjeu'] . '.png';
} else {
    // Sinon, affiche une image par défaut
    $phototest = 'img/objets/no_image.jpg';
}

// lien vidéo si il existe 

if ($jeu[0]['lien_video'] == "") {
    $video = "";
} else {
    $video = '<iframe width="1200" height="500" src="https://www.youtube.com/embed/' . $jeu[0]['lien_video'] . '"YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>';
}
$styles_telephone = "styles/telephone/ajoutjeu_tel.css";
$paniers = new panier;

$script = "<script src='../js/script_jeusolo.js'></script>";

?>

<div class="jeutop">
    <div class="image">
        <div class="img">
            <img src="../<?= $phototest ?>" alt="cave">
        </div>
    </div>
    <div class="infos">
        <div class="titrePage">
            <h1 id="TitreJeu<?= $jeu[0]['ID_jeu'] ?>"><?= $jeu[0]['Titre'] ?></h1>
            <div class="rectangleTitre">
            </div>
        </div>
        <div class="description" id="DescriptionJeu<?= $jeu[0]['ID_jeu'] ?>">
            <?= $jeu[0]['description'] ?>
        </div>
        <div class="adresse">
            Adresse : <?= $jeu[0]['adresse']. " ". $jeu[0]['ville'] . " ".$jeu[0]['postale'] ?>
        </div>
        <div class="autre">
            <div class="age">
                <p><span id='minimum-age'>Age minimum : </span><?= $jeu[0]['age'] ?> ans</p>
            </div>
            <div class="prix">
                <p><span id="price-single-game">Prix pour 1 personne : </span><?= $jeu[0]['prix'] ?> €</p>
            </div>
            <div class="nombre">
                <p><span id='participants-range-1'>De </span><?= $jeu[0]['nombre_min'] ?><span id='participants-range-2'> à </span><?= $jeu[0]['nombre_max'] ?><span id='participants-range-3'> participants.es</span></p>
            </div>
        </div>
    </div>
</div>
<div class="fleches" id="calender">
    <div class="gauche">
        <img src="../img/LeftArrow.svg" alt="fleche gauche">
    </div>
    <div class="moisActuel">
        <h2></h2>
    </div>
    <div class="droite">
        <img src="../img/RightArrow.svg" alt="fleche droite">
    </div>
</div>
<div class="calendrier">
</div>
<div class="video">
    <?= $video ?>
</div>

<div class="cache">
    <!-- div cachée, sert juste à avoir le min et le max en js -->
    <div class="min" id="<?= $jeu[0]['nombre_min'] ?>"></div>
    <div class="max" id="<?= $jeu[0]['nombre_max'] ?>"></div>
    <div class="prixJeu" id="<?= $jeu[0]['prix'] ?>"></div>
</div>