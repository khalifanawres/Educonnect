<?php
include '../../controller/UserController.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['nom'];
    $email = $_POST['email'];
    $dob = $_POST['dob'] ?? null;
    $tel = $_POST['tel'] ?? null;
    $photo = null;

    // Gestion de l'upload de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../../uploads/';
        $fileName = uniqid() . '-' . basename($_FILES['photo']['name']);
        $filePath = $uploadDir . $fileName;
    
        // Journalisation pour vérifier
        error_log("Upload en cours : " . $filePath);
    
        // Vérification du type de fichier
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['photo']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $filePath)) {
                $photo = 'uploads/' . $fileName;
                error_log("Photo téléchargée avec succès : " . $photo);
            } else {
                error_log("Erreur lors du déplacement du fichier.");
            }
        } else {
            error_log("Format de fichier non autorisé : " . $_FILES['photo']['type']);
        }
    } else {
        error_log("Aucun fichier téléchargé ou erreur d'upload.");
    }
    

    // Mettre à jour l'utilisateur
    $userController = new UserController();
    $result = $userController->updateUserProfile($id, $name, $email, $dob, $tel, $photo);

    if ($result) {
        $_SESSION['success'] = "Profil mis à jour avec succès.";
        header("Location: profile.php");
    } else {
        $_SESSION['error'] = "Erreur lors de la mise à jour du profil.";
        header("Location: profile.php");
    }
    exit();
}
?>
