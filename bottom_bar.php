<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .navbar {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #3fb0a8;
            left: 0;
        }

        .navbar-brand {
            padding-left: 15px; /* Add left padding */
        }

        .call-button {
            color: white;
            display: flex;
            align-items: center; /* Center items vertically */
        }

        .call-button i {
            margin-right: 15px; /* Space between icon and text */
            color: red; /* Set icon color */
        }

        .cart-icon {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -15px;
            right: -15px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <!-- Bottom Navbar -->
    <nav class="navbar justify-content-between">
        <a class="navbar-brand call-button" href="tel:<?php 
            // Fetch contact number from session
            session_start();
            if (isset($_SESSION['contact_number'])) {
                echo $_SESSION['contact_number'];
            } else {
                echo ''; // Default or empty if not set
            }
        ?>">
            Call Us<i class="fa fa-phone"></i>
        </a>
        <div class="cart-icon">
            <a href="cart.php" class="text-white">
                <i class="fa fa-shopping-cart"></i> Cart
                <span class="cart-count">
                    <?php 
                        // PHP Code to Get Cart Count
                        if (isset($_SESSION['count'])) {
                            echo count($_SESSION['count']); // Display number of items in cart
                        } else {
                            echo 0; // Default cart count
                        }
                    ?>
                </span>
            </a>
        </div>
    </nav>

    <!-- Bootstrap and FontAwesome JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</body>
</html>
