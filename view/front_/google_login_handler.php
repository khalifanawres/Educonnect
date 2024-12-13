<?php
include '../../controller/UserController.php';
require 'path/to/vendor/autoload.php'; // Inclure la bibliothèque Google API Client

use Google\Client;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents('php://input'), true);
    $token = $data['token'];

    // Configurer le client Google
    $client = new Client();
    $client->setClientId('683896753133-t1u8r32o6tep42a6pkujund3j1ramn5i.apps.googleusercontent.com');
    $client->setClientSecret('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');

    try {
        $payload = $client->verifyIdToken($token);

        if ($payload) {
            $email = $payload['email'];
            $name = $payload['name'];

            $userController = new UserController();
            $user = $userController->getUserByEmail($email);

            session_start();
            if ($user) {
                // Utilisateur existant
                $_SESSION['user'] = $user;

                echo json_encode([
                    'status' => 'success',
                    'role' => $user['role']
                ]);
            } else {
                // Nouvel utilisateur
                $_SESSION['temp_user'] = [
                    'name' => $name,
                    'email' => $email
                ];

                echo json_encode([
                    'status' => 'new_user',
                    'message' => 'Choisissez un rôle.'
                ]);
            }
        } else {
            throw new Exception('Jeton ID invalide.');
        }
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Échec de l\'authentification : ' . $e->getMessage()
        ]);
    }
}
?>
