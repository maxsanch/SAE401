<?php
require_once "controleur/ctlConnexion.php";
require_once "controleur/ctlPage.php";
require_once "controleur/ctlUser.php";
require_once "controleur/ctlPanier.php";
require_once "controleur/ctlLieux.php";
require_once "controleur/ctlJeux.php";
require_once "controleur/ctlShop.php";
require_once "controleur/ctlEmployes.php";

class routeur
{
    private $ctlPage;

    private $ctlUser;

    private $ctlConnexion;

    private $ctlPanier;

    private $ctlJeux;

    private $ctlEmployes;

    private $ctlShop;

    private $ctlLieux;


    public function __construct()
    {
        $this->ctlPage = new ctlPage;

        $this->ctlPanier = new ctlPanier;

        $this->ctlUser = new ctlUser;

        $this->ctlConnexion = new ctlConnexion;

        $this->ctlJeux = new ctlJeux;

        $this->ctlLieux = new ctlLieux;

        $this->ctlShop = new ctlshop;

        $this->ctlEmployes = new ctlEmploye;
    }

    public function routerRequete()
    {
        try {
            if (isset($_GET['page'])) {
                if (isset($_SESSION['acces'])) {

                    $user = $this->ctlUser->users();

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
                        case "informationmyuser":
                            $this->ctlUser->infoperso();
                            break;
                        case "changerpdp":
                            $this->ctlUser->changerpdp();
                            break;
                        case "deletMyAccount":
                            $this->ctlUser->deletMyAccount();
                            break;
                        case "Panier":
                            $this->ctlUser->objetsshop();
                            break;
                        case "checkusers":
                            if ($user[0]['niveau'] == 'admin') {
                                $this->ctlUser->checkusers();
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "AjoutJeu":
                            if ($user[0]['niveau'] == 'admin') {
                                $this->ctlJeux->ajouterjeu($_POST['titre'], $_POST['ville'], $_POST['mail'], $_POST['link'], $_POST['description'], $_POST['min'], $_POST['max'], $_POST['age'], $_POST['adresse'], $_POST['postale']);
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "PageAjoutJeu":
                            if ($user[0]['niveau'] == 'admin') {
                                $this->ctlJeux->ajoutjeux("");
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "modifjeu":
                            if ($user[0]['niveau'] == 'admin') {
                                if (isset($_GET['idJeu'])) {
                                    $this->ctlJeux->modifjeu($_GET['idJeu']);
                                } else {
                                    $this->ctlPage->accueil();
                                }
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "modifierjeu":
                            if ($user[0]['niveau'] == 'admin') {
                                if (isset($_GET['idjeu'])) {
                                    $this->ctlJeux->enregistrerModif($_GET['idjeu'], $_POST['titre'], $_POST['ville'], $_POST['mail'], $_POST['link'], $_POST['description'], $_POST['min'], $_POST['max'], $_POST['age'], $_POST['adresse'], $_POST['postale']);
                                } else {
                                    $this->ctlPage->accueil();
                                }
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "supprJeu":
                            if ($user[0]['niveau'] == 'admin') {
                                if (isset($_GET['idJeu'])) {
                                    $this->ctlJeux->supprimerjeu($_GET['idJeu']);
                                } else {
                                    $this->ctlPage->accueil();
                                }
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "supprimerCompte":
                            if ($user[0]['niveau'] == 'admin') {
                                if (isset($_GET['idUser'])) {
                                    $this->ctlUser->supprimerCompte($_GET['idUser']);
                                } else {
                                    $this->ctlPage->accueil();
                                }
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "ModifMdpUser":
                            if ($user[0]['niveau'] == 'admin') {
                                if (isset($_GET['idUser'])) {
                                    $this->ctlUser->modifiermdp($_GET['idUser'], $_POST['mdp'], $_POST['confirmation']);
                                    } else {
                                    $this->ctlPage->accueil();
                                }
                            } else {
                                $this->ctlPage->accueil();
                            }
                                break;
                        case "informationsUser":
                            if ($user[0]['niveau'] == 'admin') {
                                if (isset($_GET['idUser'])) { 
                                    $this->ctlUser->modifUser($_GET['idUser'], "");
                                } else {
                                    $this->ctlPage->accueil();
                                }
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "enregUserPhoto":
                            if ($user[0]['niveau'] == 'admin') {
                                if (isset($_GET['idUser'])) { 
                                    $this->ctlUser->EnregPhotoUser($_GET['idUser']);
                                } else {
                                    $this->ctlPage->accueil();
                                }
                            } else {
                                $this->ctlPage->accueil();
                            }
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