<?php

$styles = "";


$result = "";
foreach($jeux as $valeur){
    if (file_exists('img/photojeu/' . $valeur['ID_jeu'] . '.jpg')) {
        $phototest = 'img/photojeu/' . $valeur['ID_jeu'] . '.jpg';
        // Si l'image existe, l'affiche
    } else if (file_exists('img/photojeu/' . $valeur['ID_jeu'] . '.png')) {
        $phototest = 'img/photojeu/' . $valeur['ID_jeu'] . '.png';
    } else {
        // Sinon, affiche une image par défaut
        $phototest = 'img/photojeu/no_image.jpg';
    }

    $result.= "<div class='total'><img src='".$phototest."'><div class='titre'>".$valeur['Titre']."</div><div class='age'>age : ".$valeur['age']."</div><div class='nbrpart'>".$valeur['nombre_min']." - ".$valeur['nombre_max']."</div><div class='bouton'><a href='index.php?page=infojeusolo&idjeu=".$valeur['ID_jeu']."'>Voir plus</a></div></div>";
}

?>


<div class="global">
    <?= $result ?>
</div>
