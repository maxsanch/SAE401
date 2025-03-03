<?php

$styles = "";

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

    $result .= '<div class="case"><a href="index.php?page=modifjeu&idRuche=' . $valeur['ID_jeu'] . '" class="photo"><img src="' . $phototest . '" alt="Jeu choisi" style="height: 200px; object-fit: cover;"></a><b>' . $valeur['Titre'] . '</b><a class="bout" href="index.php?page=infojeusolo&idJeu=' . $valeur['ID_jeu'] . '">Voir le jeu</a><a href="index.php?page=modifjeu&idJeu=' . $valeur['ID_jeu'] . '" class="bout">Modifier</a><a href="index.php?page=supprJeu&idJeu=' . $valeur['ID_jeu'] . '" class="bout">Supprimer</a></div>';
}

$script = "";

?>


<div class="gridTop">
    <form action="<?= $_SERVER['PHP_SELF'] . '?page=AjoutJeu' ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="titre" placeholder="un titre pour le jeu">
        <input type="email" name="mail" placeholder="entrez le mail pour les informations complémentaires sur ce jeu">
        <input type="text" name="link" placeholder="entrez le lien d'une vidéo youtube">
        <input type="number" name="min" placeholder="min participants">
        <input type="number" name="max" placeholder="max participants">
        <input type="number" name="age" placeholder="age participants">
        <input type="number" name="prix" placeholder="prix">
        <textarea name="description" id="test">Entrez une description du jeu</textarea>

        <div class="in">
            infos ville :
        </div>

        <input type="text" name="ville" placeholder="entrez une ville">
        <input type="text" name="adresse" placeholder="entrez une adresse">
        <input type="number" name="postale" placeholder="entrez un code postale">

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
        <!-- Bouton pour valider le formulaire -->
        <input class="boutbout" type="submit" class="valid" name="ok" value="Valider">
    </form>
    .
</div>

<div class="err">
    <?= $erreur ?>
</div>

<div class="jeux">
    <!-- result sera bougé la ou tu voudra afficher dinamiquement tout les jeux, a modifier en conséquence en haut. -->
    <?= $result ?>
</div>