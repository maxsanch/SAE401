<?php
require_once "controleur/ctlPanier.php";

$styles = "../styles/style_dashboard.css";
$styles_telephone = "styles/telephone/dashbord_tel.css";
$librairie = '';

$result = "";

$script = "<script src='js/fermer.js'></script>";

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
        $result .= "<div class='PetiteCase'><a class='PhotoDeProfil' href='index.php?page=informationsUser&idUser=" . $ligne['Id_utilisateur'] . "'><img class='photo' style='height: 250px; object-fit: cover;'' src='../" . $phototest . "' alt='photo'></a><div class='MiseEnPageUser'><div class='MiseEnPageUser2'><div class='Nom'>" . $ligne['prenom'] . "</div><div class='InfoDansCase'><span id='last-login'>Dernière connexion : </span> " . $ligne['connexion'] . "</div><div class='InfoDansCase'><span id='validated-carts'>paniers validés : </span> " . count($paniervalid) . "</div><div class='CadreInfo'><a class='InformationDashbord' href='index.php?page=informationsUser&idUser=" . $ligne['Id_utilisateur'] . "'>Informations</a></div></div></div></div>";
    }
} else {
    $result .= "<div class='reponse' id='no-user-registered'>Aucun Utilisateur n'est enregistré</div>";
}

// tableau pour le graphique
$tableau = [];
foreach ($nombreparmois as $cle) {
    $tableau[] = $cle['nombreConnexion'] . ' ';
}
$final = join(',', $tableau);


if (!empty($meilleurRes) && !empty($meilleurSouv)) {
    if ($meilleurRes[0]['total'] >= $meilleurSouv[0]['total']) {
        $meilleur = $meilleurRes[0]['Titre'];
    } else {
        $meilleur = $meilleurSouv[0]['nom'];
    }
} else {
    $meilleur = "<span id='no-basket-validated'> aucun panier n'a encore été validé, il est alors impossible de définir une préférence.</span>";
}

?>

<?= $erreur ?>
<div class="MiseEnPage">
    <div class="dashboard">
        <div class="nombre">
            <div class="nombrePanierValide">
                <img src="../img/Shopping_bag.png" alt="une icone">
                <div class="stat">
                    <span id='number-of-validated-carts'>Nombre de paniers validés : </span> <?= $comptepanier ?>
                </div>
            </div>
            <div class="nombreInscrit">
                <img src="../img/User2.svg" alt="une icone">
                <div class="stat">
                    <span id='number-of-registrations'>Nombre d'inscriptions : </span><?= $compteinscrit ?>
                </div>
            </div>
            <!-- <div class="nombreConnexion">
            <img src="" alt="une icone">
            <div class="stat"> -->

            <!-- </div>
        </div> -->
            <div class="nombrePanierValide">
                <img src="../img/Shopping_cart.png" alt="une icone">
                <div class="stat">
                    <span id='favorite-product'>Produit préféré : </span><?= $meilleur ?>
                </div>
            </div>
        </div>
        <div class="MiseEnPage">
            <div class="graph">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <div class="MiseEnPage">
        <div class="usersAll">
            <?= $result ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // grapique chart js
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            // changer les labels pour les mois et le texte "nombre de connexions" avec la traduction
            labels: ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
            datasets: [{
                label: 'nombre de connexions',
                data: [<?= $final ?>],
                borderWidth: 1,
                backgroundColor: [
                    '#BC9032'
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