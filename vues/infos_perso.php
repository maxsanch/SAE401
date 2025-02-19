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

$resultpanier = "";

foreach ($panier as $valeurs) {
    $resultpanier .= '<div class="lignepanier"><div class="linetop"><div class="titre">' . $valeurs['Titre'] . '</div><div class="personnes">nombre de personnes : ' . $valeurs['nombre_personnes'] . '</div><div class="prix">prix total : ' . ($valeurs['nombre_personnes'] * $valeurs['prix']) . '</div></div><div class="infojour"><div class="jour">' . $valeurs['jour_reservation'] . '</div><div class="heure">' . $valeurs['heure_reservation'] . '</div><div class="prixsolo">' . $valeurs['prix'] . '</div></div><div class="description">' . $valeurs['description'] . '</div><a href=index.php?page=suppressionReservation&idJeu='.$valeurs['ID_jeu'].'&heure='.$valeurs['heure_reservation'].'&jour='.$valeurs['jour_reservation'].'><div class="iconepoubelle">Retirer du panier (mettre une icone de poubelle)</div></a></div>';
}

foreach ($souvenirs as $ligne) {
    $resultpanier .= '<div class="lignepanier"><div class="linetop"><div class="nom">'.$ligne['nom'].'</div><div class="prixTot">Prix total : '.($ligne['prix']*$ligne['quantitée']).' ('.$ligne['prix'].' x'.$ligne['quantitée'].')</div></div><div class="description">' . $ligne['description'] . '</div><a href=index.php?page=suppressionSouvenirs&idobj='.$ligne['id_objet_shop'].'&idpanier='.$ligne['id_panier'].'><div class="iconepoubelle">Retirer du panier (mettre une icone de poubelle)</div></a></div>';
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
    </div>
    <div class="paniers">
        <h2>Votre paniers</h2>

        <div class="infoproduits">
            <?= $resultpanier ?>
        </div>
    </div>
</div>