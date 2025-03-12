<?php
$styles_telephone = "styles/telephone/ajoutjeu_tel.css";
$styles = "../styles/style_ajoutJeu.css";

if (file_exists('img/photojeu/' . $_GET['idJeu']  . '.jpg')) {
    $phototest = 'img/photojeu/' . $_GET['idJeu']  . '.jpg';
    // Si l'image existe, l'affiche
} else if (file_exists('img/photojeu/' . $_GET['idJeu']  . '.png')) {
    $phototest = 'img/photojeu/' . $_GET['idJeu'] . '.png';
} else {
    // Sinon, affiche une image par défaut
    $phototest = 'img/photojeu/no_image.jpg';
}

$script = '<script src="js/ajoutJeu.js"></script>';

$librairie = "";

?>

<h2>
    <span id='modif-information'>modifier les informations de :</span> <?= $jeu['Titre'] ?><span id='game-number'>, jeu numéro </span><?= $jeu['ID_jeu'] ?>
</h2>
<div class="gridTop">
    <form action="<?= $_SERVER['PHP_SELF'] . '?page=modifierjeu&idjeu=' . $_GET['idJeu'] . '' ?>" method="post" enctype="multipart/form-data">
        <div class="nombre">
            <input type="text" name="titre" placeholder="un titre pour le jeu"  value="<?= $jeu['Titre'] ?>">
            <input type="text" name="Titre_anglais" placeholder="un titre pour le jeu"  value="<?= $jeu['Titre_anglais'] ?>">
        </div>
        <input type="text" name="link" value="<?= $jeu['lien_video'] ?>"
            placeholder="entrez le lien d'une vidéo youtube (partager, puis enlever : https://youtu.be/)">
        <div class="nombre">
            <input type="number" value="<?= $jeu['nombre_min'] ?>" name="min" placeholder="min participants">
            <input type="number" value="<?= $jeu['nombre_max'] ?>" name="max" placeholder="max participants">
        </div>
        <div class="nombre">
            <input type="number" value="<?= $jeu['age'] ?>" name="age" placeholder="age participants">
            <input type="number" value="<?= $jeu['prix'] ?>" name="prix" placeholder="prix">
        </div>
        <div class="nombre">
            <textarea required name="description" id="test"><?= $jeu['description'] ?></textarea>
            <textarea required name="Description_anglais" id="test"><?= $jeu['Description_anglais'] ?></textarea>
        </div>
        <div class="in" id='city-info'>
            infos ville : Cliquez sur la carte pour ajouter l'emplacement.
        </div>
        <div class="nombre">
            <input type="text" value="<?= $jeu['ville'] ?>" name="ville" placeholder="entrez une ville">
            <input type="text" value="<?= $jeu['ville'] ?>" name="region" placeholder="renseignez la région">
        </div>
        <div class="nombre">
            <input type="text" value="<?= $jeu['adresse'] ?>" name="adresse" placeholder="entrez une adresse">
            <input type="number" value="<?= $jeu['postale'] ?>" name="postale" placeholder="entrez un code postale">
        </div>
        <div class="form_elt">
            <!-- Limite la taille maximale de fichier téléchargé (500Ko ici) -->
            <input type="hidden" name="MAX_FILE_SIZE" value="500000">
            <!-- Label pour l'input de téléchargement de photo -->
            <label>
                <span class="orange" id='edit-game'>Modifiez </span> <span id='change-photo-max'> la photo. (max 500ko)</span>
                <input type="file" class="texte" name="photoGame" accept="image/jpeg, image/png" hidden>
            </label>
        </div>
        <input value="<?= $jeu['pays'] ?>" class="paysInput" type="hidden" name="Pays">
        <input value="<?= $jeu['coX'] ?>" class="xInput" type="hidden" name="coordonneesX">
        <input value="<?= $jeu['coY'] ?>" class="yInput" type="hidden" name="coordonneesY">

        <!-- Bouton pour valider le formulaire -->
        <input class="boutbout" type="submit" class="valid" name="ok" value="ajouter">
    </form>
    <div class="conteneur">
        <div class="cartes">
            <div class="Pays" id="France">
                <img src="../img/france.svg" alt="Carte de la france qui montre où sont les escapes games">
                <div class="point">
                    <img src="../img/map.svg" alt="map point">
                </div>
            </div>
            <div class="Pays none" id="Allemagne">
                <img src="../img/germany.svg" alt="Carte de l'allemagne qui montre où sont les escapes games">
                <div class="point">
                    <img src="../img/map.svg" alt="map point">
                </div>
            </div>
            <div class="boutons">
                <div class="flag" id="FranceFlag">
                    <img src="../img/allemagne.png" alt="drapeau de la france">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ima">
    <img src="<?= $phototest ?>" alt="image_jeu">
</div>