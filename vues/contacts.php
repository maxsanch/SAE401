<?php

$styles = '';

$result = "";

foreach ($employes as $valeur) {
    if (file_exists('img/employes/' . $valeur['ID_employé'] . '.jpg')) {
        $phototest = 'img/employes/' . $valeur['ID_employé'] . '.jpg';
        // Si l'image existe, l'affiche
    } else if (file_exists('img/employes/' . $valeur['ID_employé'] . '.png')) {
        $phototest = 'img/employes/' . $valeur['ID_employé'] . '.png';
    } else {
        // Sinon, affiche une image par défaut
        $phototest = 'img/objets/no_image.jpg';
    }

    $result .= "<div class='case'><img src='" . $phototest . "'><div class='nom'>" . $valeur['prenom'] . "</div><div class='statut'>" . $valeur['metier'] . "</div></div>";
}

?>

<h1>L'équipe</h1>
<div class="allemployes">
    <?= $result ?>
</div>
<div class="contacts">
    <div class="phone">
        <div class="icone">
            <img src="imgphoneamettre" alt="">
        </div>
        <div class="info">
            <div class="info1">
                07668 996660
            </div>
            <div class="info2">
                Lun. - Ven. 9h00 - 16h00
            </div>
        </div>
    </div>
    <div class="mail">
        <div class="icone">
            <img src="imgmailamettre" alt="">
        </div>
        <div class="info">
            réservation@we-escape.de
        </div>
    </div>
</div>