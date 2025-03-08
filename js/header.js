// pour ouvrir le menu dans la version mobile du site 

let barres = document.querySelector('.tribarres')

if(barres){
    barres.addEventListener('click', openmenu)
}

function openmenu() {
    document.querySelector('.liensdéroulant').classList.toggle('ouvertmenu')
}