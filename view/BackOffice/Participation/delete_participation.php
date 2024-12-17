<?php
require_once(__DIR__ . '/../../../controller/ParticipationController.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $participationController = new ParticipationController();

    try {
        $participationController->deleteParticipation($id);
        header("Location: List_Participation.php?success=deleted"); // Redirection après suppression
        exit;
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    header("Location: List_Participation.php?error=invalid_id");
    exit;
}
?>
