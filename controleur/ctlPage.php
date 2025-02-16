<?php

require_once "vues/vue.class.php";
require_once "modeles/utilisateurs.class.php";
require_once "modeles/jeux.class.php";

class ctlPage
{

  private $user;

  private $jeu;
  public function __construct()
  {
    $this->jeu = new jeux;
    $this->user = new utilisateurs;
  }
  /*******************************************************
  Affichage de la page d'accueil du site
    Entrée : 

    Retour : 
      
  *******************************************************/
  public function accueil()
  {
    if (isset($_SESSION['acces'])) {
      $utilisateurStatut = $this->user->GetUser($_SESSION['acces']);
    } else {
      $utilisateurStatut = "";
    }

    $jeux = $this->jeu->getjeux();

    $vue = new vue("accueil_déco"); // Instancie la vue appropriée
    $vue->afficher(array('utilisateurStatut' => $utilisateurStatut, 'jeux' => $jeux)); // Affiche la liste des clients dans la vue, c'est ca qui est passé en paramètres au niveau de data dans la classe vue
  }

  /*******************************************************
  Affichage d'une page d'erreur
    Entrée : 
      message [string] : message d'erreur

    Retour : 
      
  *******************************************************/
  public function erreur($message)
  {
    $vue = new vue("erreurs"); // Instancie la vue appropriée
    $vue->afficher(array("message" => $message)); // Affiche la liste des clients dans la vue, c'est ca qui est passé en paramètres au niveau de data dans la classe vue
  }   // Balise PHP non fermée pour éviter de retourner des caractères "parasites" en fin de traitement

  public function remerciements(){
    $vue = new vue('remerciements');
    $vue->afficher(array());
  }

  
}