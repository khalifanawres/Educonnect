<?php
include '../../controller/UserController.php';

// Assuming $pdo is your PDO instance
$UserController = new UserController($pdo);

$response = [
    'success' => false,
    'errors' => [],
    'alert' => '' // Ajoutez un champ pour les alertes
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérifiez si l'email est vide ou invalide
    if (empty($email)) {
        $response['errors']['email'] = 'L\'email est obligatoire.';
    } elseif (!$UserController->emailExists($email)) { // Vérifiez si l'email existe
        $response['errors']['email'] = 'Cet email n\'est pas enregistré.';
    }

    // Vérifiez si le mot de passe est vide
    if (empty($password)) {
        $response['errors']['password'] = 'Le mot de passe est obligatoire.';
    } elseif (!isset($response['errors']['email'])) { // Si l'email est valide, vérifiez le mot de passe
        $user = $UserController->authenticateUser($email, $password);

        if (!$user) {
            $response['errors']['password'] = 'Mot de passe incorrect.';
        } elseif (!$user['is_verified']) { // Vérifiez si la seconde vérification a été effectuée
            $response['alert'] = 'Veuillez vérifier votre compte avant de vous connecter.';
        } else {
            $response['success'] = true;

            // Déterminez la redirection en fonction du rôle
            switch ($user['role']) {
                case 'student':
                    $response['redirect'] = 'home.html';
                    break;
                case 'prof':
                    $response['redirect'] = '../back/tables.php';
                    break;
                default:
                    $response['redirect'] = '../back/tablesProfAdmin.php';
                    break;
            }

            // Démarrer une session et stocker les informations de l'utilisateur
            session_start();
            $_SESSION['user'] = $user;
        }
    }

    // Renvoyer une réponse JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
