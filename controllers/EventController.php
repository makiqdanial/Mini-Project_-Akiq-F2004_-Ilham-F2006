<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Event.php';

class EventController {
    private $db;
    private $eventModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_logged_in'])) {
            header("Location: views/login.php");
            exit();
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->eventModel = new Event($this->db);
    }

    public function index() {
        $stmt = $this->eventModel->getAllEvents();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'views/events/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['event_name'] ?? '';
            $date = $_POST['event_date'] ?? '';
            $venue = $_POST['venue'] ?? '';
            $audience = $_POST['target_audience'] ?? '';
            $budget = $_POST['budget'] ?? 0;

            if (!empty($name) && !empty($date) && !empty($venue)) {
                if ($this->eventModel->create($name, $date, $venue, $audience, $budget)) {
                    header("Location: index.php?status=created");
                    exit();
                }
            }
        }
        require_once 'views/events/create.php';
    }

    public function edit($id) {
        $event = $this->eventModel->getEventById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['event_name'];
            $date = $_POST['event_date'];
            $venue = $_POST['venue'];
            $audience = $_POST['target_audience'];
            $budget = $_POST['budget'];
            $status = $_POST['status'];

            if ($this->eventModel->update($id, $name, $date, $venue, $audience, $budget, $status)) {
                header("Location: index.php?status=updated");
                exit();
            }
        }
        require_once 'views/events/edit.php';
    }

    public function upload_participants() {
        $event_id = $_GET['event_id'] ?? null;
        if (!$event_id) {
            header("Location: index.php");
            exit();
        }

        require_once 'models/Participant.php';
        $participant = new Participant($this->db);
        $participants = $participant->getByEvent($event_id);

        require_once 'views/events/upload_participants.php';
    }

    public function process_upload() {
        if (isset($_POST['upload']) && isset($_FILES['csv_file'])) {
            $event_id = $_POST['event_id'];
            $file = $_FILES['csv_file'];

            if ($file['size'] > 2097152) {
                header("Location: index.php?action=upload_participants&event_id=$event_id&error=Saiz fail melebihi 2MB!");
                exit();
            }

            $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if ($file_ext !== 'csv') {
                header("Location: index.php?action=upload_participants&event_id=$event_id&error=Format fail mestilah .csv!");
                exit();
            }

            if (($handle = fopen($file['tmp_name'], "r")) !== FALSE) {
                fgetcsv($handle, 1000, ","); 

                require_once 'models/Participant.php';
                $participant = new Participant($this->db);

                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (!empty($data[0]) && !empty($data[1])) {
                        $student_id = $data[0]; 
                        $name       = $data[1]; 
                        $email      = $data[2] ?? 'N/A'; 

                        $participant->insert($event_id, $student_id, $name, $email);
                    }
                }
                fclose($handle);

                header("Location: index.php?action=upload_participants&event_id=$event_id&success=1");
                exit();
            }
        }
    }

    public function delete($id) {
        if ($this->eventModel->delete($id)) {
            header("Location: index.php?status=deleted");
            exit();
        }
    }
}
?>