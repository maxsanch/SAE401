let point = document.querySelector('#France>.point')
let point2 = document.querySelector('#Allemagne>.point')

let paysInput = document.querySelector('.paysInput')
let coox = document.querySelector('.xInput')
let cooy = document.querySelector('.yInput')

document.querySelector('#France').addEventListener('click', updateInputFrance)

document.querySelector('#Allemagne').addEventListener('click', updateInputAllemagne)

console.log('eho')

function updateInputFrance(event) {
    console.log('eho')
    let x = ((event.offsetX*100) / document.querySelector('#France').clientWidth)
    let y = ((event.offsetY*100) / document.querySelector('#France').clientHeight)

    paysInput.value = "France";

    coox.value = x;
    cooy.value = y;
    point.style = "top: " + y + "%; left: " + x + "%; display: block;"
}

function updateInputAllemagne(event) {
    let x = ((event.offsetX*100) / document.querySelector('#France').clientWidth)
    let y = ((event.offsetY*100) / document.querySelector('#France').clientHeight)

    let largeur = document.querySelector('#Allemagne').offsetX;

    console.log(largeur);

    paysInput.value = "Allemagne";
    coox.value = x;
    cooy.value = y;
    point2.style = "top: " + y + "%; left: " + x + "%; display: block;"
}

document.querySelector('.flag').addEventListener('click', changerfr)

function changerfr(){
    if(document.querySelector('.flag').id == 'FranceFlag'){
        document.querySelector('.flag').id = 'AllemagneFlag';
        document.querySelector('.flag>img').src = "../img/france.png"
    }
    else{
        document.querySelector('.flag').id = 'FranceFlag';
        document.querySelector('.flag>img').src = "../img/allemagne.png"
    }

    document.querySelector('#Allemagne').classList.toggle('none');
    document.querySelector('#France').classList.toggle('none');
}
