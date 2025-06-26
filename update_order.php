<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();


// Database connection
$servername = "localhost"; // Update with your server name
$username = "rnsoftwa_newcord"; // Update with your database username
$password = "MnEct7lK[yTv"; // Update with your database password
$dbname = "rnsoftwa_newcustord_db";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$mobile = $_SESSION['mobile'];

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

$menuId = mysqli_real_escape_string($conn, $data['MenuId']);
$menuName = mysqli_real_escape_string($conn, $data['MenuName']);
$description = mysqli_real_escape_string($conn, $data['Description']);
$rate = mysqli_real_escape_string($conn, $data['Rate']);
$quantity = mysqli_real_escape_string($conn, $data['Quantity']);
$amount = mysqli_real_escape_string($conn, $data['Amount']);
$menuTypeId = mysqli_real_escape_string($conn, $data['MenuTypeID']);

// First delete the existing record with the given MenuID
$sql_delete = "DELETE FROM menu_items WHERE MenuID = '$menuId' AND MobileNo='$mobile'";

if (mysqli_query($conn, $sql_delete)) {
    // After deleting, insert the new record
    $sql = "INSERT INTO menu_items (MenuID,MenuName, Description, Rate, Quantity, Amount, MenuTypeID, MobileNo)
    VALUES ('$menuId','$menuName', '$description', '$rate', '$quantity', '$amount', '$menuTypeID','$mobile')";

    // echo $sql_insert;

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Record updated successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
}

// Close connection
mysqli_close($conn);
?>
