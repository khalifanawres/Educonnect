<?php
include_once('../../controller/ReclamationController.php');
include_once('../../model/Reclamation.php'); // Inclure la classe Reclamation

// Vérifier que l'ID de la réclamation est passé dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Sécurisation de l'ID
    $reclamationController = new ReclamationController();

    // Récupérer les données de la réclamation à modifier
    $reclamationData = $reclamationController->getReclamationById($id);

    // Si la réclamation n'existe pas
    if (!$reclamationData) {
        die("<p style='color: red;'>Réclamation introuvable !</p>");
    }
} else {
    // Rediriger si l'ID n'est pas valide
    header("Location: tableau_reclamations.php?error=invalid_id");
    exit;
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);  // Nouveau champ pour le téléphone
    $sujet = trim($_POST['sujet']);
    $message = trim($_POST['message']);

    // Validation côté serveur
    $erreurs = [];

    if (empty($nom)) {
        $erreurs[] = "Le champ 'Nom' est obligatoire.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse e-mail n'est pas valide.";
    }

    if (empty($telephone)) {
        $erreurs[] = "Le champ 'Téléphone' est obligatoire.";
    } elseif (!preg_match("/^\+?[1-9]\d{1,14}$/", $telephone)) {
        $erreurs[] = "Le numéro de téléphone n'est pas valide. Exemple : +21612345678.";
    }

    if (empty($sujet)) {
        $erreurs[] = "Le champ 'Sujet' est obligatoire.";
    }

    if (empty($message)) {
        $erreurs[] = "Le champ 'Message' est obligatoire.";
    }

    // Afficher les erreurs si elles existent
    if (!empty($erreurs)) {
        foreach ($erreurs as $erreur) {
            echo "<p style='color: red;'>$erreur</p>";
        }
    } else {
        // Si tout est valide, mettre à jour la réclamation
        $reclamation = new Reclamation($nom, $email, $telephone, $sujet, $message, $id);
        $reclamationController->updateReclamation($reclamation);

        // Afficher un message de succès et rediriger
        header('Location: ../FrontOffice/historique.php');
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Réclamation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h2>Modifier Réclamation</h2>
    <form method="POST">
        <!-- Champ caché contenant l'ID -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($id); ?>">

        <!-- Champs préremplis -->
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($reclamationData['nom']); ?>" required>

        <label>Email :</label>
        <input type="email" name="email" value="<?= htmlspecialchars($reclamationData['email']); ?>" required>

        <label>Téléphone :</label>
        <input type="text" name="telephone" value="<?= htmlspecialchars($reclamationData['telephone']); ?>" required>

        <label>Sujet :</label>
        <input type="text" name="sujet" value="<?= htmlspecialchars($reclamationData['sujet']); ?>" required>

        <label>Message :</label>
        <textarea name="message" required><?= htmlspecialchars($reclamationData['message']); ?></textarea>

        <!-- Boutons -->
        <button type="submit">Enregistrer les modifications</button>
    </form>
</body>
</html>