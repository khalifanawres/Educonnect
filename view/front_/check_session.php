<?php
session_start();

if (isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'logged_in',
        'role' => $_SESSION['role']
    ]);
} else {
    echo json_encode(['status' => 'logged_out']);
}
?>
