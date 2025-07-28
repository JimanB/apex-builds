<?php
//checkout.php
require_once 'php/header.php'; // Includes session_start()

//security check
//if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?redirect=cart'); // Redirect back to cart after login
    exit();
}

//get cart items from session
$cart_items = isset($_SESSION['cart']) && is_array($_SESSION['cart']) ? $_SESSION['cart'] : [];

//if cart is empty, redirect to the cart page
if (empty($cart_items)) {
    header('Location: cart.php');
    exit();
}

//process the order
require_once 'php/db_connect.php';

$grand_total = 0;
//first, calculate the grand total
foreach ($cart_items as $item) {
    $build = $item['build'];
    $quantity = $item['quantity'];
    $build_total = 0;
    foreach ($build as $component) {
        $build_total += $component['price'];
    }
    $grand_total += $build_total * $quantity;
}

// insert the main order record into the `orders` table
$stmt = $conn->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
$stmt->bind_param("id", $_SESSION['user_id'], $grand_total);
$stmt->execute();
$order_id = $stmt->insert_id; //get the ID of the order we just created
$stmt->close();

//insert each item from the cart into the `order_items` table
$item_stmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, product_price) VALUES (?, ?, ?)");
foreach ($cart_items as $item) {
    //for each build in the cart
    for ($i = 0; $i < $item['quantity']; $i++) {
        //loop through its components and save each one
        foreach($item['build'] as $component) {
            $item_stmt->bind_param("isd", $order_id, $component['name'], $component['price']);
            $item_stmt->execute();
        }
    }
}
$item_stmt->close();
$conn->close();

//clear the shopping cart
unset($_SESSION['cart']);

//display confirmation
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation | Apex Builds</title>
    
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" id="theme-stylesheet">
    <script src="js/main.js" defer></script>
     <style>
        .content-container { text-align: center; max-width: 800px; margin: 2rem auto; background-color: var(--secondary-bg-color); padding: 2rem; border-radius: 8px; }
    </style>
</head>
<body>
    <?php require_once 'php/header.php'; ?>

    <main>
        <div class="content-container">
            <h1>Thank You For Your Order!</h1>
            <p>Your order (ID: #<?php echo $order_id; ?>) has been placed successfully.</p>
            <p>A confirmation has been sent to your email (simulation). You will be able to view your order history on your profile page soon.</p>
            <a href="index.php" class="cta-button" style="margin-top: 1rem;">Return to Homepage</a>
        </div>
    </main>

    <?php require_once 'php/footer.php'; ?>
    
   
</body>
</html>