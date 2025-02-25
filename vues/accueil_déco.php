<?php

$styles = "styles/accueil.css"; // mettre le lien vers le style ici

if (isset($_SESSION['acces'])) {
    if ($utilisateurStatut[0]['niveau'] == "admin") {
        $test = "test admin";
    } else {
        $test = "test user";
    }
} else {
    $test = "test pas co";
}

$result = "";
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

    $result .= "<div class='PropositionEscapeGame'>
                <div class='ImageDeEscapeGame'><img src='" . $phototest . "'
                        alt='Images de présentation des escapes games'></div>
                <div class='MiseEnPageEG'>
                    <div class='TitreEscapeGame'>" . $valeur['Titre'] . "</div>
                    <div class='InformationEscapeGame'>
                        <div class='InfoRuche'>age : " . $valeur['age'] . " ans</div>
                        <div class='InformationEscapeGame'>
                            <div class='User'><img src='img/Users.svg' alt='Icon d'utilisateur'></div>
                            <div class='InfoEG'>" . $valeur['nombre_min'] . " - " . $valeur['nombre_max'] . "</div>
                        </div>
                    </div>
                    <div class='EscageGameBarreSelecteurGlobal'>
                        <input type='range' id='volume' name='volume' min='" . $valeur['nombre_min'] - 1 . "' 
                        max='" . $valeur['nombre_max'] . "' value='" . $valeur['nombre_min'] - 1 . "' />
                        <label>AFFICHER LA VALUE EN DIRECT !!!</label>
                    </div>

                    <div class='BoutonEscapeGame'>
                        <a href='/' class='EscapeGameBouton'>Voir plus</a>
                        <a href='/' class='EscapeGameBouton'>Réserver</a>
                    </div>
                </div>
            </div>";
}

$script = "";
?>

<div class="CadreDesEngrenages">
    <div class="engrenage" style="--X:50%; --Y:50%;">
        <img src="img/roue.svg" alt="un engrenage">
    </div>
    <div class="engrenage" style="--X:-50%; --Y:50%;">
        <img src="img/roue.svg" alt="un engrenage">
    </div>
</div>
<div class="MiseEnPage">
    <div class="Accueil">
        <div class="AccueilTexte">
            <h1 class="AccueilTitre">WE ESCAPE</h1>
            <h2 class="AccueilSousTitre">Escape game en plein air</h2>
            <div class="AccueilDescritpion">
                <div>Découvrez <b>We-Escape</b> et ses escapes games en <b>plein air !</b></div>
                <div>Plongez dans différentes aventures au coeurs d’enquêtes et d’énigmes <b>en foret ou même en
                        ville.</b></div>
                <div><b>En équipe</b>, vous devrez trouver les indices pour <b>résoudre les mystères</b> que
                    vous rencontrerez
                    sur votre parcors afin de <b>vous échapper !</b></div>
            </div>
            <div class="AccueilBoutonsGlobal">
                <div class="AccueilBouton">Je réserve !</div>
                <div class="AccueilBouton">A propos</div>
            </div>
        </div>
        <div class="AccueilCle">
            <div><img src="img/cle.png" alt="Une clé"></div>
        </div>
    </div>
</div>
<div class="EscapeGameDisponible">
    <div class="MiseEnPage">
        <div>
            <h2 class="TitreEscapeGame">Nos escapes games disponible</h2>
            <div class="RectangleTitre"></div>
        </div>
        <div class="ListeDesEscapeGame">
            <div>
                <!-- pour modifier le tout, en haut il y a la boucle de ce qui est affiché, dans une variable result -->
                <?= $result ?>
            </div>
        </div>
        <div>
            <h2 class="TitreEscapeGame">Où sommes nous ?</h2>
            <div class="RectangleTitre"></div>
        </div>
        <div class="Carte">
            <div><img src="../img/france.svg" alt="Carte de la france qui montre où sont les escapes games"></div>
            <div><img src="../img/germany.svg" alt="Carte de l'allemagne qui montre où sont les escapes games"></div>
        </div>
        <div class="PresentationGlobal">
            <div class="PresentationText">
                <div>
                    <h2 class="TitreEscapeGame">Qui sommes nous ?</h2>
                    <div class="RectangleTitre"></div>
                </div>
                <div class="PresentationPave">
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
<footer>
    <div><img src="../img/Logo.svg" alt="Logo de we escape"></div>
    <div>
        <div>
            <div>
                <div>Découvrez we-escape et ses escapes games en plein air !
                    Plongez dans différentes aventures au coeurs d’enquêtes et d’énigmes en foret ou même en ville.
                </div>
                <div>En équipe, vous devrez trouver les indices pour résoudre les mystères que vous rencontrerz sur
                    votre
                    parcors
                    afin de vous echapper !</div>
            </div>
            <div>Nos réseaux</div>
            <div>
                <div><img src="../img/facebook.svg" alt="icon de facebook"></div>
                <div><img src="../img/instagram.svg" alt="icon de instagram"></div>
                <div><img src="../img/youtube.svg" alt="icon de youtube"></div>
            </div>
        </div>
        <div>
            <div>Contact</div>
            <div>
                <div><img src="../img/telephone.svg" alt="Icon de téléphone"></div>
                <div>07668 996660</div>
            </div>
            <div>
                <div><img src="../img/mail.svg" alt="Icon de mail"></div>
                <div>
                    <div>booking@we-escape.de</div>
                    <div>noah.goguet@uha.fr</div>
                    <div>alexandre.spitzer@uha.fr</div>
                    <div>maxence.sanchez-varas-leclercq@uha.fr</div>
                </div>
            </div>
        </div>
        <div>
            <div>Information</div>
            <div>Nos jeux</div>
            <div>Nous trouver</div>
            <div>Réservation</div>
            <div>Blog / FAQ</div>
            <div>Contact</div>
        </div>
    </div>
    <div>Codé par Noah, Maxence et Alexandre | Hébergé par Infomaniak</div>
</footer>