<?php
session_start();
include '../../controller/UserController.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Vérifiez si les données POST sont soumises
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données soumises
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $tel = $_POST['tel'] ?? null;

    // Valider les données
    if (empty($name) || empty($email)) {
        $_SESSION['error'] = "Le nom et l'e-mail sont obligatoires.";
        header("Location: profile.php");
        exit();
    }

    // Récupérer l'utilisateur connecté
    $userId = $_SESSION['user']['id'];

    // Instancier le contrôleur utilisateur
    $userController = new UserController();

    // Mettre à jour les données de l'utilisateur
    $isUpdated = $userController->updateUserProfile($userId, $name, $email, $dob, $tel);

    if ($isUpdated) {
        // Mettre à jour les données de session
        $_SESSION['user']['nom'] = $name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['dob'] = $dob;
        $_SESSION['user']['tel'] = $tel;

        $_SESSION['success'] = "Les informations ont été mises à jour avec succès.";
    } else {
        $_SESSION['error'] = "Une erreur est survenue lors de la mise à jour.";
    }

    header("Location: profile.php");
    exit();
}
