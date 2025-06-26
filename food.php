<?php
session_start();


// if (!isset($_SESSION['mobile']) || !isset($_SESSION['parameter'])) {
//     header("Location: index.php"); 
//     exit();
// }


// $parameter = $_SESSION['parameter'];


// $url = "http://52.66.71.147/XpressPP_Running/hotel_details_for_ordering.php?parameter=$parameter";

// $res = file_get_contents($url);
// $result = json_decode($res, true);


// foreach ($result['result'] as $res) {

//     echo "<p>Hotel Name: " . $res['hotel_name'] . "</p>";

// }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">

    <title>Menu</title>
    <style>
        * {

            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Tahoma, sans-serif;
            font-size: 12px;
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
            border-right: 1px solid #bec2c2;
            border-left: 1px solid #bec2c2;
            /* Adjust color as needed */
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
    </style>


</head>

<body>
    <?php
    $parameter = $_GET['parameter'];

    $api_url = "http://52.66.71.147/XpressPP_Running/hotel_details_for_ordering.php";

    
    $input_data = [
        [
            "Parameter" => "QUxnWDFSNWVscHdJYTJXZzBjTmFyZz09",

            "UserName" => "hotelorder@6262",
            "Password" => "hotelorder@4474"
        ]
    ];

    // Convert the input array to JSON
    $json_input = json_encode($input_data);

    // Initialize cURL
    $curl = curl_init($api_url);

    // Set the cURL options
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json_input);

    // Execute the API call
    $response = curl_exec($curl);

    // Close cURL
    curl_close($curl);

    // Decode the JSON response
    $data = json_decode($response, true);
    // print_r($data);
// Handle errors in decoding
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Failed to decode JSON: " . json_last_error_msg();
        exit;
    }

    // Extract the hotel details
    $hotel = $data['result'][0];
    // echo $hote/;
