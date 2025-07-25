<?php
//php/update_cart_quantity.php
session_start();

//check if all required parameters are present
if (isset($_GET['key']) && isset($_GET['change']) && isset($_SESSION['cart'])) {
    
    $key = $_GET['key'];
    $change = (int)$_GET['change']; //convert change to an integer (-1 or 1)

    //check if the item exists in the cart
    if (isset($_SESSION['cart'][$key])) {
        
        //add or subtract from the quantity
        $_SESSION['cart'][$key]['quantity'] += $change;
        
        //if quantity drops to 0 or less, remove the item entirely
        if ($_SESSION['cart'][$key]['quantity'] <= 0) {
            unset($_SESSION['cart'][$key]);
            //re-index the array to prevent gaps
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
}

//redirect back to the cart page
header('Location: ../cart.php');
exit();
?>