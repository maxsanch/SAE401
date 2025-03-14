<?php

// liens styles et scripts

$styles = "../styles/style_games.css";

$librairie = '';
$styles_telephone = "styles/telephone/games_tel.css";
$script = "<script src='../js/accueil.js'></script>";

$result = "";


foreach ($jeux as $valeur) {

    // verification de l'exitence de la photo
    if (file_exists('img/photojeu/' . $valeur['ID_jeu'] . '.jpg')) {
        $phototest = 'img/photojeu/' . $valeur['ID_jeu'] . '.jpg';
        // Si l'image existe, l'affiche
    } else if (file_exists('img/photojeu/' . $valeur['ID_jeu'] . '.png')) {
        $phototest = 'img/photojeu/' . $valeur['ID_jeu'] . '.png';
    } else {
        // Sinon, affiche une image par défaut
        $phototest = 'img/photojeu/no_image.jpg';
    }

    // resultat avec les escape games

    $result .= "<div class='PropositionEscapeGame'>
    <div class='ImageDeEscapeGame'><img src='" . $phototest . "'
            alt='Images de présentation des escapes games'></div>
    <div class='MiseEnPageEG'>
        <div class='TitreEscapeGame' id='TitreJeu".$valeur['ID_jeu']."'>" . $valeur['Titre'] . "</div>
        <div class='InformationEscapeGame'>
            <div class='InfoRuche'>age : " . $valeur['age'] . " <span id='age-games'>ans</span></div>
            <div class='InformationEscapeGame'>
                <div class='User'><img src='img/Users.svg' alt='Icon d'utilisateur'></div>
                <div class='InfoEG'>" . $valeur['nombre_min'] . " - " . $valeur['nombre_max'] . "</div>
            </div>
        </div>
        <div class='EscageGameBarreSelecteurGlobal'>
            <input type='range' id='volume' name='volume' min='" . $valeur['nombre_min'] . "' 
            max='" . $valeur['nombre_max'] . "' value='" . $valeur['nombre_min'] . "' />
            <label></label>
        </div>

        <div class='BoutonEscapeGame'>
            <a href='index.php?page=infojeusolo&idjeu=".$valeur['ID_jeu']."' class='EscapeGameBouton'id='view-more'>Voir plus</a>
            <a  class='EscapeGameBouton number' href='index.php?page=infojeusolo&idjeu=".$valeur['ID_jeu']."&nombre=0#calender' class='EscapeGameBouton' id='reserve'>Réserver</a>
        </div>
    </div>
</div>";
}

// affichage du message si présent

$erreurAffiche = "";
if(!empty($erreur)){
    $erreurAffiche = '
    <div class="error">
        '.$erreur.'
    </div>
    ';
}
else{
    $erreurAffiche = "";
}

?>

<?= $erreurAffiche ?>
<div class="MiseEnPage">
    <div class="Titre">
        <h2 class="TitreEscapeGame">Nos escapes games disponibles</h2>
        <div class="RectangleTitre"></div>
    </div>
    <div class="global">
        <?= $result ?>
    </div>
</div>