<?php
require_once "modeles/panier.class.php";

$styles = "../styles/style_modifuser.css";
$styles_telephone = "";
$librairie = '';

if (file_exists('img/user/' . $_GET['idUser'] . '.jpg')) {
    $phototest = 'img/user/' . $_GET['idUser'] . '.jpg';
    // Si l'image existe, l'affiche
} else if (file_exists('img/user/' . $_GET['idUser'] . '.png')) {
    $phototest = 'img/user/' . $_GET['idUser'] . '.png';
} else {
    // Sinon, affiche une image par défaut
    $phototest = 'img/user/no-user-image.jpg';
}


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
                            <div class="titre" id="TitreJeu' . $ligne['ID_jeu'] . '">
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
                        <div class="description" id="DescriptionJeu' . $ligne['ID_jeu'] . '">
                            ' . $ligne['description'] . '
                        </div>
                    </div>';
        }
        foreach ($anciensSouvenirs as $ligne) {
            $lignes .= '<div class="lignepanier">
                <div class="linetop">
                    <div class="nom" id="TitreObjet' . $ligne['id_objet_shop'] . '">' . $ligne['nom'] . '</div>
                    <div class="prixTot">Prix total : ' . ($ligne['prix'] * $ligne['quantitée']) . ' (' . $ligne['prix'] . '
                            x' . $ligne['quantitée'] . ')</div>
                </div>
                <div class="description" id="descriptionObjet' . $ligne['id_objet_shop'] . '">' . $ligne['description'] . '</div>
            </div>';
        }
        $paniervalides .= '<div class="AciennesCommandes">
                                <h3>Numéro de commande : ' . $valeur['id_panier'] . '</h3>
                                <div class="accueilPanier">
                                    ' . $lignes . '
                                </div>
                                <div class="dateValidation">
                                    Panier validé le : ' . date('d / m / Y à H : i : s', strtotime($valeur['derniere_modification'])) . '
                                </div>
                           </div> ';
    }
} else {
    $paniervalides .= "Cett utilisateur n'a passé aucune commande.";
}


?>

<div class="MiseEnPage">
    <div class="total">
        <div class="Separation">
            <h1>informations sur : <?= $user['prenom'] ?></h1>
            <div class="infosUser">
                <div class="pic">
                    <img src="<?= $phototest ?>" alt="Photo de l'utilisateur">
                </div>
                <form class="ChangerPhoto" method="post"
                    action="index.php?page=enregUserPhoto&idUser=<?= $_GET['idUser'] ?>" enctype="multipart/form-data">
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
            </div>
        </div>
        <div class="Separation">
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

            <div class="modifiermdp">
                <form method="post" action="index.php?page=ModifMdpUser&idUser=<?= $_GET['idUser'] ?>">
                    <input class="modifiermdpInput" type="password" name="mdp"
                        placeholder="entrez le nouveau mot de passe">
                    <div>
                        <input class="modifiermdpInput" type="password" name="confirmation"
                            placeholder="entrez le nouveau mot de passe">
                        <button class="modifiermdpBouton">Modifier</button>
                    </div>
                </form>
            </div>
            <div class="deletaccount">
                <a href="index.php?page=supprimerCompte&idUser=<?= $_GET['idUser'] ?>">Supprimer le compte</a>
            </div>
        </div>
    </div>
    <div class="ancienspaniers">
        <div class="titre">
            <h2 class="anciens-paniers-total">Anciennes commandes</h2>
            <div class="rectangleTitre">
            </div>
        </div>
        <div class="cadreproduit"><?= $paniervalides ?></div>
    </div>
</div>