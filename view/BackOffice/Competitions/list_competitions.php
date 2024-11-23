<?php
include_once('../../../controller/CompetitionController.php');
include_once('../../../Model/Competition.php');

$competitionController = new CompetitionController();

$competitions = $competitionController->listCompetitions();
?>
