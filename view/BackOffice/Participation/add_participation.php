<?php
// Inclure les fichiers nécessaires avec les bons chemins relatifs
require_once(__DIR__ . '/../../../Model/Participation.php');
require_once(__DIR__ . '/../../../controller/ParticipationController.php');

session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour participer.");
}

// Vérifiez si un ID de compétition est fourni
if (!isset($_GET['id_competition'])) {
    die("Aucune compétition spécifiée.");
}

$user_id = $_SESSION['user_id']; 
$competition_id = intval($_GET['id_competition']);

// Créer une nouvelle participation
$participation = new Participation($user_id, $competition_id);
$participationController = new ParticipationController();

try {
    $participationController->addParticipation($participation);

    // Redirection vers la liste des compétitions avec un message de succès
    header("Location: ../../FrontOffice/Competitions/list_competitions_form.php?success=1");
    exit;
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
