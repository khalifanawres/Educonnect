<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



include '../../controller/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $userController = new UserController();
    $user = $userController->getUserByEmail($email); // Assurez-vous d'avoir cette méthode

    if ($user) {
        // Générer un token unique
        $token = bin2hex(random_bytes(50));

        // Stocker le token dans la base de données
        $userController->storeResetToken($user['id'], $token);

        // Créer le lien de réinitialisation
        $resetLink = "http://example.com/reset_password.php?token=" . urlencode($token);

        // Envoyer l'email
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com'; // Remplacez par votre serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'abdelhamid.ayadi@esprit.tn';
            $mail->Password = '231JMT5991';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('ayadia819@gmail.com', 'Votre application');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Réinitialisation de votre mot de passe';
            $mail->Body = "Cliquez sur ce lien pour réinitialiser votre mot de passe : <a href='$resetLink'>$resetLink</a>";

            $mail->send();
            echo "Un lien de réinitialisation a été envoyé à votre adresse e-mail.";
        } catch (Exception $e) {
            echo "L'email n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet email.";
    }
}
?>
