<?php
// Check if category is set
if (!isset($_GET['category'])) {
    echo 'Category not specified.';
    exit;
}

$category = urldecode($_GET['category']);

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

// Filter items by category
$filteredItems = array_filter($data['result'], function ($item) use ($category) {
    return $item['MenuSubCategoryName'] === $category;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items in <?php echo htmlspecialchars($category); ?></title>
    <style>
        .item-container {
            padding: 10px;
        }
        .item {
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
        }
        .item img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1>Items in <?php echo htmlspecialchars($category); ?></h1>
    <div class="item-container">
        <?php if (empty($filteredItems)): ?>
            <p>No items found for this category.</p>
        <?php else: ?>
            <?php foreach ($filteredItems as $item): ?>
                <div class="item">
                    <h2><?php echo htmlspecialchars($item['MenuName']); ?></h2>
                    <?php if (!empty($item['MenuImageUrl'])): ?>
                        <img src="<?php echo htmlspecialchars($item['MenuImageUrl']); ?>" alt="<?php echo htmlspecialchars($item['MenuName']); ?>">
                    <?php endif; ?>
                    <p>Rate: <?php echo htmlspecialchars($item['Rate']); ?></p>
                    <p>Discount: <?php echo htmlspecialchars($item['Discount']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
