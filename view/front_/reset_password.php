<?php
include '../../controller/UserController.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $userController = new UserController();

    // Vérifier si le token est valide
    $user = $userController->getUserByToken($token);

    if ($user) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = $_POST['new_password'];
            $repeatPassword = $_POST['repeat_password'];

            if ($newPassword === $repeatPassword) {
                $userController->updateUserPassword($user['id'], null, $newPassword);
                $userController->clearResetToken($user['id']); // Supprimer le token
                echo "Votre mot de passe a été réinitialisé avec succès.";
            } else {
                echo "Les mots de passe ne correspondent pas.";
            }
        }
    } else {
        echo "Lien invalide ou expiré.";
    }
}
?>

<form method="POST">
    <label for="new_password">Nouveau mot de passe :</label>
    <input type="password" id="new_password" name="new_password" required>
    <label for="repeat_password">Répéter le mot de passe :</label>
    <input type="password" id="repeat_password" name="repeat_password" required>
    <button type="submit">Réinitialiser le mot de passe</button>
</form>
