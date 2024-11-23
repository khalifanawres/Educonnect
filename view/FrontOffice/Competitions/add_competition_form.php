<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']); 
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
            
            <?php if (!empty($errors)): ?>
                <div class="error-messages">
                    <?php foreach ($errors as $error): ?>
                        <p style="color: red;"><?= htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="../../BackOffice/Competitions/add_competition.php">
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
