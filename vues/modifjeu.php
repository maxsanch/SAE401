<?php

$styles = "";

if (file_exists('img/photojeu/' . $_GET['idJeu']  . '.jpg')) {
    $phototest = 'img/photojeu/' . $_GET['idJeu']  . '.jpg';
    // Si l'image existe, l'affiche
} else if (file_exists('img/photojeu/' . $_GET['idJeu']  . '.png')) {
    $phototest = 'img/photojeu/' . $_GET['idJeu'] . '.png';
} else {
    // Sinon, affiche une image par défaut
    $phototest = 'img/photojeu/no_image.jpg';
}

?>

<h1>
    modifier les informations de : <?= $jeu['Titre'] ?>, jeu numéro <?= $jeu['ID_jeu'] ?>
</h1>
<div class="informationmodif">
    <form action="<?= $_SERVER['PHP_SELF'] . '?page=modifierjeu&idjeu=' . $_GET['idJeu'] . '' ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="titre" value="<?= $jeu['Titre'] ?>" placeholder="Modifiez le titre du jeu">
        <input type="email" name="mail" value="<?= $jeu['mail'] ?>"
            placeholder="entrez le mail pour les informations complémentaires sur ce jeu">
        <input type="text" name="link" value="<?= $jeu['lien_video'] ?>"
            placeholder="entrez le lien d'une vidéo youtube">
        <input type="number" name="min" value="<?= $jeu['nombre_min'] ?>" placeholder="min participants">
        <input type="number" name="max" value="<?= $jeu['nombre_max'] ?>" placeholder="max participants">
        <input type="number" name="age" value="<?= $jeu['age'] ?>" placeholder="age participants">
        <textarea name="description" id="test"><?= $jeu['description'] ?></textarea>

        <div class="in">
            infos ville :
        </div>

        <input type="text" name="ville" value="<?= $jeu['ville'] ?>" placeholder="entrez une ville">
        <input type="text" name="adresse" value="<?= $jeu['adresse'] ?>" placeholder="entrez une adresse">
        <input type="number" name="postale" value="<?= $jeu['postale'] ?>" placeholder="entrez un code postale">

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
        <input class="boutbout" type="submit" class="valid" name="ok" value="modifier">
    </form>
</div>

<div class="ima">
    <img src="<?= $phototest ?>" alt="image_jeu">
</div>
<div class="back">
    <a href="index.php?page=PageAjoutJeu">Page précédente.</a>
</div>