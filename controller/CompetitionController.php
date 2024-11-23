<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/Competition.php');

class CompetitionController
{
    public function listCompetitions()
    {
        $sql = "SELECT * FROM competitions";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function deleteCompetition($id)
    {
        $sql = "DELETE FROM competitions WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function addCompetition($competition)
    {
        $sql = "INSERT INTO competitions (nom, description, duree, contenu) 
                VALUES (:nom, :description, :duree, :contenu)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $competition->getNom(),
                'description' => $competition->getDescription(),
                'duree' => $competition->getDuree(),
                'contenu' => $competition->getContenu()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getCompetitionById($id)
    {
        $sql = "SELECT * FROM competitions WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function updateCompetition($competition)
    {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE competitions SET 
                nom = :nom,
                description = :description,
                duree = :duree,
                contenu = :contenu
            WHERE id = :id'
        );

        $query->execute([ 
            'id' => $competition->getId(),
            'nom' => $competition->getNom(),
            'description' => $competition->getDescription(),
            'duree' => $competition->getDuree(),
            'contenu' => $competition->getContenu()
        ]);

        echo $query->rowCount() . " record(s) UPDATED successfully <br>";
    }

    function showCompetition($id)
    {
        $sql = "SELECT * FROM competitions WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);

            $competition = $query->fetch();
            return $competition;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
