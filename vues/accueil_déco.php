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


        <div class="ContourRuche">
            <div class="UneRuche"><img class="ImageDeLaRuche" style="height: 250px; object-fit: cover;"
                    src="img/Rectangle 26.png" alt="Tes ruches">
                <div class="MaRucheTitre">La nuit d'horreur</div>
                <div class="azert">
                    <div class="InfoRuche">age : 16 ans</div>
                    <div class="azert">
                        <div class="User"><img src="img/Users.svg" alt="Icon d'utilisateur"></div>
                        <div class="InfoRuche">3 - 8</div>
                    </div>
                </div>

                <div class="BoutonEscapeGame">
                    <a href="/" class="MaRucheBouton">Voir plus</a>
                    <a href="/" class="MaRucheBouton">Réserver</a>
                </div>
            </div>
        </div>
    </div>
</div>