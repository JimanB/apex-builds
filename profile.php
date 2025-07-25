<?php
//profile.php
require_once 'php/header.php'; // Includes session_start()

//private page logic
//redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$display_name = !empty($_SESSION['nickname']) ? $_SESSION['nickname'] : $_SESSION['username'];

//fetch users order history
require_once 'php/db_connect.php';
$orders = [];
//prepare a query to get all orders for the current user
$stmt = $conn->prepare("SELECT id, total_price, order_date FROM orders WHERE user_id = ? ORDER BY order_date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($order = $result->fetch_assoc()) {
        //for each order, fetch its individual items
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

    <style>
        .content-container { max-width: 900px; margin: 2rem auto; background-color: var(--secondary-bg-color); padding: 2rem; border-radius: 8px; }
        .order-card { border: 1px solid var(--border-color); border-radius: 8px; margin-top: 1.5rem; overflow: hidden; }
        .order-summary { background-color: var(--primary-bg-color); padding: 1rem; border-bottom: 1px solid var(--border-color); }
        .order-summary h3 { margin: 0 0 0.5rem 0; }
        .order-summary p { margin: 0.25rem 0; }
        .order-items { padding: 1rem; }
        .order-items ul { list-style-type: disc; padding-left: 20px; margin: 0; }
        .order-items li { margin-bottom: 0.5rem; }
    </style>
</head>
<body>


    <main>
        <div class="content-container">
            <h1>Welcome, <?php echo htmlspecialchars($display_name); ?>!</h1>
            <p>Here you can view your complete order history.</p>
            <a href="logout.php" class="cta-button" style="margin-top: 1rem; margin-bottom: 2rem; display: inline-block;">Log Out</a>

            <hr style="border-color: var(--border-color);">

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
    
    
</body>
</html>