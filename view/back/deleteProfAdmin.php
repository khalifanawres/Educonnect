<?php
include '../../controller/UserController.php';
$userC = new UserController();
$userC->deleteUser($_GET["id"]);
header('Location:tablesProfAdmin.php');
