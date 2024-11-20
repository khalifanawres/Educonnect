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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $sujet = trim($_POST['sujet']);
    $description = trim($_POST['description']);

    // Validation côté serveur
    $erreurs = [];

    if (empty($nom)) {
        $erreurs[] = "Le champ 'Nom' est obligatoire.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse e-mail n'est pas valide.";
    }

    if (empty($sujet)) {
        $erreurs[] = "Le champ 'Sujet' est obligatoire.";
    }

    if (empty($description)) {
        $erreurs[] = "Le champ 'Description' est obligatoire.";
    }

    // Si des erreurs existent, les afficher
    if (!empty($erreurs)) {
        foreach ($erreurs as $erreur) {
            echo "<p style='color: red;'>$erreur</p>";
        }
        exit;
    }

    // Si tout est valide, créer une instance du modèle Reclamation
    $reclamation = new Reclamation($nom, $email, $sujet, $description, $id);  // Passer l'ID ici

    // Créer une instance du contrôleur
    $reclamationController->updateReclamation($reclamation);

    // Afficher le message de succès
    echo "<p style='color: green;'>Votre réclamation a été mise à jour avec succès.</p>";
}
?>



