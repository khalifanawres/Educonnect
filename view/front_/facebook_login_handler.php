<?php
include '../../controller/UserController.php';

$response = [
    'status' => 'error',
    'message' => ''
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $userController = new UserController();
    $user = $userController->getUserByEmail($data['email']);

    if ($user) {
        session_start();
        $_SESSION['user'] = $user;
        echo json_encode(['status' => 'success', 'role' => $user['role'], 'message' => 'Login successful']);
    } else {
        // Utilisateur nouveau, stocker les informations temporairement
        session_start();
        $_SESSION['temp_user'] = $data; // Stocker les infos temporairement
        echo json_encode(['status' => 'new_user', 'message' => 'Choose a role']);
    }
}
?>
