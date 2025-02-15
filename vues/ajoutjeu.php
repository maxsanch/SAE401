<?php

$styles = "";

?>


<form action="<?= $_SERVER['PHP_SELF'] . '?page=AjoutJeu' ?>" method="post" enctype="multipart/form-data">
    
    <input type="text" name="titre" placeholder="un titre pour le jeu">
    <input type="text" name="lieu" placeholder="entre l'id du lieu">
    <input type="email" name="mail" placeholder="entrez le mail pour les informations complémentaires sur ce jeu">
    <input type="text" name="link" placeholder="entrez le lien d'une vidéo youtube">
    <textarea name="description" id="test">Entrez une description du jeu</textarea>
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