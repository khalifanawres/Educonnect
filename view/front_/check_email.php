<?php
include '../../controller/UserController.php';

header('Content-Type: application/json');

$response = ['exists' => false];

if (isset($_POST['email'])) {
    $UserController = new UserController();
    $email = $_POST['email'];

    $response['exists'] = $UserController->doesEmailExist($email);
}

echo json_encode($response);
?>