// print_r($hotel);
    

    ?>
    <center>
        <pre><h3>Welcome to Xpress Hotel</h3></pre>
    </center>

    <div class="d-flex align-items-start justify-content-start text-right mt-3 pt-">
        <!-- <img src="<?php echo ($hotel['LogoUrl']); ?>" alt="" height="100" class="me-8">-->
        <div>
            <h1 class="mb-0">
                <?php echo ($hotel['HotelName']); ?>
            </h1>
            <p class="my-2">
                <?php echo ($hotel['Address']); ?>
            </p>
            <p class="my-2">
                <?php echo ($hotel['ContactNo']); ?>
            </p>
            <!-- <p> <?php echo ($hotel['TagLineContact']); ?></p>
        <p> <?php echo ($hotel['WhatsAppNumber']); ?></p> -->
            <div class="mt-2">
                <a href="<?php echo ($hotel['InstaUrl']); ?>" class="me-1">
                    <img src="instagram.png" alt="" height="16">
                </a>
                <a href="<?php echo ($hotel['FacebookUrl']); ?>" class="me-1">
                    <img src="facebook.png" alt="" height="16">
                </a>
                <a href="<?php echo ($hotel['GooglePageUrl']); ?>" class="me-1">
                    <img src="google.png" alt="" height="16">
                </a>
                <a href="<?php echo ($hotel['Website']); ?>" class="me-1">
                    <img src="internet.png" alt="" height="16">
                </a>
                <a href="<?php echo ($hotel['LocationLink']); ?>" class="me-1">
                    <img src="map.png" alt="" height="16">
                </a>
            </div>
        </div>
    </div>


    <div class="container col-12 col-md-8 col-lg-5">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="Xpress.png" class="d-block w-100" alt="picture1">
                </div>
                <div class="carousel-item">
                    <img src="s2.png" class="d-block w-100" alt="picture2">
                </div>
                <div class="carousel-item">
                    <img src="3rd pic.jpeg" class="d-block w-100" alt="picture3">
                </div>
                <div class="carousel-item">
                    <img src="4th pic.jpeg" class="d-block w-100" alt="picture4">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <?php

        function callApi($url, $data)
        {
            $options = array(
                'http' => array(
                    'header' => "Content-Type: application/json\r\n",
                    'method' => 'POST',
                    'content' => json_encode($data)
                )
            );
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            if ($result === FALSE) {
                return "Error: Unable to fetch data.";
            }

            return json_decode($result, true);
        }

        // API URL
        $vegOnlyUrl = "http://52.66.71.147/XpressPP_Running/vegonlyothers.php";

        // API Input Data
        $vegOnlyData = array(
            "Parameter" => "QUxnWDFSNWVscHdJYTJXZzBjTmFyZz09",
            "UserName" => "hotelorder@6262",
            "Password" => "hotelorder@4474",
            "VegOnly" => 1
        );

        // Call the API
        $vegOnlyResponse = callApi($vegOnlyUrl, $vegOnlyData);

        // Display the menu items
        echo "<h2>Menu Items</h2>";
        if (isset($vegOnlyResponse['result']) && !empty($vegOnlyResponse['result'])) {
            echo "<ul>";
            foreach ($vegOnlyResponse['result'] as $menuItem) {
                echo "<li>";
                echo "<strong>{$menuItem['MenuName']}</strong> ({$menuItem['MenuSubCategoryName']}) -₹ {$menuItem['Rate']}<br>";
                echo !empty($menuItem['Description']) ? "<em>Description:</em> {$menuItem['Description']}<br>" : "";
                echo !empty($menuItem['MenuImageUrl']) && trim($menuItem['MenuImageUrl']) != '' ? "<img src='" . trim($menuItem['MenuImageUrl']) . "' alt='{$menuItem['MenuName']}' width='100'><br>" : "";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "No menu items found.";
        }
        ?>


        <!-- created by aditya bhole -->
        <!-- switch button veg -->

        

        <div>
            <span>Only Veg</span>
            <label class="switch">
                <input type="checkbox" id="vegOnlySwitch">
                <span class="slider"></span>
            </label>
        </div>

        <div id="menu-items"></div>


        <!-- for the toggle button -->
        <script>
            const vegOnlySwitch = document.getElementById('vegOnlySwitch');
            const menuItemsDiv = document.getElementById('menu-items');

            vegOnlySwitch.addEventListener('change', function () {
                if (vegOnlySwitch.checked) {
                    loadVegMenu();
                } else {
                    menuItemsDiv.innerHTML = '';
                }
            });

            function loadVegMenu() {

                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'vegapi.php', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        menuItemsDiv.innerHTML = xhr.responseText;
                    } else {
                        menuItemsDiv.innerHTML = '<p>Failed to load veg-only menu items.</p>';
                    }
                };
                xhr.send();
            }
        </script>


        <div class="container">


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

            // Generate dropdown items
            $options = '';
            foreach ($data['result'] as $item) {
                $options .= '<li><a class="dropdown-item" href="#" data-value="' . htmlspecialchars($item['ItemGroupId']) . '">' . htmlspecialchars($item['ItemGroupName']) . '</a></li>';
            }
            ?>

            <div class="container mt-3">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Select Item Group
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php echo $options; ?>
                    </ul>
                </div>
            </div>


            <!-- for click code -->

            <?php
            // API endpoint
            $apiUrl = 'http://52.66.71.147/XpressPP_Running/get_other_items.php';

            // Input data
            $inputData = [
                [
                    "Parameter" => $parameter,
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
            <div class="subcategory-count-container blurred">
                <?php foreach ($countMap as $subcategory => $count): ?>
                    <div class="subcategory-item">
                        <a href="home.php?category=<?php echo urlencode($subcategory); ?>">
                            <?php echo htmlspecialchars($subcategory); ?> [
                            <?php echo $count; ?>]
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>


            <?php
            // Check if category is set
            // if (!isset($_GET['category'])) {
            //     echo 'Category not specified.';
            //     exit;
            // }
            
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

            <div class="container mt-5">
                <div class="row">
                    <?php foreach ($filteredItems as $item): ?>
                        <?php
                        // Determine the icon based on MenuTypeID
                        $menuTypeIcon = $item['MenuTypeID'] == 1 ? 'veg_icon.png' : 'nonvegicon.png';
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 d-flex flex-row align-items-center">
                                <div class="menu-details p-3" style="flex-grow: 1;">
                                    <h6 class="card-title d-flex align-items-center menu-name">
                                        <!-- Veg/Non-Veg Icon before the menu name -->
                                        <img src="<?php echo $menuTypeIcon; ?>" alt="Menu Type Icon"
                                            style="width: 20px; margin-right: 8px;">
                                        <?php echo htmlspecialchars($item['MenuName']); ?>
                                    </h6>
                                    <p>
                                        <?php echo htmlspecialchars($item['Description']); ?>
                                    </p>
                                    <p>₹
                                        <?php echo htmlspecialchars($item['Rate']); ?>
                                    </p>
                                </div>
                                <div class="item-image-button p-3 text-center">
                                    <?php if (!empty($item['MenuImageUrl'])): ?>
                                        <img src="<?php echo htmlspecialchars($item['MenuImageUrl']); ?>"
                                            alt="<?php echo htmlspecialchars($item['MenuName']); ?>"
                                            style="max-width: 100px; max-height: 100px;">
                                    <?php endif; ?>
                                    <button class="btn btn-primary add-btn" onclick="addToCart(this)">ADD</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>



            <!-- Category Title -->

            <?php

            $api_url = "http://52.66.71.147/XpressPP_Running/get_other_items.php";


            $input_data = [
                [
                    "Parameter" =>"QUxnWDFSNWVscHdJYTJXZzBjTmFyZz09",
                    "UserName" => "hotelorder@6262",
                    "Password" => "hotelorder@4474"
                ]
            ];


            $json_input = json_encode($input_data);


            $curl = curl_init($api_url);


            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json_input);


            $response = curl_exec($curl);

            // Close cURL
            curl_close($curl);

            // Decode the JSON response
            $data = json_decode($response, true);

            // Handle JSON decoding errors
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo "Failed to decode JSON: " . json_last_error_msg();
                exit;
            }

            // Extract menu items
            $menu_items = $data['result'];
            ?>
            <!-- Menu Item -->
            <div class="container mt-4 p-0">
                <!-- <h1 class="text-center">Menu Items</h1> -->
                <div class="row no-gutters">
                    <?php foreach ($menu_items as $item): ?>
                        <?php
                        // Determine the icon based on MenuTypeId
                        $menuTypeIcon = $item['MenuTypeId'] == 1 ? 'veg_icon.png' : 'nonvegicon.png';
                        ?>
                        <div class="col-md-12">
                            <div class="card p-3 d-flex flex-row align-items-start position-relative menu-card">
                                <div class="menu-details" style="flex-grow: 1;">
                                    <h6 class="card-title" style="font-size:18px; display: flex; align-items: center;">
                                        <!-- Veg/Non-Veg Icon before the menu name -->
                                        <img src="<?php echo $menuTypeIcon; ?>" alt="Menu Type Icon"
                                            style="width: 20px; margin-right: 8px;">
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
                                        <img src="<?php echo htmlspecialchars($item['MenuImageUrl']); ?>" class="img-fluid mb-2"
                                            alt="">
                                    <?php else: ?>
                                        <img src="placeholder.jpg" class="img-fluid mb-2" alt="">
                                    <?php endif; ?>
                                    <button class="btn btn-primary add-btn" onclick="addToCart(this)">ADD</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>



           
