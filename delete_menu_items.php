<?php
session_start(); // Start the session

// Include your database connection file
include("connection.php");

// Check if the required session variable is set
if (isset($_SESSION['unique_device_id'])) {
    // Retrieve the device ID from the session
    $device_id = $_SESSION['unique_device_id'];

    // Prepare the SQL query to delete menu items associated with the device
    $sql = "DELETE FROM menu_items WHERE DeviceID = '$device_id'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // If the deletion is successful
        echo json_encode(['status' => 'success', 'message' => 'All menu items deleted successfully.']);
    } else {
        // If there was an error executing the query
        echo json_encode(['status' => 'error', 'message' => 'Error deleting menu items: ' . mysqli_error($conn)]);
    }
} else {
    // If required parameters are missing
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}

// Close the database connection
mysqli_close($conn);
?>
