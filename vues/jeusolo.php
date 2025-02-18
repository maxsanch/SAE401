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

$affichage = "";

for ($i = 0; $i < 10; $i++) {
    $heures = "";

    for ($j = 8; $j <= 16; $j += 2) {
        foreach($recup as $valeur){
            if($valeur['jour_reservation'] == $date->format('Y-m-d') && $valeur['heure_reservation'] == $j."-". ($j + 2)."h" && $valeur['ID_jeu'] == $_GET['idjeu']){
                $heures .= "<label><input disabled required type='radio' name='heure' value='".$j."-". ($j + 2)."h'>" . $j . " - " . ($j + 2) . "h</label>";
            }
            else{
                $heures .= "<label><input required type='radio' name='heure' value='".$j."-". ($j + 2)."h'>" . $j . " - " . ($j + 2) . "h</label>";
            }
        }
    }

    $affichage .= "<div class='total'>
                    <form action='index.php?page=réserverJeu&idjeu=".$_GET['idjeu']."&jour=".$date->format('Y-m-d')."' method='post'>
                        <div class='parentCalender'>" . $date->format('d-m-Y') . "</div>
                        <div class='heures'>" . $heures . "</div>
                        <label>
                            Choisissez un nombre de participants.
                            <input type='number' required max='".$jeu[0]['nombre_max']."' min='".$jeu[0]['nombre_min']."' name='nombre' placeholder='nombre de participants'>
                        </label>
                        <button>Valider</button>
                    </form>
                    </div>";
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