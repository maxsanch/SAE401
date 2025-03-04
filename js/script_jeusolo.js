const url = new URLSearchParams(window.location.search);

const idjeu = url.get('idjeu');

var d = new Date();

var semaine = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];

// Tableau des mois

var mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"];

async function fetchdata() {
    const response = await fetch('datas/fetch.php'); // Appel à un fichier.
    const txt = await response.json(); // Prétraitement de la réponse.
    return txt; // Retourner les données après les avoir récupérées.
}

var date = new Date();
date.setDate(1);

function FinDuMois() {
    var temp = new Date(date.getYear(), date.getMonth() + 1, 0);
    return temp.getDate();
}

async function calendrier() {
    let min = document.querySelector('.min').id;
    let max = document.querySelector('.max').id;
    let prix = document.querySelector('.prixJeu').id;
    let datas = await fetchdata();
    affichage = "";
    moisActuel = "";
    for (let i = 1; i <= FinDuMois(); i++) {
        date.setDate(i);
        let iso = date.toISOString().split('T')[0];

        let heures = "";
        for (let j = 8; j <= 16; j += 2) {
            let aujourdhui = new Date();
            // aujourdhui.setDate(aujourdhui.getDate() - 1);
            let iscool = false;
            if (datas.length > 0) {
                if (date > aujourdhui || (date.toDateString() === aujourdhui.toDateString() && j > aujourdhui.getHours())) {
                    datas.forEach(e => {
                        if ((e['jour_reservation'] == iso) && (e['heure_reservation'] == (j + "-" + (j + 2) + "h")) && (e['ID_jeu'] == idjeu)) {
                            iscool = true;
                        }
                    })
                    if (!iscool) {
                        heures += "<label><input class='radio' required type='radio' name='heure' value='" + j + "-" + (j + 2) + "h'>" + j + " - " + (j + 2) + "h</label>";
                    }
                    else {
                        heures += "<label style='background: linear-gradient(-135deg, #3F2C05, #745619); color: white;'><input class='radio' disabled required type='radio' name='heure' value='" + j + "-" + (j + 2) + "h'>Complet.</label>";
                    }
                }
                else {
                    heures += "<label style='background: linear-gradient(-135deg, #3F2C05, #745619); color: white;'><input class='radio' disabled required type='radio' name='heure' value='" + j + "-" + (j + 2) + "h'>Indisponible.</label>";
                }
            }
            else {
                if (date > aujourdhui || (date.toDateString() === aujourdhui.toDateString() && j > aujourdhui.getHours())) {
                    heures += "<label><input class='radio' required type='radio' name='heure' value='" + j + "-" + (j + 2) + "h'>" + j + " - " + (j + 2) + "h</label>";
                }
                else {
                    heures += "<label style='background: linear-gradient(-135deg, #3F2C05, #745619); color: white;'><input class='radio' disabled required type='radio' name='heure' value='" + j + "-" + (j + 2) + "h'>Indisponible.</label>";
                }
            }
        }

        affichage += "<div class='total'><form action='index.php?page=réserverJeu&idjeu=" + idjeu + "&jour=" + iso + "' method='post'><div class='parentCalender'>" + semaine[date.getDay()] + " " + date.getDate() +"</div><div class='heures'>" + heures + "</div><label><div class='nombreclient'><div>Prix : " + prix + " €</div><div>Combien êtes vous ?</div><input type='number' required max=" + max + " min=" + min + " name='nombre' placeholder='nombre de participants'></label><button>Réserver.</button></form></div></div>";
        moisActuel = mois[date.getMonth()] + " " + date.getFullYear();
    }

    document.querySelector('.calendrier').innerHTML = affichage
    document.querySelector('.moisActuel>h2').innerHTML = moisActuel
}
calendrier();

document.querySelector('.gauche').addEventListener('click', reculerMois)
document.querySelector('.droite').addEventListener('click', avancerMois)

function reculerMois() {
    date = new Date(date.getFullYear(), date.getMonth() - 1, 1); // Recrée un nouvel objet Date
    calendrier(); // Rafraîchir le calendrier après modification
}

function avancerMois() {
    date = new Date(date.getFullYear(), date.getMonth() + 1, 1); // Recrée un nouvel objet Date
    calendrier(); // Rafraîchir le calendrier après modification
}

document.querySelector('.calendrier').addEventListener('click', check)

function check() {
    document.querySelectorAll('.radio').forEach(element => {
        console.log(element.checked)
        if (element.checked) {
            element.parentElement.classList.add('selected')
        }
        else {
            element.parentElement.classList.remove('selected')
        }
    });
}