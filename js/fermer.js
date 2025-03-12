document.querySelector('.cache_fond').addEventListener('click', fermer)

function fermer(){
    document.querySelector('.cache_fond').classList.remove('ouvert')
    document.querySelector('.err').style = "display: none;"
}

let err = document.querySelector('.err')

if(err){
    document.querySelector('.cache_fond').classList.add('ouvert')
}