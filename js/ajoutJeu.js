let point = document.querySelector('.point')

let paysInput = document.querySelector('.paysInput')
let coox = document.querySelector('.xInput')
let cooy = document.querySelector('.yInput')

document.querySelector('#France').addEventListener('click', updateInputFrance)

document.querySelector('#Allemagne').addEventListener('click', updateInputAllemagne)

console.log('eho')

function updateInputFrance(event) {
    console.log('eho')
    let x = event.offsetX
    let y = event.offsetY

    paysInput.value = "France";

    coox.value = x;
    cooy.value = y;
    point.style = "top: " + y + "px; left: " + x + "px; display: block;"
}

function updateInputAllemagne(event) {
    let x = event.offsetX
    let y = event.offsetY

    paysInput.value = "Allemagne";
    coox.value = x;
    cooy.value = y;
    point.style = "top: " + y + "px; left: " + x + "px; display: block;"
}