<?php

require_once "controleur/ctlPage.php";

class routeur
{
    private $ctlPage;

    public function __construct()
    {
        $this->ctlPage = new ctlPage;
    }

    public function routerRequete()
    {
        try {
            if(isset($_GET['page'])){
                var_dump('bonjour');
            }
            else{
                $this->ctlPage->accueil();
            }
        } catch (Exception $e) {                                                      // Page d'erreur
            $this->ctlPage->erreur($e->getMessage());
        }   // Balise PHP non fermée pour éviter de retourner des caractères "parasites" en fin de traitement
    }
}