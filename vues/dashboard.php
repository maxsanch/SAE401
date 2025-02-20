<?php
require_once "controleur/ctlPanier.php";

$styles = "";


$result = "";
if (count($users)) {
    // Affichage des lignes du tableau
    foreach ($users as $ligne) {
        if (file_exists('img/user/' . $ligne['Id_utilisateur'] . '.jpg')) {
            $phototest = 'img/user/' . $ligne['Id_utilisateur'] . '.jpg';
            // Si l'image existe, l'affiche
        } else if (file_exists('img/user/' . $ligne['Id_utilisateur'] . '.png')) {
            $phototest = 'img/user/' . $ligne['Id_utilisateur'] . '.png';
        } else {
            // Sinon, affiche une image par défaut
            $phototest = 'img/user/no-user-image.jpg';
        }

        $acces = new ctlpanier;
        $paniervalid = $acces->getValidPaniers($ligne['Id_utilisateur']);
        $result .= "<div class='GrandeCase'><div class='PetiteCase'><a href='index.php?page=PhotoUser&idUser=" . $ligne['Id_utilisateur'] . "'><img class='photo' style='height: 250px; object-fit: cover;'' src='../" . $phototest . "' alt='photo'></a><b>" . $ligne['prenom'] . "</b><div>Dernière connexion : " . $ligne['connexion'] . "</div><div>paniers validés : " . count($paniervalid) . "</div><a class='Information' href='index.php?page=informationsUser&idUser=" . $ligne['Id_utilisateur'] . "'>Information</a></div></div>";
    }
} else{
     $result .= "<div class='reponse'>Aucun Utilisateur n'est enregistré</div>";
}

// tableau pour le graphique
$tableau = [];
foreach ($nombreparmois as $cle) {
    $tableau[] = $cle['nombreConnexion'] . ' ';
}
$final = join(',', $tableau);

?>


<div class="dashboard">
    <div class="nombre">
        <div class="nombrePanierValide">
            <img src="" alt="une icone">
            <div class="stat">
                <?= $comptepanier ?>
            </div>
        </div>
        <div class="nombreInscrit">
            <img src="" alt="une icone">
            <div class="stat">
                <?= $compteinscrit ?>
            </div>
        </div>
        <div class="nombreConnexion">
            <img src="" alt="une icone">
            <div class="stat">

            </div>
        </div>
    </div>
    <div class="graph">
            <canvas id="myChart"></canvas>
    </div>
</div>
<div class="usersAll">
    <?= $result ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // grapique chart js
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
            datasets: [{
                label: 'nombre de connexions',
                data: [<?= $final ?>],
                borderWidth: 1,
                backgroundColor: [
                    '#B95E06'
                ]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>