<?php
include_once(__DIR__ . '/../config.php');
include_once(__DIR__ . '/../Model/Reclamation.php');

class ReclamationController {
    public function addReclamation(Reclamation $reclamation) {
    $sql = "INSERT INTO reclamation (nom, email, telephone, sujet, message, statut) 
            VALUES (:nom, :email, :telephone, :sujet, :message, :statut)";
    $db = Config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute([
            'nom' => $reclamation->getNom(),
            'email' => $reclamation->getEmail(),
            'telephone' => $reclamation->getTelephone(),
            'sujet' => $reclamation->getSujet(),
            'message' => $reclamation->getMessage(),
            'statut' => $reclamation->getStatut() // Ajouter le statut ici
        ]);
        $reclamation->setId($db->lastInsertId());  // Récupère l'ID généré
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
public function addReponse($reponse) {
    $sql = "INSERT INTO reponse (id, reponse_message, date_reponse) VALUES (:id, :reponse_message, NOW())";

    try {
        $db = Config::getConnexion();
        $query = $db->prepare($sql);
        $query->execute([
            ':id' => $reponse->getIdReclamation(),
            ':reponse_message' => $reponse->getReponseMessage(),
        ]);

        // Mettre à jour le statut de la réclamation pour "Répondu"
        $this->updateStatutReclamation($reponse->getIdReclamation(), 'Répondu');

    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}

 function updateStatutReclamation($id) {
    // Connexion à la base de données
    $db = Config::getConnexion();
    
    // Vérifier si la réclamation a des réponses associées
    $sql = "SELECT COUNT(*) FROM reponse WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    // Récupérer le nombre de réponses
    $reponsesCount = $query->fetchColumn();

    // Déterminer le statut
    $statut = ($reponsesCount > 0) ? 'Répondu' : 'En cours';

    // Mettre à jour le statut dans la table reclamation
    $updateSql = "UPDATE reclamation SET statut = :statut WHERE id = :id";
    $updateQuery = $db->prepare($updateSql);
    $updateQuery->bindParam(':statut', $statut, PDO::PARAM_STR);
    $updateQuery->bindParam(':id', $id, PDO::PARAM_INT);
    $updateQuery->execute();
}



    public function updateReclamation($reclamation) {
        $sql = "UPDATE reclamation SET 
                    nom = :nom,
                    email = :email,
                    telephone = :telephone,
                    sujet = :sujet,
                    message = :message,
                    statut = :statut  // Assurer que le statut est inclus
                WHERE id = :id";
    
        try {
            // Appel à la base de données via la méthode getConnexion() depuis config.php
            $db = Config::getConnexion();
            
            // Préparation de la requête
            $query = $db->prepare($sql);
            
            // Exécution de la requête avec les paramètres
            $query->execute([
                ':id' => $reclamation->getId(),
                ':nom' => $reclamation->getNom(),
                ':email' => $reclamation->getEmail(),
                ':telephone' => $reclamation->getTelephone(),
                ':sujet' => $reclamation->getSujet(),
                ':message' => $reclamation->getMessage(),
                ':statut' => $reclamation->getStatut()  // Passer la valeur du statut
            ]);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
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

    // Méthode pour récupérer une réclamation par ID
    public function getReclamationById($id) {
        // Connexion à la base de données
        $db = Config::getConnexion();
        // Préparer la requête SQL pour récupérer la réclamation par ID
        $sql = "SELECT * FROM reclamation WHERE id = :id";
        // Préparer la requête
        $query = $db->prepare($sql);
        // Lier le paramètre ID
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        // Exécuter la requête
        $query->execute();
        // Retourner la réclamation sous forme de tableau associatif
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getStatistiques() {
        // Connexion à la base de données
        $db = Config::getConnexion();
    
        // Requête SQL pour récupérer le nombre de réclamations par statut
        $sql = "SELECT statut, COUNT(*) AS count FROM reclamation GROUP BY statut";
    
        try {
            // Exécution de la requête
            $query = $db->prepare($sql);
            $query->execute();
    
            // Retourner les résultats sous forme de tableau associatif
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    public function getStatistiquesReponses() {
        $db = Config::getConnexion();
        
        // Requête pour obtenir le nombre de réclamations répondus et non répondus
        $query = "
            SELECT 
                IF(r.id IS NOT NULL, 'Répondu', 'Non répondu') AS statut,
                COUNT(*) as count
            FROM 
                reclamation r
            LEFT JOIN 
                reponse rp ON r.id = rp.id
            GROUP BY 
                statut
        ";
        
        $result = $db->query($query);
        
        if ($result) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return []; // Si aucune donnée n'est trouvée
        }
    }
    public function getNonReponduCount() {
        $db = Config::getConnexion();
        $sql = "SELECT COUNT(*) FROM reclamation WHERE statut = 'Non répondu'"; // 'En cours' signifie non répondu
    
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $count = $query->fetchColumn();
            return $count;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
    
  public function getAllReclamations($search = '') {
    // Connexion à la base de données via la classe Config
    $db = Config::getConnexion();

    // Initialiser la requête SQL de base
    $sql = "SELECT * FROM reclamation WHERE 1";

    // Ajouter une condition de recherche si un terme est fourni
    if (!empty($search)) {
        // Assurer que le terme de recherche soit propre pour éviter les injections SQL
        $search = "%" . $search . "%";  // Ajouter des jokers pour la recherche
        $sql .= " AND (nom LIKE :search OR sujet LIKE :search OR message LIKE :search)";
    }

    // Préparer la requête
    $stmt = $db->prepare($sql);

    // Si un terme de recherche est fourni, lier la valeur de recherche
    if (!empty($search)) {
        $stmt->bindValue(':search', $search, PDO::PARAM_STR);
    }

    // Exécuter la requête
    $stmt->execute();

    // Retourner les résultats sous forme de tableau associatif
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    
    }
    


?>