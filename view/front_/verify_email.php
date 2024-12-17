<?php
include '../../controller/UserController.php';

if (isset($_GET['code'])) {
    $verificationCode = $_GET['code'];

    $UserController = new UserController();
    $db = config::getConnexion();
    $sql = "SELECT * FROM user WHERE verification_code = :code";
    $query = $db->prepare($sql);
    $query->execute(['code' => $verificationCode]);

    if ($query->rowCount() > 0) {
        // Mettre à jour l'état de vérification
        $sql = "UPDATE user SET is_verified = 1, verification_code = NULL WHERE verification_code = :code";
        $query = $db->prepare($sql);
        $query->execute(['code' => $verificationCode]);
        echo "Your email has been verified successfully.";
    } else {
        echo "Invalid verification code.";
    }
} else {
    echo "No verification code provided.";
}
?>
