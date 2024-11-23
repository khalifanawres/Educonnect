<?php 
include_once('../../BackOffice/Competitions/update_competition.php'); 
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
