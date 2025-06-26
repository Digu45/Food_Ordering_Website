<?php

session_start();
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {

    if (isset($_SESSION['unique_device_id'])) {
        $device_id = $_SESSION['unique_device_id'];

        $sql = "DELETE FROM menu_items WHERE DeviceID = '$device_id'";

        if (mysqli_query($conn, $sql)) {

            echo "<script> 
            window.location.href = 'home.php';</script>";
        } else {
            echo "<script>alert('Error deleting menu items: " . mysqli_connect_error() . "');</script>";
        }
    } else {
        echo "<script>alert('Invalid request.');</script>";
    }
}

// Close the database connection
// mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'ABeeZee', monospace;
            background-color: #f9f9f9;
            padding: 20px;
            font-size: 10px;
        }


        /* .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            border: 1px solid #6e6c69;
        } */

        .cart-item img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .item-quantity input {
            width: 50px;
            text-align: center;
        }

        .bill-details {
            margin-top: 20px;
            font-size: 14px;
        }

        .bill-details .total {
            font-weight: bold;
        }

        /* Modal specific styles */
        .modal-header {
            background-color: #5AA8AB;
            color: white;
        }
    </style>
    <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete all items from your cart?")) {
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
</head>


<body>

    <div class="container">

        <!-- Back and Checkout Buttons -->
        <!-- <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-primary" onclick="window.location.href='home.php'">Add Menu</button> 
        </div> -->

        <div class="d-flex justify-content-between mb-3">
            <!-- <button class="btn btn-primary" id="back" onclick="return cancleOrder();">Back</button> -->

            <button class="btn btn-primary" onclick="window.location.href='home.php'">Add Menu</button>
   
            <form method="POST" id="deleteForm" style="display: inline;">
                <button type="button" onclick="confirmDelete()" class="btn btn-danger">Delete Orders</button>
                <input type="hidden" name="delete_all" value="1">
            </form>

        </div>

        <center>
            <h4>Your Cart</h4>
        </center>
        
        <center><b style="font-size: 1.0rem;">Table:
                <?php echo $_SESSION['table_name']; ?>
        </center></b>



        <?php
        include("connection.php");

        $mobile = $_SESSION['mobile'];

        if (isset($_SESSION['unique_device_id'])) {
            $device_id = $_SESSION['unique_device_id'];
        }

        if (isset($_SESSION['table_id'])) {
            $table_id = $_SESSION['table_id'];
        }

        if (isset($_SESSION['OrderId'])) {
            $orderId = $_SESSION['OrderId'];
        }

        if (isset($_SESSION['table_name'])) {
            $table_name = $_SESSION['table_name'];
        }

        // print_r($_SESSION);
        // Check if the mobile number has been verified
        $mobile_verified = isset($_SESSION['mobile_verified']) && $_SESSION['mobile_verified'];



        function getTaxRates()
        {
            return ['cgst' => 2.50, 'sgst' => 2.50]; // Simulating tax rates, e.g., 2.5% each
        }

        
        $taxRates = getTaxRates();
        $cgstRate = $taxRates['cgst'];
        $sgstRate = $taxRates['sgst'];

        $sql = "SELECT MenuID, MenuName, Rate, Quantity, MenuTypeId, Instructions FROM menu_items WHERE DeviceID='$device_id'";
        $result = mysqli_query($conn, $sql);

        $item_total = 0;
        $item_exists = mysqli_num_rows($result) > 0; // Check if there are items
        
        if ($item_exists) {
            while ($row = mysqli_fetch_assoc($result)) {
                $menuTypeIcon = $row['MenuTypeId'] == 1 ? 'veg_icon.png' : 'nonvegicon.png';
                $menuTypeAltText = $row['MenuTypeId'] == 1 ? 'Veg' : 'Non-Veg';

                $item_price = $row["Rate"] * $row["Quantity"];
                $item_total += $item_price;

                echo "<div class='cart-item row py-2 border-bottom' data-menuid='{$row['MenuID']}'>
                <div class='col-5 d-flex align-items-center'>
                    <img src='$menuTypeIcon' alt='$menuTypeAltText' />
                    <h6 class='mb-0'>{$row['MenuName']} (₹" . number_format($row['Rate'], 2) . ")</h6>
                </div>
                <div class='col-4 item-quantity d-flex justify-content-between align-items-center'>
                    <button class='btn btn-sm btn-outline-primary decrease-qty'>&ndash;</button>
                    <input type='text' class='form-control form-control-sm quantity' value='{$row['Quantity']}' readonly>
                    <button class='btn btn-sm btn-outline-primary increase-qty'>+</button>
                </div>
                <div class='col-3 text-right item-price' data-price='{$row['Rate']}' style='font-size:16px; margin-top:14px;'>
                    ₹" . number_format($item_price, 2) . "
                </div>
                <div class='col-12 mt-2'>
                    <button class='btn btn-outline-info btn-sm add-instruction' data-menuid='{$row['MenuID']}' data-instruction='{$row['Instructions']}'>Add Instructions</button>
                </div>
            </div>";
            }
        } else {
            echo "<b style='font-size:16px;'>Your cart is empty.</b>";
        }

        mysqli_close($conn);
        // session_destroy();
        // print_r($_SESSION);
        ?>
        

        <!-- Bill Details -->
        <?php if ($item_exists): ?>
            <div class="bill-details mt-3" style="font-size: 1.0rem;">
                <div class="d-flex justify-content-between">
                    <span>Item Total</span><span id="item-total">₹0.00</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>CGST (
                        <?php echo $cgstRate; ?>%)
                    </span><span id="cgst-total">₹0.00</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>SGST (
                        <?php echo $sgstRate; ?>%)
                    </span><span id="sgst-total">₹0.00</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Round Off</span>
                    <span id="fractional-amount">₹0.00</span>
                </div>
                <div class="d-flex justify-content-between total">
                    <span>To Pay</span>
                    <span id="rounded-total">₹0.00</span>
                </div>
            </div>

            <div class="text-center">
                <?php if (!$mobile_verified): ?>
                    <button class="btn btn-outline-primary my-2" id="verify_mobile" onclick="location.href='index.php'">Verify
                        Mobile</button>
                <?php else: ?>
                    <button class="btn btn-outline-primary my-2" id="place_order">Place Order</button>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Instruction Modal -->
        <div class="modal fade" id="instructionModal" role="dialog" aria-labelledby="instructionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="instructionModalLabel">Add Special Instructions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea id="instructionText" class="form-control" rows="4"
                            placeholder="Enter your special instructions here..."></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="saveInstructionBtn">Done</button>
                    </div>
                </div>
            </div>
        </div>



        <script>
            document.getElementById('place_order').addEventListener('click', function () {
                if (confirm('Are you sure you want to confirm the order?')) {
                    // Get values from the bill details
                    var itemTotal = document.getElementById('item-total').innerText.replace('₹', '').replace(',', '');
                    var cgstTotal = document.getElementById('cgst-total').innerText.replace('₹', '').replace(',', '');
                    var sgstTotal = document.getElementById('sgst-total').innerText.replace('₹', '').replace(',', '');
                    var fractionalAmount = document.getElementById('fractional-amount').innerText.replace('₹', '').replace(',', '');
                    var roundedTotal = document.getElementById('rounded-total').innerText.replace('₹', '').replace(',', '');

                    // Prepare data to send to PHP
                    var data = {
                        item_total: itemTotal,
                        cgst_total: cgstTotal,
                        sgst_total: sgstTotal,
                        fractional_amount: fractionalAmount,
                        rounded_total: roundedTotal
                    };

                    // Call the PHP script to get the API response
                    fetch('place_order.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data)
                    })

                        // .then(response => response.json()) // Parse JSON from the PHP response\


                        // .then(data => {
                        //     console.log('Response from place_order.php:', data);

                        //     // Check if the response indicates success
                        //     if (data.result === 'success') {
                        //         // Unset mobile_verified in the session
                        //         // return fetch('unset_mobile_verified.php', {
                        //         //     method: 'POST',
                        //         // });
                        //         alert('Order placed.');
                        //     } else {
                        //         alert('Order not placed. Please try again.');
                        //     }
                        // })
                        .then(response => response.json())
                        .then(data => {
                            if (data.result === 'success') {
                                alert('Order Placed!');
                                window.location.href = 'home.php';
                            } else {
                                alert('Failed to unset mobile verification status. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while placing the order.');
                        });
                } else {
                    alert('Order not confirmed.');
                }
            });

        </script>

        <!-- 
