<?php 

$idsponsor = $_GET['idsponsor']; // Updated to 'idsponsor'
include_once "../controller/sponsorC.php"; // Updated to 'sponsorC'

$sponsorC = new sponsorC(); // Updated to 'sponsorC'
$sponsorC->deletesponsor($idsponsor); // Updated method to 'deletesponsor'
header('Location:afficherC.php'); // Updated the redirection to the sponsor display page

?>
