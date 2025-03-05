<?php

$styles = "../styles/style_ajoutJeu.css";

$librairie = '';

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

    $result .= '<div class="case"><a href="index.php?page=modifjeu&idJeu=' . $valeur['ID_jeu'] . '" class="photo"><img src="' . $phototest . '" alt="Jeu choisi"></a><div class="contTout"><b>' . $valeur['Titre'] . '</b><div class="parentBout"><a class="bout" href="index.php?page=infojeusolo&idjeu=' . $valeur['ID_jeu'] . '">Voir le jeu</a></div><div class="parentBout"><a href="index.php?page=modifjeu&idJeu=' . $valeur['ID_jeu'] . '" class="bout">Modifier</a></div><div class="parentBout"><a href="index.php?page=supprJeu&idJeu=' . $valeur['ID_jeu'] . '" class="bout">Supprimer</a></div></div></div>';
}

$script = '<script src="js/ajoutJeu.js"></script>';

?>


<div class="gridTop">
    <form action="<?= $_SERVER['PHP_SELF'] . '?page=AjoutJeu' ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="titre" placeholder="un titre pour le jeu">
        <input type="text" name="link"
            placeholder="entrez le lien d'une vidéo youtube (partager, puis enlever : https://youtu.be/)">
        <div class="nombre">
            <input type="number" name="min" placeholder="min participants">
            <input type="number" name="max" placeholder="max participants">
        </div>
        <div class="nombre">
            <input type="number" name="age" placeholder="age participants">
            <input type="number" name="prix" placeholder="prix">
        </div>
        <textarea name="description" id="test">Entrez une description du jeu</textarea>
        <div class="in">
            infos ville : Cliquez sur la carte pour ajouter l'emplacement.
        </div>
        <div class="nombre">
            <input type="text" name="ville" placeholder="entrez une ville">
            <input type="text" name="region" placeholder="renseignez la région">
        </div>
        <div class="nombre">
            <input type="text" name="adresse" placeholder="entrez une adresse">
            <input type="number" name="postale" placeholder="entrez un code postale">
        </div>
        <div class="form_elt">
            <!-- Limite la taille maximale de fichier téléchargé (500Ko ici) -->
            <input type="hidden" name="MAX_FILE_SIZE" value="500000">
            <!-- Label pour l'input de téléchargement de photo -->
            <label>
                <span class="orange">Ajoutez </span> <span> Une photo. (max 500ko)</span>
                <!-- Champ pour sélectionner le fichier image (acceptant JPEG et PNG uniquement) -->
                <input type="file" class="texte" name="photoGame" accept="image/jpeg, image/png" hidden>
            </label>
        </div>
        <input class="paysInput" type="hidden" name="Pays">
        <input class="xInput" type="hidden" name="coordonneesX">
        <input class="yInput" type="hidden" name="coordonneesY">

        <!-- Bouton pour valider le formulaire -->
        <input class="boutbout" type="submit" class="valid" name="ok" value="ajouter">
        <div class="err">
            <?= $erreur ?>
        </div>
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
<div class="jeux">
    <!-- result sera bougé la ou tu voudra afficher dinamiquement tout les jeux, a modifier en conséquence en haut. -->
    <?= $result ?>
</div>