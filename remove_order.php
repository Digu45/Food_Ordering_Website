<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();


// Database connection
include("connection.php");
$mobile = $_SESSION['mobile'];

if (isset($_SESSION['unique_device_id'])) {
    $device_id = $_SESSION['unique_device_id'];
}


// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

$menuID = mysqli_real_escape_string($conn, $data['MenuID']);
$menuName = mysqli_real_escape_string($conn, $data['MenuName']);
$description = mysqli_real_escape_string($conn, $data['Description']);
$rate = mysqli_real_escape_string($conn, $data['Rate']);
$quantity = mysqli_real_escape_string($conn, $data['Quantity']);
$amount = mysqli_real_escape_string($conn, $data['Amount']);
$menuTypeId = mysqli_real_escape_string($conn, $data['MenuTypeID']);

// First delete the existing record with the given MenuID
$sql_delete = "DELETE FROM menu_items WHERE MenuID = '$menuID' AND DeviceID='$device_id'";

if (mysqli_query($conn, $sql_delete)) {

        echo json_encode(['success' => true, 'message' => 'Record updated successfully']);
    } 
 else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}

// Close connection
mysqli_close($conn);
?>
