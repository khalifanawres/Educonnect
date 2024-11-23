<?php
include_once('../../../controller/CompetitionController.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $competitionController = new CompetitionController();

    $competitionController->deleteCompetition($id);

    header("Location: ../../FrontOffice/Competitions/list_competitions_form.php"); 
    exit;
} else {
    header("Location: ../../FrontOffice/Competitions/list_competitions_form.php");
    exit;
}
?>
