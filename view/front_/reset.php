<?php
require_once '../../config/Database.php';
require_once '../../model/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $newPassword = $_POST['password'] ?? '';

    // Basic validation
    if (empty($token) || empty($newPassword)) {
        echo "Please provide both the token and a new password.";
        exit();
    }

    try {
        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);

        // Get user data by reset token
        $sql = "SELECT id, email, reset_expires_at FROM utilisateurs WHERE reset_token = :reset_token";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':reset_token', $token);
        $stmt->execute();

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            // Check if the reset token is expired
            $expiresAt = $userData['reset_expires_at'];
            if (strtotime($expiresAt) > time()) {
                // Token is valid, update the password
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

                $updateSql = "UPDATE utilisateurs SET password = :password, reset_token = NULL, reset_expires_at = NULL WHERE reset_token = :reset_token";
                $updateStmt = $db->prepare($updateSql);
                $updateStmt->bindParam(':password', $hashedPassword);
                $updateStmt->bindParam(':reset_token', $token);

                if ($updateStmt->execute()) {
                    // Password reset successful
                    echo "Your password has been successfully reset. <a href='signin.php'>Click here to login</a>";
                } else {
                    echo "Error updating password.";
                }
            } else {
                echo "The reset token has expired.";
            }
        } else {
            echo "Invalid reset token.";
        }
    } catch (PDOException $exception) {
        echo "Database connection error: " . $exception->getMessage();
    } catch (Exception $exception) {
        echo "Unexpected error: " . $exception->getMessage();
    }
}
?>

<<?php
// Your PHP code for resetting the password goes here (as in the previous example)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #ffffff;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-container input[type="password"], .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Reset Your Password</h2>
        <form method="POST" action="">
            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token']) ?>">
            <input type="password" name="password" placeholder="New Password" required><br>
            <input type="submit" value="Reset Password">
        </form>
    </div>

</body>
</html>

