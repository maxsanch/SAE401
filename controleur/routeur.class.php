<?php

class routeur
{

    public function __construct()
    {
        
    }

    public function routerRequete()
    {
        try {
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case "clients":
                        $this->ctlClient->clients();
                        break;
                    case "articles":
                        $this->ctlArticle->articles();
                        break;
                    case "commandes":
                        $this->ctlCommande->commandes();
                        break;
                    case "commande":
                        if (isset($_GET["idComm"])) {
                            $idComm = (int) $_GET["idComm"];
                            if ($idComm > 0)
                                $this->ctlCommande->commande($idComm);                                                // Affichage d'une commande
                            else
                                throw new Exception("Identifiant de commande invalide");
                        } else
                            throw new Exception("Aucun identifiant de commande");
                        break;
                    default:
                        throw new Exception("Action non valide");
                }
            } else                                                                      // Page d'accueil
                $this->ctlPage->accueil();
        } catch (Exception $e) {                                                      // Page d'erreur
            $this->ctlPage->erreur($e->getMessage());
        }   // Balise PHP non fermée pour éviter de retourner des caractères "parasites" en fin de traitement
    }
}