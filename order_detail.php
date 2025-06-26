<?php
// API endpoint and credentials
$apiUrl = "http://52.66.71.147/XpressPP_Running/get_order_data.php";
$postData = json_encode([
    [
        "username" => "hotelorder@6262",
        "password" => "hotelorder@4474",
        "parameter" => "QUxnWDFSNWVscHdJYTJXZzBjTmFyZz09",
        "order_id" => "799"
    ]
]);

// Initialize cURL to call API
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

// Decode the response
$orderData = json_decode($response, true);

// Check if order details and menu data are available
$orderDetails = $orderData['order_details'][0] ?? null;
$menuItems = $orderData['menu'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cart-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: white;
        }

        .back-button {
            margin-bottom: 10px;
        }

        .place-order-btn {
            width: 100%;
        }

        .checkout-btn {
            float: right;
        }
    </style>
</head>
<body>
    <div class="container cart-container">
        <button class="btn btn-secondary back-button">Back</button>
        <button class="btn btn-primary checkout-btn">Checkout</button>
        <h3>Your Cart</h3>

        <!-- Check if there are any items in the cart -->
        <?php if ($menuItems): ?>
            <!-- Table to display menu items -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Rate</th>
                        <th class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menuItems as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['MenuName']); ?></td>
                        <td class="text-right"><?php echo htmlspecialchars($item['Quantity']); ?></td>
                        <td class="text-right">₹<?php echo number_format($item['Rate'], 2); ?></td>
                        <td class="text-right">₹<?php echo number_format($item['Amount'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>

        <!-- Order summary -->
        <?php if ($orderDetails): ?>
            <table class="table">
                <tbody>
                    <tr>
                        <td>Item Total</td>
                        <td class="text-right">₹<?php echo number_format($orderDetails['Sub_total'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>CGST (2.5%)</td>
                        <td class="text-right">₹<?php echo number_format($orderDetails['Tax_Amount'] / 2, 2); ?></td>
                    </tr>
                    <tr>
                        <td>SGST (2.5%)</td>
                        <td class="text-right">₹<?php echo number_format($orderDetails['Tax_Amount'] / 2, 2); ?></td>
                    </tr>
                    <tr>
                        <td>Round Off</td>
                        <td class="text-right">₹<?php echo number_format($orderDetails['Roundoff'], 2); ?></td>
                    </tr>
                    <tr>
                        <td><strong>To Pay</strong></td>
                        <td class="text-right"><strong>₹<?php echo number_format($orderDetails['GrandTotal'], 2); ?></strong></td>
                    </tr>
                </tbody>
            </table>
        <?php endif; ?>

        <button class="btn btn-primary place-order-btn">Place Order</button>
    
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>