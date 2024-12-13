
<?php

class config

{   private static $pdo = null;

    public static function getConnexion()

    {

        if (!isset(self::$pdo)) {

            $servername="localhost";

            $username="root";

            $password ="";

            $dbname="educonnect";

            try {

                self::$pdo = new PDO("mysql:host=$servername;dbname=$dbname",

                        $username,

                        $password

                   

                );

                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

               

             

            } catch (Exception $e) {

                die('Erreur: ' . $e->getMessage());

            }
        }

        return self::$pdo;

    }

    public static function start_db()
    {
        $servername="localhost";
        $username="root";
        $password="";
        $dbname="educonnect";
        
        $conn = new mysqli($servername,$username,$password,$dbname);
        if($conn->connect_error)
        {die ("connection failed" . $sonn->connect_error);}

        $sql="CREATE TABLE Cours(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        idCreator INT UNSIGNED,
        title VARCHAR(50) NOT NULL,
        category VARCHAR(20) NOT NULL,
        descript VARCHAR(500) NULL,
        creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

        if ($conn->query($sql)===TRUE)
        {
            echo("Table Cours created with success");
        }
        else 
        {
            echo("Error creating the cours table : " . $conn->error);
        }
    }

}

config::getConnexion();
config::start_db();

?>

