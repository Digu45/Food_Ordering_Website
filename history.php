<?php

session_start();
// session_destroy();

if (isset($_SESSION['parameter'])) {
    $parameter = $_SESSION['parameter'];
}
$parameter = $_SESSION['parameter'];

if (isset($_SESSION['mobile_for_history'])) {
    $mobile = $_SESSION['mobile_for_history'];
}
$mobile = $_SESSION['mobile_for_history'];

if (isset($_GET['order_id'])) {
    $_SESSION['OrderId'] = $_GET['order_id']; // Store the OrderId in the session
}


// echo $mobile;

// API URL
$url = "http://52.66.71.147/XpressPP_Running/get_orders_for_customer.php";

// print_r($_SESSION);

// Data to be sent to the API
$data = [
    [
        "username" => "hotelorder@6262",
        "password" => "hotelorder@4474",
        "parameter" => $parameter,
        "mobile_no" => $mobile,
    ]
];
// print_r($data);

// Initialize cURL session
$ch = curl_init($url);

// Set the cURL options
curl_setopt($ch, CURLOPT_POST, true); // Set the request method to POST
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Attach the data as JSON
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response instead of outputting it
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']); // Set the content type to JSON

// Execute the cURL request and get the response
$response = curl_exec($ch);

// print_r($response);

// Check if any error occurred
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Convert JSON response to PHP array
    $orders = json_decode($response, true);
}

