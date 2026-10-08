<?php

class Participant {
    private $conn;
    private $table_name = "participants";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert($event_id, $student_id, $name, $email) {
        $query = "INSERT INTO " . $this->table_name . " (event_id, student_id, name, email) VALUES (:event_id, :student_id, :name, :email)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':event_id', $event_id);
        $stmt->bindParam(':student_id', htmlspecialchars(strip_tags($student_id)));
        $stmt->bindParam(':name', htmlspecialchars(strip_tags($name)));
        $stmt->bindParam(':email', htmlspecialchars(strip_tags($email)));

        return $stmt->execute();
    }

    public function getByEvent($event_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE event_id = :event_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':event_id', $event_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>