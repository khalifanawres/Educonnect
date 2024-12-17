<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/Participation.php');

class ParticipationController
{
    public function listParticipationsByCompetition($competition_id)
    {
        $sql = "SELECT * FROM participation WHERE competition_id = :competition_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['competition_id' => $competition_id]);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listParticipationsByUser($user_id)
    {
        $sql = "SELECT * FROM participation WHERE user_id = :user_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['user_id' => $user_id]);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function addParticipation($participation)
    {
        $sql = "INSERT INTO participations (user_id, competition_id, date_participation) 
                VALUES (:user_id, :competition_id, :date_participation)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $participation->getUserId(),
                'competition_id' => $participation->getCompetitionId(),
                'date_participation' => $participation->getDateParticipation()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteParticipation($id)
    {
        $sql = "DELETE FROM participations WHERE id = :id";
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            throw new Exception('Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
    

    function getParticipation($user_id, $competition_id)
    {
        $sql = "SELECT * FROM participation WHERE user_id = :user_id AND competition_id = :competition_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $user_id,
                'competition_id' => $competition_id
            ]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function getAllParticipations()
    {
        $sql = "SELECT p.id, p.date_participation, u.nom AS username, c.nom AS competition_name 
                FROM participations p
                JOIN user u ON p.user_id = u.id
                JOIN competitions c ON p.competition_id = c.id";
        $db = config::getConnexion();
        try {
            return $db->query($sql)->fetchAll();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }
    public function getParticipationById($id)
{
    $sql = "SELECT * FROM participations WHERE id = :id";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute(['id' => $id]);
        return $query->fetch();
    } catch (Exception $e) {
        throw new Exception('Erreur : ' . $e->getMessage());
    }
}
public function updateParticipation($id, $user_id, $competition_id, $date_participation)
{
    $sql = "UPDATE participations 
            SET user_id = :user_id, competition_id = :competition_id, date_participation = :date_participation 
            WHERE id = :id";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->execute([
            'id' => $id,
            'user_id' => $user_id,
            'competition_id' => $competition_id,
            'date_participation' => $date_participation
        ]);
    } catch (Exception $e) {
        throw new Exception('Erreur lors de la mise à jour : ' . $e->getMessage());
    }
}

}
