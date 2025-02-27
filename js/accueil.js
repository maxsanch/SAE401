function lancement() {
    document.querySelectorAll(".PropositionEscapeGame").forEach (EscapeGame =>{
    Lecture_De_La_Value_De_LInput_Range(EscapeGame);
});
}

lancement();

function Lecture_De_La_Value_De_LInput_Range(EscapeGame) {
    let valeur = EscapeGame.children[1].children[2].children[0].value;
    let Ecrire_ici = EscapeGame.children[1].children[2].children[1];
    document.querySelector(""+Ecrire_ici).innerText = ""+valeur+"";
}

document.querySelector("body").addEventListener("click", lancement())