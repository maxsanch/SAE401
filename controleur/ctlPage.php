<?php

require_once "vues/vue.class.php";

class ctlPage
{
/*******************************************************
Affichage de la page d'accueil du site
  Entrée : 

  Retour : 
    
*******************************************************/
function accueil()
{
  $vue = new vue("accueil_déco"); // Instancie la vue appropriée
  $vue->afficher(array()); // Affiche la liste des clients dans la vue, c'est ca qui est passé en paramètres au niveau de data dans la classe vue
}

/*******************************************************
Affichage d'une page d'erreur
  Entrée : 
    message [string] : message d'erreur

  Retour : 
    
*******************************************************/
function erreur($message)
{
  $vue = new vue("erreurs"); // Instancie la vue appropriée
  $vue->afficher(array("message" => $message)); // Affiche la liste des clients dans la vue, c'est ca qui est passé en paramètres au niveau de data dans la classe vue
}   // Balise PHP non fermée pour éviter de retourner des caractères "parasites" en fin de traitement

}