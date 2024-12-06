<?php 
require '../config.php';

class sponsorC {

    public function addsponsor($sponsor)
{
    // Update the query to include address, number, and name
    $sql = "INSERT INTO Sponsor (idarticle, contenu_, address, number, name, likee) 
            VALUES (:idarticle, :contenu_, :address, :number, :name, :likee)";
    
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            "idarticle" => $sponsor->getidarticle(),
            "contenu_" => $sponsor->getcontenu_(),
            "address" => $sponsor->getaddress(),
            "number" => $sponsor->getnumber(),
            "name" => $sponsor->getname(),
            "likee" => 0,  // Assuming 'likee' is fixed at 0
        ]);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}


    public function updateLikeValue($sponsorId, $like)
    {
        // Update to use the new column name 'idsponsor' and 'Sponsor' table
        $sql = "UPDATE Sponsor SET likee=:likee WHERE idsponsor = :idsponsor";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                "idsponsor" => $sponsorId,
                "likee" => $like,
            ]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function alllike()
    {
        // Update to use the new table name 'Sponsor'
        $sql = "SELECT likee FROM Sponsor";
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

    public function deletesponsor($idsponsor)
    {
        // Update to use the new column name 'idsponsor'
        $sql = "DELETE FROM Sponsor WHERE idsponsor = :idsponsor";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                "idsponsor" => $idsponsor,
            ]);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function allsponsor()
    {
        // Update to use the new table name 'Sponsor'
        $sql = "SELECT * FROM Sponsor";
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
        // Update to use the new table name 'Sponsor'
        $sql = "SELECT * FROM Sponsor WHERE idarticle = :idarticle";
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

    public function findsponsor($idsponsor)
    {
        // Update to use the new column name 'idsponsor'
        $sql = "SELECT * FROM Sponsor WHERE idsponsor = :idsponsor";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                "idsponsor" => $idsponsor,
            ]);
            $service = $query->fetch();

            return $service;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
