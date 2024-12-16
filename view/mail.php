<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../view/PHPMailer/PHPMailer.php';
require '../view/PHPMailer/SMTP.php';
require '../view/PHPMailer/Exception.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
}

$mail = new PHPMailer(true);

try {
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = "localhost";
    $mail->Port = 1025;

    $mail->CharSet = "utf-8";

    $mail->addAddress("omaima.Bouzekri@Admin.tn");
    $mail->setFrom($email);

    $mail->isHTML();

    $mail->Subject = "Signalisation sur un message du forum";

    // Email body with Bootstrap card design
    $mail->Body = "
        <html>
        <head>
            <title>Signalisation sur un message du forum</title>
            <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
        </head>
        <body>
            <div class='card'>
                <div class='card-body'>
                    <h2 class='card-title'>Signalisation sur un message du forum</h2>
                    <p class='card-text'>
                        <strong>Nom de l'expéditeur:</strong> $name <br>
                        <strong>Email de l'expéditeur:</strong> $email <br>
                        <strong>Message signalé:</strong> $message
                    </p>
                </div>
            </div>
        </body>
        </html>
    ";

    $mail->send();
    header('Location:afficher.php');

} catch (Exception $e) {
    echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
}

?>
