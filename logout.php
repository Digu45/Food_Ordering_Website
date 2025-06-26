<?php
session_start();

if (isset($_SESSION['mobile_verified'])) {
    unset($_SESSION['mobile_verified']);
}

if (isset($_SESSION['mobile_for_history'])) {
    unset($_SESSION['mobile_for_history']);
}

if(isset($_SESSION['mobile'])){
    unset($_SESSION['mobile']);
}

if(isset($_SESSION['name'])){
    unset($_SESSION['name']);
}


header("Location: home.php");
exit();
?>
