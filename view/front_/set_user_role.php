<?php
include '../../controller/UserController.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    session_start();
    $userController = new UserController();

    // Enregistrer le rôle en fonction de la session temporaire
    if (isset($_SESSION['temp_user'])) {
        $tempUserData = $_SESSION['temp_user'];
        $user = new User(
            null,
            $tempUserData['name'],
            $tempUserData['email'],
            '', // Pas de mot de passe pour les connexions Facebook
            $data['role'] // Rôle choisi par l'utilisateur
        );

        // Ajouter l'utilisateur à la base de données
        $userController->addUser($user);

        // Enregistrement de l'utilisateur en session
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user'] = $user;
        unset($_SESSION['temp_user']); // Retirer les données temporaires après l'enregistrement
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Utilisateur non trouvé']);
    }
}
?>
