<?php

class ParticipantRepository {
    private $conn;
    public function __construct($db) {
       $this->conn = $db;
    }
 
    // Inscription à une conférence
    public function inscrire($numParticipant, $id) { 
        $sql = "INSERT INTO participer(numParticipant, id) VALUES(?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1,$numParticipant);
        $stmt->bindValue(2,$id);
        if($stmt->execute()){
        return[
           "message" => 'Participant inscrit'
            ];
        }
        else{
            return [
            "message" => 'Participant déjà inscrit'
            ];
        }
    }

 
    // Authentification
    public function login($data) {  
        $sql = "SELECT* FROM participant WHERE mail=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $data['mail']);
        $stmt->execute();
        $participant = $stmt->fetch(PDO::FETCH_OBJ);

            if($participant && password_verify($data['mdp'], $participant->mdp)){
                return[
                    "message" => 'Participant connecté',
                    "participant" => [
                    "numParticipant" => $participant->numParticipant,
                    "nom" => $participant->nom,
                    "prenom" => $participant->prenom,
                    "mail" => $participant->mail,
                    ]
                ];
                    }
                    else{
                        return [
                        "message" => 'Participant non connecté'
                        ];
                    }
            }
    
 
    // Inscription d'un nouveau participant
    public function register($data) {  
        $hash = password_hash($data['mdp'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO participant(numParticipant, nom, prenom, profession, ville, mail, mdp) VALUES(NULL, ?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $data['nom']);
        $stmt->bindValue(2, $data['prenom']);
        $stmt->bindValue(3, $data['profession']);
        $stmt->bindValue(4, $data['ville']);
        $stmt->bindValue(5, $data['mail']);
        $stmt->bindValue(6, $hash);

        if($stmt->execute()){
            return[
            "message" => 'Participant inscrit'
                ];
            }
            else{
                return [
                "message" => 'Participant non inscrit'
                ];
            }
        }
 
    // Récupérer les inscriptions d’un participant
    public function getInscriptions($data) {  
        $sql = "SELECT participer.numParticipant, conference.id, conference.description, conference.salle, conference.nbplace, seminaire.numSemi, seminaire.intitule, creneau.horaire, intervenant.numIntervenant, intervenant.nom, intervenant.prenom from participant INNER JOIN participer ON participer.numParticipant = participant.numParticipant INNER JOIN conference ON conference.id = participer.id INNER JOIN creneau ON creneau.numHoraire = conference.numHoraire INNER JOIN seminaire ON seminaire.numSemi = creneau.numSemi INNER JOIN intervenant ON intervenant.numIntervenant = conference.numIntervenant WHERE participer.numParticipant=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $data['numParticipant']);
        $stmt->execute();
        $lesInscriptions = $stmt->fetchAll(PDO::FETCH_OBJ);

        $lesParticipations = [];

        foreach($lesInscriptions as $uneInscription){
            $seminaire = new Seminaire($uneInscription->numSemi, $uneInscription->intitule);
            $intervenant = new Intervenant($uneInscription->numIntervenant, $uneInscription->nom, $uneInscription->prenom);
            $conference = new Conference(
                $uneInscription->id,
                $uneInscription->description,
                $uneInscription->salle,
                $uneInscription->nbplace,
                $intervenant,
                $uneInscription->horaire,
                $seminaire
            );
        $lesParticipations[] = $conference;
        }
        return $lesParticipations;
    }
}
?>