<?php

require_once "controleur/ctlPanier.php";

if (isset($_SESSION['acces'])) {
    $pan = new ctlPanier;
    $global = $pan->getGlobalPanier();

    $panierglobal = '<h2>Mon panier</h2> ';

    if (!empty($global[0]) || !empty($global[1])) {
        $reservationsGlobales = '';
        if (!empty($global[0])) {
            foreach ($global[0] as $valeurs) {
                $reservationsGlobales .= '<div class="ligne">
                                                <div class="titreetnombre">
                                                    ' . $valeurs['Titre'] . ' x' . $valeurs['nombre_personnes'] . '
                                                </div>
                                                <div class="prix">
                                                    ' . ($valeurs['nombre_personnes'] * $valeurs['prix']) . ' €
                                                </div>
                                                <a href="index.php?page=suppressionReservation&idJeu=' . $valeurs['ID_jeu'] . '&heure=' . $valeurs['heure_reservation'] . '&jour=' . $valeurs['jour_reservation'] . '">
                                                    <div class="iconepoubelle">
                                                        Retirer du panier (mettre une icone de poubelle)
                                                    </div>
                                                </a>
                                            </div>';
            }
        } else {
            $reservationsGlobales = "Vous n'avez effectué aucune réservation";
        }

        if (!empty($global[1])) {
            $souvenirsGlobal = '';
            foreach ($global[1] as $valeurs) {
                $souvenirsGlobal .= '<div class="ligne">
                                                <div class="titreetnombre">
                                                    ' . $valeurs['nom'] . ' x' . $valeurs['quantitée'] . '
                                                </div>
                                                <div class="prix">
                                                    ' . ($valeurs['quantitée'] * $valeurs['prix']) . ' €
                                                </div>
                                                <form action=index.php?page=suppressionSouvenirs&idobj=' . $valeurs['id_objet_shop'] . '&idpanier=' . $valeurs['id_panier'] . ' method=post>
                                                    <input type=number placeholder="entre un nombre" max='.$valeurs['quantitée'].' name="nombredelet">
                                                    <button class="iconepoubelle">Retirer du panier (mettre une icone de poubelle)</button>
                                                </form>
                                            </div>';
            }
        } else {
            $souvenirsGlobal = "Vous n'avez acheté aucun objet.";
        }

        $panierglobal .= '<div class="categorie">
                             <div class="titre">Jeux réservés</div>
                             <div class="info">
                                ' . $reservationsGlobales . '
                             </div>
                           </div>
                           <div class="categorie">
                            <div class="titre">Objets/bons réservés</div>
                             <div class="info">
                                ' . $souvenirsGlobal . '
                             </div>
                           </div>';
    } else {
        $panierglobal = '<div class="ligne">Votre panier est vide.</div>';
    }
} else {
    $panierglobal = '';
}

echo $panierglobal;