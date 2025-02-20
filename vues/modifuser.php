<?php
require_once "modeles/panier.class.php";

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
        $paniervalides .= '<div class="panier">
                                <h3>Numéro de commande : ' . $valeur['id_panier'] . '</h3>
                                <div class="accueilPanier">
                                    ' . $lignes . '
                                </div>
                           </div> ';
    }
} else {
    $paniervalides .= "Cet utilisateur n'a passé encore aucune commande.";
}


?>

<div class="total">
    <h1>informations sur : <?= $user['prenom'] ?></h1>
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

        <div class="informationPopUp">
            <?= $message ?>
        </div>

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
            <!-- rendre le bouton clicable pour qu'au clic, la fenetre du formulaire "modifiermdp" s'ouvre. -->
            Modifier le mot de passe
        </div>
        <div class="deletaccount">
            <a href="index.php?page=supprimerCompte&idUser=<?= $_GET['idUser'] ?>">Supprimer le compte</a>
        </div>
        <div class="modifiermdp">
            <form method="post" action="index.php?page=ModifMdpUser&idUser=<?= $_GET['idUser'] ?>">
                <input type="password" name="mdp" placeholder="entrez le nouveau mot de passe">
                <input type="password" name="confirmation"  placeholder="entrez le nouveau mot de passe">
                <button>Modifier</button>
            </form>
        </div>
    </div>
    <div class="panier">
        <h2>Commandes effectuées</h2>
        <?= $paniervalides ?>
    </div>
</div>