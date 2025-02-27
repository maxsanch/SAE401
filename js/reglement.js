document.querySelector('body').addEventListener('keyup', testInput)
let num = document.querySelector('#num')
function testInput(event) {
    let touche = event.key;
    if (num.value == "4") {
        document.querySelector('.carte_front').classList.add('visa')
        document.querySelector('.carte_front').classList.remove('mastercard')
        document.querySelector('.carte_back').classList.add('visa')
        document.querySelector('.carte_back').classList.remove('mastercard')
        document.querySelector('#logo').src = '../img/Visa-logo.png'
    }
    if (num.value == "51" || num.value == "55") {
        document.querySelector('.carte_front').classList.add('mastercard')
        document.querySelector('.carte_front').classList.remove('visa')
        document.querySelector('.carte_back').classList.remove('visa')
        document.querySelector('.carte_back').classList.add('mastercard')
        document.querySelector('#logo').src = '../img/Mastercard-logo.svg';
    }
    if (num.value == "") {
        document.querySelector('.carte_front').classList.remove('visa')
        document.querySelector('.carte_front').classList.remove('mastercard')
        document.querySelector('.carte_back').classList.remove('visa')
        document.querySelector('.carte_back').classList.remove('mastercard')
        document.querySelector('#logo').src = '../img/cb.jpg';
    }
}
num.addEventListener('keypress', testerEspace)
function testerEspace(event) {
    if (!isNaN(event.key) || event.key == "") {
        console.log('ok')
    }
    else {
        event.preventDefault()
    }
}
num.addEventListener('change', changementinput)
function changementinput() {
    let test = num.value;

    let resultat = test.replace(/ /g, "")

    num.value = resultat;

    num.value = resultat.replace(/(.{4})/g, "$1 ");
}



document.querySelector('.flipcard').addEventListener('click', flip)

function flip(){
    document.querySelector('.in').classList.toggle('tourne')
}