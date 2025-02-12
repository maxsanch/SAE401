<?php

var_dump('test');
require_once "controleur/ctlConnexion.php";
require_once "controleur/ctlPage.php";
require_once "controleur/ctlUser.php";

class routeur
{
    private $ctlPage;

    private $ctlUser;

    private $ctlConnexion;


    public function __construct()
    {
        $this->ctlPage = new ctlPage;
        $this->ctlUser = new ctlUser;

        $this->ctlConnexion = new ctlConnexion;
    }

    public function routerRequete()
    {
        try {
            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case "connexion":
                        $erreur = "";
                        $this->ctlConnexion->connexion($erreur);
                        break;
                    case "login":
                        $this->ctlConnexion->login($_POST['email'], $_POST['MDP']);
                        break;
                    case "signin":
                        $this->ctlConnexion->signin($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['adresse'], $_POST['MDP']);
                        break;
                    default:
                        $this->ctlPage->accueil();
                }
            } else {
                $this->ctlPage->accueil();
            }
        } catch (Exception $e) {  // Page d'erreur
            $this->ctlPage->erreur($e->getMessage());
        }   // Balise PHP non fermée pour éviter de retourner des caractères "parasites" en fin de traitement
    }
}