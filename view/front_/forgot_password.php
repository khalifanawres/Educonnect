<?php
require_once '../../controller/UserController.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if (!$email) {
        $error = "Invalid email format.";
    } else {
        $userController = new UserController();

        // Vérifiez si l'e-mail existe dans la base de données
        if ($userController->checkEmailExists($email)) {
            // Générer un jeton unique
            $token = bin2hex(random_bytes(32));
            $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

            // Stocker le token dans la base de données
            $userController->storeResetToken($email, $token, $expiry);

            // Envoyer l'e-mail de réinitialisation
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Remplacez par votre hôte SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'spouz2003@gmail.com'; // Votre email
                $mail->Password = 'fdbx olhy sjgg wdwr'; // Mot de passe de l'email
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('your-email@example.com', 'Support');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body = "Click the link below to reset your password: <br>
                <a href='http://localhost/projet/view/front_/reset_password.php?token=$token'>Reset Password</a>";

                $mail->send();
                $success = "A password reset link has been sent to your email.";
            } catch (Exception $e) {
                $error = "Failed to send email. Error: " . $mail->ErrorInfo;
            }
        } else {
            $error = "Email does not exist in our records.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <form action="" method="POST">
        <h2>Forgot Password</h2>
        <?php if ($error): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color: green;"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Send Reset Link</button>
    </form>
</body>
</html>
