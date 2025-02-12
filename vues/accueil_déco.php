<?php 

$styles = ""; // mettre le lien vers le style ici

if(isset($_SESSION['acces'])){
    if($utilisateurStatut[0]['niveau'] == "admin"){
        $test = "test admin";
    }
    else{
        $test = "test user";
    }
}
else{
    $test = "test pas co";
}

?>


<div class="test">
    <?= $test ?>
</div>