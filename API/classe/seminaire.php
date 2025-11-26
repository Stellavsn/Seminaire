<?php
class Seminaire{
    public $numSemi;
    public $intitule;

    public function __construct($numSemi, $intitule){
        $this->numSemi = $numSemi;
        $this->intitule = $intitule;
    }
}
?>