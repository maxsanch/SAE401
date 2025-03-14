<?php
require_once "controleur/ctlConnexion.php";
require_once "controleur/ctlPage.php";
require_once "controleur/ctlUser.php";
require_once "controleur/ctlPanier.php";
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

    public function __construct()
    {
        $this->ctlPage = new ctlPage;

        $this->ctlPanier = new ctlPanier;

        $this->ctlUser = new ctlUser;

        $this->ctlConnexion = new ctlConnexion;

        $this->ctlJeux = new ctlJeux;

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
                        // différentes actions disponibles
                        case "remerciements":
                            // remerciements
                            $this->ctlPage->remerciements();
                            break;
                        case 'valide':
                            // valide
                            $this->ctlPanier->validerpanierall();
                            break;
                        case "quitter":
                            // quitter
                            $this->ctlConnexion->quitter();
                            break;
                        case 'reglement':
                            // reglements
                            $this->ctlPanier->reglement("");
                            break;
                        case "propos":
                            // a propos
                            $this->ctlPage->propos();
                            break;
                        case "infojeusolo":
                            // info sur les jeux
                            if (isset($_GET['idjeu'])) {
                                $this->ctlJeux->Jeuxsingle($_GET['idjeu']);
                            } else {
                                $this->ctlJeux->alljeux();
                            }
                            break;
                        case "carte":
                            // carte du jeu
                            $this->ctlJeux->spots();
                            break;
                        case "jeuxAll":
                            // jeux all
                            $this->ctlJeux->alljeux();
                            break;
                        case "Contacts":
                            // contacts
                            $this->ctlEmployes->allemployes();
                            break;
                        case "shop":
                            // shop
                            $this->ctlShop->objetsshop();
                            break;
                        case "informationmyuser":
                            // info perso
                            $this->ctlUser->infoperso("");
                            break;
                        case "changerpdp":
                            // changer de mot de passe
                            $this->ctlUser->changerpdp();
                            break;
                        case "deletMyAccount":
                            // suppriemr mon compte
                            $this->ctlUser->deletMyAccount();
                            break;
                        case "modifprofil":
                            // modifier mon profil 
                            $this->ctlUser->editprofil($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['NewPassword'], $_POST['ConfirmationNewPassword'], $_POST['ancienmdp']);
                            break;
                        case "suppressionSouvenirs":
                            // suppriemr souvenirs
                            if (isset($_GET['idobj']) && isset($_GET['idpanier']) && isset($_POST['nombredelet'])) {
                                $this->ctlPanier->supprimerSouvenir($_GET['idobj'], $_GET['idpanier'], $_POST['nombredelet']);
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "suppressionReservation":
                            // supprimer les reservations
                            if (isset($_GET['idJeu']) && isset($_GET['heure']) && isset($_GET['jour'])) {
                                $this->ctlPanier->supprimerReservation($_GET['idJeu'], $_GET['heure'], $_GET['jour']);
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "réserverJeu":
                            // réserver un jeu
                            if (isset($_GET['idjeu']) && isset($_GET['jour']) && isset($_POST['heure']) && isset($_POST['nombre'])) {

                                $this->ctlPanier->EnregReservation($_GET['idjeu'], $_GET['jour'], $_POST['nombre'], $_POST['heure']);
                            } else {
                                $this->ctlJeux->alljeux();
                            }
                            break;
                        case 'ajouterObjPanier':
                            // ajouter un objet au panier
                            if (isset($_GET['idobj'])) {
                                $this->ctlPanier->ajouterpanier($_GET['idobj'], $_POST['quantite']);
                            } else {
                                $this->ctlShop->objetsshop();
                            }
                            break;
                        case "checkusers":
                            // dashboard admin
                            if ($user[0]['niveau'] == 'admin') {
                                $this->ctlUser->checkusers();
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "AjoutJeu":
                            // ajouter un jeu
                            if ($user[0]['niveau'] == 'admin') {
                                if (isset($_POST['titre']) && isset($_POST['ville']) && isset($_POST['link']) && isset($_POST['description']) && isset($_POST['min']) && isset($_POST['max']) && isset($_POST['age']) && isset($_POST['adresse']) && isset($_POST['postale']) && isset($_POST['prix']) && isset($_POST['region']) && isset($_POST['Titre_anglais']) && isset($_POST['Description_anglais'])) {
                                    if (empty($_POST['Pays'])) {
                                        $pays = 'aucun';
                                        $coX = 0;
                                        $coY = 0;
                                    } else {
                                        if (is_numeric($_POST['coordonneesX']) && is_numeric($_POST['coordonneesY'])) {
                                            $pays = $_POST['Pays'];
                                            $coX = $_POST['coordonneesX'];
                                            $coY = $_POST['coordonneesY'];
                                        } else {
                                            $pays = 'aucun';
                                            $coX = 0;
                                            $coY = 0;
                                        }
                                    }
                                    $this->ctlJeux->ajouterjeu($_POST['titre'], $_POST['ville'], $_POST['link'], $_POST['description'], $_POST['min'], $_POST['max'], $_POST['age'], $_POST['adresse'], $_POST['postale'], $_POST['prix'], $pays, $coX, $coY, $_POST['region'], $_POST['Titre_anglais'], $_POST['Description_anglais']);
                                } else {
                                    $this->ctlJeux->ajoutjeux("");
                                }
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "PageAjoutJeu":
                            // page ajout du jeu
                            if ($user[0]['niveau'] == 'admin') {
                                $this->ctlJeux->ajoutjeux("");
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "modifjeu":
                            // modifier un jeu
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
                            // modifier le jeu vraiment
                            if ($user[0]['niveau'] == 'admin') {
                                if (isset($_GET['idjeu'])) {
                                    $this->ctlJeux->enregistrerModif($_GET['idjeu'], $_POST['titre'], $_POST['link'], $_POST['min'], $_POST['max'], $_POST['age'], $_POST['prix'], $_POST['description'], $_POST['ville'], $_POST['region'], $_POST['adresse'], $_POST['postale'], $_POST['Pays'], $_POST['coordonneesX'], $_POST['coordonneesY'], $_POST['Titre_anglais'], $_POST['Description_anglais']);
                                } else {
                                    $this->ctlPage->accueil();
                                }
                            } else {
                                $this->ctlPage->accueil();
                            }
                            break;
                        case "supprJeu":
                            // supprimer un jeu
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
                            // suppriemr un compte
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
                            // modifier un mot de passe en tant qu'admin
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
                            // voir les informations d'un utilisateur
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
                            // enregistrer la photo d'un utilisateurs
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
                        // les actions sont globalement les memes
                        case "connexion":
                            // page de connexion
                            $erreur = "";
                            $this->ctlConnexion->connexion($erreur);
                            break;
                        case "réserverJeu":
                            // réserver un jeu
                            $this->ctlConnexion->connexion("Vous devez être connecté pour commander.");
                            break;
                        case 'ajouterObjPanier':
                            $this->ctlConnexion->connexion("Vous devez être connecté pour commander.");
                            break;
                        case "login":
                            // connexion littérale
                            $this->ctlConnexion->login($_POST['email'], $_POST['MDP']);
                            break;

                        case "signin":
                            // inscription
                            $this->ctlConnexion->signin($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['adresse'], $_POST['MDP']);
                            break;
                        case "propos":
                            $this->ctlPage->propos();
                            break;
                        case "infojeusolo":
                            if (isset($_GET['idjeu'])) {
                                $this->ctlJeux->Jeuxsingle($_GET['idjeu']);
                            } else {
                                $this->ctlJeux->alljeux();
                            }
                            break;
                        case "carte":
                            $this->ctlJeux->spots();
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
        }
    }
}