<?php
require_once __DIR__."/../ApiClient.php";

class ConferenceController {
    
    public function list() {

        // TODO : Utiliser ApiClient pour récupérer les conférences
        // TODO : Afficher les conférences (include d’une vue)

        $api = new ApiClient();

        $lesSeminaires = $api->getSeminaires();

        // Récupérer toutes les conférences ou selon le séminaire choisi
        if(isset($_POST["seminaire_id"]) && !empty($_POST["seminaire_id"])) {
            $seminaire_id = $_POST["seminaire_id"];
            $lesConferences = $api->getConferences($seminaire_id);
        } else {
            $lesConferences = $api->getConferences(); // toutes les conférences
        }

        // Inscription
        if(isset($_POST['id']) && isset($_SESSION['numParticipant'])) {
            $numParticipant = $_SESSION['numParticipant'];
            $idConference = $_POST['id'];
            $resultat = $api->inscrire($numParticipant, $idConference);
        }

        include_once __DIR__.'/../views/layout.php';
            
    }

    public function listInscription() {
        $api = new ApiClient();
        if(isset($_SESSION['numParticipant'])){
        $numParticipant = $_SESSION['numParticipant'];
        $lesParticipations = $api->getInscriptions($numParticipant);
        }
        include_once __DIR__.'/../views/layout.php';
    }
}
?>