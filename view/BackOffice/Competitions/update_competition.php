<?php
include_once('../../../controller/CompetitionController.php');
include_once('../../../Model/Competition.php');

// Ensure that the ID is passed in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $competitionController = new CompetitionController();

    // Retrieve competition data by ID
    $competitionData = $competitionController->getCompetitionById($id);

    // If competition is not found
    if (!$competitionData) {
        die("Competition not found!");
    }
} else {
    // Redirect if no ID is found
    header("Location: list_competitions.php");
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

    // If no errors, update the competition
    if (empty($errors)) {
        $competition = new Competition($nom, $description, $duree, $contenu, $id);
        $competitionController->updateCompetition($competition);
        header("Location: list_competitions.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la Compétition</title>
    <link rel="stylesheet" href="css/add_competition.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Modifier la compétition</h2>

            <!-- Display validation errors if there are any -->
            <?php if (!empty($errors)): ?>
                <ul style="color: red;">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <!-- Form to update competition -->
            <form method="POST">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($competitionData['nom']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea id="description" name="description" required><?php echo htmlspecialchars($competitionData['description']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="duree">Durée (en jours) :</label>
                    <input type="number" id="duree" name="duree" value="<?php echo htmlspecialchars($competitionData['duree']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="contenu">Contenu :</label>
                    <textarea id="contenu" name="contenu" required><?php echo htmlspecialchars($competitionData['contenu']); ?></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-btn">Mettre à jour la compétition</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
