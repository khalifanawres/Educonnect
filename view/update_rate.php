<?php 
// Fetch ID and rating from the URL parameters
$id = $_GET['id'];
$ratevalue = $_GET['rating'];

// Include necessary files
include_once "../controller/forumC.php";
include_once "../model/forum.php";

// Create an instance of the forum controller
$forumC= new forumC();

$currentforum = $forumC->findforum($id);

    $newforum = new forum(
        $currentforum['categorie'],
        $currentforum['titre'],
        $currentforum['message'],
        $currentforum['image'],
        $currentforum['date'],
        $ratevalue
    );
    $forumC->updateforum($newforum, $id);

    header('Location: afficher.php');
?>