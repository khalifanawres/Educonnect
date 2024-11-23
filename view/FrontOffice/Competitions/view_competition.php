<?php
// Include necessary files
include_once('../../../controller/CompetitionController.php');
include_once('../../../Model/Competition.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);  
    $competitionController = new CompetitionController();
    $competition = $competitionController->getCompetitionById($id);
} else {
    header("Location: list_competitions.php");  
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Compétition</title>
    <link rel="stylesheet" href="css/view_competition.css">
</head>
<body>
    <div class="container">
        <div class="competition-detail">
            <!-- Competition Title -->
            <h1><?= htmlspecialchars($competition['nom']); ?></h1>

            <!-- Competition Description -->
            <p class="description"><?= nl2br(htmlspecialchars($competition['description'])); ?></p>

            <!-- Competition Duration -->
            <p class="duree"><strong>Durée :</strong> <?= htmlspecialchars($competition['duree']); ?> jours</p>

            <!-- Competition Content -->
            <div class="contenu">
                <strong>Contenu de la compétition :</strong>
                <p><?= nl2br(htmlspecialchars($competition['contenu'])); ?></p>
            </div>

            <!-- Action buttons -->
            <div class="actions">
                <a href="list_competitions.php" class="back-btn">Retour à la liste</a>
            </div>
        </div>
    </div>
</body>
</html>