<!-- created by Aditya  Bhole-->
<script>
    function addToCart(button) {
        // Get the menu details when the ADD button is clicked
        let card = button.closest('.card');
        let quantity = 1;  // Initial quantity when added to cart
        let menuName = card.querySelector('.card-title').innerText;
        let description = card.querySelector('.card-text').innerText;
        let rate = card.querySelector('.card-text').innerText.split('₹')[1];
        let amount = quantity * parseFloat(rate);
        let menuTypeId = card.querySelector('img').src.includes('veg_icon.png') ? 1 : 2;

        // Immediately insert the record into the database using submit_order.php
        fetch('submit_order.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
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
            } else {
                console.error('Failed to add item.');
            }
        })
        .catch(error => console.error('Error:', error));

        // Replace the "ADD" button with quantity controls
        button.outerHTML = `
            <div class="quantity-controls">
                <button onclick="decreaseQuantity(this)">-</button>
                <input type="text" value="1" readonly>
                <button onclick="increaseQuantity(this)">+</button>
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
        if (parseInt(input.value) > 0) {
            input.value = parseInt(input.value) - 1;
            updateOrder(button);
        }
    }

    function updateOrder(button) {
        let card = button.closest('.card');
        let quantity = card.querySelector('input').value;
        let rate = card.querySelector('.card-text').innerText.split('₹')[1];
        let amount = quantity * parseFloat(rate);

        if (currentMenuId) {
            // Update the existing record in the database using update_order.php
            fetch('update_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    MenuID: currentMenuId,
                    Quantity: quantity,
                    Amount: amount
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Item updated in cart!');
                } else {
                    console.error('Failed to update item.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>


            <script>
          
                // for the dropdown of menus 

                window.onscroll = function () { stickySubmenu() };

                var submenu = document.querySelector('.subcategory-count-container');
                var sticky = submenu.offsetTop;

                function stickySubmenu() {
                    if (window.pageYOffset > sticky) {
                        submenu.classList.add('fixed');
                    } else {
                        submenu.classList.remove('fixed');
                    }
                }
            </script>

            <!-- <script src="script.js"></script> -->


</body>

</html>