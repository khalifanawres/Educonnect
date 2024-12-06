<?php 
require '../config.php';
class forumC   {
    
    public function addforum($forum)
    {
      $sql = "INSERT INTO forum VALUES (NULL, :categorie, :titre, :message, :image, :date,:rate)";
      $db = config::getConnexion();
      try {
        $query = $db->prepare($sql);
        $query->execute([
          "categorie" => $forum->getcategorie(),
          "titre" => $forum->gettitre(),
          "message" => $forum->getmessgae(),
          "image" => $forum->getimage(),
          "date" => $forum->getdate(),
          "rate"=> 0
        ]);
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }
  
    public function updateforum($forum,$id)
    {
      $sql = "UPDATE forum SET categorie=:categorie,titre=:titre,message=:message,image=:image,date=:date,rate=:rate WHERE id = :id";
      $db = config::getConnexion();
      try {
        $query = $db->prepare($sql);
        $query->execute([
          "id" => $id,
          "categorie" => $forum->getcategorie(),
          "titre" => $forum->gettitre(),
          "message" => $forum->getmessgae(),
          "image" => $forum->getimage(),
          "date" => $forum->getdate(),
          "rate" => $forum->getrate(),
        ]);
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }
        public function deleteforum($id)
    {
      $sql = "DELETE FROM forum WHERE id = :id";
      $db = config::getConnexion();
      try {
        $query = $db->prepare($sql);
        $query->execute([
          "id" => $id,
        ]);
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }

    public function allforum()
    {
      $sql = "SELECT * FROM forum";
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
    public function findforum($id)
    {
      $sql = "SELECT * FROM forum WHERE id = :id";
      $db = config::getConnexion();
      try {
        $query = $db->prepare($sql);
        $query->execute([
          "id" => $id,
        ]);
        $service = $query->fetch();
  
        return $service;
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
    }
    public function findforumBycategorie($forum, $categorie)
    {
        $sql = "SELECT * FROM forum WHERE categorie = :categorie";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['categorie' => $categorie]);
            $user = $query->fetch();
    
            if ($forum) {
                // Password matches (comparing as strings)
                return $forum;
            } else {
                // Invalid username or password
                return false;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    function recherchercotegorie($categorie){
      $sql="SELECT * From forum WHERE categorie= '$categorie' ";
      $db = config::getConnexion();
      try{
      $liste=$db->query($sql);
      return $liste;
      }
      catch (Exception $e){
        die('Erreur: '.$e->getMessage());
      }	
    }

    function recherchertitre($titre){
      $sql="SELECT * From forum WHERE titre = '$titre' ";
      $db = config::getConnexion();
      try{
      $liste=$db->query($sql);
      return $liste;
      }
      catch (Exception $e){
        die('Erreur: '.$e->getMessage());
      }	
    }
}
?>


