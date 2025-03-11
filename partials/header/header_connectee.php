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

$header = 'test';

if ($user['niveau'] == 'admin') {

    $header = '<div class="centreHeader">
                <div><a href="index.php"><img src="img/Logo.png" alt="Logo de we escape"></a></div>
                <div class="HeaderCoteDroite">
                    <div class="HeaderBouton"><a href="index.php" class="home">Accueil</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=propos" class="about">A propos</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=jeuxAll" class="games-header">Les jeux</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=carte" class="find-us">Nous trouver</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=Contacts" class="contacts-header">Contacts</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=checkusers" class="users-header">Utilisateurs</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=PageAjoutJeu" class="add-games">Ajouter un escape game</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=quitter" class="disconnect">Se déconnecter</a></div>
                    <div class="HeaderBouton Reservation"><a href="index.php?page=reglement" class="book-header">Réservation</a></div>
                    <div class="autre" id="panier"><img src="img/Shopping_bag.png" alt="Sac des réservations"></div>
                    <div class="autre"><a href="index.php?page=shop"><img src="img/Shopping_cart.png"
                                alt="Caddies des réservations"></a></div>
                    <div class="autre PhotoDeProfilHeader">
                        <a href="index.php?page=informationmyuser">
                            <img src="' . $phototest . '" alt="Photo de profil">
                        </a>
                    </div>
                </div>
            </div>
            


            <div class="HeaderMobile">
                <div class="Conteneur">
                    <div class="ConteneurHeader">
                        <a href="index.php" class="TitreHeader">We escape</a>
                        <div class="tribarres">
                            <div class="barresingle"></div>
                            <div class="barresingle"></div>
                            <div class="barresingle"></div>
                        </div>
                    </div>
                </div>
                <div class="liensdéroulant">
                    <div class="HeaderBouton"><a href="index.php" class="home">Accueil</a></div>
                    <div class="HeaderBouton" ><a href="index.php?page=propos" class="about">A propos</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=jeuxAll" class="games-header">Les jeux</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=carte" class="find-us">Nous trouver</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=Contacts" class="contacts-header">Contacts</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=checkusers" class="users-header">Utilisateurs</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=PageAjoutJeu" class="add-games">Ajouter un escape game</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=informationmyuser" class="my-profil">Mon compte</a></div>
                    <div class="HeaderBouton Panier" id="panier">Mon panier</div>
                    <div class="HeaderBouton"><a href="index.php?page=shop" class="shop-header">Magasin</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=quitter" class="disconnect">Se déconnecter</a></div>
                    <div class="HeaderBouton"><a href="index.php?page=reglement" class="book-header">Réservation</a></div>
                </div>
            </div>';
} else {
    $header = '<div class="centreHeader">
                    <div><a href="index.php"><img src="img/Logo.png" alt="Logo de we escape"></a></div>
                    <div class="HeaderCoteDroite">
                        <div class="HeaderBouton"><a href="index.php" class="home">Accueil</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=propos" class="about"> A propos</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=jeuxAll" class="games">Les jeux</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=carte" class="find-us">Nous trouver</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=Contacts" class="contacts-header">Contacts</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=quitter" class="disconnect">Se déconnecter</a></div>
                        <div class="HeaderBouton Reservation"><a href="index.php?page=reglement" class="book-header">Réservation</a></div>
                        <div class="autre" id="panier"><img src="img/Shopping_bag.png" alt="Sac des réservations"></div>
                        <div class="autre"><a href="index.php?page=shop"><img src="img/Shopping_cart.png"
                                    alt="Caddies des réservations"></a></div>
                        <div class="autre PhotoDeProfilHeader">
                            <a href="index.php?page=informationmyuser">
                                <img src="' . $phototest . '" alt="Photo de profil">
                            </a>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="HeaderMobile">
                <div class="Conteneur">
                    <div class="ConteneurHeader">
                        <a href="index.php" class="TitreHeader">We escape</a>
                        <div class="tribarres">
                            <div class="barresingle"></div>
                            <div class="barresingle"></div>
                            <div class="barresingle"></div>
                        </div>
                    </div>
                </div>
                <div class="liensdéroulant">
                   <div class="HeaderBouton"><a href="index.php" class="home">Accueil</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=propos" class="about"> A propos</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=jeuxAll" class="games">Les jeux</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=carte" class="find-us">Nous trouver</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=Contacts" class="contacts-header">Contacts</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=informationmyuser" class="my-profil">Mon compte</a></div>
                        <div class="HeaderBouton Panier" id="panier">Mon panier</div>
                        <div class="HeaderBouton"><a href="index.php?page=shop" class="shop-header">Magasin</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=quitter" class="disconnect">Se déconnecter</a></div>
                        <div class="HeaderBouton"><a href="index.php?page=reglement" class="book-header">Réservation</a></div>
                </div>
            </div>';
}


echo $header;

?>