<?php
$styles = "";

if (file_exists('img/user/' . $_GET['idUser'] . '.jpg')) {
    $phototest = 'img/user/' . $_GET['idUser'] . '.jpg';
    // Si l'image existe, l'affiche
} else if (file_exists('img/user/' . $_GET['idUser'] . '.png')) {
    $phototest = 'img/user/' . $_GET['idUser'] . '.png';
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
        <form method="post" action="index.php?page=enregUserPhoto&idUser=<?= $_GET['idUser'] ?>"
            enctype="multipart/form-data">
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
                    <?= $user['nom'] ?>
                </div>
                <div class="prenom">
                    <?= $user['prenom'] ?>
                </div>
            </div>
            <div class="mail">
                <?= $user['mail'] ?>
            </div>
            <div class="adresse">
                <?= $user['adresse'] ?>
            </div>

        </div>


        <div class="modifmdp">
            
        </div>
    </div>
    <div class="panier">

    </div>
</div>