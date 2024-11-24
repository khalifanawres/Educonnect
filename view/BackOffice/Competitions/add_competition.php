<?php
include_once('../../../controller/CompetitionController.php');
include_once('../../../Model/Competition.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $duree = trim($_POST['duree']);
    $contenu = trim($_POST['contenu']);

    $erreurs = [];

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

    if (!empty($erreurs)) {
        session_start();
        $_SESSION['errors'] = $erreurs; 
    } else {
        $competitionController = new CompetitionController();
        $competition = new Competition(null, $nom, $description, (int)$duree, $contenu);

        $competitionController->addCompetition($competition);

        header('Location: ../../FrontOffice/Competitions/list_competitions_form.php');
        exit;
    }
}
?>
