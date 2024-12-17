<?php
require_once '../../controller/UserController.php';

$error = '';
$success = '';

if (isset($_GET['token']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_GET['token'];
    $new_password = $_POST['new_password'];
    $userController = new UserController();

    if ($userController->verifyToken($token)) {
        $userController->updatePassword($token, $new_password);
        echo '<script>alert("Password has been reset successfully!"); window.location.href = "login.php";</script>';
    } else {
        echo '<script>alert("Invalid or expired token.");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <form action="" method="POST">
        <h2>Reset Password</h2>
        <?php if ($error): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color: green;"><?= $success ?></p>
        <?php endif; ?>
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" id="new_password" >
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