<script>
    // Event listener for the "Place Order" button
    document.getElementById('place_order').addEventListener('click', function() {
        // Show confirmation alert
        if (confirm('Are you sure you want to confirm your order?')) {
            // If the user clicks "OK", redirect to the mobile OTP verification page
            window.location.href = 'index.php';
        }
        // If the user clicks "Cancel", nothing happens, and the page remains the same
    });
</script> -->

        <!-- JavaScript to handle special instructions -->
        <script>
            let currentMenuId = null;

            // Event listener to open the modal when clicking "Add Instructions"
            document.querySelectorAll('.add-instruction').forEach(button => {
                button.addEventListener('click', function () {
                    currentMenuId = this.getAttribute('data-menuid');
                    let currentInstruction = this.getAttribute('data-instruction');
                    document.getElementById('instructionText').value = currentInstruction || '';
                    $('#instructionModal').modal('show');
                });
            });

            // Handle saving the instruction
            document.getElementById('saveInstructionBtn').addEventListener('click', function () {
                let instruction = document.getElementById('instructionText').value;

                let formData = new FormData();
                formData.append('menu_id', currentMenuId);
                formData.append('instruction', instruction);

                fetch('update_instruction.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // alert('Instruction updated successfully!');
                            $('#instructionModal').modal('hide');
                        } else {
                            alert('Failed to update instruction.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while updating the instruction.');
                    });
            });
        </script>




        <!-- JavaScript for updating totals -->
        <script>
            function updateTotals() {
                let itemTotal = 0;
                let cgstRate = 2.50;
                let sgstRate = 2.50;

                // Calculate the item total
                document.querySelectorAll('.cart-item').forEach((item) => {
                    let rate = parseFloat(item.querySelector('.item-price').getAttribute('data-price'));
                    let quantity = parseInt(item.querySelector('.quantity').value);

                    if (!isNaN(rate) && !isNaN(quantity) && quantity > 0) {
                        let totalPerItem = rate * quantity;
                        item.querySelector('.item-price').innerText = `₹${totalPerItem.toFixed(2)}`;
                        itemTotal += totalPerItem;
                    }
                });

                // Calculate CGST and SGST
                let cgstTotal = itemTotal * (cgstRate / 100);
                let sgstTotal = itemTotal * (sgstRate / 100);
                let totalToPay = itemTotal + cgstTotal + sgstTotal;

                // Calculate fractional part and rounded total
                let fractionalPart = totalToPay % 1; // Get fractional part (e.g., 0.50)
                let roundedTotalToPay = (fractionalPart >= 0.50) ? Math.ceil(totalToPay) : Math.floor(totalToPay);

                // Update the DOM with totals
                document.getElementById('item-total').innerText = `₹${itemTotal.toFixed(2)}`;
                document.getElementById('cgst-total').innerText = `₹${cgstTotal.toFixed(2)}`;
                document.getElementById('sgst-total').innerText = `₹${sgstTotal.toFixed(2)}`;

                // Display fractional amount (e.g., 0.50) and rounded total
                document.getElementById('fractional-amount').innerText = `₹${fractionalPart.toFixed(2)}`;
                document.getElementById('rounded-total').innerText = `₹${roundedTotalToPay.toFixed(2)}`;
            }

            // Ensure the updateTotals function runs when quantities change
            updateTotals();


            document.querySelectorAll('.increase-qty').forEach((button, index) => {
                button.addEventListener('click', () => {
                    let quantityInput = document.querySelectorAll('.quantity')[index];
                    let newQuantity = parseInt(quantityInput.value) + 1;
                    quantityInput.value = newQuantity;

                    let menuId = document.querySelectorAll('.cart-item')[index].getAttribute('data-menuid');
                    updateQuantityInDatabase(menuId, newQuantity);
                    updateTotals();
                });
            });

            document.querySelectorAll('.decrease-qty').forEach((button, index) => {
                button.addEventListener('click', () => {
                    let quantityInput = document.querySelectorAll('.quantity')[index];
                    let quantity = parseInt(quantityInput.value);

                    if (quantity > 1) {
                        let newQuantity = quantity - 1;
                        quantityInput.value = newQuantity;

                        let menuId = document.querySelectorAll('.cart-item')[index].getAttribute('data-menuid');
                        updateQuantityInDatabase(menuId, newQuantity);
                    } else if (quantity === 1) {
                        let cartItem = document.querySelectorAll('.cart-item')[index];
                        cartItem.remove();
                    }
                    updateTotals();
                });
            });

            function updateQuantityInDatabase(menuId, quantity) {
                let formData = new FormData();
                formData.append('menu_id', menuId);
                formData.append('quantity', quantity);

                fetch('update_quantity.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            alert('Failed to update quantity in the database');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            updateTotals();
        </script>

        <!-- <script>
         function cancleOrder(){
            alert("Are You Sure Want to Cancel Order?");
         }

        </script> -->


    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>