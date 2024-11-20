<?php
include '../../controller/ReclamationController.php';

// Vérification que l'ID de la réclamation est fourni
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $reclamationController = new ReclamationController();
    $reclamation = $reclamationController->getReclamationById(intval($_GET['id']));

    // Si la réclamation n'est pas trouvée
    if (!$reclamation) {
        header('Location: tableau_reclamations.php?error=not_found');
        exit;
    }
} else {
    header('Location: tableau_reclamations.php?error=missing_id');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Réclamation</title>
</head>
<body>
    <h2>Modifier Réclamation</h2>
    <form action="update_reclamation.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($reclamation['id']); ?>">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($reclamation['nom']); ?>" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($reclamation['email']); ?>" required><br>

        <label for="sujet">Sujet :</label>
        <input type="text" id="sujet" name="sujet" value="<?= htmlspecialchars($reclamation['sujet']); ?>" required><br>

        <label for="message">Message :</label>
        <textarea id="message" name="message" required><?= htmlspecialchars($reclamation['message']); ?></textarea><br>

        <button type="submit">Enregistrer les modifications</button>
        <a href="tableau_reclamations.php">Annuler</a>
    </form>
</body>
</html>


