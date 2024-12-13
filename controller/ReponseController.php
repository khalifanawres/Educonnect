<?php
include_once(__DIR__ . '/../config.php');
include_once(__DIR__ . '/../Model/Reponse.php');

class ReponseController {
    // Ajouter une réponse
    public function addReponse(Reponse $reponse) {
        $sql = "INSERT INTO reponse (id, message_reponse, date_reponse) VALUES (:id, :message_reponse, :date_reponse)";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $reponse->getId(),
                'message_reponse' => $reponse->getMessageReponse(),
                'date_reponse' => $reponse->getDateReponse()
            ]);

            // Mettre à jour l'ID de la réponse après l'insertion
            $reponse->setIdReponse($db->lastInsertId());
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getReponsesByReclamation($id) {
        $sql = "SELECT * FROM reponse WHERE id = :id"; // Colonne "id_reclamation" dans la table "reponse"
        $db = Config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]); // Liaison correcte avec "id_reclamation"
            return $query->fetchAll(PDO::FETCH_ASSOC); // Retourne toutes les réponses associées
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
    
    

    
    public function getReclamationById($id) {
        $sql = "SELECT * FROM reclamation WHERE id = :id"; // "id" correspond à la colonne de la table "reclamation"
        $db = Config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]); // Liaison correcte avec "id"
            return $query->fetch(PDO::FETCH_ASSOC); // Retourne une seule réclamation
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    


    // Récupérer une réponse par ID
    public function getReponseById($id_reponse) {
        $sql = "SELECT * FROM reponse WHERE id_reponse = :id_reponse";
        $db = Config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id_reponse]);
            return $query->fetch(PDO::FETCH_ASSOC); // Retourner une seule réponse
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public function getAllReclamations() {
        $sql = "SELECT r.*, 
                       IFNULL((SELECT COUNT(*) FROM reponse WHERE reponse.id_reclamation = r.id), 0) AS has_response
                FROM reclamation r";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
            // Vérification des résultats
            if (empty($result)) {
                echo "Aucune réclamation trouvée.";
            } else {
                return $result;
            }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
   

    

}
?>

