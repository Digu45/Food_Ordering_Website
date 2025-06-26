<?php
$con = mysqli_connect('localhost', 'root', '', 'restaurant_db');
$sql = "SELECT * FROM m_menuitems";
$run = mysqli_query($con, $sql);

// Initialize an array to hold grouped items
$cart_items = [];

while ($fetch = mysqli_fetch_array($run)) {
    $menu_id = $fetch['MenuId'];
    $menu_subcat = $fetch['MenuSubCategoryName'];
    $menu_name = $fetch['MenuName'];
    $menu_imageUrl = $fetch['MenuImageUrl'];
    $menu_des = $fetch['Description'];
    $rate = $fetch['Rate'];
    $menu_type_id = $fetch['MenuTypeId'];
    $discount = $fetch['Discount'];

    // Calculate discounted price
    $discounted_price = $rate - ($rate * $discount / 100);

    // If item already exists in cart, increase quantity and update price
    if (isset($cart_items[$menu_id])) {
        $cart_items[$menu_id]['quantity']++;
        $cart_items[$menu_id]['total_price'] += $discounted_price;
    } else {
        // Add new item to cart
        $cart_items[$menu_id] = [
            'name' => $menu_name,
            'subcat' => $menu_subcat,
            'imageUrl' => $menu_imageUrl,
            'description' => $menu_des,
            'price' => $rate,
            'discount' => $discount,
            'discounted_price' => $discounted_price,
            'quantity' => 1,
            'total_price' => $discounted_price,
            'type_id' => $menu_type_id
        ];
    }
}

// Calculate the total amount for all items
$total_rate = 0;
foreach ($cart_items as $item) {
    $total_rate += $item['total_price'];
}

// Calculate tax and round off
$tax = $total_rate * 0.14; // Assuming 14% tax
$round_off = round($total_rate + $tax) - ($total_rate + $tax);
$total_payable = $total_rate + $tax + $round_off;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Cart List</title>
</head>

 
  
<body>


<div class="container my-4">
    <h4 class="text-center p-3">Cart List</h4>
    <div class="mb-3"style="">
        <a href="home.php" class="btn btn-primary">Go back</a>
    </div>

    <div class="row">
        <?php foreach ($cart_items as $item) { ?>
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5><?php echo $item['name']; ?></h5>
                            <p class="text-muted">Subcategory: <?php echo $item['subcat']; ?></p>
                            <p class="text-muted">Type ID: <?php echo $item['type_id']; ?></p>
                            <p><strong>Price:</strong> ₹<?php echo number_format($item['price'], 2); ?></p>
                            <?php if ($item['discount'] > 0) : ?>
                            <p class="text-success"><strong>Discount:</strong> <?php echo $item['discount']; ?>% off</p>
                            <p class="text-danger"><strong>Discounted Price:</strong> ₹<?php echo number_format($item['discounted_price'], 2); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4 d-flex align-items-center justify-content-end">
                            <button class="btn btn-outline-secondary">-</button>
                            <input type="text" class="form-control text-center mx-2" style="width: 50px;" value="<?php echo $item['quantity']; ?>">
                            <button class="btn btn-outline-secondary">+</button>
                            <p class="ms-3"><strong>₹<?php echo number_format($item['total_price'], 2); ?></strong></p>
                        </div>
                    </div>
                    <!-- <a href="#" class="text-success mt-2 d-block">Add Special Instruction</a> -->
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <!-- <div class="card p-3">
        <h5 class="mb-3">Write Suggestions to Restaurant?</h5> -->
        <textarea class="form-control mb-3" placeholder="Write Suggestions to Restaurant?"></textarea>
        <h5 class="mt-3">Bill Details</h5>
        <p>Item Total: ₹<?php echo number_format($total_rate, 2); ?></p>
        <p>Tax: ₹<?php echo number_format($tax, 2); ?></p>
        <p>RoundOff: ₹<?php echo number_format($round_off, 2); ?></p>
        <h5 class="mt-3">To Pay: <strong>₹<?php echo number_format($total_payable, 2); ?></strong></h5>
        <a href="#" class="btn btn-primary mt-3">Proceed to Checkout</a>
    </div>
</div>
</body>
</html>

