<?php
session_start(); // Start the session

// Check if order_id is provided in the GET request
if (isset($_GET['order_id'])) {
    // Store the OrderId in the session
    $_SESSION['OrderId'] = $_GET['order_id'];
}

// Redirect to the order summary page
header('Location: order_summary.php');
exit();