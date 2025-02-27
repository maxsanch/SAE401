<?php

require_once "modeles/panier.class.php";

$librairie = '';

$styles = "";

$script = "";

$panierClass = new panier;

$paniervalides = '';
if (!empty($anciensPaniers)) {
    foreach ($anciensPaniers as $valeur) {
        $anciennesReservations = $panierClass->LastReservations($valeur['id_panier']);
        $anciensSouvenirs = $panierClass->LastSouvenirs($valeur['id_panier']);

        $lignes = "";
        foreach ($anciennesReservations as $ligne) {
            $lignes .= '<div class="lignepanier">
                        <div class="linetop">
                            <div class="titre">
                                ' . $ligne['Titre'] . '
                            </div>
                            <div class="personnes">
                                nombre de personnes : ' . $ligne['nombre_personnes'] . '
                            </div>
                            <div class="prix">
                                prix total : ' . ($ligne['nombre_personnes'] * $ligne['prix']) . '
                            </div>
                        </div>
                        <div class="infojour">
                            <div class="jour">
                                ' . $ligne['jour_reservation'] . '
                            </div>
                            <div class="heure">
                                ' . $ligne['heure_reservation'] . '
                            </div>
                            <div class="prixsolo">
                                ' . $ligne['prix'] . '
                            </div>
                        </div>
                        <div class="description">
                            ' . $ligne['description'] . '
                        </div>
                    </div>';
        }
        foreach ($anciensSouvenirs as $ligne) {
            $lignes .= '<div class="lignepanier">
                <div class="linetop">
                    <div class="nom">' . $ligne['nom'] . '</div>
                    <div class="prixTot">Prix total : ' . ($ligne['prix'] * $ligne['quantitée']) . ' (' . $ligne['prix'] . '
                            x' . $ligne['quantitée'] . ')</div>
                </div>
                <div class="description">' . $ligne['description'] . '</div>
            </div>';
        }
        $paniervalides .= '<div class="AciennesCommandes">
                                <h3>Numéro de commande : ' . $valeur['id_panier'] . '</h3>
                                <div class="accueilPanier">
                                    ' . $lignes . '
                                </div>
                           </div> ';
    }
} else {
    $paniervalides .= "Vous n'avez aucune ancienne commande.";
}


if (file_exists('img/user/' . $user['Id_utilisateur'] . '.jpg')) {

    $phototest = 'img/user/' . $user['Id_utilisateur'] . '.jpg'; // Si l'image existe, l'affiche
} else if (file_exists('img/user/' . $user['Id_utilisateur'] . '.png')) {
    $phototest = 'img/user/' . $user['Id_utilisateur'] . '.png';
} else { // Sinon, affiche une image par défaut
    $phototest = 'img/user/no-user-image.jpg';
}


$resultpanier = "";
if (empty($panier) && empty($souvenirs)) {
    $resultpanier = "Vous n'avez aucun article dans votre panier.";
} else {
    foreach ($panier as $valeurs) {
        $resultpanier .= '<div class="lignepanier">
                            <div class="linetop">
                                <div class="titre">
                                    ' . $valeurs['Titre'] . '
                                </div>
                                <div class="personnes">
                                    nombre de personnes : ' . $valeurs['nombre_personnes'] . '
                                </div>
                                <div class="prix">
                                    prix total : ' . ($valeurs['nombre_personnes'] * $valeurs['prix']) . '
                                </div>
                            </div>
                            <div class="infojour">
                                <div class="jour">
                                    ' . $valeurs['jour_reservation'] . '
                                </div>
                                <div class="heure">
                                    ' . $valeurs['heure_reservation'] . '
                                </div>
                                <div class="prixsolo">
                                    ' . $valeurs['prix'] . '
                                </div>
                            </div>
                            <div class="description">
                                ' . $valeurs['description'] . '
                            </div>
                            <a href=index.php?page=suppressionReservation&idJeu=' . $valeurs['ID_jeu'] . '&heure=' . $valeurs['heure_reservation'] . '&jour=' . $valeurs['jour_reservation'] . '>
                            <div class="iconepoubelle">
                                Retirer du panier (mettre une icone de poubelle)
                            </div>
                            </a>
                        </div>';
    }
    foreach ($souvenirs as $ligne) {
        $resultpanier .= '<div class="lignepanier">
            <div class="linetop">
                <div class="nom">' . $ligne['nom'] . '</div>
                <div class="prixTot">Prix total : ' . ($ligne['prix'] * $ligne['quantitée']) . ' (' . $ligne['prix'] . '
                    x' . $ligne['quantitée'] . ')</div>
            </div>
            <div class="description">' . $ligne['description'] . '</div>
            <form action=index.php?page=suppressionSouvenirs&idobj=' . $ligne['id_objet_shop'] . '&idpanier=' . $ligne['id_panier'] . ' method=post>
                <input type=number placeholder="entre un nombre" max=' . $ligne['quantitée'] . ' name="nombredelet">
                <button class="iconepoubelle">Retirer du panier (mettre une icone de poubelle)</button>
            </form>
        </div>';
    }
}

