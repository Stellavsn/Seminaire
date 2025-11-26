<?php
class ConferenceRepository {
    private $conn;
    public function __construct($db) {
        $this-> conn = $db;
    }

    public function findAll(){
        $sql = "SELECT conference.id, conference.description, conference.salle, conference.nbplace, conference.numHoraire, creneau.horaire, intervenant.numIntervenant, intervenant.nom, intervenant.prenom, seminaire.intitule, seminaire.numSemi FROM seminaire INNER JOIN creneau ON creneau.numSemi = seminaire.numSemi INNER JOIN conference ON conference.numHoraire = creneau.numHoraire INNER JOIN intervenant ON intervenant.numIntervenant = conference.numIntervenant; ";
        $stmt = $this->conn->prepare($sql);
        $stmt -> execute();
        $lesConferences = $stmt->fetchAll(PDO::FETCH_OBJ);

        $confs = [];
        foreach($lesConferences as $conf){
            $seminaire = new Seminaire($conf->numSemi, $conf->intitule);
            $intervenant = new Intervenant($conf->numIntervenant, $conf->nom, $conf->prenom);
            $conference = new Conference(
                $conf->id,
                $conf->description,
                $conf->salle,
                $conf->nbplace,
                $intervenant,
                $conf->horaire,
                $seminaire
            );
            $confs[] = $conference;
        }

        return $confs;
    }

    public function getSeminaires(){
        $sql = "SELECT * FROM seminaire";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $seminaires = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $seminaires;
    }

    public function findBySeminaire($seminaire_id){
        $sql = "SELECT conference.id, conference.description, conference.salle, conference.nbplace, conference.numHoraire, creneau.horaire, intervenant.numIntervenant, intervenant.nom, intervenant.prenom, seminaire.intitule, seminaire.numSemi FROM seminaire INNER JOIN creneau ON creneau.numSemi = seminaire.numSemi INNER JOIN conference ON conference.numHoraire = creneau.numHoraire INNER JOIN intervenant ON intervenant.numIntervenant = conference.numIntervenant WHERE seminaire.numSemi = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $seminaire_id);
        $stmt->execute();
        $lesSeminairesById = $stmt->fetchAll(PDO::FETCH_OBJ);

        $confById = [];
        foreach($lesSeminairesById as $unSeminaireById){
            $seminaire = new Seminaire($unSeminaireById->numSemi, $unSeminaireById->intitule);
            $intervenant = new Intervenant($unSeminaireById->numIntervenant, $unSeminaireById->nom, $unSeminaireById->prenom);
            $conference = new Conference(
                $unSeminaireById->id,
                $unSeminaireById->description,
                $unSeminaireById->salle,
                $unSeminaireById->nbplace,
                $intervenant,
                $unSeminaireById->horaire,
                $seminaire
            );
        $confById[] = $conference;
    }

        return $confById;
    }
}
?>