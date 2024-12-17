<?php
session_start(); // Démarrage de la session

// Ajout de données utilisateur dans la session pour tester
$_SESSION['user_id'] = 1; // ID fictif de l'utilisateur
$_SESSION['user_name'] = "TestUser"; // Nom fictif de l'utilisateur

echo "Session définie avec succès pour l'utilisateur ID : " . $_SESSION['user_id'];
?>
