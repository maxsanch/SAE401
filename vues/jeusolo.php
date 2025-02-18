<?php
$styles = "";

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


$date = new dateTime();

$affichage="";

for($i = 0; $i< 60; $i++){
    $heures = "";

    // for($j == 8; $j<16; $j+2){
    //     $heures .= "<div>".$j." - ".($j+2)."h</div>";
    // }


    $affichage .= "<div class='total'><div class='parentCalender'>".$date->format('d-m-Y')."</div> <div class='heures'>".$heures."</div></div>";
    $date->modify('+1 day');
}

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
<div class="calendrier">
    <?= $affichage ?>
</div>