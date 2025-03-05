// pour la barre input

function lancement() {
    document.querySelectorAll(".PropositionEscapeGame").forEach (EscapeGame =>{
    Lecture_De_La_Value_De_LInput_Range(EscapeGame);
});
}

lancement();

function Lecture_De_La_Value_De_LInput_Range(EscapeGame) {
    let valeur = EscapeGame.children[1].children[2].children[0].value;
    let Ecrire_ici = EscapeGame.children[1].children[2].children[1];

    let lien = EscapeGame.querySelector('.number')
    
    let urlActuelle = new URL(lien.href);
    urlActuelle.searchParams.set('nombre', valeur);

    lien.href = urlActuelle;

    Ecrire_ici.innerHTML = valeur;
}

document.querySelectorAll("#volume").forEach (ChangementDeValeur =>{
    ChangementDeValeur.addEventListener("change", lancement);
});

// pour ouvrir les erreurs en pop up

let test = document.querySelector('.error')

if(test){
    document.querySelector('.cache_fond').classList.add('ouvert');
}

document.querySelector('.cache_fond').addEventListener('click', fermer)

function fermer(){
    if(test){
        test.style = 'display: none;'
    }
    document.querySelector('.cache_fond').classList.remove('ouvert');
}
