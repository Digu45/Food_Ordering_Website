<?php
// API endpoint
$apiUrl = 'http://52.66.71.147/XpressPP_Running/get_item_group_cust_ord.php';

// Input data
$inputData = [
    [
        "UserName" => "hotelorder@6262",
        "Password" => "hotelorder@4474",
        "Parameter" => "QUxnWDFSNWVscHdJYTJXZzBjTmFyZz09"
    ]
];

// Initialize cURL
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($inputData));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

// Execute cURL request
$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    exit;
}
curl_close($ch);

// Decode the JSON response
$data = json_decode($response, true);

// Check if the 'result' key exists
if (!isset($data['result'])) {
    $data['result'] = []; // No data found
}

// Generate dropdown options
$options = '';
foreach ($data['result'] as $item) {
    $options .= '<option value="' . htmlspecialchars($item['ItemGroupId']) . '">' . htmlspecialchars($item['ItemGroupName']) . '</option>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Dropdown</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Select Item Group
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php echo $options; ?>
            </ul>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
