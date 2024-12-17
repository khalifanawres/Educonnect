<?php 

$id = $_GET['id'];
include_once "../controller/forumC.php";

$forumC= new forumC();
$forumC->deleteforum($id); 
header('Location:dashboard.php');




?>