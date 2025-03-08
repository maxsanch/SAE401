const variable = document.querySelector('#panier')

if (variable) {
    variable.addEventListener('click', ouvrirPanier)

    function ouvrirPanier() {
        document.querySelector('.panier').classList.add('ouvert');
    }
}

// récuperer les datas depuis la BDD

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


// utilisation des données et traitement du changement de langue

let langue = "francais";

document.querySelectorAll('.languechoose').forEach(element => {
    element.addEventListener('click', changerLangue)
});

function changerLangue() {
    langue = this.id;

    setLangueBDD();
}

async function setLangueBDD() {

    Jeux = await fetchJeux();
    employes = await fetchEmployés();
    objets = await fetchObjets()

    Jeux.forEach(e => {
        console.log(e['Titre_'+langue])
        let titreJeu = document.querySelector('#TitreJeu'+e['ID_jeu'])

        // if(titreJeu){
        //     titreJeu.innerText = ;
        // }
    });
}


setLangueBDD();