<?php
//php/remove_from_cart.php
session_start();

//check if an item key is provided in the URL
if (isset($_GET['key']) && isset($_SESSION['cart'])) {
    $key_to_remove = $_GET['key'];

    //unset (remove) the item from the cart array
    unset($_SESSION['cart'][$key_to_remove]);

    //re-index the array to prevent issues, though not strictly necessary
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

//redirect back to the cart page
header('Location: ../cart.php');
exit();
?>