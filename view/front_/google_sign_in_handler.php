<?php
require 'path/to/google-api/vendor/autoload.php'; // Inclure les bibliothèques Google

use Google\Client;

$response = ['status' => 'error', 'message' => 'Something went wrong'];

try {
    $client = new Client();
    $client->setClientId('683896753133-irr48t3kldu1on8hiurrl2ork2kij2r3.apps.googleusercontent.com'); // Votre Client ID Google

    // Vérifier le token JWT reçu depuis Google
    $payload = $client->verifyIdToken(json_decode(file_get_contents('php://input'), true)['credential']);

    if ($payload) {
        $email = $payload['email'];
        $name = $payload['name'];

        // Vérifier si l'utilisateur existe dans la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=projet', 'root', '');
        $stmt = $pdo->prepare("SELECT role FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Utilisateur existant
            $response = [
                'status' => 'success',
                'role' => $user['role']
            ];
        } else {
            // Nouvel utilisateur
            $stmt = $pdo->prepare("INSERT INTO users (email, name) VALUES (?, ?)");
            $stmt->execute([$email, $name]);

            $response = [
                'status' => 'new_user'
            ];
        }
    } else {
        $response['message'] = 'Invalid token';
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Retourner une réponse JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
