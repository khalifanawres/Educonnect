<?php
// Inclure le contrôleur et le modèle
include_once('../../controller/ReclamationController.php');
include_once('../../model/Reclamation.php');  // Inclure la classe Reclamation

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
    $reclamation = new Reclamation($nom, $email, $sujet, $description); // No ID required

    // Créer une instance du contrôleur
    $reclamationController = new ReclamationController();

    // Envoyer l'objet Reclamation au contrôleur pour ajout dans la base de données
    $reclamationController->addReclamation($reclamation);

    // Afficher l'ID après l'insertion
    header('Location: ../FrontOffice/contact administrateur.html');
    echo "<p style='color: green;'>Votre réclamation a été envoyée avec succès. ID: " . $reclamation->getId() . "</p>";
    
} else {
    echo "<p style='color: red;'>Méthode non autorisée.</p>";
 
}
?>
