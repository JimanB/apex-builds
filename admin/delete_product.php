<?php
//admin/delete_product.php

session_start();

//admin security check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    die("Access Denied.");
}

//check if an ID is provided
if (isset($_GET['id'])) {
    require_once '../php/db_connect.php';
    
    $product_id = (int)$_GET['id'];
    
    if ($product_id > 0) {
        //use a prepared statement to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        
        //execute the statement
        if ($stmt->execute()) {
            //redirect back to the product list with a success message
            header("Location: products.php?status=deleted");
            exit();
        } else {
            //handle potential errors, e.g., redirect with an error message
            header("Location: products.php?status=error");
            exit();
        }
        $stmt->close();
    }
    $conn->close();
}

//if no ID is provided, just redirect back to the list
header("Location: products.php");
exit();
?>