<?php
//php/api_cart_count.php
session_start();
header('Content-Type: application/json');

$total_quantity = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    //sum up the quantity of each item in the cart
    foreach ($_SESSION['cart'] as $item) {
        if (isset($item['quantity'])) {
            $total_quantity += $item['quantity'];
        }
    }
}

echo json_encode(['item_count' => $total_quantity]);
?>