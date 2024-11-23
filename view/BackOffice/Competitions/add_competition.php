<?php
// Include necessary files
include_once('../../../controller/CompetitionController.php');
include_once('../../../Model/Competition.php');

// If the form is submitted (method POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the form inputs
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
        foreach ($erreurs as $erreur) {
            echo "<p style='color: red;'>$erreur</p>";
        }
    } else {
        $competitionController = new CompetitionController();
        
        $competition = new Competition(null, $nom, $description, (int)$duree, $contenu);

        // Add the competition to the database
        $competitionController->addCompetition($competition);

        header('Location: list_competitions.php');  // Change this to the actual page you want to redirect to
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Competition</title>
    <link rel="stylesheet" href="css/add_competition.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Ajouter une Competition</h2>
            <form method="POST">
                <!-- Nom -->
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="" required>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea id="description" name="description" required></textarea>
                </div>

                <!-- Durée -->
                <div class="form-group">
                    <label for="duree">Durée (en jours) :</label>
                    <input type="number" id="duree" name="duree" value="" required>
                </div>

                <!-- Contenu -->
                <div class="form-group">
                    <label for="contenu">Contenu :</label>
                    <textarea id="contenu" name="contenu" required></textarea>
                </div>

                <!-- Submit button -->
                <div class="form-group">
                    <button type="submit" class="submit-btn">Ajouter la compétition</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
