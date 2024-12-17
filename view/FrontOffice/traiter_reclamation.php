<?php
// Inclure le contrôleur et le modèle
include_once('../../controller/ReclamationController.php');
include_once('../../model/Reclamation.php');  // Inclure la classe Reclamation

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = trim($_POST['nom']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);
    $sujet = trim($_POST['sujet']);
    $description = trim($_POST['description']);
    $statut = 'Non répondu'; // Définir un statut par défaut ('Non répondu')

    // Validation côté serveur
    $erreurs = [];

    // Validation des autres champs
    if (empty($nom)) {
        $erreurs[] = "Le champ 'Nom' est obligatoire.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse e-mail n'est pas valide.";
    }

    // Validation du téléphone
    if (empty($telephone)) {
        $erreurs[] = "Le champ 'Téléphone' est obligatoire.";
    } elseif (!preg_match("/^\+?[1-9]\d{1,14}$/", $telephone)) {
        $erreurs[] = "Le numéro de téléphone n'est pas valide. Exemple : +21612345678.";
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

    // Si tout est valide, créer une instance du modèle Reclamation avec statut
    $reclamation = new Reclamation($nom, $email, $telephone, $sujet, $description, $statut); // Ajout du statut

    // Créer une instance du contrôleur
    $reclamationController = new ReclamationController();

    // Envoyer l'objet Reclamation au contrôleur pour ajout dans la base de données
    $reclamationController->addReclamation($reclamation);

    // Afficher l'ID après l'insertion ou rediriger vers une autre page
    header('Location: ../FrontOffice/contact administrateur.html');
} else {
    echo "<p style='color: red;'>Méthode non autorisée.</p>";
}
?>