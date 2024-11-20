<?php
include_once(__DIR__ . '/../config.php');
include_once(__DIR__ . '/../Model/Reclamation.php');

class ReclamationController {
    public function addReclamation(Reclamation $reclamation) {
        $sql = "INSERT INTO reclamation (nom, email, sujet, message) VALUES (:nom, :email, :sujet, :message)";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $reclamation->getNom(),
                'email' => $reclamation->getEmail(),
                'sujet' => $reclamation->getSujet(),
                'message' => $reclamation->getMessage()
            ]);

            $reclamation->setId($db->lastInsertId()); // Récupère l'ID généré
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getAllReclamations() {
        $sql = "SELECT * FROM reclamation";
        $db = Config::getConnexion();

        try {
            return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function deleteReclamation(int $id) {
        $sql = "DELETE FROM reclamation WHERE id = :id";
        $db = Config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public function updateReclamation($reclamation) {
        $sql = "UPDATE reclamation SET 
                    nom = :nom,
                    email = :email,
                    sujet = :sujet,
                    message = :message
                WHERE id = :id";
    
        try {
            // Appel de la fonction getConnection() depuis config.php
            $db = Config::getConnexion();
    
            // Préparation de la requête
            $query = $db->prepare($sql);
    
            // Exécution de la requête avec un tableau associatif contenant les propriétés de l'objet Reclamation
            $query->execute([
                ':id' => $reclamation->id,
                ':nom' => $reclamation->nom,
                ':email' => $reclamation->email,
                ':sujet' => $reclamation->sujet,
                ':message' => $reclamation->message
            ]);
    
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    
    


    public function getReclamationById($id) {
        $sql = "SELECT * FROM reclamation WHERE id = :id";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
?>

