<?php
class Conference {
    public $id;
    public $description;
    public $salle;
    public $nbplace;
    public $intervenant;
    public $horaire;
    public $seminaire;

    public function __construct($id, $description, $salle, $nbplace, $intervenant, $horaire, $seminaire){
        $this->id = $id;
        $this->description = $description;
        $this->salle = $salle;
        $this->nbplace = $nbplace;
        $this->intervenant = $intervenant;
        $this->horaire = $horaire;
        $this->seminaire = $seminaire;
    }
}
?>