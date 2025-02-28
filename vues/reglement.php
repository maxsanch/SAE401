<?php

$styles = "styles/style_reglement.css";

$librairie = '';

$script = "<script src='js/reglement.js'></script>";

$resultpanier = "";
$total = 0;
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
        $total = ($total + ($valeurs['nombre_personnes'] * $valeurs['prix']));
    }
    foreach ($souvenirs as $ligne) {
        $resultpanier .= '<div class="lignepanier">
            <div class="linetop">
                <div class="nom">' . $ligne['nom'] . '</div>
                <div class="prixTot">Prix total : ' . ($ligne['prix'] * $ligne['quantitée']) . ' (' . $ligne['prix'] . '
                    x' . $ligne['quantitée'] . ')</div>
            </div>
            <div class="description">' . $ligne['description'] . '</div><a
                href=index.php?page=suppressionSouvenirs&idobj=' . $ligne['id_objet_shop'] . '&idpanier=' . $ligne['id_panier'] . '>
                <div class="iconepoubelle">Retirer du panier (mettre une icone de poubelle)</div>
            </a>
        </div>';
        $total = ($total + ($ligne['prix'] * $ligne['quantitée']));
    }
}
?>

<div class="all">
    <div class="paniers">
        <div class="titrePage">
            <h2>Votre panier</h2>
            <div class="rectangleTitre">
            </div>
        </div>

        <div class="infoproduits">
            <?= $resultpanier ?>
        </div>
        <div class="total">
            Total : <?= $total ?>
        </div>
    </div>
    <div class="infoUser">
        <div class="titrePage">
            <h2>Votre panier</h2>
            <div class="rectangleTitre">
            </div>
        </div>
        <div class="sousinf">
            <div class="name">
                <div class="nom">
                    <div class="inf">
                        <p>Nom</p>
                        <div class="contour"><?= $user['nom'] ?></div>
                    </div>
                </div>
                <div class="prenom">
                    <div class="inf">
                        <p>Prenom</p>
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
                    <p>Adresse</p>
                    <div class="contour"><?= $user['adresse'] ?></div>
                </div>
            </div>
        </div>
        <form action="index.php?page=valide" id="carte" method="post">
            <div class="carte_flip">
                <div class="in">
                    <div class="carte_front">
                        <div class="top">
                            <div class="titrecb">
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
                            <input type="text" name="numéro_carte" required maxlength="19" id="num"
                                placeholder="Numéro de carte">
                        </div>
                        <div class="gridbottom">
                            <div class="inputs">
                                <label>
                                    <div class="expire">
                                        EXPIRE A FIN
                                    </div>
                                    <input type="text" required name="expiration" id="expiration"
                                        placeholder="date d'expiration">
                                </label>
                                <input type="text" required name="nomUser" id="nomuser" placeholder="Nom d'utilisateur">
                            </div>
                            <div class="logo_cb">
                                <img src="../img/cb.jpg" id="logo" alt="logo_type_carte">
                            </div>
                        </div>
                    </div>
                    <div class="carte_back">
                        <div class="ligne">

                        </div>
                        <label>
                            Numéro de sécurité : <input type="number" max=999 required id="securite"
                                name="numéro_de_sécurité" placeholder="Code de securité">
                        </label>
                    </div>
                </div>
            </div>
            <div class="flibandvalid">
                <div class="flipcard">
                    Tourner la carte
                </div>
                <button type="submit" id="validerCommande">Valider la commande</button>
            </div>
            <?= $erreur ?>
        </form>
    </div>
</div>
<div class="fixedReussite">
    <div class="svgGood">

    </div>
    <div class="message">
        <p>La transaction à été acceptée.</p>
        <p>Vous allez être redirigé vers la page de confirmation dans quelques instants.</p>
    </div>
</div>
<div class="fixedError">
    <div class="svgGood">
        <div class="message">
            <p>Une erreur est survenue.</p>
            <p>La communication avec la banque à échouée, veuillez recommencer.</p>
        </div>
    </div>
</div>