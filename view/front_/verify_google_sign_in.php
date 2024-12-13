<?php
session_start();
include '../../controller/UserController.php';

// Recevoir et décoder le token ID de Google
$data = json_decode(file_get_contents('php://input'), true);
$idToken = $data['idToken'] ?? '';

if ($idToken) {
    $UserController = new UserController();

    // Vérifiez l'utilisateur avec le token Google
    $userInfo = $UserController->verifyGoogleSignIn($idToken);

    if ($userInfo) {
        $_SESSION['user'] = $userInfo;
        echo json_encode(['status' => 'user_exists', 'role' => $userInfo['role']]);
    } else {
        echo json_encode(['status' => 'new_user']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid token']);
}
?>
