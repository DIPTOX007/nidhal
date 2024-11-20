<?php
include_once 'connect.php'; 

class EventController {
    // Fetch all events from the "evenements" table
    public function getEvents() {
        $conn = config::getConnexion();
        try {
            $sql = "SELECT * FROM evenements";
            return $conn->query($sql)->fetchAll();
        } catch (PDOException $e) {
            die("Error fetching events: " . $e->getMessage());
        }
    }

    // Create a new event
    public function createEvent($nom_evenement, $desc_evenement, $date_evenement, $lieu_evenement, $prix_evenement, $capacite) {
        $conn = config::getConnexion();
        try {
            $sql = "INSERT INTO evenements (nom_evenement, desc_evenement, date_evenement, lieu_evenement, prix_evenement, capacite) 
                    VALUES (:nom_evenement, :desc_evenement, :date_evenement, :lieu_evenement, :prix_evenement, :capacite)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'nom_evenement' => $nom_evenement,
                'desc_evenement' => $desc_evenement,
                'date_evenement' => $date_evenement,
                'lieu_evenement' => $lieu_evenement,
                'prix_evenement' => $prix_evenement,
                'capacite' => $capacite
            ]);        
        } catch (PDOException $e) {
            die("Error creating event: " . $e->getMessage());
        }
    }

    // Update an existing event
    public function updateEvent($id_evenement, $nom_evenement, $desc_evenement, $date_evenement, $lieu_evenement, $prix_evenement, $capacite) {
        $conn = config::getConnexion();
        try {
            $sql = "UPDATE evenements 
                    SET nom_evenement = :nom_evenement, desc_evenement = :desc_evenement, date_evenement = :date_evenement, 
                        lieu_evenement = :lieu_evenement, prix_evenement = :prix_evenement, capacite = :capacite 
                    WHERE id_evenement = :id_evenement";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                'id_evenement' => $id_evenement,
                'nom_evenement' => $nom_evenement,
                'desc_evenement' => $desc_evenement,
                'date_evenement' => $date_evenement,
                'lieu_evenement' => $lieu_evenement,
                'prix_evenement' => $prix_evenement,
                'capacite' => $capacite
            ]);
        } catch (PDOException $e) {
            die("Error updating event: " . $e->getMessage());
        }
    }

    // Delete an event
    public function deleteEvent($id_evenement) {
        $conn = config::getConnexion();
        try {
            $sql = "DELETE FROM evenements WHERE id_evenement = :id_evenement";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['id_evenement' => $id_evenement]);
        } catch (PDOException $e) {
            die("Error deleting event: " . $e->getMessage());
        }
    }
    public function getEventById($id_evenement) {
        $conn = config::getConnexion();
        try {
            $sql = "SELECT * FROM evenements WHERE id_evenement = :id_evenement";
            $stmt = $conn->prepare($sql);
            $stmt->execute(['id_evenement' => $id_evenement]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching event by ID: " . $e->getMessage());
        }
    }
}
?>