// Close the cURL session
curl_close($ch);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History UI</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <style>
        /* Main history item container */
        body {
            font-size: 15px;
            font-family: 'ABeeZee', monospace;
        }


        .history-item {
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 15px;
            padding: 10px;
            background-color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row;
            /* Keep row direction */
        }

        /* Image for restaurant or order */
        .history-item img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            margin-right: 10px;
        }

        /* Restaurant name */
        .restaurant-name {
            font-weight: bold;
            font-size: 15px;
        }

        /* Order details */
        .item-list {
            font-size: 0.8rem;
            color: #000;
            font-weight: bold;
        }

        /* Order date and time */
        .order-time {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 5px;
        }

        /* Price styling */
        .price {
            font-size: 1rem;
            font-weight: bold;
            color: #000;
            margin-top: 5px;
        }

        /* Status buttons */
        .status-delivered,
        .status-rejected,
        .status-payment-failed {
            font-size: 0.75rem;
            padding: 3px 10px;
            border-radius: 5px;
            text-align: center;
        }

        /* Delivered status */
        .status-delivered {
            background-color: #ffffff;
            color: #1d7823;
        }

        /* Rejected status */
        .status-rejected {
            background-color: #ffffff;
            color: red;
        }

        /* Payment failed status */
        .status-payment-failed {
            color: #dc3545;
            font-weight: bold;
        }

        .status-not-confirmed {
            color: #b3ae32;
            font-weight: bold;
        }

        /* View menu link */
        .view-menu {
            color: #dc3545;
            font-size: 0.75rem;
            text-decoration: underline;
        }

        /* Mobile responsive design */
        @media (max-width: 768px) {
            .history-item {
                padding: 8px;
                margin-bottom: 12px;
                flex-direction: row;
                /* Keep row layout */
            }

            .history-item img {
                width: 45px;
                /* Adjust image size */
                height: 45px;
            }

            .restaurant-name {
                font-size: 1rem;
                /* Increase restaurant name font size for mobile view */
            }

            .item-list,
            .order-time {
                font-size: 0.75rem;
                /* Adjust font size for smaller screens */
            }

            .price {
                font-size: 0.9rem;
                /* Adjust price font size */
            }

            .status-delivered,
            .status-rejected,
            .status-payment-failed {
                font-size: 0.7rem;
                /* Adjust status font size */
                padding: 2px 8px;
                /* Slightly smaller padding */
            }

            .view-menu {
                font-size: 0.7rem;
            }
        }

        /* Extra Small Devices (max-width: 576px) */
        @media (max-width: 576px) {
            .history-item {
                padding: 6px;
                margin-bottom: 10px;
            }

            .history-item img {
                width: 40px;
                /* Further reduce image size */
                height: 40px;
            }

            .restaurant-name {
                font-size: 1.1rem;
                /* Further increase font size on small devices */
            }

            .item-list,
            .order-time {
                font-size: 0.7rem;
                /* Smaller text for small devices */
            }

            .price {
                font-size: 0.85rem;
                /* Smaller price text */
            }

            .status-delivered,
            .status-rejected,
            .status-payment-failed,
            status-not-confirmed {
                font-size: 0.65rem;
                /* Adjust status font size */
                padding: 2px 6px;
                /* Smaller padding */
            }

            .view-menu {
                font-size: 0.65rem;
            }
        }

        /* For very small mobile screens (max-width: 360px) */
        @media (max-width: 360px) {
            .history-item {
                padding: 5px;
                /* Reduce padding */
            }

            .history-item img {
                width: 35px;
                height: 35px;
                /* Adjust image size further */
            }

            .restaurant-name {
                font-size: 0.85rem;
                /* Slightly increase font size for very small devices */
            }

            .item-list,
            .order-time,
            .price {
                font-size: 0.65rem;
                /* Even smaller text for very small devices */
            }
        }

        .container {
            overflow-x: hidden;
            /* Prevent horizontal scrolling */
            width: 100%;
            /* Ensure it uses the full width of the viewport */
            max-width: 100%;
            /* Ensure it does not exceed the viewport */
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-between " style="margin: 8px;">
        <a href="home.php" class="btn btn-primary" id="back">Back</a>
        <a href="verify_mobile.php" class="btn btn-primary" id="back">Verify Mobile</a>
    </div>
    <center>
        <h3 style="margin-top: 10px;">
            <pre>Order History</pre>
        </h3>
    </center>
    <div class="container mt-4">
        <?php
        if (isset($orders['result'])) {
            foreach ($orders['result'] as $order) {
                // Determine order status styling
                $statusClass = '';
                $statusText = '';

                if ($order['OrderStatus'] == 'Order Confirmed') {
                    $statusClass = 'status-delivered';
                    $statusText = 'Order Confirmed';
                } elseif ($order['OrderStatus'] == 'Rejected') {
                    $statusClass = 'status-rejected';
                    $statusText = 'Rejected';
                } elseif ($order['OrderStatus'] == 'Payment Failed') {
                    $statusClass = 'status-payment-failed';
                    $statusText = 'Payment Failed';
                } elseif ($order['OrderStatus'] == 'Pending for Confirmation') {
                    $statusClass = 'status-not-confirmed';
                    $statusText = 'Not Confirmed';
                }

                echo '
        <div class="history-item row align-items-center">
           
            <div class="col-8">
                <div class="restaurant-name" style="opacity:0;">Order Id: ' . $order['OrderId'] . '</div>
                <div class="restaurant-name">Order No: ' . $order['OrderIdNo'] . '</div>
                <div class="item-list">' . $order['menus'] . '</div>
                <div class="order-time">' . $order['OrderDateTime'] . '</div>
            </div>

            <div class="col-4 text-center" style="font-size: 10px; white-space: nowrap;">
                 <div style="margin-bottom: 5px; margin-left:13px;">
                    <span class="' . $statusClass . '" style="margin-left:-3px;">' . $statusText . '</span>
                 </div>
        
               <div style="margin-bottom: 5px;">
                  <a href="store_order_id.php?order_id=' . $order['OrderId'] . '">
                     <span class="btn btn-outline-danger btn-sm" style="font-size:9px; margin-left:14px;">View menu</span>
                  </a>
               </div>

               <div>
                 <span class="price" style="margin-left: 23px;">₹' . $order['Amount'] . '</span>
               </div>

            </div>

        </div>

        ';
            }
        } else {
            echo '<p>No orders found.</p>';
        }
        // print_r($_SESSION);
        ?>

    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>