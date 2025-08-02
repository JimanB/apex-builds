<?php
//php/api_admin_stats.php

session_start();
header('Content-Type: application/json');

//admin security check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Access Denied']);
    exit();
}

require_once 'db_connect.php';

$stats = [];

//get count of products per category
$sql_products = "SELECT category, COUNT(*) as product_count FROM products GROUP BY category ORDER BY product_count DESC";
$result_products = $conn->query($sql_products);
$product_stats = [];
if ($result_products) {
    while($row = $result_products->fetch_assoc()) {
        $product_stats[] = $row;
    }
}
$stats['products_per_category'] = $product_stats;

//get total orders and revenue
$sql_orders = "SELECT COUNT(id) as total_orders, SUM(total_price) as total_revenue FROM orders";
$result_orders = $conn->query($sql_orders);
$order_stats = $result_orders->fetch_assoc();

//ensure values are not null if there are no orders
$stats['total_orders'] = $order_stats['total_orders'] ?? 0;
$stats['total_revenue'] = $order_stats['total_revenue'] ?? 0.00;

//output the final stats as JSON
echo json_encode($stats);

$conn->close();
?>
