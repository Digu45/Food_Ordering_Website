<?php
session_start();

// Debug all session variables
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

if (!isset($_SESSION['mobile'])) {
    die('Session mobile number not set.');
}
$mobile = $_SESSION['mobile'];




$sql_cart_count = "SELECT count(MenuID) FROM `menu_items` WHERE MobileNo = '$mobile'";
        $cursor = mysqli_query($conn,$sql_cart_count);
        // echo $sql_cart_count;
        $row = mysqli_fetch_row($cursor);
        $cart_count = $row[0];

        $_SESSION['count']=$cart_count;

?>