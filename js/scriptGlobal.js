const variable = document.querySelector('#panier')

if (variable) {
    variable.addEventListener('click', ouvrirPanier)

    function ouvrirPanier() {
        document.querySelector('.panier-tot').classList.add('ouvert');
        document.querySelector('.cache_fond').classList.add('ouvert');
        document.querySelector('main').classList.add('flou');
        document.querySelector('header').classList.add('flou');
        document.querySelector('footer').classList.add('flou');
    }

    document.querySelector('.cache_fond').addEventListener('click', fermerpanier)
    let croix = document.querySelector('.croix')

    if(croix){
        croix.addEventListener('click', fermerpanier)
    }

    function fermerpanier() {
        document.querySelector('.panier-tot').classList.remove('ouvert');
        document.querySelector('.cache_fond').classList.remove('ouvert');
        document.querySelector('main').classList.remove('flou');
        document.querySelector('header').classList.remove('flou');
        document.querySelector('footer').classList.remove('flou');
    }
}



// récuperer les datas depuis la BDD ou le json

async function fetchJeux() {
    const response = await fetch('../datas/fetchJeux.php'); // Appel à un fichier.
    const jeux = await response.json(); // Prétraitement de la réponse.
    return jeux; // Retourner les données après les avoir récupérées.
}
async function fetchEmployés() {
    const response = await fetch('../datas/fetchEmployés.php'); // Appel à un fichier.
    const employes = await response.json(); // Prétraitement de la réponse.
    return employes; // Retourner les données après les avoir récupérées.
}
async function fetchObjets() {
    const response = await fetch('../datas/fetchObjets.php'); // Appel à un fichier.
    const objets = await response.json(); // Prétraitement de la réponse.
    return objets; // Retourner les données après les avoir récupérées.
}

async function fetchLanguesGlobales() {
    const response = await fetch('../datas/langues.json'); // Appel à un fichier.
    const objets = await response.json(); // Prétraitement de la réponse.
    return objets; // Retourner les données après les avoir récupérées.
}


// utilisation des données et traitement du changement de langue

let langue = localStorage.getItem('langue') || "francais";

document.querySelectorAll('.languechoose').forEach(element => {
    element.addEventListener('click', changerLangue)
});

function changerLangue() {
    langue = this.id;

    localStorage.setItem('langue', langue)

    setLangueBDD();
}

let Jeux = [];
let employes = [];
let objets = [];
let global = [];

async function recupBDD() {
    Jeux = await fetchJeux();
    employes = await fetchEmployés();
    objets = await fetchObjets();
    global = await fetchLanguesGlobales();

    setLangueBDD();
}

recupBDD();

async function setLangueBDD() {
    Jeux.forEach(e => {
        let titreJeu = document.querySelectorAll('#TitreJeu' + e['ID_jeu'])
        let descriptionJeu = document.querySelectorAll('#DescriptionJeu' + e['ID_jeu'])
        if (langue == 'francais') {
            if (titreJeu) {
                titreJeu.forEach(element => {
                    element.innerText = e['Titre'];
                })
            }
            if (descriptionJeu) {
                descriptionJeu.forEach(element => {
                    element.innerText = e['description'];
                })
            }
        }
        else {
            if (titreJeu) {
                titreJeu.forEach(element => {
                    element.innerText = e['Titre_' + langue];
                })
            }
            if (descriptionJeu) {
                descriptionJeu.forEach(element => {
                    element.innerText = e['Description_' + langue];
                })
            }
        }
    });

    objets.forEach(e => {
        let Titreobj = document.querySelectorAll('#TitreObjet' + e['id_objet_shop'])
        let descobj = document.querySelectorAll('#descriptionObjet' + e['id_objet_shop'])
        if (langue == 'francais') {
            if (Titreobj) {
                Titreobj.forEach(element => {
                    element.innerText = e['nom'];
                })
            }
            if (descobj) {
                descobj.forEach(element => {
                    element.innerText = e['description'];
                })
            }
        }
        else {
            if (Titreobj) {
                Titreobj.forEach(element => {
                    element.innerText = e['nom_' + langue];
                })
            }
            if (descobj) {
                descobj.forEach(element => {
                    element.innerText = e['description_' + langue];
                })
            }
        }
    });


    employes.forEach(e => {
        let domaine = document.querySelector('#metier' + e['ID_employé'])
        if (langue == 'francais') {
            if (domaine) {
                domaine.innerText = e['metier'];
            }
        }
        else {
            if (domaine) {
                domaine.innerText = e['metier_' + langue];
            }
        }
    });

    Object.entries(global).forEach(([key, value]) => {
        let domaine = document.querySelectorAll(key)
        if (domaine) {
            domaine.forEach(element => {
                element.innerHTML = value[langue];
            });
        }
    });
}