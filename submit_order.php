<?php
 session_start();
include("connection.php");
// $mobile = $_SESSION['mobile'];


if (isset($_SESSION['unique_device_id'])) {
    $device_id = $_SESSION['unique_device_id'];
   
}

//  print_r($_SESSION);



// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

$menuId =$conn->real_escape_string($data['MenuId']);
$menuName = $conn->real_escape_string($data['MenuName']);
$description = $conn->real_escape_string($data['Description']);
$rate = $conn->real_escape_string($data['Rate']);
$quantity = $conn->real_escape_string($data['Quantity']);
$amount = $conn->real_escape_string($data['Amount']);
$menuTypeID = $conn->real_escape_string($data['MenuTypeID']);

$sql_delete = "DELETE FROM menu_items WHERE MenuID = '$menuId' AND DeviceID='$device_id'";
mysqli_query($conn,$sql_delete);

// Prepare and execute the SQL statement
$sql = "INSERT INTO menu_items (MenuID,MenuName, Description, Rate, Quantity, Amount, MenuTypeID, MobileNo,DeviceID)
        VALUES ('$menuId','$menuName', '$description', '$rate', '$quantity', '$amount', '$menuTypeID','$mobile','$device_id')";

        // echo $sql;
        if ($conn->query($sql) === TRUE) {

            $sql_cart_count = "SELECT count(MenuID) FROM `menu_items` WHERE DeviceID = '$device_id'";
        $cursor = mysqli_query($conn,$sql_cart_count);
        // echo $sql_cart_count;
        $row = mysqli_fetch_row($cursor);
        $cart_count = $row[0];

        // $_SESSION['count']=$cart_count;
    



            $menuID = $conn->insert_id;
            echo json_encode(['success' => true, 'menuID' => $menuID , 'cart_count'=> $cart_count]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }

        

        // $_SESSION['count']=$cart_count;

         // PHP Code to Get Cart Count
        //  if (isset($_SESSION['count'])) {
        //     echo count($_SESSION['count']); 




// Close connection
$conn->close();
?>
