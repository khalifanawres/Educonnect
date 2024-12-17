<?php
include_once('../../Controller/ReclamationController.php');

// Vérification si l'ID est passé en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id']; // Récupérer l'ID depuis le formulaire POST

    // Initialiser le contrôleur et appeler la méthode de suppression
    $controller = new ReclamationController();
    $controller->deleteReclamation($id); // Supprimer la réclamation avec l'ID donné

    // Rediriger vers la page des réclamations après suppression
    header('Location: ../FrontOffice/historique.php');
    exit(); // Assurez-vous d'appeler exit() après header pour éviter toute exécution de code supplémentaire
} else {
    // Si l'ID n'est pas passé, afficher un message d'erreur
    echo "Aucun ID trouvé dans la requête POST.";
    exit();
}
?>
