<?php

include("constant.php");
if($project_mode == "localhost"){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "restaurant_db";
}
else{
    $servername = "localhost"; // Update with your server name
$username = "rnsoftwa_newcord"; // Update with your database username
$password = "MnEct7lK[yTv"; // Update with your database password
$dbname = "rnsoftwa_newcustord_db";
}


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
  // echo "database connected ";
}
//mysqli_close($conn);
?>