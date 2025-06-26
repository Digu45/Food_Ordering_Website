<?php
session_start();
if (isset($_SESSION['parameter'])) {
    $parameter = $_SESSION['parameter'];
}

$itemGroupId = isset($_GET['itemGroupId']) ? $_GET['itemGroupId'] : "0";

// API URL
$api_url = "http://52.66.71.147/XpressPP_Running/vegonlyothers.php";

// Input data
$input_data = [
    [
        "Parameter" => $parameter,
        "UserName" => "hotelorder@6262",
        "Password" => "hotelorder@4474",
        "VegOnly" => 1,
        "ItemGroupId" => $itemGroupId 
    ]
];
   // Handle the "ALL" option separately
   if ($itemGroupId === "ALL") {
    // If ALL is selected, modify the request as needed for the API
    $input_data[0]['ItemGroupId'] = ''; // Modify as needed for the API
}

$json_input = json_encode($input_data);

$curl = curl_init($api_url);

// Set cURL options
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($curl, CURLOPT_POSTFIELDS, $json_input);

// Execute the API call
$response = curl_exec($curl);

// Check for cURL errors
if ($response === false) {
    echo "cURL Error: " . curl_error($curl);
    exit;
}

// Close cURL
curl_close($curl);

// Decode the JSON response
$data = json_decode($response, true);
// print_r($data);

// Handle JSON decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Failed to decode JSON: " . json_last_error_msg();
    exit;
}

