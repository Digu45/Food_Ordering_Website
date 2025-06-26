<?php
// API endpoint
$apiUrl = 'http://52.66.71.147/XpressPP_Running/get_other_items.php';

// Input data
$inputData = [
    [
        "Parameter" => "QUxnWDFSNWVscHdJYTJXZzBjTmFyZz09",
        "UserName" => "hotelorder@6262",
        "Password" => "hotelorder@4474"
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
    echo 'No data found.';
    exit;
}

// Count occurrences of each MenuSubCategoryName
$countMap = [];
foreach ($data['result'] as $item) {
    $subcategory = $item['MenuSubCategoryName'];
    if (!isset($countMap[$subcategory])) {
        $countMap[$subcategory] = 0;
    }
    $countMap[$subcategory]++;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Subcategories Count</title>
    <style>
        .subcategory-count-container {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px;
            border: 1px solid #ddd;
        }
        .subcategory-item {
            display: inline-block;
            margin: 0 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        .subcategory-item:nth-child(odd) {
            background-color: #e9e9e9;
        }
        .subcategory-item a {
            text-decoration: none;
            color: #333;
        }
        .subcategory-item a:hover {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="subcategory-count-container">
        <?php foreach ($countMap as $subcategory => $count): ?>
            <div class="subcategory-item">
                <a href="items.php?category=<?php echo urlencode($subcategory); ?>">
                    <?php echo htmlspecialchars($subcategory); ?>: <?php echo $count; ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
