<?php

require_once "controleur/ctlPanier.php";

$total = 0;

if (isset($_SESSION['acces'])) {
    $pan = new ctlPanier;
    $global = $pan->getGlobalPanier();

    $panierglobal = '<div class="top-panier">
                        <h2>Mon panier</h2>
                        <div class="croix">
                        <img src="../img/croix.svg" alt="croix de fermeture">
                        </div>
                    </div>';

    if (!empty($global[0]) || !empty($global[1])) {
        $reservationsGlobales = '';
        if (!empty($global[0])) {
            foreach ($global[0] as $valeurs) {
                $reservationsGlobales .= '<div class="ligne-panier">
                                                <div class="titreetnombre">
                                                    <span id="TitreJeu' . $valeurs['ID_jeu'] . '">' . $valeurs['Titre'] . '</span> x' . $valeurs['nombre_personnes'] . '
                                                </div>
                                                <div class="prix">
                                                    ' . ($valeurs['nombre_personnes'] * $valeurs['prix']) . ' €
                                                </div>
                                                <a href="index.php?page=suppressionReservation&idJeu=' . $valeurs['ID_jeu'] . '&heure=' . $valeurs['heure_reservation'] . '&jour=' . $valeurs['jour_reservation'] . '">
                                                    <div class="icone-poubelle-panier">
                                                        <img src="../img/trash.svg" alt="corbeille">
                                                    </div>
                                                </a>
                                            </div>';
                $total = ($total + ($valeurs['nombre_personnes'] * $valeurs['prix']));
            }
        } else {
            $reservationsGlobales = "Vous n'avez effectué aucune réservation";
        }

        if (!empty($global[1])) {
            $souvenirsGlobal = '';
            foreach ($global[1] as $valeurs) {
                $souvenirsGlobal .= '<div class="ligne-panier">
                                                <div class="titreetnombre">
                                                    ' . $valeurs['nom'] . ' x' . $valeurs['quantitée'] . '
                                                </div>
                                                <div class="prix">
                                                    ' . ($valeurs['quantitée'] * $valeurs['prix']) . ' €
                                                </div>
                                                <form action=index.php?page=suppressionSouvenirs&idobj=' . $valeurs['id_objet_shop'] . '&idpanier=' . $valeurs['id_panier'] . ' method=post>
                                                    <input type=number placeholder="entre un nombre" max=' . $valeurs['quantitée'] . ' name="nombredelet">
                                                    <button class="icone-poubelle-panier"><img src="../img/trash.svg" alt="corbeille"></button>
                                                </form>
                                            </div>';
                $total = ($total + ($valeurs['prix'] * $valeurs['quantitée']));
            }
        } else {
            $souvenirsGlobal = "Vous n'avez acheté aucun objet.";
        }

        $panierglobal .= '
                        <div class="parent-panier">
                           <div class="categorie-panier">
                             <div class="titre-panier">Jeux réservés</div>
                             <div class="info-panier">
                                ' . $reservationsGlobales . '
                             </div>
                           </div>
                           <div class="categorie">
                            <div class="titre-panier">Objets/bons réservés</div>
                             <div class="info-panier">
                                ' . $souvenirsGlobal . '
                             </div>
                           </div>
                           </div>
                           <div class="total-panier">
                           Total : ' . $total . ' €
                           </div>';
    } else {
        $panierglobal = '<div class="ligne">Votre panier est vide.</div>';
    }
} else {
    $panierglobal = '';
}

?>

<div class="lepaniercomplet">
    <?= $panierglobal ?>
</div>