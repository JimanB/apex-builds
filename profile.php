<?php
//profile.php

//includes session_start() and the main site header
require_once 'php/header.php'; 

//redirect to login if user is not logged in.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
require_once 'php/db_connect.php';

$feedback_message = '';
$feedback_class = '';

//handle address update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_address'])) {
    $address1 = trim($_POST['address_line1']);
    $address2 = trim($_POST['address_line2']);
    $city = trim($_POST['city']);
    $province = trim($_POST['province']);
    $postal_code = trim($_POST['postal_code']);
    
    //update the user's address in the database
    $stmt = $conn->prepare("UPDATE users SET address_line1 = ?, address_line2 = ?, city = ?, province = ?, postal_code = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $address1, $address2, $city, $province, $postal_code, $user_id);
    
    if ($stmt->execute()) {
        $feedback_message = 'Address updated successfully!';
        $feedback_class = 'feedback-success';
    } else {
        $feedback_message = 'Error updating address.';
        $feedback_class = 'feedback-error';
    }
    $stmt->close();
}

//fetch current user data (including new address)
$stmt = $conn->prepare("SELECT username, nickname, email, address_line1, address_line2, city, province, postal_code FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

$display_name = !empty($user['nickname']) ? $user['nickname'] : $user['username'];

//fetch user's order history
$orders = [];
$stmt = $conn->prepare("SELECT id, total_price, order_date FROM orders WHERE user_id = ? ORDER BY order_date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($order = $result->fetch_assoc()) {
        $item_stmt = $conn->prepare("SELECT product_name, product_price FROM order_items WHERE order_id = ?");
        $item_stmt->bind_param("i", $order['id']);
        $item_stmt->execute();
        $items_result = $item_stmt->get_result();
        $items = [];
        while ($item = $items_result->fetch_assoc()) {
            $items[] = $item;
        }
        $order['items'] = $items;
        $orders[] = $order;
        $item_stmt->close();
    }
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Apex Builds</title>
    
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" id="theme-stylesheet">
    <script src="js/main.js" defer></script>
</head>
<body>
    <?php require_once 'php/header.php'; ?>

    <main>
        <div class="content-container">
            <h1>Welcome, <?php echo htmlspecialchars($display_name); ?>!</h1>
            <p>Here you can manage your shipping details and view your order history.</p>

            <hr class="divider">

            <h2>Shipping Address</h2>
            
            <?php if (!empty($feedback_message)): ?>
                <div class="feedback-message <?php echo $feedback_class; ?>"><?php echo $feedback_message; ?></div>
            <?php endif; ?>

            <form action="profile.php" method="post" class="profile-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="address_line1">Address Line 1</label>
                        <input type="text" name="address_line1" value="<?php echo htmlspecialchars($user['address_line1'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="address_line2">Address Line 2 (Optional)</label>
                        <input type="text" name="address_line2" value="<?php echo htmlspecialchars($user['address_line2'] ?? ''); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" name="city" value="<?php echo htmlspecialchars($user['city'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="province">Province</label>
                        <input type="text" name="province" value="<?php echo htmlspecialchars($user['province'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" value="<?php echo htmlspecialchars($user['postal_code'] ?? ''); ?>">
                    </div>
                </div>
                <button type="submit" name="update_address" class="cta-button">Save Address</button>
            </form>
            
            <hr class="divider">

            <h2>Your Order History</h2>

            <?php if (empty($orders)): ?>
                <p>You have not placed any orders yet.</p>
            <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <div class="order-card">
                        <div class="order-summary">
                            <h3>Order #<?php echo $order['id']; ?></h3>
                            <p><strong>Date:</strong> <?php echo date("F j, Y, g:i a", strtotime($order['order_date'])); ?></p>
                            <p><strong>Total:</strong> $<?php echo number_format($order['total_price'], 2); ?></p>
                        </div>
                        <div class="order-items">
                            <h4>Items in this order:</h4>
                            <ul>
                                <?php foreach ($order['items'] as $item): ?>
                                    <li><?php echo htmlspecialchars($item['product_name']); ?> - $<?php echo number_format($item['product_price'], 2); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
    
    <?php require_once 'php/footer.php'; ?>
    
    <style>
        .content-container { max-width: 900px; margin: 2rem auto; background-color: var(--secondary-bg-color); padding: 2rem; border-radius: 8px; }
        .order-card { border: 1px solid var(--border-color); border-radius: 8px; margin-top: 1.5rem; overflow: hidden; }
        .order-summary { background-color: var(--primary-bg-color); padding: 1rem; border-bottom: 1px solid var(--border-color); }
        .order-summary h3, .order-summary p { margin: 0.25rem 0; }
        .order-items { padding: 1rem; }
        .order-items ul { list-style-type: disc; padding-left: 20px; margin: 0; }
        .order-items li { margin-bottom: 0.5rem; }
        .divider { border-color: var(--border-color); margin: 2rem 0; }
        .profile-form .form-row { display: flex; gap: 1rem; flex-wrap: wrap; }
        .profile-form .form-group { flex: 1; min-width: 200px; margin-bottom: 1rem; }
        .profile-form label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        .profile-form input { width: 100%; padding: 0.8rem; background-color: var(--primary-bg-color); color: var(--secondary-text-color); border: 1px solid var(--border-color); border-radius: 5px; font-size: 1rem; box-sizing: border-box; }
        .feedback-message { padding: 1rem; margin-bottom: 1.5rem; border-radius: 5px; font-weight: bold; text-align: center; }
        .feedback-success { background-color: #2a9d8f; color: white; }
        .feedback-error { background-color: #e76f51; color: white; }
    </style>
</body>
</html>