// Extract menu items
$menu_items = $data['result'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Design</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 12px;
            font-family: 'ABeeZee', monospace;
            /* font-family: 'ABeeZee', Times, serif; */
            /* font-family: Georgia, 'Times New Roman', Times, serif; */
        }

        h3 {
            margin-top: 20px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        /* For general layout */
        .d-flex.align-items-center.text-right {
            margin-top: 40px;
            /* Adjust the margin as needed */
        }



        @media (max-width: 768px) {
            .d-flex.align-items-center.text-right {
                margin: 10px;
                flex-direction: column;
                text-align: center;
            }
        }

        .add-btn {
            width: 100px;
            height: 40px;
            font-size: 16px;
            line-height: 1.5;
            margin: 0 auto;
            display: block;
            padding-bottom: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .add-btn {
                width: 100px;
                /* Adjust width for mobile view */
                height: 40px;
                /* Adjust height for mobile view */
                font-size: 16px;
                /* Adjust font size for mobile view */
            }
        }

        /* Additional media queries for other viewports if needed */
        @media (min-width: 769px) and (max-width: 992px) {
            .add-btn {
                width: 90px;
                /* Adjust width for tablets or medium screens */
                height: 38px;
                /* Adjust height for tablets or medium screens */
                font-size: 15px;

            }
        }

        /* Remove left and right padding from the container */
        .container {
            padding-left: 0;
            padding-right: 0;
        }

        /* Remove margins between rows to ensure no space between borders */
        .row.no-gutters {
            margin-left: 0;
            margin-right: 0;
        }

        .row.no-gutters>.col-md-12 {
            padding-left: 0;
            padding-right: 0;
        }

        /* Remove card borders but add bottom border */
        .card {
            border: none;
            border-bottom: 1px solid #bec2c2;
            border-left: 1px solid #bec2c2;
            border-right: 1px solid #bec2c2;
            margin-bottom: 0;
            /* Ensure no extra space at the bottom */
        }

        /* Optional: Adjust spacing for mobile view */
        @media (max-width: 768px) {
            .container {
                padding-left: 0;
                padding-right: 0;
            }
        }

        .menu-name {
            font-size: 13px;
            font-weight: bold;
        }

        .navbar {
            position: fixed;
            bottom: 0;
            width: 100%;
            /* background-color: #3fb0a8; */
            background-color: #1d6678;
            left: 0;
            z-index: 1000;
        }



        .navbar-brand {
            padding-left: 15px;
            /* Add left padding */
        }

        .call-button {
            color: white;
            display: flex;
            align-items: center;

        }

        .call-button i {
            margin-right: 15px;
            /* Space between icon and text */
            color: red;
            /* Set icon color */
        }

        .cart-icon {
            position: relative;
            left: -25px;
        }

        .cart-icon span {
            font-size: 1.2rem;
            margin-right: 18px;
        }

        .cart-icon a {
            text-decoration: none;
        }

        .call-button span {
            font-size: 1.2rem;
        }

        .history-icon {
            position: relative;
        }

        .history-icon span {
            font-size: 1.2rem;
        }

        .history-icon a {
            text-decoration: none;
        }

        .cart-count {
            position: absolute;
            top: -10px;
            right: -25px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }


        /* Full-screen container */
        .full-screen-container {
            position: fixed;
            bottom: -100%;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: bottom 0.5s ease;
        }

        .full-screen-container.visible {
            bottom: 0;
        }

        /* Full-screen content */
        .full-screen-content {
            width: 90%;
            max-width: 600px;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }

        .menu-image-full {
            width: 100%;
            height: auto;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
        }

        .quantity-controls button {
            width: 30px;
            height: 30px;
            font-size: 18px;
            line-height: 18px;
            text-align: center;
        }
        .form-select{
            border: 1px solid black;
        }
    </style>
</head>

<body>

    <div class="container" style="display: none;">

        <?php
        session_start(); // Start the session
        
        // API endpoint to get item groups
        $apiUrl = 'http://52.66.71.147/XpressPP_Running/get_item_group_cust_ord.php';

        // Input data for the API request
        $inputData = [
            [
                "UserName" => "hotelorder@6262",
                "Password" => "hotelorder@4474",
                "Parameter" => $parameter
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
        if (!isset($data['result'])) {
            $data['result'] = []; // No data found
        }

        // Get the selected ItemGroupId from the query string
        $itemGroupId = isset($_GET['itemGroupId']) ? $_GET['itemGroupId'] : "ALL"; // Default to ALL if not provided
        ?>

        <div class="container mt-3 mb-3">
            <div class="dropdown ">
                <b><label for="itemGroupSelect" class="form-label" style="font-size: 15px;">Select Item
                        Group:</label></b>
                <select id="itemGroupSelect" class="form-select" name="item_group" onchange="location = this.value;">
                    <option value="home.php?itemGroupId=ALL" <?php echo $itemGroupId === "ALL" ? 'selected' : ''; ?>>
                        ALL</option> <!-- Default option for showing all items -->
                    <?php
                    foreach ($data['result'] as $item) {
                        $itemGroupIdValue = htmlspecialchars($item['ItemGroupId'], ENT_QUOTES);
                        $itemGroupName = htmlspecialchars($item['ItemGroupName'], ENT_QUOTES);
                        echo "<option value='home.php?itemGroupId={$itemGroupIdValue}' " . ($itemGroupId === $itemGroupIdValue ? 'selected' : '') . ">{$itemGroupName}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <!-- Menu Item -->
    <div class="container mt-4 p-0">

        <!-- <h1 class="text-center">Menu Items</h1> -->
        <div class="row no-gutters">
            <?php foreach ($menu_items as $item): ?>
                <?php

                // $menuTypeIcon = $item['MenuTypeId'] == 1 ? 'veg_icon.png' : 'nonvegicon.png';
                $menuTypeIcon = '';
                if ($item['MenuTypeId'] == '0' || $item['MenuTypeId'] == '1') {
                    $menuTypeIcon = 'veg_icon.png';
                } elseif ($item['MenuTypeId'] == '2') {
                    $menuTypeIcon = 'nonvegicon.png';
                } elseif ($item['MenuTypeId'] == '3') {
                    $menuTypeIcon = '';
                }
                // $item['menuTypeIcon'] = $menuTypeIcon; // Add the icon to the item array
            
                ?>

                <div class="col-md-12" style="margin-bottom: 20px;">
                    <div class="card p-3 d-flex flex-row align-items-start position-relative menu-card"
                        data-menuname="<?php echo htmlspecialchars($item['MenuName']); ?>"
                        data-menuprice="<?php echo htmlspecialchars($item['Rate']); ?>"
                        data-menuicon="<?php echo $menuTypeIcon; ?>"
                        data-menuimage="<?php echo htmlspecialchars($item['MenuImageUrl']); ?>"
                        data-description="<?php echo htmlspecialchars($item['Description']); ?>"
                        onclick="handleClick(event, this)">
                        <div class="menu-details" style="flex-grow: 1;">
                            <h6 class="card-title" style="font-size:18px; display: flex; align-items: center;">
                                <!-- Veg/Non-Veg Icon before the menu name -->
                                <img src="<?php echo $menuTypeIcon; ?>" alt="" style="width: 20px; margin-right: 8px;">
                                <b style="font-size: 13px;">
                                    <?php echo htmlspecialchars($item['MenuName']); ?>
                                </b>
                            </h6>
                            <p class="card-text" style="font-size:14px;">
                                <strong></strong> ₹
                                <?php echo htmlspecialchars($item['Rate']); ?>
                            </p>
                            <?php if (trim($item['Description'])): ?>
                                <p class="card-text" style="font-size:10px;">
                                    <?php echo nl2br(htmlspecialchars($item['Description'])); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="menu-image text-right" style="width: 100px; position: relative; height: auto;">
                            <?php if (trim($item['MenuImageUrl'])): ?>
                                <img src="<?php echo htmlspecialchars($item['MenuImageUrl']); ?>" class="img-fluid mb-2" alt="">
                            <?php else: ?>
                                <img src="placeholder.jpg" class="img-fluid mb-2" alt="">
                            <?php endif; ?>
                            <div class="menuId" style="opacity: 0;">
                                <?php echo htmlspecialchars($item['MenuID']); ?>
                            </div>
                            <?php
                            include("connection.php");
                            // Accessing the session variable directly (if it's set)
                            if (isset($_SESSION['mobile'])) {
                                $mobile = $_SESSION['mobile'];
                                // Now you can use $mobile wherever needed
                            }


                            if (isset($_SESSION['unique_device_id'])) {
                                $device_id = $_SESSION['unique_device_id'];
                            }



                            // print_r($_SESSION);
                            $sql_quantity = "SELECT Quantity FROM `menu_items` WHERE MenuID = '{$item['MenuID']}' AND DeviceID = '$device_id'";
                            $cursor = mysqli_query($conn, $sql_quantity);
                            // echo  $sql_quantity; 
                            $row = mysqli_fetch_row($cursor);
                            $menu_quantity = $row[0];

                            if ($menu_quantity == '' || is_null($menu_quantity)) {
                                $menu_quantity = 0;

                            }
                            // echo $menu_quantity;
                            if ($menu_quantity > 0) { ?>
                                <div class="quantity-controls">
                                    <button class="btn btn-primary" onclick="decreaseQuantity(this)">-</button>
                                    <input type="text" value=<?php echo $menu_quantity; ?> readonly>
                                    <button class="btn btn-primary" onclick="increaseQuantity(this)">+</button>
                                </div>
                                <?php
                            } else {
                                echo '<button class="btn btn-primary add-btn" onclick="addToCart(this)">ADD</button>';
                            }
                            ?>
                            <!-- <button class="btn btn-primary add-btn" onclick="addToCart(this)">ADD</button> -->
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
    <script>
        function filterItems() {
            // Get the value of the search bar
            const searchValue = document.getElementById('searchBar').value.toLowerCase();

            // Get all menu item cards
            const menuCards = document.querySelectorAll('.menu-card');

            // Loop through all menu items and hide those that don't match the search
            menuCards.forEach(card => {
                const menuName = card.getAttribute('data-menuname').toLowerCase();
                if (menuName.includes(searchValue)) {
                    card.parentElement.style.display = ''; // Show the card
                } else {
                    card.parentElement.style.display = 'none'; // Hide the card
                }
            });
        }
    </script>


    <!-- Enlarge Modal (hidden by default) -->
    <div id="fullScreenContainer" class="full-screen-container" style="display:none;">
        <div class="full-screen-content">
            <span class="close-btn" onclick="closeDetails()">×</span>
            <div id="menuDetails"></div>
        </div>
    </div>


    <script>
        function showDetails(element) {
            // Get the data from the clicked container
            const menuName = element.getAttribute('data-menuname');
            const menuPrice = element.getAttribute('data-menuprice');
            const menuIcon = element.getAttribute('data-menuicon');
            const menuImage = element.getAttribute('data-menuimage');
            const menuDescription = element.getAttribute('data-description');

            // Populate the full-screen container with the menu details
            document.getElementById('menuDetails').innerHTML = `
        <div class="menu-header" style="display: flex; align-items: center; justify-content: space-between;">
            <img src="${menuIcon}" alt="Menu Type" style="width: 30px; margin-right: 10px;">
            <h2>${menuName}</h2>
        </div>
        <p><strong>Price:</strong> ₹ ${menuPrice}</p>
        <img src="${menuImage}" class="menu-image-full" alt="${menuName}">
        <p><strong>Description:</strong> ${menuDescription}</p>
        
       
    `;

            // Show the full-screen container and trigger the slide-up animation
            const fullScreenContainer = document.getElementById('fullScreenContainer');
            fullScreenContainer.style.display = 'flex';

            // Add a small delay to apply the visible class for animation
            setTimeout(() => {
                fullScreenContainer.classList.add('visible');
            }, 100);
        }

        function closeDetails() {
            const fullScreenContainer = document.getElementById('fullScreenContainer');

            // Slide down the full-screen container
            fullScreenContainer.classList.remove('visible');

            // Hide the container after the animation completes
            setTimeout(() => {
                fullScreenContainer.style.display = 'none';
            }, 500); // This matches the transition time in CSS
        }

        function handleClick(event, element) {
            // Check if the clicked element is the ADD button
            if (event.target.closest('.add-btn')) {
                return; // Do not show details if the ADD button was clicked
            }

            // Check if the clicked element is a price or quantity controls
            if (event.target.closest('.card-text') || event.target.closest('.quantity-controls')) {
                return; // Do not show details if the price or quantity controls were clicked
            }

            // If it's not the add button, price, or quantity, show the details
            showDetails(element);
        }

    </script>


    <!-- <script>
    function addToCart(button) {
      alert('Added to cart');
    }
  </script> -->

    <script>
        let cartCount = <?php echo isset($_SESSION['count']) ? count($_SESSION['count']) : 0; ?>; // Initialize cart count from PHP session
        let currentMenuId = null; // Initialize currentMenuId



        function addToCart(button) {
            // Get the menu details when the ADD button is clicked
            let card = button.closest('.card');
            let quantity = 1;  // Initial quantity when added to cart
            let menuId = card.querySelector('.menuId').innerText;
            //console.log(menuId);
            let menuName = card.querySelector('.card-title').innerText;
            let description = card.querySelector('.card-text').innerText.split('₹')[0].trim(); // Correct extraction
            let rate = card.querySelector('.card-text').innerText.split('₹')[1].trim(); // Correct extraction
            let amount = quantity * parseFloat(rate);
            let menuTypeId = card.querySelector('img').src.includes('veg_icon.png') ? 1 : 2;

            console.log(menuId);
            // console.log(menuName);
            // console.log(description);
            // console.log(rate);
            // console.log(amount);
            // console.log(menuTypeId);

            // Immediately insert the record into the database using submit_order.php
            fetch('submit_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    MenuId: menuId,
                    MenuName: menuName,
                    Description: description,
                    Rate: rate,
                    Quantity: quantity,
                    Amount: amount,
                    MenuTypeID: menuTypeId
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Item added to cart!');
                        currentMenuId = data.menuID; // Store the menu ID for future updates

                        // Increase cart count and update DOM
                        cartCount = data.cart_count;
                        updateCartCount(cartCount);

                        // Update the card with menuId and menuTypeId
                        //card.querySelector('.menuId').innerText = menuId;
                        // card.querySelector('.menuTypeId').innerText = menuTypeId;
                    } else {
                        console.error('Failed to add item.');
                    }
                })
                .catch(error => console.error('Error:', error));

            // Replace the "ADD" button with quantity controls
            button.outerHTML = `
            <div class="quantity-controls">
                <button class="btn btn-primary" onclick="decreaseQuantity(this)">-</button>
                <input type="text" value="1" readonly>
                <button class="btn btn-primary" onclick="increaseQuantity(this)">+</button>
            </div>
        `;
        }

        function increaseQuantity(button) {
            let input = button.previousElementSibling;
            input.value = parseInt(input.value) + 1;
            updateOrder(button);
        }

        function decreaseQuantity(button) {
            let input = button.nextElementSibling;
            let card = button.closest('.card');
            let menuId = card.querySelector('.menuId').innerText;
            let menuName = card.querySelector('.card-title').innerText;
            let description = card.querySelector('.card-text').innerText.split('₹')[0].trim();
            let rate = card.querySelector('.card-text').innerText.split('₹')[1].trim();
            let amount = parseFloat(rate);
            let menuTypeId = card.querySelector('img').src.includes('veg_icon.png') ? 1 : 2;


            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateOrder(button);
            } else {
                // Replace quantity controls with "ADD" button if quantity is 1
                button.closest('.quantity-controls').outerHTML = `
            <button class="btn btn-primary add-btn" onclick="addToCart(this)">ADD</button>
            `;

                // Update the existing record in the database using remove_order.php
                fetch('remove_order.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        MenuID: menuId,
                        MenuName: menuName,
                        Description: description,
                        Quantity: 1, // Send updated quantity
                        Amount: amount,
                        MenuTypeID: menuTypeId
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Item updated in cart!');

                            // Decrease cart count and update DOM
                            cartCount -= 1;
                            updateCartCount(cartCount);

                            currentMenuId = null; // Clear currentMenuId if the item is updated

                            // Update the card with menuId and menuTypeId
                            card.querySelector('.menuId').innerText = menuId;
                            card.querySelector('.menuTypeId').innerText = menuTypeId;
                        } else {
                            console.error('Failed to update item.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        function updateOrder(button) {
            let card = button.closest('.card');
            let menuId = card.querySelector('.menuId').innerText;
            let menuName = card.querySelector('.card-title').innerText;
            let description = card.querySelector('.card-text').innerText.split('₹')[0].trim();
            let quantity = card.querySelector('input').value;
            let rate = card.querySelector('.card-text').innerText.split('₹')[1].trim();
            let amount = quantity * parseFloat(rate);
            let menuTypeId = card.querySelector('img').src.includes('veg_icon.png') ? 1 : 2;

            console.log(quantity)
            // if (currentMenuId) {
            // Update the existing record in the database using update_order.php
            fetch('submit_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    MenuId: menuId,
                    MenuName: menuName,
                    Description: description,
                    Rate: rate,
                    Quantity: quantity,
                    Amount: amount,
                    MenuTypeID: menuTypeId

                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Item updated in cart!');

                        // Update the card with menuId and menuTypeId
                        card.querySelector('.menuId').innerText = menuId;
                        card.querySelector('.menuTypeId').innerText = menuTypeId;
                    } else {
                        console.error('Failed to update item.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        // }

        function updateCartCount(count) {
            document.querySelector('.cart-count').innerText = count;
        }
    </script>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>