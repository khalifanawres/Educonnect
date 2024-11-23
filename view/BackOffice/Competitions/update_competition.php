<?php
include_once('../../../controller/CompetitionController.php');
include_once('../../../Model/Competition.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $competitionController = new CompetitionController();

    $competitionData = $competitionController->getCompetitionById($id);

    if (!$competitionData) {
        die("Competition not found!");
    }
} else {
    header("Location: ../../FrontOffice/Competitions/list_competitions_form.php");
    exit;
}

// Handle form submission (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $duree = trim($_POST['duree']);
    $contenu = trim($_POST['contenu']);

    // Server-side validation
    $errors = [];

    if (empty($nom)) {
        $errors[] = "Nom is required.";
    }
    if (empty($description)) {
        $errors[] = "Description is required.";
    }
    if (empty($duree) || !is_numeric($duree)) {
        $errors[] = "Duration must be a number.";
    }
    if (empty($contenu)) {
        $errors[] = "Content is required.";
    }

    if (empty($errors)) {
        $competition = new Competition($id, $nom, $description, $duree, $contenu); 
        $competitionController->updateCompetition($competition); 
        header("Location: ../../FrontOffice/Competitions/list_competitions_form.php");
        exit;
    }
}
?>