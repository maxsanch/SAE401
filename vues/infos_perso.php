<?php

$styles = "";

if (file_exists('img/user/' . $user['Id_utilisateur'] . '.jpg')) {
    $phototest = 'img/user/' . $user['Id_utilisateur'] . '.jpg';
    // Si l'image existe, l'affiche
} else if (file_exists('img/user/' . $user['Id_utilisateur'] . '.png')) {
    $phototest = 'img/user/' . $user['Id_utilisateur'] . '.png';
} else {
    // Sinon, affiche une image par défaut
    $phototest = 'img/user/no-user-image.jpg';
}

?>


<div class="total">
    <div class="infosUser">
        <div class="pic">
            <img src="<?= $phototest ?>" alt="Photo de l'utilisateur">
        </div>
        <form method="post" action="index.php?page=changerpdp" enctype="multipart/form-data">
            <div class="form_elt">
                <!-- Limite la taille maximale de fichier téléchargé (500Ko ici) -->
                <input type="hidden" name="MAX_FILE_SIZE" value="500000">
                <!-- Label pour l'input de téléchargement de photo -->
                <label>
                    <span class="orange">Modifiez </span> <span> la photo. (max 500ko)</span>
                    <!-- Champ pour sélectionner le fichier image (acceptant JPEG et PNG uniquement) -->
                    <input type="file" class="texte" name="photoUser" accept="image/jpeg, image/png" hidden>
                </label>
            </div>
            <!-- Bouton pour valider le formulaire -->
            <input class="boutbout" type="submit" class="valid" name="ok" value="modifier">
        </form>
        <div class="informations">
            <div class="name">
                <div class="nom">
                    <div class="inf">
                        Nom :
                    </div>
                    <?= $user['nom'] ?>
                </div>
                <div class="prenom">
                    <div class="inf">
                        Prenom :
                    </div>
                    <?= $user['prenom'] ?>
                </div>
            </div>
            <div class="mail">
                <div class="inf">
                    mail :
                </div>
                <?= $user['mail'] ?>
            </div>
            <div class="adresse">
                <div class="inf">
                    Adresse :
                </div>
                <?= $user['adresse'] ?>
            </div>
            <div class="deletaccount">
                <a href="index.php?page=deletMyAccount">
                    Supprimer le compte
                </a>
            </div>
        </div>

        <div class="paniers">

        </div>
    </div>
</div>