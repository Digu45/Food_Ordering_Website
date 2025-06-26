<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['itemGroupId'])) {
        // Store the ItemGroupId in session
        $_SESSION['itemGroupId'] = $_POST['itemGroupId'];
        echo 'ItemGroupId stored successfully'; // Optional response
    } else {
        echo 'No ItemGroupId received';
    }
} else {
    echo 'Invalid request method';
}
?>
