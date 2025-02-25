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

$date = new dateTime();

$affichage = "";

for ($i = 0; $i < 100; $i++) {
    $heures = "";
    for ($j = 8; $j <= 16; $j += 2) {
        $iscool = false;
        if (!empty($recup)) {
            foreach ($recup as $valeur) {
                if (($valeur['jour_reservation'] == $date->format('Y-m-d')) && ($valeur['heure_reservation'] == ($j . "-" . ($j + 2) . "h")) && ($valeur['ID_jeu'] == $_GET['idjeu'])) {
                    $heures .= "<label><input disabled required type='radio' name='heure' value='" . $j . "-" . ($j + 2) . "h'>" . $j . " - " . ($j + 2) . "h</label>";
                    $iscool = true;
                }
            }
            if (!$iscool) {
                $heures .= "<label><input required type='radio' name='heure' value='" . $j . "-" . ($j + 2) . "h'>" . $j . " - " . ($j + 2) . "h</label>";
            }
        } else {
            $heures .= "<label><input required type='radio' name='heure' value='" . $j . "-" . ($j + 2) . "h'>" . $j . " - " . ($j + 2) . "h</label>";
        }
    }

    $affichage .= "<div class='total'>
                    <form action='index.php?page=réserverJeu&idjeu=" . $_GET['idjeu'] . "&jour=" . $date->format('Y-m-d') . "' method='post'>
                        <div class='parentCalender'>" . $date->format('D: d / m / Y') . "</div>
                        <div class='heures'>" . $heures . "</div>
                        <label>
                            Choisissez un nombre de participants.
                            <input type='number' required max='" . $jeu[0]['nombre_max'] . "' min='" . $jeu[0]['nombre_min'] . "' name='nombre' placeholder='nombre de participants'>
                        </label>
                        <button>Valider</button>
                    </form>
                    </div>";
    $date->modify('+1 day');
}

$script = "<script src='https://uicdn.toast.com/calendar /latest/toastui-calendar.min.js'></script>
<script>
    const Calendar = tui.Calendar;

    const container = document.getElementById('calendar');
    const options = {
        defaultView: 'week',
        timezone: {
            zones: [
                {
                    timezoneName: 'Europe/Paris',
                    displayLabel: 'Paris',
                        },
                    ],
                },
                calendars: [
                        {
                        id: 'cal1',
                        name: 'Work',
                        backgroundColor: '#03bd9e',
                        },
                    ]
                };

                const calendar = new Calendar(container, options);

                                calendar.createEvents([
                        {
                            id: 'event1',
                            calendarId: 'cal2',
                            title: 'Weekly meeting',
                            start: '2025-02-26T12:00:00',
                            end: '2025-02-26T18:02:00',
                        },
                        {
                            id: 'event2',
                            calendarId: 'cal1',
                            title: 'Lunch appointment',
                            start: '2025-02-25T17:15:00',
                            end: '2025-02-25T19:16:45',
                        },
                        {
                            id: 'event3',
                            calendarId: 'cal2',
                            title: 'Vacation',
                            start: '2025-02-25T15:15:00',
                            end: '2025-02-25T16:10:00',
                        },
                ]);
                
calendar.setTheme({
  common: {
    gridSelection: {
      backgroundColor: 'rgba(11, 255, 27, 0.05)',
      border: '1px dottedrgb(0, 0, 0)',
    },
  },
});
            </script>
            "


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