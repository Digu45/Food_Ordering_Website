<?php
session_start();

// Unset the mobile_verified session variable
if (isset($_SESSION['mobile_verified'])) {
    unset($_SESSION['mobile_verified']);
}

// Return a JSON response
echo json_encode(['result' => 'success']);
?>
