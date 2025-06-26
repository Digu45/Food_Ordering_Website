<?php
session_start();
$mobile= $_SESSION['mobile'];

if (isset($_SESSION['unique_device_id'])) {
    $device_id = $_SESSION['unique_device_id'];

}

if (isset($_SESSION['parameter'])) {
    $parameter = $_SESSION['parameter'];
}

if (isset($_SESSION['table_id'])) {
    $table_id = $_SESSION['table_id'];
}

if(isset($_SESSION['name'])){
    $cust_name = $_SESSION['name'];
}

//  print_r($_SESSION);


// Get the JSON input from the request body
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Check if data was received
// if (!isset($data['item_total']) || !isset($data['cgst_total']) || !isset($data['sgst_total']) || !isset($data['fractional_amount']) || !isset($data['rounded_total'])) {
//     echo json_encode(['error' => 'Missing data']);
//     exit;
// }

// Extract the values
$itemTotal = $data['item_total'];
$cgstTotal = $data['cgst_total'];
$sgstTotal = $data['sgst_total'];
$fractionalAmount = $data['fractional_amount'];
$roundedTotal = $data['rounded_total'];

include("connection.php");
// Query to fetch data from menu_items table
$sql = "SELECT MenuID,MenuName, Description, Rate, Quantity, Amount, MenuTypeID, MobileNo, DeviceID, Instructions FROM menu_items WHERE DeviceID= '$device_id'";
$result = $conn->query($sql);

// print_r($result);

$dataArray = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dataArray[] = [
            "hotel_id" => $parameter, 
            "mobile_no" => $mobile,
            "product_id" => $row['MenuID'], 
            "qty" => $row['Quantity'],
            "rate" => $row['Rate'],
            "discount" => "0", 
            "amount" => $row['Amount'],
            "sub_total" => $itemTotal,  // Use captured values
            "total_discount" => "0", 
            "total_taxable_amt" => $itemTotal, // Use captured values
            "total_tax_amt" => $cgstTotal + $sgstTotal, // Use captured values
            "extra_charges" => "0", 
            "rounded_amt" => $fractionalAmount, // Use captured values
            "grand_amt" => $roundedTotal, // Use captured values
            "delivery_mode" => "",
            "table_id" => $table_id,
            "Instructions" =>$row['Instructions'],
            "customer_name" => $cust_name
        ];
    }
} else {
    echo json_encode(['error' => 'No records found!']);
    exit;
}

// print_r($dataArray);
// Close the database connection
$conn->close();

// URL of the API
$api_url = 'http://52.66.71.147/XpressPP_Running/placeorder_xkot.php';

// Initialize cURL session
$ch = curl_init($api_url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataArray));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen(json_encode($dataArray))
]);

// Execute cURL request and get the response
$response = curl_exec($ch);


// Check for cURL errors
if ($response === false) {
    echo json_encode(['error' => curl_error($ch)]);
} else {
    // Decode the API response
    $responseData = json_decode($response, true);

    // Check if JSON decoding was successful
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['error' => 'JSON decoding error: ' . json_last_error_msg()]);
        exit;
    }

    // Check if 'result' key exists and 'success' is in the first element of the array
    if (isset($responseData['result'][0]['success'])) {
        if ($responseData['result'][0]['success'] == 1) {
            // Success response: Delete all records from menu_items table
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
         
            $sql_delete = "DELETE FROM menu_items where DeviceID = '$device_id'";
            if ($conn->query($sql_delete) === TRUE) {
                echo json_encode(['result' => 'success']);
            } else {
                echo json_encode(['error' => 'Error deleting records: ' . $conn->error]);
            }
            
            $conn->close();
        } else {
            // Failure response
            echo json_encode(['result' => 'failure']);
        }
    } else {
        echo json_encode(['error' => 'An error occurred while confirming the order. No "success" key found in the response.']);
    }
}

// Close cURL session
curl_close($ch);
?>
