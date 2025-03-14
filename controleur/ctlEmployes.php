<?php


require_once 'modeles/employés.class.php';
require_once 'vues/vue.class.php';

class ctlEmploye{
    private $employes;

    public function __construct(){
        $this->employes = new employes;
    }

    // récupérer tout les employés
    public function allemployes(){
        $employes = $this->employes->getEmployes();

        $vue = new vue('contacts');
        $vue->afficher(array('employes' => $employes));
    }

}