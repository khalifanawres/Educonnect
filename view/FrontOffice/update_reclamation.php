<?php
include_once('../../controller/ReclamationController.php');
include_once('../../model/Reclamation.php');  // Inclure la classe Reclamation

// Vérifier si l'ID est fourni dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les données de la réclamation à modifier
    $reclamationController = new ReclamationController();
    $reclamationData = $reclamationController->getReclamationById($id);
} else {
    echo "<p style='color: red;'>ID de réclamation non valide.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_reclamation'])) {
    // Récupération des données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];
    $statut = isset($_POST['statut']) ? $_POST['statut'] : 'en cours'; // Définir un statut par défaut

    // Validation côté serveur
    $erreurs = [];
    if (empty($nom)) {
        $erreurs[] = "Le champ 'Nom' est obligatoire.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse e-mail n'est pas valide.";
    }

    if (empty($telephone) || !preg_match('/^\+?[0-9]{10,15}$/', $telephone)) {
        $erreurs[] = "Le numéro de téléphone n'est pas valide.";
    }

    if (empty($sujet)) {
        $erreurs[] = "Le champ 'Sujet' est obligatoire.";
    }

    if (empty($message)) {
        $erreurs[] = "Le champ 'Message' est obligatoire.";
    }

    // Si des erreurs existent, les afficher sous forme de liste
    if (!empty($erreurs)) {
        echo "<ul style='color: red;'>";
        foreach ($erreurs as $erreur) {
            echo "<li>$erreur</li>";
        }
        echo "</ul>";
        exit;
    }

    // Si tout est valide, créer une instance du modèle Reclamation
    $reclamation = new Reclamation($nom, $email, $telephone, $sujet, $message, $statut, $id);  // Passer l'ID ici

    // Créer une instance du contrôleur
    $reclamationController->updateReclamation($reclamation);

    // Afficher le message de succès et rediriger
    echo "<p style='color: green;'>Votre réclamation a été mise à jour avec succès.</p>";

    // Rediriger vers l'historique des réclamations
    header('Location: ../FrontOffice/historique.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Réclamation</title>
</head>
<body>

<h2>Modifier votre réclamation</h2>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($reclamationData['id']); ?>">
    
    <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($reclamationData['nom']); ?>" required>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($reclamationData['email']); ?>" required>
    </div>

    <div>
        <label for="telephone">Téléphone</label>
        <input type="text" name="telephone" id="telephone" value="<?php echo htmlspecialchars($reclamationData['telephone']); ?>" required>
    </div>

    <div>
        <label for="sujet">Sujet</label>
        <input type="text" name="sujet" id="sujet" value="<?php echo htmlspecialchars($reclamationData['sujet']); ?>" required>
    </div>

    <div>
        <label for="message">Message</label>
        <textarea name="message" id="message" required><?php echo htmlspecialchars($reclamationData['message']); ?></textarea>
    </div>

    <div>
        <label for="statut">Statut</label>
        <select name="statut" id="statut">
            <option value="en cours" <?php echo ($reclamationData['statut'] == 'en cours') ? 'selected' : ''; ?>>En cours</option>
            <option value="résolu" <?php echo ($reclamationData['statut'] == 'résolu') ? 'selected' : ''; ?>>Résolu</option>
        </select>
    </div>

    <button type="submit" name="edit_reclamation">Mettre à jour</button>
</form>

</body>
</html>
