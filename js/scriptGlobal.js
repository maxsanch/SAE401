const variable = document.querySelector('#panier')

if(variable){
    variable.addEventListener('click', ouvrirPanier)

    function ouvrirPanier(){
        document.querySelector('.panier').classList.add('ouvert');
    }
}