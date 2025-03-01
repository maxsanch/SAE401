<?php

require_once "modeles/panier.class.php";

$styles = "../styles/style_jeusolo.css";

$librairie = '<link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script>';

if (file_exists('img/photojeu/' . $_GET['idjeu'] . '.jpg')) {
    $phototest = 'img/photojeu/' . $_GET['idjeu'] . '.jpg';
    // Si l'image existe, l'affiche
} else if (file_exists('img/photojeu/' . $_GET['idjeu'] . '.png')) {
    $phototest = 'img/photojeu/' . $_GET['idjeu'] . '.png';
} else {
    // Sinon, affiche une image par défaut
    $phototest = 'img/objets/no_image.jpg';
}

if ($jeu[0]['lien_video'] == "") {
    $video = "";
} else {
    $video = $jeu[0]['lien_video'];
}

$paniers = new panier;

$affichage = "";

$script = ""
    ?>

<div class="jeutop">
    <div class="image">
        <img src="<?= $phototest ?>" alt="photo_de_l'escape-game">
    </div>
    <div class="infos">
        <div class="titre">
            <h1><?= $jeu[0]['Titre'] ?></h1>
        </div>
        <div class="description">
            <?= $jeu[0]['description'] ?>
        </div>
        <div class="autre">
            <div class="age">
                Age minimum : <?= $jeu[0]['age'] ?>
            </div>
            <div class="nombre">
                De <?= $jeu[0]['nombre_min'] ?> à <?= $jeu[0]['nombre_max'] ?> participants.es
            </div>
        </div>
    </div>
</div>
<div class="video">
    <?= $video ?>
</div>
<div id="calendar" style="height: 600px;">
</div>


<div class="calendrier">
    <?= $affichage ?>
</div>

<script>
    var d = new Date();

    fetch('datas/fetch.php')        // Appel à un fichier.
    .then(function (response) {  // Prétraitement de la réponse.
            return response.json();
    })
    .then(function (txt) {       // Utilisation de la réponse.
            var datas = txt
            console.log(datas)
    });



    var date = new Date();
    date.setDate(1);
    //let jour1 = date.getDate(); // 1


    function FinDuMois() {
        var temp = new Date(date.getYear(), date.getMonth() + 1, 0);
        return temp.getDate();
    }

    FinDuMois();

    date.setMonth((date.getMonth() + 1))
    date.setDate((date.getDate() + 1))

    for (let i = 0; i <= FinDuMois(); i++) {
        let heures = "";
        for (let j = 8; j <= 16; j += 2) {
            let iscool = false;
            if (datas.length > 0) {
    //             foreach(recup as valeur) {
    //                 if ((valeur['jour_reservation'] == date -> format('Y-m-d')) && (valeur['heure_reservation'] == (j. "-". (j + 2). "h")) && (valeur['ID_jeu'] == _GET['idjeu'])) {
    //                     heures.= "<label><input disabled required type='radio' name='heure' value='".j. "-". (j + 2). "h'>".j. " - ". (j + 2). "h</label>";
    //                     iscool = true;
    //                 }
    //             }
    //             if (!iscool) {
    //                 heures.= "<label><input required type='radio' name='heure' value='".j. "-". (j + 2). "h'>".j. " - ". (j + 2). "h</label>";
    //             }
            }
            else {
                 heures+= "<label><input required type='radio' name='heure' value='"+j+ "-"+ (j + 2)+ "h'>"+j+ " - "+ (j + 2)+ "h</label>";
            }
        }

    //     affichage.= "<div class='total'>< form action = 'index.php?page=réserverJeu&idjeu=".$_GET['idjeu']. "&jour=".$date -> format('Y-m-d'). "' method = 'post' ><div class='parentCalender'>".$date -> format('D: d / m / Y'). "</div><div class='heures'>".$heures. "</div><label>Choisissez un nombre de participants.<input type='number' required max='".$jeu[0]['nombre_max']. "' min='".$jeu[0]['nombre_min']. "' name='nombre' placeholder='nombre de participants'></label><button>Valider</button></form ></div > ";

    //     d.setMonth(d.getMonth() + 1);
    }
</script>