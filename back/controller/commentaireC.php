<?php 
require '../config.php';
class commentaireC   {
    
    public function addcommentaire($commentaire)
    {
      $sql = "INSERT INTO commentaire VALUES (NULL, :idarticle, :contenu_,:likee)";
      $db = config::getConnexion();
      try {
        $query = $db->prepare($sql);
        $query->execute([
          "idarticle" => $commentaire->getidarticle(),
          "contenu_" => $commentaire->getcontenu_(),
          "likee" => 0,
         
        ]);
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    public function updateLikeValue($commentId, $like)
{
    $sql = "UPDATE commentaire SET likee=:likee WHERE idcommentaire = :idcommentaire";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            "idcommentaire" => $commentId,
            "likee" => $like,
        ]);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
    public function alllike()
    {
      $sql = "SELECT likee FROM commentaire";
      $db = config::getConnexion();
      try {
        $query = $db->prepare($sql);
        $query->execute();
        $service = $query->fetch();
        $res = [];
        for ($x = 0; $service; $x++) {
          $res[$x] = $service;
          $service = $query->fetch();
        }
        return $res;
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    public function deletecommentaire($idcommentaire)
    {
      $sql = "DELETE FROM commentaire WHERE idcommentaire = :idcommentaire";
      $db = config::getConnexion();
      try {
        $query = $db->prepare($sql);
        $query->execute([
          "idcommentaire" => $idcommentaire,
        ]);
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }


    public function allcommentaire()
    {
      $sql = "SELECT * FROM commentaire";
      $db = config::getConnexion();
      try {
        $query = $db->prepare($sql);
        $query->execute();
        $service = $query->fetch();
        $res = [];
        for ($x = 0; $service; $x++) {
          $res[$x] = $service;
          $service = $query->fetch();
        }
        return $res;
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    public function findbyarticle($idarticle)
    {
      $sql = "SELECT * FROM commentaire WHERE idarticle = :idarticle";
      $db = config::getConnexion();
      try {
        $query = $db->prepare($sql);
        $query->execute([
          "idarticle" => $idarticle,
        ]);
        $service = $query->fetch();
        $res = [];
        for ($x = 0; $service; $x++) {
          $res[$x] = $service;
          $service = $query->fetch();
        }
        return $res;
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    public function findcommentaire($idcommentaire)
    {
      $sql = "SELECT * FROM commentaire WHERE idcommentaire = :idcommentaire";
      $db = config::getConnexion();
      try {
        $query = $db->prepare($sql);
        $query->execute([
          "idcommentaire" => $idcommentaire,
        ]);
        $service = $query->fetch();
  
        return $service;
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }

}
?>


