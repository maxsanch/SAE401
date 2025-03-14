<?php

// appel des fichiers style

$styles = "styles/accueil.css"; // mettre le lien vers le style ici
$styles_telephone = "styles/telephone/accueil_tel.css";

// varification du niveau de connexion

if (isset($_SESSION['acces'])) {
    $connecteoupas = '<span class="Discover-button">Découvrir !</span>';
    $link = "index.php?page=jeuxAll";
} else {
    $connecteoupas = '<span class="connect-header">Se connecter !</span>';
    $link = "index.php?page=connexion";
}

$librairie = "";

$result = "";
$pointFrancais = "";
$pointAllemagne = "";

foreach ($jeux as $valeur) {
    if (file_exists('img/photojeu/' . $valeur['ID_jeu'] . '.jpg')) {
        $phototest = 'img/photojeu/' . $valeur['ID_jeu'] . '.jpg';
        // Si l'image existe, l'affiche
    } else if (file_exists('img/photojeu/' . $valeur['ID_jeu'] . '.png')) {
        $phototest = 'img/photojeu/' . $valeur['ID_jeu'] . '.png';
    } else {
        // Sinon, affiche une image par défaut
        $phototest = 'img/photojeu/no_image.jpg';
    }

    // points points la carte

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

    // escape game disponibles 

    $result .= "<div class='PropositionEscapeGame'>
                <div class='ImageDeEscapeGame'><img src='" . $phototest . "'
                        alt='Images de présentation des escapes games'></div>
                <div class='MiseEnPageEG'>
                    <div class='TitreEscapeGame' id='TitreJeu" . $valeur['ID_jeu'] . "'>" . $valeur['Titre'] . "</div>
                    <div class='InformationEscapeGame'>
                        <div class='InfoRuche'>age : " . $valeur['age'] . " <span id='age-games'>ans</span></div>
                        <div class='InformationEscapeGame'>
                            <div class='User'><img src='img/Users.svg' alt='Icon d'utilisateur'></div>
                            <div class='InfoEG'>" . $valeur['nombre_min'] . " - " . $valeur['nombre_max'] . "</div>
                        </div>
                    </div>
                    <div class='EscageGameBarreSelecteurGlobal'>
                        <input type='range' id='volume' name='volume' min='" . $valeur['nombre_min'] - 1 . "' 
                        max='" . $valeur['nombre_max'] . "' value='" . $valeur['nombre_min'] - 1 . "' />
                        <label></label>
                    </div>

                    <div class='BoutonEscapeGame'>
                        <a href='index.php?page=infojeusolo&idjeu=" . $valeur['ID_jeu'] . "' class='EscapeGameBouton' id='see-more'>Voir plus</a>
                        <a class='EscapeGameBouton number' href='index.php?page=infojeusolo&idjeu=" . $valeur['ID_jeu'] . "&nombre=0#calender' id='reserve'>Réserver</a>
                    </div>
                </div>
            </div>";
}

// script lié

$script = "<script src='../js/accueil.js'></script>";
?>


<div class="MiseEnPage">
    <div class="Accueil">
        <div class="AccueilTexte">
            <h1 class="AccueilTitre">WE-ESCAPE</h1>
            <h2 class="AccueilSousTitre">Escape games en plein air !</h2>
            <div class="AccueilDescritpion">
                <div>Découvrez <b>We-Escape</b> et ses escapes games en <b>plein air !</b></div>
                <div>Plongez dans différentes aventures au coeurs d’enquêtes et d’énigmes <b>en foret ou même en
                        ville.</b></div>
                <div><b>En équipe</b>, vous devrez trouver les indices pour <b>résoudre les mystères</b> que
                    vous rencontrerez
                    sur votre parcors afin de <b>vous échapper !</b></div>
            </div>
            <div class="AccueilBoutonsGlobal">
                <a href="<?= $link ?>" class="AccueilBouton"><?= $connecteoupas ?></a>
                <a href="index.php?page=propos" class="AccueilBouton about">A propos</a>
            </div>
        </div>
        <div class="AccueilCle">
            <div><video autoplay muted loop>
                    <source src="../img/cle_qui_tourne.webm" alt="Une clé en 3D qui tourne">
                </video></div>
        </div>
    </div>
</div>
<div class="CadreDesEngrenages">
    <div class="engrenage" style="--X:50%; --Y:50%; --Xtel:50%; --Ytel:85%;">
        <img src="img/roue.svg" alt="un engrenage">
    </div>
    <div class="engrenage" style="--X:-50%; --Y:60%; --Xtel:-50%; --Ytel:150%">
        <img src="img/roue.svg" alt="un engrenage">
    </div>
</div>
<div class="EscapeGameDisponible">
    <div class="MiseEnPage">
        <div>
            <h2 class="TitreEscapeGame" id="available-games">Nos escapes games disponible</h2>
            <div class="RectangleTitre"></div>
        </div>
        <div class="ListeDesEscapeGame">
            <div>
                <!-- pour modifier le tout, en haut il y a la boucle de ce qui est affiché, dans une variable result -->
                <?= $result ?>
            </div>
        </div>
        <div>
            <h2 class="TitreEscapeGame" id="places">Où sommes nous ?</h2>
            <div class="RectangleTitre"></div>
        </div>
        <div class="Carte">
            <div class="pays">
                <img src="../img/france.svg" alt="Carte de la france qui montre où sont les escapes games">
                <?= $pointFrancais ?>
            </div>
            <div class="pays">
                <img src="../img/germany.svg" alt="Carte de l'allemagne qui montre où sont les escapes games">
                <?= $pointAllemagne ?>
            </div>
        </div>
        <div class="PresentationGlobal">
            <div class="PresentationText">
                <div>
                    <h2 class="TitreEscapeGame" id="who-presentation">Qui sommes nous ?</h2>
                    <div class="RectangleTitre"></div>
                </div>
                <div class="PresentationPave" id="Presentation">
                    <p>chez we escape, vous pourrez redécouvrir le concept d’escape game.
                        Que vous soyez innexperimenté ou un passionnés, vous ne serez pas au bout de vos surprises avec
                        notre concept d’escape game en plein air.</p>

                    <p>En effet, nous proposons des scénarios grandeur nature en ville, en foret ou même en montagne !
                        Votre équipe devra suivre des indices, résoudre des mystères et relever des défis pour
                        progresser
                        dans l’histoire. Chaque rue devient un élément du jeu, chaque détail peut être la clé qui vous
                        rapproche de la victoire.</p>

                    <p>Que vous soyez amateurs de défis intellectuels ou simplement en quête d’une activité ludique
                        entre
                        amis, notre escape game en extérieur vous plonge dans une aventure immersive où l’observation,
                        la
                        logique et l’esprit d’équipe seront vos meilleurs alliés.</p>
                </div>
            </div>
            <div class="PresentationImg"><img src="../img/Presentation.png" alt="Photo de l'équipe de we escape"></div>
        </div>
    </div>
</div>