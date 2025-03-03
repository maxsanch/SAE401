<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/controleur/ctlUser.php";

$Profil = new ctlUser;

$user = $Profil->RecupererUser();

if (file_exists('img/user/' . $user['Id_utilisateur'] . '.jpg')) {

    $phototest = 'img/user/' . $user['Id_utilisateur'] . '.jpg'; // Si l'image existe, l'affiche
} else if (file_exists('img/user/' . $user['Id_utilisateur'] . '.png')) {
    $phototest = 'img/user/' . $user['Id_utilisateur'] . '.png';
} else { // Sinon, affiche une image par défaut
    $phototest = 'img/user/no-user-image.jpg';
}

?>

<div class="centreHeader">
    <div><a href="index.php"><img src="img/Logo.png" alt="Logo de we escape"></a></div>
    <div class="HeaderCoteDroite">
        <div class="HeaderBouton"><a href="index.php">Accueil</a></div>
        <div class="HeaderBouton"><a href="index.php?page=propos"> A propos</a></div>
        <div class="HeaderBouton"><a href="index.php?page=jeuxAll">Les jeux</a></div>
        <div class="HeaderBouton"><a href="index.php?page=carte">Nous trouver</a></div>
        <div class="HeaderBouton"><a href="index.php?page=Contacts">Contacts</a></div>
        <div class="HeaderBouton Reservation"><a href="index.php?page=connexion">Réservation</a></div>
        <div class="HeaderBouton" id="panier"><img src="img/Shopping_bag.png" alt="Sac des réservations"></div>
        <div class="HeaderBouton"><a href="index.php?page=shop"><img src="img/Shopping_cart.png"
                    alt="Caddies des réservations"></a></div>
        <div class="HeaderBouton PhotoDeProfilHeader">
            <a href="index.php?page=informationmyuser">
                <img src="<?= $phototest ?>" alt="Photo de l'utilisateur">
            </a>
        </div>
    </div>
</div>