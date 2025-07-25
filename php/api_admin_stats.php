<?php
//php/api_admin_stats.php

session_start();
header('Content-Type: application/json');

//admin security check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    //we send a proper error response that javascript can understand
    http_response_code(403); //forbidden
    echo json_encode(['error' => 'Access Denied']);
    exit();
}

require_once 'db_connect.php';

$stats = [];

//get count of products per category
$sql = "SELECT category, COUNT(*) as product_count FROM products GROUP BY category ORDER BY product_count DESC";
$result = $conn->query($sql);

$product_stats = [];
if ($result) {
    while($row = $result->fetch_assoc()) {
        $product_stats[] = $row;
    }
}

//add the product stats to our main stats array
$stats['products_per_category'] = $product_stats;


//output the final stats as JSON
echo json_encode($stats);

$conn->close();

?>