<?php

$styles = "styles/style_reglement.css";
$styles_telephone = "styles/telephone/reglement_tel.css";
$librairie = '';

$script = "<script src='js/reglement.js'></script>";

$resultpanier = "";

$total = 0;

if (isset($_POST['numéro_carte'])) {
    $carte = $_POST['numéro_carte'];
} else {
    $carte = "";
}


if (isset($_POST['expiration'])) {
    $exp = $_POST['expiration'];
} else {
    $exp = "";
}
if (isset($_POST['nomUser'])) {
    $username = $_POST['nomUser'];
} else {
    $username = "";
}
if (isset($_POST['numéro_de_sécurité'])) {
    $secure = $_POST['numéro_de_sécurité'];
} else {
    $secure = "";
}


if (empty($panier) && empty($souvenirs)) {
    $resultpanier = "Vous n'avez aucun article dans votre panier.";
} else {
    foreach ($panier as $valeurs) {
        $resultpanier .= '<div class="lignepanier">
                            <div class="linetop">
                                <div class="titre" id="TitreJeu'.$valeurs['ID_jeu'].'">
                                    ' . $valeurs['Titre'] . '
                                </div>
                                <div class="personnes" >
                                    <span id="number-of-people">nombre de personnes : </span> ' . $valeurs['nombre_personnes'] . '
                                </div>
                                <div class="prix">
                                    <span id="total-price">prix total : </span> ' . ($valeurs['nombre_personnes'] * $valeurs['prix']) . ' €
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
                                    ' . $valeurs['prix'] . ' €
                                </div>
                            </div>
                            <div class="description" id="DescriptionJeu'.$valeurs['ID_jeu'].'">
                                ' . $valeurs['description'] . '
                            </div>
                        </div>';
        $total = ($total + ($valeurs['nombre_personnes'] * $valeurs['prix']));
    }
    foreach ($souvenirs as $ligne) {
        $resultpanier .= '<div class="lignepanier">
            <div class="linetop">
                <div class="nom" id="TitreObjet'.$ligne['id_objet_shop'].'">' . $ligne['nom'] . '</div>
                <div class="prixTot"><span id="total-price">Prix total : </span> ' . ($ligne['prix'] * $ligne['quantitée']) . ' € (' . $ligne['prix'] . ' € 
                    x' . $ligne['quantitée'] . ')</div>
                </div>
                <div id="descriptionObjet'.$ligne['id_objet_shop'].'">' . $ligne['description'] . '</div>
        </div>';
        $total = ($total + ($ligne['prix'] * $ligne['quantitée']));
    }
}
?>

<?= $erreur ?>
<div class="loader">
    <div class="engre">
        <div class="engrenage">
            <img src="../img/engre.svg" alt="Engrenage">
        </div>
        <div class="cadenas">
            <img src="../img/cadenas.svg" alt="Engrenage">
        </div>
    </div>
    <div class="smoke">
        <video src="../video/smoke.webm" muted autoplay></video>
    </div>
    <div class="background">
        <img src="../img/engrenage.png" alt="Engrenage">
    </div>
</div>

<div class="engrenages">
    <img src="../img/allEngre.png" alt="plein d'engrenages">
</div>
<div class="engrenage-single">
    <img class="small" src="../img/smallEngre.png" alt="petit engrenage">
    <img class="med1" src="../img/medEngre.png" alt="petit engrenage">
    <img class="med2" src="../img/medEngre.png" alt="petit engrenage">
</div>

<div class="all">
    <div class="paniers">
        <div class="titrePage">
            <h2 id='your-cart'>Votre panier</h2>
            <div class="rectangleTitre">
            </div>
        </div>

        <div class="infoproduits">
            <?= $resultpanier ?>
        </div>
        <div class="total">
            Total : <?= $total ?> €
        </div>
    </div>
    <div class="infoUser">
        <div class="titrePage">
            <h2 id='your-cart'>Votre panier</h2>
            <div class="rectangleTitre">
            </div>
        </div>
        <div class="sousinf">
            <div class="name">
                <div class="nom">
                    <div class="inf">
                        <p id='last-name'>Nom</p>
                        <div class="contour"><?= $user['nom'] ?></div>
                    </div>
                </div>
                <div class="prenom">
                    <div class="inf">
                        <p id='first-name'>Prenom</p>
                        <div class="contour"><?= $user['prenom'] ?></div>
                    </div>
                </div>
            </div>
            <div class="mail">
                <div class="inf">
                    <p>E-mail</p>
                    <div class="contour"><?= $user['mail'] ?></div>
                </div>
            </div>
            <div class="adresse">
                <div class="inf">
                    <p id='address-field'>Adresse</p>
                    <div class="contour"><?= $user['adresse'] ?></div>
                </div>
            </div>
        </div>
        <form action="index.php?page=valide" id="carte" method="post">
            <div class="carte_flip">
                <div class="in">
                    <div class="carte_front">
                        <div class="top">
                            <div class="titrecb" id='bank-card'>
                                Carte bancaire
                            </div>
                            <div class="logo_cb">
                                <img src="../img/cb.jpg" alt="logo">
                            </div>
                        </div>
                        <div class="line2">
                            <div class="puce">
                                <img src="../img/puce.png" alt="puce en or">
                            </div>
                        </div>
                        <div class="numbers">
                            <input type="text" name="numéro_carte" value="<?= $carte ?>" required minlength="19"
                                maxlength="19" id="num" placeholder="Numéro de carte">
                        </div>
                        <div class="gridbottom">
                            <div class="inputs">
                                <label>
                                    <div class="expire" id='expires-end'>
                                        EXPIRE A FIN
                                    </div>
                                    <input type="text" required name="expiration" value="<?= $exp ?>" id="expiration"
                                        placeholder="date d'expiration">
                                </label>
                                <input type="text" required name="nomUser" id="nomuser" value="<?= $username ?>"
                                    placeholder="Nom du proprietaire">
                            </div>
                            <div class="logo_cb">
                                <img src="../img/cb.jpg" id="logo" alt="logo_type_carte">
                            </div>
                        </div>
                    </div>
                    <div class="carte_back">
                        <div class="ligne_reglement">

                        </div>
                        <label>
                            <span id='security-number'>Numéro de sécurité : </span><input type="number" value="<?= $secure ?>" max=999 required id="securite" name="numéro_de_sécurité" placeholder="Code de securité">
                        </label>
                    </div>
                </div>
            </div>
            <div class="flibandvalid">
                <div class="flipcard" id='turn-card'>
                    Tourner la carte
                </div>
                <button type="submit" id="validerCommande">Valider la commande</button>
            </div>
        </form>
    </div>
</div>