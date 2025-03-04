<?php

$styles="../styles/style_carte.css";
$librairie="";
$script  = "";
$styles_telephone = "";
$pointFrancais = "";
$pointAllemagne = "";

foreach ($jeux as $valeur) {
    switch ($valeur['pays']) {
        case "France":
            $pointFrancais .= '<a href="index.php?page=infojeusolo&idjeu='.$valeur['ID_jeu'].'" class="point" style="top: ' . $valeur['coY'] . 'px; left: ' . $valeur['coX'] . 'px;">
                                    <img src="../img/map.svg" alt="map point">
                                </a>';
            break;
        case 'Allemagne':
            $pointAllemagne = '<a href="index.php?page=infojeusolo&idjeu='.$valeur['ID_jeu'].'" class="point" style="top: ' . $valeur['coY'] . 'px; left: ' . $valeur['coX'] . 'px;">
                                    <img src="../img/map.svg" alt="map point">
                                </a>';
            break;
    }
}

?>

<div class="content">
<h1>We-escape maintenant en france !</h1>
<div class="rectangleTitre"></div>
<div class="lesCartes">
    <div class="lesCartes">
        <div class="france">
            <img src="../img/france.svg" alt="">
            <?= $pointFrancais ?>
        </div>
        <div class="germany">
            <img src="../img/germany.svg" alt="">
            <?= $pointAllemagne ?>
        </div>
    </div>
</div>

<h2>Retrouvez nous dans ces villes !</h2>
<div class="rectangleTitre"></div>
<div class="lesVilles">
    <div class="DivVilles">
        <div class="grandeVilles">Région grand est</div>
        <div class="rectangleVille"></div>
        <div class="petiteVille">Mulhouse</div>
        <div class="petiteVille">Strasbourg</div>
    </div>
    <div class="DivVilles">
        <div class="grandeVilles">Lorraine</div>
        <div class="rectangleVille"></div>
        <div class="petiteVille">Ville</div>
        <div class="petiteVille">Ville</div>
        <div class="petiteVille">Ville</div>
        <div class="petiteVille">Ville</div>
    </div>
    <div class="DivVilles">
        <div class="grandeVilles">Lorraine</div>
        <div class="rectangleVille"></div>
        <div class="petiteVille">Ville</div>
        <div class="petiteVille">Ville</div>
        <div class="petiteVille">Ville</div>
        <div class="petiteVille">Ville</div>
    </div>
    <div class="DivVilles">
        <div class="grandeVilles">Lorraine</div>
        <div class="rectangleVille"></div>
        <div class="petiteVille">Ville</div>
        <div class="petiteVille">Ville</div>
    </div>
    <div class="DivVilles">
        <div class="grandeVilles">Lorraine</div>
        <div class="rectangleVille"></div>
        <div class="petiteVille">Ville</div>
        <div class="petiteVille">Ville</div>
        <div class="petiteVille">Ville</div>
    </div>
</div>
</div>