<?php 
header("Content-Type: application/json; charset=UTF-8");
 
require_once "config/database.php";
require_once "repository/conferenceRepository.php";
require_once "repository/participantRepository.php";
require_once "classe/intervenant.php";
require_once "classe/conference.php";
require_once "classe/seminaire.php";
 
$database = new Database();
$db = $database->getConnection();
 
$endpoint = $_GET["endpoint"] ?? "";
$method = $_SERVER["REQUEST_METHOD"];
 
switch ($endpoint) {
    case "conferences":        

        $data=json_decode(file_get_contents('php://input'), true);       
        $repo = new ConferenceRepository($db);
        
        if(isset($data['seminaire_id'])){
        $seminaire_id=$data['seminaire_id'];   

        $confById = $repo->findBySeminaire($seminaire_id);
        echo json_encode($confById, JSON_PRETTY_PRINT);

        }else{

        $repo = new ConferenceRepository($db);
        $confs = $repo->findAll();
        echo json_encode($confs, JSON_PRETTY_PRINT);
        }
        
        break;

    case "seminaires":
        $repo = new ConferenceRepository($db);
        $lesSeminaires = $repo->getSeminaires();

        echo json_encode($lesSeminaires, JSON_PRETTY_PRINT);
        break;
        
    case "inscription":
        $data = json_decode(file_get_contents("php://input"), true);
        $numParticipant = $data['numParticipant'] ?? null;
        $id = $data['id'] ?? null;

        $repo = new ParticipantRepository($db);
        $message = $repo->inscrire($numParticipant, $id);

        echo json_encode($message, JSON_PRETTY_PRINT);
        break;

    case "login":
        $data = json_decode(file_get_contents("php://input"), true);
        
        $repo = new ParticipantRepository($db);
        $message = $repo->login($data);

        echo json_encode($message, JSON_PRETTY_PRINT);
        break;

    case "register":
        $data = json_decode(file_get_contents("php://input"), true);

        $repo = new ParticipantRepository($db);
        $message = $repo->register($data);

        echo json_encode($message, JSON_PRETTY_PRINT);
        break;

    case "mesInscriptions":
        $data = json_decode(file_get_contents("php://input"), true);

        $repo = new ParticipantRepository($db);
        $lesParticipations = $repo->getInscriptions($data);

        echo json_encode($lesParticipations, JSON_PRETTY_PRINT);
        break;
    }

?>