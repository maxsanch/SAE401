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
        let datas = await fetchdata();
        affichage = "";
        for (let i = 1; i <= FinDuMois(); i++) {
            date.setDate(i);
            let iso = date.toISOString().split('T')[0];

            let heures = "";
            for (let j = 8; j <= 16; j += 2) {
                let iscool = false;
                if (datas.length > 0) {
                    datas.forEach(e => {
                        if ((e['jour_reservation'] == iso) && (e['heure_reservation'] == (j + "-" + (j + 2) + "h")) && (e['ID_jeu'] == idjeu)) {
                            heures += "<label><input disabled required type='radio' name='heure' value='" + j + "-" + (j + 2) + "h'>" + j + " - " + (j + 2) + "h</label>";
                            iscool = true;
                        }
                        if (!iscool) {
                            heures += "<label><input required type='radio' name='heure' value='" + j + "-" + (j + 2) + "h'>" + j + " - " + (j + 2) + "h</label>";
                        }
                    })
                }
                else {
                    heures += "<label><input required type='radio' name='heure' value='" + j + "-" + (j + 2) + "h'>" + j + " - " + (j + 2) + "h</label>";
                }
            }

            affichage += "<div class='total'><form action='index.php?page=réserverJeu&idjeu=" + idjeu + "&jour="+iso+"' method='post'><div class='parentCalender'>" + semaine[date.getDay()]+" "+date.getDate() + " " + mois[date.getMonth()] +" "+date.getFullYear()+"</div><div class='heures'>" + heures + "</div><label>Choisissez un nombre de participants.<input type='number' required max="+max+" min="+min+" name='nombre' placeholder='nombre de participants'></label><button>Valider</button></form ></div > ";
        }

        document.querySelector('.calendrier').innerHTML = affichage
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