<?php
// Include necessary files
include_once('../../../controller/CompetitionController.php');
include_once('../../../Model/Competition.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $duree = trim($_POST['duree']);
    $contenu = trim($_POST['contenu']);

    // Server-side validation
    $erreurs = [];

    // Validation checks
    if (empty($nom)) {
        $erreurs[] = "Le champ 'Nom' est obligatoire.";
    }
    if (empty($description)) {
        $erreurs[] = "Le champ 'Description' est obligatoire.";
    }
    if (empty($duree) || !is_numeric($duree)) {
        $erreurs[] = "Le champ 'Durée' doit être un nombre.";
    }
    if (empty($contenu)) {
        $erreurs[] = "Le champ 'Contenu' est obligatoire.";
    }

    // If there are validation errors, show them
    if (!empty($erreurs)) {
        session_start();
        $_SESSION['errors'] = $erreurs; // Store errors in session
    } else {
        // Create a new competition object
        $competitionController = new CompetitionController();
        $competition = new Competition(null, $nom, $description, (int)$duree, $contenu);

        // Add the competition to the database
        $competitionController->addCompetition($competition);

        // Redirect to list_competitions page
        header('Location: list_competitions.php');
        exit;
    }
}
?>
