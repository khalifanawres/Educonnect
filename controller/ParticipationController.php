<?php
include(__DIR__ . '/config.php');
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
        $sql = "INSERT INTO participation (user_id, competition_id, date_participation) 
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

    function deleteParticipation($user_id, $competition_id)
    {
        $sql = "DELETE FROM participation WHERE user_id = :user_id AND competition_id = :competition_id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':user_id', $user_id);
        $req->bindValue(':competition_id', $competition_id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
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
}
