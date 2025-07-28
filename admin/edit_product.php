<?php
//admin/edit_product.php

session_start();

//admin security check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    die("Access Denied.");
}

require_once '../php/db_connect.php';

$errors = [];
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id <= 0) {
    header("Location: products.php");
    exit();
}

//fetch existing categories for the dropdown
$categories = [];
$sql_cats = "SELECT DISTINCT category, displayName FROM products ORDER BY FIELD(category, 'CPU', 'GPU', 'Motherboard', 'RAM', 'SSD', 'Cooler', 'PSU', 'Case', 'Fans', 'OS', 'HDD', 'Monitor', 'Keyboard', 'Mouse', 'Headset', 'Webcam', 'Microphone', 'Speakers', 'Wifi', 'Cables')";
$result_cats = $conn->query($sql_cats);
if ($result_cats && $result_cats->num_rows > 0) {
    while ($row = $result_cats->fetch_assoc()) {
        $categories[] = $row;
    }
}

//handle the form submission for updating the product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $category_data = explode('|', $_POST['category']);
    $category = trim($category_data[0]);
    $displayName = trim($category_data[1]);
    
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $image = trim($_POST['image']);

    if (empty($category) || empty($displayName) || empty($name) || empty($price) || empty($image)) {
        $errors[] = "All fields are required.";
    }
    if (!is_numeric($price) || $price < 0) {
        $errors[] = "Price must be a valid positive number.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE products SET category = ?, displayName = ?, name = ?, price = ?, image = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $category, $displayName, $name, $price, $image, $id);

        if ($stmt->execute()) {
            header("Location: products.php?status=updated");
            exit();
        } else {
            $errors[] = "Error updating product in the database.";
        }
        $stmt->close();
    }
}

//fetch the existing product data to pre-fill the form
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $product = $result->fetch_assoc();
} else {
    header("Location: products.php");
    exit();
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <header class="admin-header">
        </header>

    <main>
        <div class="content-container">
            <h1>Edit Product</h1>
            <p><a href="products.php">Back to Product List</a></p>

            <?php if (!empty($errors)): ?>
                <div class="feedback-error">
                    <?php foreach ($errors as $error): echo "<p>$error</p>"; endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="edit_product.php?id=<?php echo $product['id']; ?>" method="post" class="admin-form">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">

                <div class="form-group">
                    <label for="category">Select a Category</label>
                    <select id="category" name="category" required>
                        <option value="">-- Choose Category --</option>
                        <?php foreach ($categories as $cat): ?>
                            <?php $value = htmlspecialchars($cat['category']) . '|' . htmlspecialchars($cat['displayName']); ?>
                            <?php $selected = ($product['category'] == $cat['category']) ? 'selected' : ''; ?>
                            <option value="<?php echo $value; ?>" <?php echo $selected; ?>>
                                <?php echo htmlspecialchars($cat['displayName']); ?> (<?php echo htmlspecialchars($cat['category']); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="image">Image Path</label>
                    <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($product['image']); ?>" required>
                </div>
                <button type="submit" class="cta-button">Update Product</button>
            </form>
        </div>
    </main>
    
   <style>
    body { font-family: Roboto, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; }
    .admin-header { background-color: #212529; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
    .admin-header h1 { font-family: 'Orbitron', sans-serif; font-size: 1.5rem; margin: 0; }
    .admin-header a { color: #f8f9fa; text-decoration: none; margin-left: 1.5rem; }
    .admin-header a:hover { text-decoration: underline; }
    .content-container { max-width: 800px; margin: 2rem auto; background-color: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .content-container h1 { color: #dc3545; }
    .content-container p a { color: #007bff; text-decoration: none; font-weight: bold; }
    .content-container p a:hover { text-decoration: underline; }
    .admin-form .form-group { margin-bottom: 1.5rem; }
    .admin-form label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
    .admin-form input, .admin-form select { width: 100%; padding: 0.8rem; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem; box-sizing: border-box; }
    .cta-button { display: inline-block; background-color: #28a745; color: white; padding: 0.8rem 1.5rem; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; font-size: 1rem; }
    .cta-button:hover { background-color: #218838; }
    .feedback-error { margin-bottom: 1.5rem; padding: 1rem; border-radius: 5px; text-align: center; font-weight: bold; background-color: #e76f51; color: white; }
</style>
</body>
</html>