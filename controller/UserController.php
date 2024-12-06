<?php
include(__DIR__ . '/../config/config.php');
include(__DIR__ . '/../Model/User.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';
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

    public function listUserProf()
    {
        $sql = "SELECT * FROM user where role ='prof' ";
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

    public function addUser($user)
{
    $db = config::getConnexion();
    $email = $user->getEmail();

    try {
        // Vérifier si l'email existe déjà
        $checkEmailSql = "SELECT COUNT(*) FROM user WHERE email = :email";
        $stmt = $db->prepare($checkEmailSql);
        $stmt->execute(['email' => $email]);
        $emailExists = $stmt->fetchColumn();

        if ($emailExists > 0) {
            // L'email existe déjà
            return [
                'status' => 'error',
                'message' => 'L\'email existe déjà. Veuillez utiliser un autre email.'
            ];
        }

        // Préparer la requête d'insertion
        $sql = "INSERT INTO user (nom, email, mot_de_passe, role, dob, tel, photo) 
                VALUES (:nom, :email, :mot_de_passe, :role, :dob, :tel, :photo)";

        $query = $db->prepare($sql);

        // Hachage du mot de passe avant de l'insérer
        $hashedPassword = password_hash($user->getMDP(), PASSWORD_DEFAULT);

        // On insère NULL par défaut pour dob, tel et photo si elles ne sont pas définies
        $dob = $user->getDob() ?? null;
        $tel = $user->getTel() ?? null;
        $photo = $user->getPhoto() ?? null;

        // Exécuter la requête
        $query->execute([
            'nom' => $user->getNom(),
            'email' => $email,
            'mot_de_passe' => $hashedPassword,
            'role' => $user->getRole(),
            'dob' => $dob,
            'tel' => $tel,
            'photo' => $photo
        ]);

        // Envoyer un email de confirmation (si nécessaire)
        $this->sendConfirmationEmail($email, $user->getNom());

        // Retourner un succès
        return [
            'status' => 'success',
            'message' => 'Compte créé avec succès.'
        ];
    } catch (Exception $e) {
        // Gérer les exceptions et retourner un message d'erreur
        return [
            'status' => 'error',
            'message' => 'Une erreur est survenue lors de la création du compte : ' . $e->getMessage()
        ];
    }
}


    // Fonction pour envoyer l'email de confirmation
    function sendConfirmationEmail($email, $name)
    {
        $mail = new PHPMailer(true);

        try {
            // Configurer le serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.Outlook.com'; // Remplacez par votre serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'abdelhamid.ayadi@esprit.tn'; // Remplacez par votre email SMTP
            $mail->Password = '231JMT5991'; // Remplacez par votre mot de passe SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configurer l'email
            $mail->setFrom('abdelhamid.ayadi@esprit.tn', 'EDUCONNECT');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Confirm your registration';
            $mail->Body = "
                <p>Hello <b>$name</b>,</p>
                <p>Thank you for registering on our platform. Please confirm your email address by clicking the link below:</p>
                <p><a href='http://yourwebsite.com/confirm.php?email=$email'>Confirm my email</a></p>
                <p>Best regards,<br>YourApp Team</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


    
    public function getUserByEmail($email) {
        $conn = config::getConnexion();
    
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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



    //login  

    public function authenticateUser($email, $password) {
        $db = config::getConnexion();
        $query = $db->prepare("SELECT * FROM user WHERE email = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Comparer le mot de passe
            if (password_verify($password, $user['mot_de_passe'])) {
                return $user;
            } else {
                return false; // Mot de passe incorrect
            }
        } else {
            return null; // Email non trouvé
        }
    }

    public function emailExists($email) {
        $db = config::getConnexion();
        $query = $db->prepare("SELECT * FROM user WHERE email = :email");
        $query->execute(['email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

public function updateUserProfile($id, $name, $email, $dob, $tel, $photo = null) {
    $conn = config::getConnexion();

    try {
        if ($photo) {
            $sql = "UPDATE user SET nom = ?, email = ?, dob = ?, tel = ?, photo = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $email, $dob, $tel, $photo, $id]);
        } else {
            $sql = "UPDATE user SET nom = ?, email = ?, dob = ?, tel = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $email, $dob, $tel, $id]);
        }
        return true;
    } catch (PDOException $e) {
        error_log("Erreur SQL : " . $e->getMessage());
        return false;
    }
}





public function updateUserPassword($id, $currentPassword, $newPassword) {
    // Connexion à la base de données
    $conn = config::getConnexion();

    try {
        // Vérifier le mot de passe actuel
        $sql = "SELECT mot_de_passe FROM user WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($currentPassword, $user['mot_de_passe'])) {
            return "Mot de passe actuel incorrect.";
        }

        // Mettre à jour avec le nouveau mot de passe
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET mot_de_passe = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$hashedPassword, $id]);

        return true; // Succès
    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour du mot de passe : " . $e->getMessage());
        return "Erreur lors de la mise à jour.";
    }
}


public function getUserById($id) {
    $conn = config::getConnexion();

    try {
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un tableau associatif
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération de l'utilisateur : " . $e->getMessage());
        return null;
    }
}

public function doesEmailExist($email) {
    $conn = config::getConnexion();

    try {
        $sql = "SELECT COUNT(*) FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();

        return $count > 0; // Retourne true si l'email existe
    } catch (PDOException $e) {
        error_log("Erreur lors de la vérification de l'email : " . $e->getMessage());
        return false;
    }
}


public function saveVerificationCode($email, $code) {
    $conn = config::getConnexion();
    
    try {
        $sql = "UPDATE user SET verification_code = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$code, $email]);
    } catch (PDOException $e) {
        error_log("Erreur lors de la sauvegarde du code de vérification : " . $e->getMessage());
    }
}

public function storeResetToken($userId, $token) {
    $conn = config::getConnexion();

    $sql = "UPDATE user SET reset_token = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$token, $userId]);
}

public function getUserByToken($token) {
    $conn = config::getConnexion();

    $sql = "SELECT * FROM user WHERE reset_token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$token]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function clearResetToken($userId) {
    $conn = config::getConnexion();

    $sql = "UPDATE user SET reset_token = NULL WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId]);
}


public function validateCurrentPassword($userId, $currentPassword) {
    $db = config::getConnexion();
    $query = $db->prepare("SELECT mot_de_passe FROM user WHERE id = :id");
    $query->execute(['id' => $userId]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($currentPassword, $user['mot_de_passe'])) {
        return true;  // Mot de passe correct
    } else {
        return false;  // Mot de passe incorrect
    }
}


}
