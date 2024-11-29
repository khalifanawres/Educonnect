<?php
include_once(__DIR__ . '/..config.php');
include_once(__DIR__ . '/../Model/Cours.php');

class CoursController{

    public function addCours(Cours $cours)
    {
        $sql = "INSERT INTO cours
        VALUES (NULL, NULL, :titre, :types, :descript, NULL)";
        $db =config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute
            (
                [
                    'titre'=> $cours->getTitre(),
                    'types'=> $cours->getType(),
                    'descript'=>$cours->getDescription(),
                ]
                );
            }
            catch (Execption $e)
            {
                echo 'Erreur: ' . $e->getMessage();
            }
    }

    public function listCours()
    {
        $sql="SELECT * FROM Cours";
        $db =config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function updateCours($cours,$id)
    {
        $sql = "UPDATE cours SET
            'idCours'=>$cours->idCours,
            'idCreateur'=>$cours->idCreateur,
            'titre'=>$cours->titre,
            'types'=>$cours->type,
            'descript'=>$cours->description"
    }
}
?>