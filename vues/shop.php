<?php

$styles = '../styles/style_souvenirs.css';
$styles_telephone = "styles/telephone/souvenir_tel.css";
$result = "";

$script = "";

$librairie = '';

foreach ($objets as $valeur) {
    if (file_exists('img/objets/' . $valeur['id_objet_shop'] . '.jpg')) {
        $phototest = 'img/objets/' . $valeur['id_objet_shop'] . '.jpg';
        // Si l'image existe, l'affiche
    } else if (file_exists('img/objets/' . $valeur['id_objet_shop'] . '.png')) {
        $phototest = 'img/objets/' . $valeur['id_objet_shop'] . '.png';
    } else {
        // Sinon, affiche une image par défaut
        $phototest = 'img/objets/no_image.jpg';
    }

    if ($valeur['stock'] == 0) {
        $result .= "<div class='case'><div class='ImageDesProduits'><img src='" . $phototest . "'></div><div class='infotop'><div class='titre' id='TitreObjet".$valeur['id_objet_shop']."'>" . $valeur['nom'] . "</div><div class='prix'>" . $valeur['prix'] . " €</div></div><div class='description'>description : <span id='descriptionObjet".$valeur['id_objet_shop']."'>" . $valeur['description'] . "</span></div><div class='infobot'><div class='disponibilite'><div class='stock'>indisponible : " . $valeur['stock'] . "</div></div><form method='post' action='#'><input type='number' name='quantite' value='0' min='0' max='" . $valeur['stock'] . "' placeholder='quantite'></div><button class='add-cart'>Ajouter au panier</button></form></div>";
    } else {
        $result .= "<div class='case'><div class='ImageDesProduits'><img src='" . $phototest . "'></div><div class='infotop'><div class='titre' id='TitreObjet".$valeur['id_objet_shop']."'>" . $valeur['nom'] . "</div><div class='prix'>" . $valeur['prix'] . " €</div></div><div class='description'>description : <span id='descriptionObjet".$valeur['id_objet_shop']."'>" . $valeur['description'] . "</span></div><div class='infobot'><div class='disponibilite'><div class='stock'>disponible : " . $valeur['stock'] . "</div></div><form method='post' action='index.php?page=ajouterObjPanier&idobj=" . $valeur['id_objet_shop'] . "''><input type='number' name='quantite' value='1' min='1' max='" . $valeur['stock'] . "' placeholder='quantite'></div><button class='add-cart'>Ajouter au panier</button></form></div>";
    }
}

?>

<div class="titre">
    <h1>Envie de garder des souvenirs ?</h1>
    <div class="rectangleTitre">
    </div>
</div>
<div class="cellulAllobjets">
    <?= $result ?>
</div>