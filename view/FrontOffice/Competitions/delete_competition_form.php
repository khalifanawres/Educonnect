<?php
include_once('../../BackOffice/Competitions/delete_competition.php');

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer la Compétition</title>
    <link rel="stylesheet" href="css/delete_competition.css">
</head>
<body>
    <div class="container">
        <h2>Supprimer la Compétition</h2>
        <p>Êtes-vous sûr de vouloir supprimer cette compétition ?</p>
        <form method="POST" action="../../BackOffice/Competitions/delete_competition.php?id=<?php echo $id; ?>">
            <button type="submit" class="delete-btn">Oui, supprimer</button>
            <a href="list_competitions_form.php" class="cancel-btn">Annuler</a>
        </form>
    </div>
</body>
</html>
