<?php
//admin/products.php

session_start();

//admin security check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    die("Access Denied.");
}

//include the database connection
require_once '../php/db_connect.php';

//fetch all products from the database to display them
$sql = "SELECT * FROM products ORDER BY category, name";
$result = $conn->query($sql);
$products = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Admin</title>
    <meta name="description" content="Admin page to manage the product catalog for Apex Builds.">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="admin-header">
        <h1>APEX BUILDS ADMIN</h1>
        <nav>
            <a href="index.php">Dashboard</a>
            <a href="products.php">Products</a>
            <a href="users.php">Users</a>
            <a href="messages.php">Messages</a>
            <a href="../index.php" target="_blank">View Main Site</a>
            <a href="../logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <div class="content-container">
            <h1>Manage Products</h1>
            <p><a href="add_product.php" class="add-new-link">Add New Product</a></p>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($product['id']); ?></td>
                                <td><?php echo htmlspecialchars($product['category']); ?></td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td>$<?php echo htmlspecialchars(number_format($product['price'], 2)); ?></td>
                                <td><?php echo htmlspecialchars($product['stock_quantity']); ?></td>
                                <td>
                                    <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="action-link">Edit</a> |
                                    <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="action-link delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No products found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
    
    <style>
        body { font-family: Roboto, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; }
        .admin-header { background-color: #212529; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .admin-header h1 { font-family: 'Orbitron', sans-serif; font-size: 1.5rem; margin: 0; }
        .admin-header a { color: #f8f9fa; text-decoration: none; margin-left: 1.5rem; }
        .admin-header a:hover { text-decoration: underline; }
        .content-container { max-width: 1200px; margin: 2rem auto; background-color: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 1.5rem; }
        .admin-table th, .admin-table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .admin-table th { background-color: #f2f2f2; }
        .admin-table tr:nth-child(even) { background-color: #f9f9f9; }
        .action-link, .add-new-link { color: #007bff; text-decoration: none; font-weight: bold; }
        .action-link:hover, .add-new-link:hover { text-decoration: underline; }
        .action-link.delete { color: #dc3545; }
    </style>
</body>
</html>
