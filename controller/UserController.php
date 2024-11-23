<?php
include(__DIR__ . '/config.php');
include(__DIR__ . '/../Model/User.php');

class UserController
{
    public function listUser()
    {
        $sql = "SELECT * FROM user where role ='student' ";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteUser($id)
    {
        $sql = "DELETE FROM user WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addUser($user)
    {
        $sql = "INSERT INTO user (nom, email, mot_de_passe, role) 
                VALUES (:nom, :email, :mot_de_passe, :role)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $user->getNom(),
                'email' => $user->getEmail(),
                'mot_de_passe' => $user->getMDP(), // Pour sécuriser le mot de passe
                'role' => $user->getRole(),
        ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['email' => $email]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function updateUser($offer, $id)
{
    var_dump($offer);
    try {
        $db = config::getConnexion();

        $query = $db->prepare(
            'UPDATE user SET 
                nom = :nom,
                email = :email,
                mot_de_passe = :mot_de_passe
            WHERE id = :id'
        );

        $query->execute([
            'id' => $id,
            'nom' => $offer->getNom(),
            'email' => $offer->getEmail(),
            'mot_de_passe' => $offer->getMDP()
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}


    function showUser($id)
    {
        $sql = "SELECT * from user where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $offer = $query->fetch();
            return $offer;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    function updateProfile($name, $email, $id)
    {
        try {
            $db = config::getConnexion();

            $query = $db->prepare(
                'UPDATE user SET 
                    nom = :nom,
                    email = :email
                WHERE id = :id'
            );

            $query->execute([
                'nom' => $name,
                'email' => $email,
                'id' => $id
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); 
        }
    }
}