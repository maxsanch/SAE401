<?php

require_once "modeles/connexion.class.php";
require_once "modeles/utilisateurs.class.php";
require_once "modeles/connexion.class.php";
require_once "vues/vue.class.php";

class ctlConnexion
{

    private $connexion;
    private $inscription;
    private $routeur;

    public function __construct()
    {

        $this->connexion = new utilisateurs;
        $this->inscription = new inscription;
        $this->routeur = new ctlPage;
    }


    public function connexion($erreur)
    {
        $vue = new vue("connexion"); // Instancie la vue appropriée
        $vue->afficher(array("erreur" => $erreur)); // Affiche la liste des clients dans la vue, c'est ca qui est passé en paramètres au niveau de data dans la classe vue
    }

    public function login($nom, $mdp)
    {
        // Récupération des informations de l'utilisateur à partir de son mail.
        $user = $this->connexion->GetUser($nom);

        // Vérification si un utilisateur correspondant existe.
        if (!empty($user)) {
            // Vérification du mot de passe entré par rapport au mot de passe hashé stocké.
            if (password_verify($mdp, $user[0]['MotDePasse'])) {
                // Si le mot de passe est correct, enregistrer l'email dans la session pour authentification.
                $_SESSION['acces'] = $user[0]['Mail'];
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
        $this->connexion->GetUser($email);

        // Si aucun utilisateur avec cet email n'est trouvé, on peut continuer l'inscription.
        if (empty($user)) {
            if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($mdp) && !empty($adresse)) {
                // Vérification si les deux mots de passe saisis sont identiques.
                // Hashage du mot de passe.
                $mdpgood = password_hash($mdp, PASSWORD_DEFAULT);

                // Appel de la méthode inscrire.
                $this->inscription->inscrire($prenom, $nom, $email, $adresse, $mdpgood);

                // Récupération des informations de l'utilisateur nouvellement inscrit.
                $user =  $this->connexion->GetUser($email);

                

                // Enregistrement de l'email de l'utilisateur dans la session.
                $_SESSION['acces'] = $user[0]['mail'];
                $this->routeur->accueil();
            } else {
                // Si aucun utilisateur ne correspond au mail, afficher un message d'erreur.
                $erreur = '<b>Identifiant invalide</b>';
                $this->connexion($erreur);
            }
        } else {
            // Si aucun utilisateur ne correspond au mail, afficher un message d'erreur.
            $erreur = '<b>Identifiant invalide</b>';
            $this->connexion($erreur);
        }
    }

    public function quitter()
    {
        // suppression de la session et des cookies de ce dernier
        session_destroy();
        setcookie(session_name(), '', time() - 1, "/");
        // retour à l'accueil
        $this->routeur->accueil();
    }
}