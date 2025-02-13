<?php
require_once "controleur/ctlConnexion.php";
require_once "controleur/ctlPage.php";
require_once "controleur/ctlUser.php";

class routeur
{
    private $ctlPage;

    private $ctlUser;

    private $ctlConnexion;

    private $ctlPanier;

    private $ctlJeux;

    private $ctlEmployes;

    private $ctlLieux;


    public function __construct()
    {
        $this->ctlPage = new ctlPage;

        $this->ctlPanier = new ctlPanier;

        $this->ctlUser = new ctlUser;

        $this->ctlConnexion = new ctlConnexion;

        $this->ctlJeux = new ctlJeux;

        $this->ctlLieux = new ctlLieux;
    }

    public function routerRequete()
    {
        try {
            if (isset($_GET['page'])) {
                if (isset($_SESSION['acces'])) {
                    switch ($_GET['page']) {
                        case "remerciements":
                            $this->ctlPage->remerciements();
                            break;
                        case "quitter":
                            $this->ctlConnexion->quitter();
                            break;
                        case "propos":
                            $this->ctlPage->propos();
                            break;
                        case "infojeusolo":
                            $this->ctlJeux->Jeuxsingle();
                            break;
                        case "carte":
                            $this->ctlLieux->spots();
                            break;
                        case "jeuxAll":
                            $this->ctlJeux->alljeux();
                            break;
                        case "Contacts":
                            $this->ctlEmployes->allemployes();
                            break;
                        case "shop":
                            $this->ctlShop->objetsshop();
                            break;
                        default:
                            $this->ctlPage->accueil();
                    }
                } else {
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
                        case "propos":
                            $this->ctlPage->propos();
                            break;
                        case "infojeusolo":
                            $this->ctlJeux->Jeuxsingle();
                            break;
                        case "carte":
                            $this->ctlLieux->spots();
                            break;
                        case "jeuxAll":
                            $this->ctlJeux->alljeux();
                            break;
                        case "Contacts":
                            $this->ctlEmployes->allemployes();
                            break;
                        case "shop":
                            $this->ctlShop->objetsshop();
                            break;
                        default:
                            $this->ctlPage->accueil();
                    }
                }
            } else {
                $this->ctlPage->accueil();
            }
        } catch (Exception $e) {  // Page d'erreur
            $this->ctlPage->erreur($e->getMessage());
        }   // Balise PHP non fermée pour éviter de retourner des caractères "parasites" en fin de traitement
    }
}