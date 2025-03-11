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
            Adresse : <?= $jeu[0]['adresse'] ?>
        </div>
        <div class="autre">
            <div class="age">
                <p>Age minimum : <?= $jeu[0]['age'] ?></p>
            </div>
            <div class="prix">
                <p>Prix pour 1 personne : <?= $jeu[0]['prix'] ?> €</p>
            </div>
            <div class="nombre">
                <p>De <?= $jeu[0]['nombre_min'] ?> à <?= $jeu[0]['nombre_max'] ?> participants.es</p>
            </div>
        </div>
    </div>
</div>
<div class="fleches">
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
<div class="calendrier" id="calender">

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