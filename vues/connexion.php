<?php
$styles = "";
?>

<div class="connexion">
    <div class="left">
        <div class="croix">

        </div>
        <div class="titre">

        </div>
        <form action="<?= $_SERVER['PHP_SELF'] . '?page=login' ?>" method="post">
            <input type="email" maxlength="50" name="email" required placeholder="Email">
            <input type="password" maxlength="50" name="MDP" class="motdepasse" required placeholder="Mot de passe">
            <!-- Icône pour afficher/masquer le mot de passe -->
            <div class="oeil oeilferme">
                <img id="fermé" src="" alt="icone d'oeil">
            </div>

            <button>Me connecter</button>
        </form>
        <div class="erreur">
            <?= $erreur ?>
        </div>
    </div>
    <div class="right">
        <div class="title">
            <h1>
                Vous cherchez une partie?
            </h1>
        </div>
        <div class="subtitle">
            <h2>C'est votre première fois ?</h2>
        </div>
        <div class="bouton_inscription">
            Inscrivez-vous
        </div>
    </div>
</div>

<div class="inscription">
    <div class="left">
        <div class="croix">

        </div>
        <div class="titre">

        </div>
        <form action="<?= $_SERVER['PHP_SELF'] . '?page=signin' ?>" method="post">
            <div class="split">
                <input type="text" maxlength="50" name="prenom" required placeholder="prenom">
                <input type="text" maxlength="50" name="nom" required placeholder="nom">
            </div>
            <input type="email" maxlength="50" name="email" required placeholder="Email">
            <input type="text" maxlength="50" name="adresse" required placeholder="adresse">
            <input type="password" maxlength="50" name="MDP" class="motdepasse" required placeholder="Mot de passe">
            <!-- Icône pour afficher/masquer le mot de passe -->
            <div class="oeil oeilferme">
                <img id="fermé" src="" alt="icone d'oeil">
            </div>

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
        <div class="bouton_inscription">
            Connectez-vous
        </div>
    </div>
</div>