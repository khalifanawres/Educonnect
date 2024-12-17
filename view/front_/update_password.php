<?php
session_start();
include '../../controller/UserController.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Vérifier si les données POST sont soumises
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données soumises
    $currentPassword = $_POST['current_password'] ?? null;
    $newPassword = $_POST['new_password'] ?? null;
    $repeatPassword = $_POST['repeat_password'] ?? null;

    // Valider les données
    if (empty($currentPassword) || empty($newPassword) || empty($repeatPassword)) {
        $_SESSION['error'] = "Tous les champs sont obligatoires.";
        header("Location: profile.php#account-change-password");
        exit();
    }

    if ($newPassword !== $repeatPassword) {
        $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
        header("Location: profile.php#account-change-password");
        exit();
    }

    // Récupérer l'utilisateur connecté
    $userId = $_SESSION['user']['id'];

    // Instancier le contrôleur utilisateur
    $userController = new UserController();

    // Mettre à jour le mot de passe
    $result = $userController->updateUserPassword($userId, $currentPassword, $newPassword);

    if ($result === true) {
        $_SESSION['success'] = "Le mot de passe a été mis à jour avec succès.";
    } else {
        $_SESSION['error'] = $result;
    }

    header("Location: profile.php#account-change-password");
    exit();
}
?>
