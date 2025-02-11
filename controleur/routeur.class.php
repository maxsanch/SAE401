<?php

require_once "controleur/ctlConnexion";
require_once "controleur/ctlPage.php";

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
            if(isset($_GET['page'])){
                switch($_GET['page']){
                    case "connexion":
                        $this->ctlConnexion->connexion();
                }
            }
            else{
                $this->ctlPage->accueil();
            }
        } catch (Exception $e) {  // Page d'erreur
            $this->ctlPage->erreur($e->getMessage());
        }   // Balise PHP non fermée pour éviter de retourner des caractères "parasites" en fin de traitement
    }
}