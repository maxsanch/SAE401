<?php

$styles = "";

?>


<form action="<?= $_SERVER['PHP_SELF'] . '?page=login' ?>" method="post">
    <input type="text" name="titre" placeholder="un titre pour le jeu">
    <input type="text" name="lieu" placeholder="entre l'id du lieu">
    <input type="email" name="mail" placeholder="entrez le mail pour les informations complémentaires sur ce jeu">
    <input type="text" name="link" placeholder="entrez le lien d'une vidéo youtube">
    <textarea name="descrpition" id="test">Entrez une description du jeu</textarea>
    <button>Ajouter un jeu</button>
</form>