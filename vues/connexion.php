<?php
$styles = "styles/style_connexion.css";
?>

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
                <input type="email" maxlength="50" name="email" required placeholder="Email">
                <input type="password" maxlength="50" name="MDP" class="motdepasse" required placeholder="Mot de passe">
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
                <h2>C'est votre première fois ?</h2>
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
                    <input type="text" maxlength="50" name="prenom" required placeholder="prenom">
                    <input type="text" maxlength="50" name="nom" required placeholder="nom">
                </div>
                <input type="email" maxlength="50" name="email" required placeholder="Email">
                <input type="text" maxlength="50" name="adresse" required placeholder="adresse">
                <input type="password" maxlength="50" name="MDP" class="motdepasse" required placeholder="Mot de passe">
                <button>Créer mon compte</button>
            </form>
            <div class="erreur">
                <?= $erreur ?>
            </div>
        </div>
        <div class="right">
            <div class="title">
                <h1>
                    Créez un compte pour pouvoir réserver un jeu !
                </h1>
            </div>
            <div class="subtitle">
                <h2>Vous avez déjà un compte ?</h2>
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


<script>

    document.querySelectorAll('.bouton_inscription').forEach(element => {
        element.addEventListener('click', chanegrInsc);
    });


    function chanegrInsc() {
        document.querySelector('.inscription').classList.toggle('ferme')
        document.querySelector('.connexion').classList.toggle('ferme')
    }
</script>