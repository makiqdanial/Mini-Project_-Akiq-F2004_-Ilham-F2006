<?php

class Event {
    private $conn;
    private $table_name = "events";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllEvents() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getEventById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $date, $venue, $audience, $budget) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (event_name, event_date, venue, target_audience, budget) 
                  VALUES (:name, :date, :venue, :audience, :budget)";
        
        $stmt = $this->conn->prepare($query);

        $name = htmlspecialchars(strip_tags($name));
        $date = htmlspecialchars(strip_tags($date));
        $venue = htmlspecialchars(strip_tags($venue));
        $audience = htmlspecialchars(strip_tags($audience));
        $budget = htmlspecialchars(strip_tags($budget));

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":venue", $venue);
        $stmt->bindParam(":audience", $audience);
        $stmt->bindParam(":budget", $budget);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update($id, $name, $date, $venue, $audience, $budget, $status) {
        $query = "UPDATE " . $this->table_name . " 
                  SET event_name = :name, event_date = :date, venue = :venue, 
                      target_audience = :audience, budget = :budget, status = :status 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", htmlspecialchars(strip_tags($name)));
        $stmt->bindParam(":date", htmlspecialchars(strip_tags($date)));
        $stmt->bindParam(":venue", htmlspecialchars(strip_tags($venue)));
        $stmt->bindParam(":audience", htmlspecialchars(strip_tags($audience)));
        $stmt->bindParam(":budget", htmlspecialchars(strip_tags($budget)));
        $stmt->bindParam(":status", htmlspecialchars(strip_tags($status)));
        $stmt->bindParam(":id", $id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>