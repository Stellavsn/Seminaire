<?php
require_once __DIR__ . "/../ApiClient.php";

class AuthController {
    public function login() {
        $api = new ApiClient();
        $connexion = ["message" => ""];

        if (isset($_POST["mail"]) && isset($_POST["password"])) {
            $connexion = $api->login($_POST["mail"], $_POST["password"]);

            if ($connexion["message"] === 'Participant connecté') {    
                $_SESSION['mail'] = $_POST["mail"];
                $_SESSION['numParticipant'] = $connexion['participant']['numParticipant'];
                

                header('Location: index.php?c=conference&a=list'); 
                exit();
            } else {
                $connexion["message"] = "Erreur d'identifiant ou de mot de passe";
            }
        }
        require_once __DIR__ . '/../views/layout.php';
    }


    // TODO: Complétez les méthodes
    public function register(){
        $api = new ApiClient();
    
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['password'])) {
        $inscription = $api->register($_POST["nom"], $_POST["prenom"], $_POST["profession"], $_POST["ville"], $_POST["mail"], $_POST["password"]);
    }
        require_once __DIR__ . '/../views/auth/register.php';
    
        //mdp : Test123! mail : visentin.stella@gmail.com
    }

    public function logout(){
        session_destroy();
        header("Location: index.php");
    }
}
?>