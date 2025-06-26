<?php
session_start();
include('connection.php');

if (isset($_SESSION['unique_device_id'])) {
    $device_id = $_SESSION['unique_device_id'];
}
// print_r($_SESSION);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menuId = $_POST['menu_id'];
    $instruction = $_POST['instruction'];

    $query = "UPDATE menu_items SET Instructions = '$instruction' WHERE MenuID= '$menuId' And DeviceID = '$device_id'";

   
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    mysqli_close($conn);
}
?>
