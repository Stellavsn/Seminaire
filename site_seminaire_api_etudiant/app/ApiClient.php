<?php
// Classe à compléter pour communiquer avec l’API REST
class ApiClient {
    private $baseUrl = "http://localhost/API/api.php?endpoint=";

    // TODO : Compléter cette méthode pour envoyer une requête à l’API
    private function request($endpoint, $method = "GET", $data = null) {
        // Indice : utiliser cURL
        // Retourner la réponse décodée (json_decode)
        
        $url=$this->baseUrl . $endpoint;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if($method == "POST"){
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);   
    }

    // TODO : Compléter pour l’authentification
    public function login($mail, $password) {
        // Appeler $this->request avec l’endpoint "login" et la méthode POST
        return $this->request("login", "POST", ["mail"=>$mail, "mdp"=>$password]);
    }

    // TODO : Compléter pour récupérer les conférences
    public function getConferences($seminaire_id = '') {
        // Appeler $this->request avec l’endpoint "conferences"
        // Si $seminaire_id est renseigné, l’envoyer en POST
        
        if($seminaire_id){
            return $this->request("conferences", "POST", ["seminaire_id"=>$seminaire_id]);
        }else{
            return $this->request("conferences", "GET");
        }
    }

    // TODO : Compléter pour l’inscription à une conférence
    public function inscrire($numParticipant, $id) {
        // Appeler $this->request avec l’endpoint "inscription" et la méthode POST
        return $this->request("inscription", "POST", ["numParticipant"=>$numParticipant,"id"=>$id ]);
    }

    // TODO : Compléter pour récupérer les inscriptions d’un participant
    public function getInscriptions($numParticipant){
        return $this->request("mesInscriptions", "POST", ["numParticipant"=>$numParticipant]);
    }

    // TODO : Compléter pour l’enregistrement d’un participant
    public function register($nom, $prenom, $profession, $ville, $mail, $mdp){
        return $this->request("register", "POST",
        [
            "nom"=>$nom,
            "prenom"=>$prenom,
            "profession"=>$profession,
            "ville"=>$ville,
            "mail"=>$mail,
            "mdp"=>$mdp,
        ]);
    }

    // TODO : Compléter pour récupérer les séminaires
    public function getSeminaires() {
        return $this->request("seminaires", "GET"); // endpoint corrigé
    }
}