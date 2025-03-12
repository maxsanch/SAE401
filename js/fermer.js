let fix = document.querySelector('.fixeddanslefixed')
let err = document.querySelector('.err')

document.querySelector('.cache_fond').addEventListener('click', fermer)

function fermer() {
    document.querySelector('.cache_fond').classList.remove('ouvert')
    if(err)[
        err.style = "display: none;"
    ]
    if(fix){
        fix.classList.remove('ouvert')
    }
}

if (err) {
    document.querySelector('.cache_fond').classList.add('ouvert')
}

let suprcompte = document.querySelector('.supprcompte')

if (suprcompte) {
    suprcompte.addEventListener('click', suppressionconfirmation)
}
function suppressionconfirmation(event) {
    console.log('dsq')
    event.preventDefault()
    document.querySelector('.fixeddanslefixed').classList.add('ouvert')
    document.querySelector('.cache_fond').classList.add('ouvert')
}


let nan = document.querySelector('.nonjesuppr2')

if (nan) {
    nan.addEventListener('click', enlever2)
}

function enlever2() {
    fix.classList.remove('ouvert')
    document.querySelector('.cache_fond').classList.remove('ouvert')
}

