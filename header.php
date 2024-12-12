<?php
session_start(); // Démarrage de la session

if (isset($_SESSION['user_id'])) {
    echo "Session active. User ID : " . $_SESSION['user_id'] . ", Nom : " . $_SESSION['user_name'];
} else {
    echo "Aucune session active.";
}
?>
