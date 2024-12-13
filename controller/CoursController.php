<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/Cours.php');

class CoursController{

    public function addCours(Cours $cours)
    {
        $sql = "INSERT INTO cours
        VALUES (NULL, NULL, :title, :category, :descript, NULL)";
        $db =config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute
            (
                [
                    'title'=> $cours->gettitle(),
                    'category'=> $cours->getType(),
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
        $sql="SELECT * FROM cours";
        $db =config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function updateCours($cours,$idCours)
    {
        var_dump($cours);
        try { 
            $db= config::getConnexion();
            $query = $db->prepare(
                'UPDATE cours SET
                    title = :title,
                    category = :category,
                    descript = descript
                    WHERE id = :idCours'
            );

            $query->execute([
                
                'title' => $title,
                'category' => $category,
                'descript' => $descript,
            ]);

            echo $query->rowCount() . "Records Updated succesfully <br>";
        } catch (PDOException $e)
        {
            $e->getMessage();
        }
    }
      
    function deleteCours($idCours)
    {
        $sql = "DELETE FROM cours WHERE id = :idCours";
        $db = config::getConnexion();
        $req = $dq->prepare($sql);
        $req->bindValue(':id',$idCours);

        try {
            $req->execute();
        } catch (Exception $e)
        {
            die ('Error:' . $e->getMessage());
        }
    }

}

?>