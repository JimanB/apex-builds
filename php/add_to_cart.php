<?php
//php/add_to_cart.php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = file_get_contents('php://input');
    $new_build = json_decode($json_data, true);

    if (is_array($new_build) && !empty($new_build)) {
        
        //new stacking logic
        if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;
        //create a signature for the new build to easily compare it
        $new_build_signature = md5(json_encode($new_build));

        //loop through existing items in the cart
        foreach ($_SESSION['cart'] as $key => &$item) {
            //check if the item has a build and create its signature
            if (isset($item['build'])) {
                $existing_build_signature = md5(json_encode($item['build']));
                if ($existing_build_signature === $new_build_signature) {
                    //identical build found, increase quantity
                    $item['quantity']++;
                    $found = true;
                    break;
                }
            }
        }
        
        //if no identical build was found, add it as a new item
        if (!$found) {
            $_SESSION['cart'][] = [
                'build' => $new_build,
                'quantity' => 1
            ];
        }

        echo json_encode(['status' => 'success', 'message' => 'Cart updated.']);

    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid data.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>