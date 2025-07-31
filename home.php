<?php
session_start();
// session_destroy();
// print_r($_SESSION);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">


    <title>Food Ordering</title>
    <!-- creted by Digvijay Vapilkar -->
    <style>
        /* @font-face {
            font-family: 'ABeeZee';
            src: url('fonts/abeezee/ABeeZee-Regular.ttf') format('truetype');
        } */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 12px;
            font-family: 'ABeeZee', monospace;
        }

        h3 {
            margin-top: 20px;
            font-family: 'ABeeZee', 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

/*         
        h3 {
            margin-top: 20px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        } */

        /* For general layout */
        .d-flex.align-items-center.text-right {
            margin-top: 40px;
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
            font-size: 12px;
            line-height: 1.5;
            margin: 0 auto;
            display: block;
            padding-bottom: 7px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .add-btn {
                width: 100px;
                height: 40px;
                font-size: 12px;
            }
        }

        @media (min-width: 769px) and (max-width: 992px) {
            .add-btn {
                width: 90px;
                height: 38px;
                font-size: 15px;
            }
        }

        .container {
            padding-left: 0;
            padding-right: 0;
        }

        .row.no-gutters {
            margin-left: 0;
            margin-right: 0;
        }

        .row.no-gutters>.col-md-12 {
            padding-left: 0;
            padding-right: 0;
        }

        .card {
            border: none;
            border-bottom: 1px solid #bec2c2;
            border-right: 1px solid #bec2c2;
            border-left: 1px solid #bec2c2;
            margin-bottom: 0;
        }

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
            background-color: #1d6678;
            left: 0;
            z-index: 1000;
        }



        .navbar-brand {
            padding-left: 15px;
        }

        .call-button {
            color: white;
            display: flex;
            align-items: center;

        }

        .call-button i {
            margin-right: 15px;
            color: red;
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

        input:checked+.slider {
            background-color: #28a745;
            border: 1px solid #28a745;
        }

        .subcategory-item a {
            padding: 5px;
            text-decoration: none;
            color: black;
        }

        .subcategory-item a.active {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            border-radius: 5px;
        }

        .subcategory-item a:hover {
            text-decoration: underline;
        }

        /* Full-screen container */
        .centered-container {
            position: fixed;
            top: 50%;
            /* Center vertically */
            left: 50%;
            /* Center horizontally */
            width: 100%;
            /* Set desired width */
            max-width: 600px;
            /* Optional: limit maximum width */
            height: 600px;
            /* Adjust height automatically based on content */
            background-color: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: translate(-50%, -50%);
            transition: opacity 0.5s ease, visibility 0.5s ease;
            opacity: 0;
            visibility: hidden;
        }

        .centered-container.visible {
            opacity: 1;
            visibility: visible;
        }

        .centered-content {
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

    <?php

    include("connection.php");

    if (isset($_SESSION['parameter'])) {
        $parameter = $_SESSION['parameter'];
    }


    // API URL
    $api_url = "http://52.66.71.147/XpressPP_Running/hotel_details_for_ordering.php";
    // print_r($api_url);
    
    $input_data = [
        [
            "Parameter" => $parameter,
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

    // echo $response;
    
    // Close cURL
    curl_close($curl);

    // Decode the JSON response
    $data = json_decode($response, true);

    // Handle errors in decoding
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Failed to decode JSON: " . json_last_error_msg();
        exit;
    }

    // Extract the hotel details
    $hotel = $data['result'][0];

    // Store the contact number in the session
    if (isset($hotel['ContactNo'])) {
        $_SESSION['contact_number'] = $hotel['ContactNo'];
    }



    $_SESSION['table_id'] = $hotel['table_id'];

    $_SESSION['HotelName'] = $hotel['HotelName'];

    $_SESSION['table_name'] = $hotel['table_name'];

    $verified_mobile = isset($_SESSION['mobile_verified']) && $_SESSION['mobile_verified'];

    ?>


    <div class="d-flex justify-content-between mt-1 pt-3">
        <div class="mx-2 mt-1" style="margin-top: -5px;">
            <a href="splash.php" id="back" class="btn btn-primary rounded-circle"
                style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-arrow-left" style="color: white;"></i>
            </a>
        </div>
        <!-- <div class="text-center flex-grow-1">
            <h1 class="mb-0">
                <?php echo ($hotel['HotelName']); ?>
            </h1>
            <p class="my-2">
                <?php echo ($hotel['Address']); ?>
            </p>
            <p class="my-2">
                <?php echo ($hotel['ContactNo']); ?>
            </p>

            <p class="my-2" style="display: none;">
                <?php echo ($hotel['table_id']);
                //   $_SESSION['table_id']=$tableId; 
                ?>

            </p>
            
        </div> -->

        <div class="text-center flex-grow-1">
    <h1 class="mb-0">
        Digus Restaurant
    </h1>
    <p class="my-2">
        CBS Stand, Kolhapur, India
    </p>
    <p class="my-2">
        +91 9309475959
    </p>

    <p class="my-2" style="display: none;">
                <?php echo ($hotel['table_id']);
                //   $_SESSION['table_id']=$tableId; 
                ?>

            </p>
</div> 

        <div class="mx-2 mt-1" style="margin-top: -5px;">
            <?php if ($verified_mobile): ?>
                <a href="logout.php" id="logout" class="btn btn-danger rounded-circle" onclick="confirmLogout()"
                    style="width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-sign-out-alt" style="color: white;"></i>
                </a>
            <?php else: ?>
                <!-- blank logout button if there is no verified_mobile in the session-->
            <?php endif; ?>
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
                    <img src="Xpress.png" class="d-block w-100" alt="picture4">
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

        <!-- <div class="text-center mt-3" style="font-size: 1.5rem; font-weight: bold;">
            Table:
            <?php echo ($hotel['table_name']); ?>
        </div> -->



        <div class="container">

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
                    <select id="itemGroupSelect" class="form-select" name="item_group"
                        onchange="location = this.value;">
                        <option value="home.php?itemGroupId=ALL"<?php echo $itemGroupId === "ALL" ? 'selected' : ''; ?>>
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



        <!-- switch button veg -->

        <div class="text-center mt-3">
            <input type="text" id="searchBar" class="form-control mx-auto" style="border: 1px solid black; width: 70%;"
                placeholder="Search for items..." onkeyup="filterItems()">
        </div>

        <div style="margin-bottom: 10px;">
            <span style="font-size: 15px;">Only Veg</span>
            <label class="switch">
                <input type="checkbox" id="vegOnlySwitch">
                <span class="slider"></span>
            </label>
        </div>

        <div id="menu-items"></div>



        <!-- this is for subcategory slider items and visible.....cretaed by Digvijay -->

        <?php
        // Check if category is set in the URL
        $activeCategory = urldecode($_GET['category']);

        $itemGroupId = isset($_GET['itemGroupId']) ? $_GET['itemGroupId'] : "0";
        // API endpoint
        $apiUrl = 'http://52.66.71.147/XpressPP_Running/get_other_items.php';

        // Input data
        $inputData = [
            [
                "Parameter" => $parameter,
                "UserName" => "hotelorder@6262",
                "Password" => "hotelorder@4474",
                "ItemGroupId" => $itemGroupId
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

        // Count of each MenuSubCategoryName
        $countMap = [];
        foreach ($data['result'] as $item) {
            $subcategory = $item['MenuSubCategoryName'];
            if (!isset($countMap[$subcategory])) {
                $countMap[$subcategory] = 0;
            }
            $countMap[$subcategory]++;
        }
        ?>

        <!-- Subcategory slider items and its count -->

        <div class="subcategory-count-container blurred">
            <div class="subcategory-item">
                <a href="home.php" class="<?php echo empty($activeCategory) ? 'active' : ''; ?>">
                    All [
                    <?php echo array_sum($countMap); ?>]
                </a>
            </div>
            <?php foreach ($countMap as $subcategory => $count): ?>

                <div class="subcategory-item">
                    <a href="home.php?category=<?php echo urlencode($subcategory); ?>"
                        class="<?php echo ($subcategory === $activeCategory) ? 'active' : ''; ?>">
                        <?php echo htmlspecialchars($subcategory); ?> [
                        <?php echo $count; ?>]
                    </a>
                </div>
            <?php endforeach; ?>
        </div>


        <!-- this is for displaying subcategory slider items data  -->

        <?php

        $category = urldecode($_GET['category']);

        $itemGroupId = isset($_GET['itemGroupId']) ? $_GET['itemGroupId'] : "0";
        // API endpoint
        $apiUrl = 'http://52.66.71.147/XpressPP_Running/get_other_items.php';

        $inputData = [
            [
                "Parameter" => $parameter,
                "UserName" => "hotelorder@6262",
                "Password" => "hotelorder@4474",
                "ItemGroupId" => $itemGroupId
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
        // $filteredItems = array_filter($data['result'], function ($item) use ($category) {
        //     return $item['MenuSubCategoryName'] === $category;
        // });
        $filteredItems = array_filter($data['result'], function ($item) use ($category) {
            return $item['MenuSubCategoryName'] === $category;
        });

        ?>


        <div class="container mt-5" id="filteredItemsContainer"
            style="margin-bottom: 30px; overflow-y: auto; max-height: 80vh;">
            <div class="row">
                <?php foreach ($filteredItems as $item): ?>
                    <?php
                    // MenuTypeID logic for icon selection
                    $menuTypeIcon = '';
                    if ($item['MenuTypeId'] == '0' || $item['MenuTypeId'] == '1') {
                        $menuTypeIcon = 'veg_icon.png';
                    } elseif ($item['MenuTypeId'] == '2') {
                        $menuTypeIcon = 'nonvegicon.png';
                    }
                    ?>
                    <div class="col-md-12">
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
                                    <img src="<?php echo htmlspecialchars($item['MenuImageUrl']); ?>" class="img-fluid mb-2"
                                        alt="">
                                <?php else: ?>
                                    <img src="placeholder.jpg" class="img-fluid mb-2" alt="">
                                <?php endif; ?>
                                <div class="menuId" style="display: none;">
                                    <?php echo htmlspecialchars($item['MenuId']); ?>
                                    <!-- <?php $_SESSION['MenuId'] = $item['MenuId'];
                                    print_r($_SESSION); ?>  -->
                                </div>

                                <?php

                                // Accessing the session variable directly (if it's set)
                                // if (isset($_SESSION['mobile'])) {
                                //     $mobile = $_SESSION['mobile'];
                                //     // Now you can use $mobile wherever needed
                                // }
                            
                                if (isset($_SESSION['unique_device_id'])) {
                                    $device_id = $_SESSION['unique_device_id'];
                                }


                                // print_r($_SESSION);
                                $sql_quantity = "SELECT Quantity FROM `menu_items` WHERE MenuID = '{$item['MenuId']}' AND DeviceID = '$device_id'";
                                $cursor = mysqli_query($conn, $sql_quantity);
                                //echo  $sql_quantity; 
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


        <!-- this is used for displaying main screen menu items with thier menu id -->

        <?php
        // Check for selected ItemGroupId and set default if not provided
        $itemGroupId = isset($_GET['itemGroupId']) ? $_GET['itemGroupId'] : "0"; // Default to ALL if not provided
        
        $api_url = "http://52.66.71.147/XpressPP_Running/get_other_items.php";

        // Prepare input data for API request
        $input_data = [
            [
                "Parameter" => $parameter,
                "UserName" => "hotelorder@6262",
                "Password" => "hotelorder@4474",
                "ItemGroupId" => $itemGroupId // Use the ItemGroupId from the query parameter
            ]
        ];

        // Handle the "ALL" option separately
        if ($itemGroupId === "ALL") {
            // If ALL is selected, modify the request as needed for the API
            $input_data[0]['ItemGroupId'] = ''; // Modify as needed for the API
        }

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
        $menu_items = isset($data['result']) ? $data['result'] : [];
        ?>

        <!-- Here you can use $menu_items to display the results -->

        <!-- Menu Item -->
        <div class="container mt-4 p-0" id="allItemsContainer">

            <!-- <h1 class="text-center">Menu Items</h1> -->
            <div class="row no-gutters hide">
                <?php foreach ($menu_items as $item): ?>
                    <?php

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
                    <div class="col-md-12" style="margin-bottom: 45px;">
                        <div class="card p-3 d-flex flex-row align-items-start position-relative menu-card"
                            data-menuname="<?php echo htmlspecialchars($item['MenuName']); ?>"
                            data-menuprice="<?php echo htmlspecialchars($item['Rate']); ?>"
                            data-menuicon="<?php echo $menuTypeIcon; ?>"
                            data-menuimage="<?php echo htmlspecialchars($item['MenuImageUrl']); ?>"
                            data-description="<?php echo htmlspecialchars($item['Description']); ?>"
                            onclick="handleClick(event, this)">

                            <div class="menu-details" style="flex-grow: 1;">
                                <h6 class="card-title" style="font-size:18px; display: flex; align-items: center;">

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
                                    <img src="<?php echo htmlspecialchars($item['MenuImageUrl']); ?>" class="img-fluid mb-2"
                                        alt="">
                                <?php else: ?>
                                    <img src="placeholder.jpg" class="img-fluid mb-2" alt="">
                                <?php endif; ?>
                                <div class="menuId" style="opacity: 0;">
                                    <?php echo htmlspecialchars($item['MenuId']); ?>
                                </div>

                                <?php
                                if (isset($item['MenuId'])) {
                                    $_SESSION['MenuId'] = $item['MenuId'];
                                }
                                // print_r($_SESSION);
                                ?>

                                <?php

                                // Accessing the session variable directly (if it's set)
                                // if (isset($_SESSION['mobile'])) {
                                //     $mobile = $_SESSION['mobile'];
                                //     // Now you can use $mobile wherever needed
                                // }
                            
                                if (isset($_SESSION['unique_device_id'])) {
                                    $device_id = $_SESSION['unique_device_id'];
                                }

                                $sql_quantity = "SELECT Quantity FROM `menu_items` WHERE MenuID = '{$item['MenuId']}' AND DeviceID = '$device_id'";
                                $cursor = mysqli_query($conn, $sql_quantity);
                                //echo  $sql_quantity; 
                                $row = mysqli_fetch_row($cursor);
                                $menu_quantity = $row[0];

                                if ($menu_quantity == '' || is_null($menu_quantity)) {
                                    $menu_quantity = 0;

                                }

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
                <?php endforeach;
                mysqli_close($conn); ?>
            </div>
        </div>

        <script>
            function filterItems() {

                const searchValue = document.getElementById('searchBar').value.toLowerCase();


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

        <div id="centeredContainer" class="centered-container" style="display:none;">
            <div class="centered-content">
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
                const centeredContainer = document.getElementById('centeredContainer');
                centeredContainer.style.display = 'flex';

                // Add a small delay to apply the visible class for animation
                setTimeout(() => {
                    centeredContainer.classList.add('visible');
                }, 100);
            }

            function closeDetails() {
                const centeredContainer = document.getElementById('centeredContainer');

                // Slide down the full-screen container
                centeredContainer.classList.remove('visible');

                // Hide the container after the animation completes
                setTimeout(() => {
                    centeredContainer.style.display = 'none';
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

        <!-- for the dropdown of menus  -->
        <script>
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


        <script>
            let cartCount = <?php echo isset($_SESSION['count']) ? count($_SESSION['count']) : 0; ?>; // Initialize cart count from PHP session
            let currentMenuId = null; // Initialize currentMenuId

            function addToCart(button) {
                // Get the menu details when the ADD button is clicked
                let card = button.closest('.card');
                let quantity = 1;  // Initial quantity when added to cart
                let menuId = card.querySelector('.menuId').innerText;
                // console.log(menuId);
                let menuName = card.querySelector('.card-title').innerText;
                let description = card.querySelector('.card-text').innerText.split('₹')[0].trim(); // Correct extraction
                let rate = card.querySelector('.card-text').innerText.split('₹')[1].trim(); // Correct extraction
                let amount = quantity * parseFloat(rate);
                let menuTypeId = card.querySelector('img').src.includes('veg_icon.png') ? 1 : 2;

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
                            currentMenuId = data.MenuId; // Store the menu ID for future updates

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

                                // Check if the cart count is greater than 0 before decrementing
                                if (cartCount > 0) {
                                    // Decrease cart count and update DOM
                                    cartCount -= 1; // Decrement the count
                                    updateCartCount(cartCount); // Update the displayed count

                                    // Clear currentMenuId if the item is updated
                                    currentMenuId = null;

                                    // Update the card with menuId and menuTypeId
                                    card.querySelector('.menuId').innerText = menuId;
                                    card.querySelector('.menuTypeId').innerText = menuTypeId;

                                    // Optionally, store the updated count in local storage
                                    localStorage.setItem('cartCount', cartCount);
                                } else {
                                    console.warn('Cart count is already zero, cannot decrement.');
                                }
                            } else {
                                console.error('Failed to update item.');
                            }

                            // On page load, initialize cart count from local storage if needed
                            window.onload = function () {
                                let storedCount = localStorage.getItem('cartCount');
                                cartCount = storedCount ? parseInt(storedCount, 10) : 0; // Parse the count or set to 0 if not found
                                updateCartCount(cartCount); // Update the displayed count
                            };

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

        <!-- for the veg only toggle button -->

        <script>
            const vegOnlySwitch = document.getElementById('vegOnlySwitch');
            const menuItemsDiv = document.getElementById('menu-items');
            const hide = document.querySelector('.hide');

            // Check localStorage for the switch state on page load
            window.onload = function () {
                const vegOnly = localStorage.getItem('vegOnly') === 'true';
                vegOnlySwitch.checked = vegOnly; // Set switch based on localStorage
                if (vegOnly) {
                    hide.style.display = 'none';
                    loadVegMenu();
                } else {
                    hide.style.display = 'block';
                    menuItemsDiv.innerHTML = ''; // Clear previous items if not veg
                }
            };

            vegOnlySwitch.addEventListener('change', function () {
                if (vegOnlySwitch.checked) {
                    hide.style.display = 'none';
                    loadVegMenu();
                    localStorage.setItem('vegOnly', 'true'); // Save state in localStorage
                } else {
                    menuItemsDiv.innerHTML = '';
                    hide.style.display = 'block';
                    localStorage.setItem('vegOnly', 'false'); // Save state in localStorage
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


        <script>
            // Function to hide the div with class 'hide'
            function hideMenuItems() {
                // Get the div with the class 'hide'
                var hiddenDiv = document.querySelector('.hide');

                // Check if the div exists and hide it
                if (hiddenDiv) {
                    hiddenDiv.style.display = 'none';
                }
            }

            // Add click event listeners to each subcategory link
            document.addEventListener('DOMContentLoaded', function () {
                // Select all subcategory links
                var subcategoryLinks = document.querySelectorAll('.subcategory-item a');

                // Loop through each link and add the click event listener
                subcategoryLinks.forEach(function (link) {
                    link.addEventListener('click', function (event) {
                        // Prevent the default link behavior
                        event.preventDefault();

                        // Hide the div with class 'hide'
                        hideMenuItems();

                        // Redirect to the category page
                        window.location.href = this.href;
                    });
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                // Get the category parameter from the URL
                const urlParams = new URLSearchParams(window.location.search);
                const category = urlParams.get('category');

                // Get references to the containers
                const filteredItemsContainer = document.getElementById('filteredItemsContainer');
                const allItemsContainer = document.getElementById('allItemsContainer');

                // Display filtered items container if category is present, otherwise display all items container
                if (category) {
                    filteredItemsContainer.style.display = 'block';
                    allItemsContainer.style.display = 'none';
                } else {
                    filteredItemsContainer.style.display = 'none';
                    allItemsContainer.style.display = 'block';
                }
            });

        </script>

        <script>
            function confirmLogout() {
                if (confirm("Are You Sure..! Want To Logout Mobile Number You Verified?")) {
                    document.getElementById("deleteForm").submit();
                }
            }
        </script>


        <nav class="navbar justify-content-between">
            <a class="navbar-brand call-button" href="tel:
            <?php
            // session_start();
            // if (isset($_SESSION['contact_number'])) {
            //     echo $_SESSION['contact_number'];
            // } else {
            //     echo ''; // Default or empty if not set
            // }
            echo '9309475959';
            ?>">
                <!-- Flipped Call Icon -->
                <i class="fa fa-phone" style="margin-right: 10px; transform: scaleX(-1);"></i>
                <span>Call Us</span>
            </a>

            <!-- History Icon and Text -->
            <div class="history-icon" style="margin-right: 35px;">
                <a href="history.php" class="text-white">
                    <i class="fa fa-history" style="margin-left: 10px;"></i>
                    <span>History</span>
                </a>
            </div>

            <!-- Cart Icon and Text -->
            <div class="cart-icon">
                <a href="cart.php" class="text-white" id="cart-link" onclick="return validateCartCount()">
                    <i class="fa fa-shopping-cart" style="margin-right: 5px;"></i>
                    <span>Cart</span>
                    <span class="cart-count">
                        <?php
                        include("connection.php");
                        $sql_cart_count = "SELECT count(MenuID) FROM `menu_items` WHERE DeviceID = '$device_id'";
                        $cursor = mysqli_query($conn, $sql_cart_count);
                        $row = mysqli_fetch_row($cursor);
                        $cart_count = $row[0];
                        echo $cart_count;

                        // $_SESSION['cart_count'] = $cart_count;
                        ?>
                    </span>
                </a>
            </div>

            <script>
                function validateCartCount() {
                    var cartCount = parseInt(document.querySelector('.cart-count').textContent);

                    if (cartCount <= 0) {
                        alert("Your cart is empty. Please add some items to your cart");
                        return false;
                    }
                    return true;
                }
            </script>

        </nav>
        <!-- Bootstrap and FontAwesome JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</body>

</html>