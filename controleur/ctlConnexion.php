<?php

require_once "modeles/inscription.class.php";
require_once "modeles/utilisateurs.class.php";
require_once "modeles/panier.class.php";
require_once "vues/vue.class.php";

class ctlConnexion
{

    private $user;
    private $inscription;
    private $panier;
    private $routeur;

    public function __construct()
    {
        $this->user = new utilisateurs;
        $this->inscription = new inscription;
        $this->routeur = new ctlPage;
        $this->panier = new panier;
    }


    public function connexion($erreur)
    {
        $vue = new vue("connexion"); // Instancie la vue appropriée
        $vue->afficher(array("erreur" => $erreur)); // Affiche la liste des clients dans la vue, c'est ca qui est passé en paramètres au niveau de data dans la classe vue
    }

    public function login($nom, $mdp)
    {
        $paniersHeures = $this->panier->getheureJourPanier();

        foreach($paniersHeures as $ligne){
            $dateLimite = (new DateTime($ligne['derniere_modification']))->modify('+1 year');
            $heureLimite = (new DateTime($ligne['derniere_modification']))->modify('+3 hour');
            $date = new DateTime();
            if($ligne['statut'] == "valide"){
                if($date->format('Y-m-d') >= $dateLimite->format('Y-m-d')){
                    var_dump("celui la, on le suppr");
                    $this->panier->supprimerPanierValide($ligne['id_panier']);
                    $this->panier->supprimerReservationValide($ligne['id_panier']);
                    $this->panier->supprimerSouvenirValide($ligne['id_panier']);
                }
            }
            else{
                if($heureLimite->format('Y-m-d-H-i-s') <= $date->format('Y-m-d-H-i-s')){
                    $stock = $this->panier->getstockCont($ligne['id_panier']);
                    if(!empty($stock)){
                        $stockActuel = $this->panier->stockactuel($stock[0]['id_objet_shop']);
                        $newNumber = ($stock[0]['quantitée']+$stockActuel[0]['stock']);
                        $this->panier->reduce($newNumber, $stock[0]['id_objet_shop']);
                    }
                    // metter a jour l'horraire
                    $heure = $date->format('Y-m-d H-i-s');
                    $this->panier->updateHorraire($ligne['id_panier'], $heure);
                    $this->panier->supprimerReservationValide($ligne['id_panier']);
                    $this->panier->supprimerSouvenirValide($ligne['id_panier']);
                }
            }
        }

        // Récupération des informations de l'utilisateur à partir de son mail.
        $user = $this->user->GetUser($nom);

        // Vérification si un utilisateur correspondant existe.
        if (!empty($user)) {
            // Vérification du mot de passe entré par rapport au mot de passe hashé stocké.
            if (password_verify($mdp, $user[0]['mdp'])) {
                // Si le mot de passe est correct, enregistrer l'email dans la session pour authentification.
                $_SESSION['acces'] = $user[0]['mail'];

                // Mise à jour de la dernière connexion de l'utilisateur (fonction personnalisée).
                $this->inscription->updatedate($user[0]['Id_utilisateur']);
                $this->testetresetannée();
                $this->routeur->accueil();

            } else {
                // Si le mot de passe est incorrect, afficher un message d'erreur.
                $erreur = '<b>mot de passe incorrecte.</b>';
                $this->connexion($erreur);
            }
        } else {
            // Si aucun utilisateur ne correspond au mail, afficher un message d'erreur.
            $erreur = '<b>Identifiant invalide</b>';
            $this->connexion($erreur);
        }
    }

    public function signin($prenom, $nom, $email, $adresse, $mdp)
    {
        // Vérification si un utilisateur avec le même email existe déjà dans la base de données.
        $check = $this->user->GetUser($email);

        // Si aucun utilisateur avec cet email n'est trouvé, on peut continuer l'inscription.
        if (empty($check)) {
            if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($mdp) && !empty($adresse)) {
                // Vérification si les deux mots de passe saisis sont identiques.
                // Hashage du mot de passe.
                $mdpgood = password_hash($mdp, PASSWORD_DEFAULT);

                // Appel de la méthode inscrire.
                $this->inscription->inscrire($prenom, $nom, $email, $adresse, $mdpgood);

                // Récupération des informations de l'utilisateur nouvellement inscrit.
                $panierUser =  $this->user->GetUser($email);

                $date = new DateTime();
                $heure = $date->format('Y-m-d H-i-s');
                $this->inscription->créerPanier($panierUser[0]["Id_utilisateur"], $heure);

                // Enregistrement de l'email de l'utilisateur dans la session.
                $_SESSION['acces'] = $email;
                $this->testetresetannée();
                $this->routeur->accueil();
            } else {
                // Si aucun utilisateur ne correspond au mail, afficher un message d'erreur.
                $erreur = '<b>Identifiant invalide</b>';
                $this->connexion($erreur);
            }
        } else {
            // Si aucun utilisateur ne correspond au mail, afficher un message d'erreur.
            $erreur = '<b>cet email existe déjà</b>';
            $this->connexion($erreur);
        }
    }

    public function testetresetannée(){
        $currentyear = $this->inscription->getannee(); // Récupération de l'année actuelle depuis la base de données.
    
        // Vérifie si l'année actuelle en base est différente de l'année actuelle.
        if ($currentyear != date('Y')) {
            $ajouterun = $currentyear + 1; // Incrémente l'année.
            $this->inscription->maj($ajouterun); // Met à jour l'année dans la base de données.
            $this->inscription->resetmois(); // Réinitialise les données mensuelles.
        } else {
            $mois = date('m'); // Récupère le mois actuel.
    
            $currentnombre = $this->inscription->getcountmois($mois); // Récupère le nombre de connexions pour le mois actuel.
            $nb = (int) $currentnombre + 1; // Incrémente le nombre de connexions.
            $this->inscription->ajouter($nb, (int) $mois); // Met à jour le nombre de connexions pour le mois actuel.
        }
    }

    public function quitter()
    {
        // suppression de la session et des cookies de ce dernier
        session_destroy();
        setcookie(session_name(), '', time() - 1, "/");
        // retour à l'accueil
        header("Location: index.php");
    }
}