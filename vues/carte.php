<?php

$styles = "../styles/style_carte.css";
$librairie = "";
$script = "";
$styles_telephone = "styles/telephone/carte_tel.css";
$pointFrancais = "";
$pointAllemagne = "";

foreach ($jeux as $valeur) {
    switch ($valeur['pays']) {
        case "France":
            $pointFrancais .= '<a href="index.php?page=infojeusolo&idjeu=' . $valeur['ID_jeu'] . '" class="point" style="top: ' . $valeur['coY'] . '%; left: ' . $valeur['coX'] . '%;">
                                    <img src="../img/map.svg" alt="map point">
                                </a>';
            break;
        case 'Allemagne':
            $pointAllemagne .= '<a href="index.php?page=infojeusolo&idjeu=' . $valeur['ID_jeu'] . '" class="point" style="top: ' . $valeur['coY'] . '%; left: ' . $valeur['coX'] . '%;">
                                    <img src="../img/map.svg" alt="map point">
                                </a>';
            break;
    }
}


$regionstot = '';

foreach ($regions as $content) {
    $villesolo = "";
    foreach ($jeux as $valeur) {
        if($content['region'] == $valeur['region']){
            $villesolo .= '<div class="petiteVille">'.$valeur['ville'].' '.$valeur['postale'].'</div>';
        }
    }
    $regionstot .= '<div class="DivVilles">
        <div class="grandeVilles">' . $content['region'] . '</div>
        <div class="rectangleVille"></div>
        '.$villesolo.'
    </div>';
}

?>

<div class="content">
    <h1>We-escape maintenant en france !</h1>
    <div class="rectangleTitre"></div>
    <div class="lesCartes">
        <div class="lesCartes">
            <div class="france">
                <img src="../img/france.svg" alt="Carte de la France">
                <?= $pointFrancais ?>
            </div>
            <div class="germany">
                <img src="../img/germany.svg" alt="Carte de l'allemagne">
                <?= $pointAllemagne ?>
            </div>
        </div>
    </div>

    <h2>Retrouvez nous dans ces villes !</h2>
    <div class="rectangleTitre"></div>
    <div class="lesVilles">
        <?= $regionstot ?>
    </div>
</div>