?>


<div class="total">
    <h1>Mon compte</h1>
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
            <form action="<?= $_SERVER['PHP_SELF'] . '?page=modifprofil' ?>" method="post">
                <div class="sousinf">
                    <div class="name">
                        <div class="nom">
                            <label class="inf">
                                <p>Nom</p><input type="text" name="nom" value="<?= $user['nom'] ?>" required>
                            </label>
                        </div>
                        <div class="prenom">
                            <label class="inf">
                                <p>Prenom</p><input type="text" name="prenom" value="<?= $user['prenom'] ?>" required>
                            </label>
                        </div>
                    </div>
                    <div class="mail">
                        <label class="inf">
                            <p>E-mail</p><input type="mail" name="mail" value="<?= $user['mail'] ?>" disabled>
                        </label>
                    </div>
                    <div class="adresse">
                        <label class="inf">
                            <p>Adresse</p><input type="text" name="adresse" value="<?= $user['adresse'] ?>" required>
                        </label>
                    </div>
                </div>
                <div class="mdp">
                    <!-- pour changer le mot de passe de l'utilisteur -->
                    <div><b>Changer de mot de passe</b></div>
                    <label>
                        <p>Nouveau mot de passe</p> <input type="password" class="motdepasse" name="NewPassword"
                            placeholder="entrez votre nouveau mot de passe">
                        <div class="oeil oeilferme">
                            <img id="fermé" src="../img/oeilfermé.svg" alt="icone d'oeil">
                        </div>
                    </label>

                    <label>
                        <p>Confirmez le mot de passe</p><input type="password" class="motdepasse"
                            name="ConfirmationNewPassword" placeholder="confirmez votre mot de passe">
                        <div class="oeil oeilferme">
                            <img id="fermé" src="../img/oeilfermé.svg" alt="icone d'oeil">
                        </div>
                    </label>
                </div>
                <div class="validation">
                    <label>
                        <p>Pour enregistrer les modifications, vous devez entrer votre mot de passe</p><input
                            type="password" name="ancienmdp" class="motdepasse" required
                            placeholder="entrez votre mot de passe">
                        <div class="oeil oeilferme">
                            <img id="fermé" src="../img/oeilfermé.svg" alt="icone d'oeil">
                        </div>
                    </label>
                </div>
                <button>Modifier</button>
                <?= $erreur ?>
            </form>

            <div class="deletaccount">
                <a href="index.php?page=deletMyAccount">
                    Supprimer le compte
                </a>
            </div>
        </div>
    </div>
    <div class="Lastpaniers">
        <h2>Votre paniers</h2>

        <div class="infoproduits">
            <?= $resultpanier ?>
        </div>
    </div>
    <div class="ancienspaniers">
        <h2>Anciennes commandes</h2>
        <?= $paniervalides ?>
    </div>
</div>