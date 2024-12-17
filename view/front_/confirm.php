<?php
include '../../controller/UserController.php';

if (isset($_GET['email']) && !empty($_GET['email'])) {
    $email = $_GET['email'];
    $db = config::getConnexion();

    $sql = "UPDATE user SET status = 'confirmed' WHERE email = :email";
    $query = $db->prepare($sql);
    $query->execute(['email' => $email]);

    echo "Votre compte a été confirmé avec succès !";
} else {
    echo "Lien de confirmation invalide.";
}
?>