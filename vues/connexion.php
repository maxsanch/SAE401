<?php
$styles = "styles/style_connexion.css";

$librairie = '';
$styles_telephone = "styles/telephone/connexion_tel.css";
$script = "<script>

    document.querySelectorAll('.bouton_inscription').forEach(element => {
        element.addEventListener('click', chanegrInsc);
    });


    function chanegrInsc() {
        document.querySelector('.inscription').classList.toggle('ferme')
        document.querySelector('.connexion').classList.toggle('ferme')
    }
</script>";

if(isset($_POST['email'])){
    $mail = $_POST['email'];
}
else{
    $mail = '';
}

if(isset($_POST['password'])){
    $pwd = $_POST['password'];
}
else{
    $pwd="";
}

if(isset($_POST['prenom'])){
    $prenom = $_POST['prenom'];
}
else{
    $prenom = '';
}

if(isset($_POST['nom'])){
    $nom = $_POST['nom'];
}
else{
    $nom = '';
}

if(isset($_POST['adresse'])){
    $adresse = $_POST['adresse'];
}
else{
    $adresse = "";
}

?>

<div class="CadreDesEngrenages">
    <div class="engrenage" style="--X:50%; --Y:50%;">
        <img src="img/roue_ouvert.svg" alt="un engrenage">
    </div>
</div>

<div class="total">
    <div class="connexion">
        <div class="left">
            <a class="croix" href="index.php">
                <img src="../img/croix.svg" alt="croix de fermeture">
            </a>
            <div class="titre">
                <h2>Connectez-vous</h2>
            </div>
            <form action="<?= $_SERVER['PHP_SELF'] . '?page=login' ?>" method="post">
                <input type="email" maxlength="50" name="email" required value="<?= $mail ?>" placeholder="Email">
                <input type="password" maxlength="50" name="MDP" value="<?= $pwd ?>" class="motdepasse" required placeholder="Mot de passe">
                <button>Me connecter</button>
            </form>
            <div class="erreur">
                <?= $erreur ?>
            </div>
        </div>
        <div class="right">
            <div class="title">
                <h2>
                    <p>Comme on se retrouve !</p>
                    <p>Vous cherchez une partie ?</p>
                </h2>
            </div>
            <div class="subtitle">
                <h3>C'est votre première fois ?</h3>
            </div>
            <div class="bouton_inscription" id="inscr">
                Inscrivez-vous
            </div>
        </div>
    </div>

    <div class="inscription ferme">
        <div class="left">
            <a class="croix" href="index.php">
                <img src="../img/croix.svg" alt="croix de fermeture">
            </a>
            <div class="titre">
                <h2>Inscrivez-vous</h2>
            </div>
            <form action="<?= $_SERVER['PHP_SELF'] . '?page=signin' ?>" method="post">
                <div class="split">
                    <input type="text" maxlength="50" value="<?= $prenom ?>" name="prenom" required placeholder="prenom">
                    <input type="text" maxlength="50" value="<?= $nom ?>" name="nom" required placeholder="nom">
                </div>
                <input type="email" value="<?= $mail ?>" maxlength="50" name="email" required placeholder="Email">
                <input type="text" value="<?= $adresse ?>" maxlength="50" name="adresse" required placeholder="adresse">
                <input type="password" value="<?= $pwd ?>" maxlength="50" name="MDP" class="motdepasse" required placeholder="Mot de passe">
                <button>Créer mon compte</button>
            </form>
            <div class="erreur">
                <?= $erreur ?>
            </div>
        </div>
        <div class="right">
            <div class="title">
                <h2>
                    Créez un compte pour pouvoir réserver un jeu !
                </h2>
            </div>
            <div class="subtitle">
                <h3>Vous avez déjà un compte ?</h3>
            </div>
            <div class="bouton_inscription" id="connex">
                Connectez-vous
            </div>
        </div>
    </div>
</div>

<div class="rect">
    <img src="../img/top.svg" alt="rectangle_haut">
</div>
<div class="rect2">
    <img src="../img/left.svg" alt="rectangle_gauche">
</div>


