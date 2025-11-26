<?php
class Intervenant {
    public $numIntervenant;
    public $nom;
    public $prenom;

    public function __construct($numIntervenant, $nom, $prenom){
        $this->numIntervenant = $numIntervenant;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
}
?>