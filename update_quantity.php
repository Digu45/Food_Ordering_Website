<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menuId = $_POST['menu_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the database
    $sql = "UPDATE menu_items SET Quantity = ? WHERE MenuID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $quantity, $menuId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
}

$conn->close();
?>
