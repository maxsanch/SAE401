<?php

$styles = "styles/style_reglement.css";

$librairie = '';

$script = "";

$resultpanier = "";
if (empty($panier) && empty($souvenirs)) {
    $resultpanier = "Vous n'avez aucun article dans votre panier.";
} else {
    foreach ($panier as $valeurs) {
        $resultpanier .= '<div class="lignepanier">
                            <div class="linetop">
                                <div class="titre">
                                    ' . $valeurs['Titre'] . '
                                </div>
                                <div class="personnes">
                                    nombre de personnes : ' . $valeurs['nombre_personnes'] . '
                                </div>
                                <div class="prix">
                                    prix total : ' . ($valeurs['nombre_personnes'] * $valeurs['prix']) . '
                                </div>
                            </div>
                            <div class="infojour">
                                <div class="jour">
                                    ' . $valeurs['jour_reservation'] . '
                                </div>
                                <div class="heure">
                                    ' . $valeurs['heure_reservation'] . '
                                </div>
                                <div class="prixsolo">
                                    ' . $valeurs['prix'] . '
                                </div>
                            </div>
                            <div class="description">
                                ' . $valeurs['description'] . '
                            </div>
                            <a href=index.php?page=suppressionReservation&idJeu=' . $valeurs['ID_jeu'] . '&heure=' . $valeurs['heure_reservation'] . '&jour=' . $valeurs['jour_reservation'] . '>
                            <div class="iconepoubelle">
                                Retirer du panier (mettre une icone de poubelle)
                            </div>
                            </a>
                        </div>';
    }
    foreach ($souvenirs as $ligne) {
        $resultpanier .= '<div class="lignepanier">
            <div class="linetop">
                <div class="nom">' . $ligne['nom'] . '</div>
                <div class="prixTot">Prix total : ' . ($ligne['prix'] * $ligne['quantitée']) . ' (' . $ligne['prix'] . '
                    x' . $ligne['quantitée'] . ')</div>
            </div>
            <div class="description">' . $ligne['description'] . '</div><a
                href=index.php?page=suppressionSouvenirs&idobj=' . $ligne['id_objet_shop'] . '&idpanier=' . $ligne['id_panier'] . '>
                <div class="iconepoubelle">Retirer du panier (mettre une icone de poubelle)</div>
            </a>
        </div>';
    }
}



?>

<div class="paniers">
    <h2>Votre paniers</h2>

    <div class="infoproduits">
        <?= $resultpanier ?>
    </div>
    <div class="total">

    </div>
</div>
<div class="infoUser">
    <form action="index.php?page=valide" method="post">
        <div class="sousinf">
            <div class="name">
                <div class="nom">
                    <div class="inf">
                        <p>Nom</p>
                        <div class="contour"><?= $user['nom'] ?></div>
                    </div>
                </div>
                <div class="prenom">
                    <div class="inf">
                        <p>Prenom</p>
                        <div class="contour"><?= $user['prenom'] ?></div>
                    </div>
                </div>
            </div>
            <div class="mail">
                <div class="inf">
                    <p>E-mail</p>
                    <div class="contour"><?= $user['mail'] ?></div>
                </div>
            </div>
            <div class="adresse">
                <div class="inf">
                    <p>Adresse</p>
                    <div class="contour"><?= $user['adresse'] ?></div>
                </div>
            </div>
        </div>
        <div class="flex">
            <div class="carte_front">
                <div class="top">
                    <div class="titre">
                        Carte bancaire
                    </div>
                    <div class="logo_cb">
                        <img src="../img/cb.jpg" alt="logo">
                    </div>
                </div>
                <div class="line2">
                    <div class="puce">

                    </div>
                </div>
                <div class="numbers">
                    <input type="text" name="numéro_carte" maxlength="19" id="num" placeholder="Numéro de carte">
                </div>
                <div class="gridbottom">
                    <div class="inputs">
                        <label>
                            <div class="expire">
                                EXPIRE A FIN
                            </div>
                            <input type="text" name="expiration" id="expiration" placeholder="date d'expiration">
                        </label>
                        <input type="text" name="nomUser" id="nomuser" placeholder="Nom d'utilisateur">
                    </div>
                    <div class="logo_cb">
                        <img src="../img/cb.jpg" id="logo" alt="logo_type_carte">
                    </div>
                </div>
            </div>
            <div class="carte_front">
                <div class="ligne">

                </div>
                <label>
                    Numéro de sécurité : <input type="text" id="securite" name="numéro_de_sécurité"
                        placeholder="Code de securité">
                </label>
            </div>
        </div>
        <button>Envoyer</button>
    </form>
</div>



<script>

    document.querySelector('body').addEventListener('keyup', testInput)
    let num = document.querySelector('#num')
    function testInput(event) {
        let touche = event.key;
        if (num.value == "4") {
            document.querySelector('.carte_front').classList.add('visa')
            document.querySelector('.carte_front').classList.remove('mastercard')
            document.querySelector('#logo').src = '../img/Visa-logo.png'
        }
        if (num.value == "51" || num.value == "55") {
            document.querySelector('.carte_front').classList.add('mastercard')
            document.querySelector('.carte_front').classList.remove('visa')
            document.querySelector('#logo').src = '../img/Mastercard-logo.svg';
        }
        if (num.value == "") {
            document.querySelector('.carte_front').classList.remove('visa')
            document.querySelector('.carte_front').classList.remove('mastercard')
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


    // document.querySelector('button').addEventListener('click', envoyerData)

    // function envoyerData(){
    //     event.preventDefault();
    //     fetchphp();
    // }

    // function fetchphp() {
    //         var1 = num.values;
    //         var2 = document.querySelector('#expiration').value
    //         var3 = document.querySelector('#nomuser').value
    //         var4 = document.querySelector('#securite').value

    //         fetch('https://www.mmi.uha.fr/exercices/paiement.php?',
    //             {
    //                 method: "post",
    //                 headers: {
    //                     "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
    //                 },
    //                 body: `num=${var1}&expiration=${var2}&nom=${var3}&securite=${var4}`
    //             }
    //         )
    //         .then(function (rep) {
    //                 return rep.text();
    //             })
    //         .then(function (traiter) {
    //                 setTimeout(tester, 2000)
    //                 function tester() {
    //                     return traiter
    //                 }
    //         })
    // }
</script>