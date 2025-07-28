<?php
//help/for-site-admins.php
require_once '../php/header-help.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>For Site Admins: How to Update Content | Apex Builds Help</title>
    <meta name="description"
        content="Instructions for site administrators on how to update the product catalogue using the admin panel.">
    <meta name="keywords" content="help, admin, documentation, update products, manage users">

    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css" id="theme-stylesheet">
    <script src="../js/main.js" defer></script>

     <style>
        .content-container { background-color: var(--secondary-bg-color); padding: 2rem; border-radius: 8px; }
        .content-container h2 { margin-top: 2rem; border-bottom: 2px solid var(--border-color); padding-bottom: 0.5rem; }
        .back-link { display: inline-block; margin-top: 2rem; font-weight: bold; }
        code { background-color: var(--primary-bg-color); padding: 2px 5px; border-radius: 4px; }
    </style>
</head>

<body>
    
        <?php require_once '../php/header-help.php'; ?>
    
    <main>
        <div class="content-container">
            <h1>For Site Admins: How to Update Content</h1>
            <p>This guide explains how to manage your website's products and users through the **Admin Panel**. You no longer need to edit any code or data files directly.</p>

            <h2>1. Accessing the Admin Panel</h2>
            <ol>
                <li>First, you must <a href="../login.php">log in</a> to the website with an account that has the 'admin' role.</li>
                <li>After logging in, you can access the dashboard by navigating to the <code>/admin/</code> directory of your site or use the URL provided to all admins.</li>
                <li>From the dashboard, you can access all management pages.</li>
            </ol>

            <h2>2. Managing Products</h2>
            <p>The "Manage Products" page gives you full control over the e-commerce catalogue.</p>
            <ul>
                <li><strong>To Add a Product:</strong> Click the "Add New Product" link. Select a category from the dropdown menu, then fill in the new product's name, price, and image path.</li>
                <li><strong>To Edit a Product:</strong> Click the "Edit" link next to any product. The form will appear pre-filled with that product's current data. Make your changes and click "Update Product".</li>
                <li><strong>To Delete a Product:</strong> Click the "Delete" link next to any product. A confirmation box will appear before the item is permanently removed from the database.</li>
            </ul>

            <h2>3. Managing Images and Media</h2>
            <p>While product details are managed in the admin panel, the image and video files themselves must still be uploaded to the server.</p>
            <ol>
                <li>Place your new image files inside the <code>/images/</code> folder in the main project directory.</li>
                <li>When adding or editing a product, make sure the "Image Path" field matches the path and filename exactly (e.g., <code>images/your-new-image.png</code>).</li>
                <li>To change the video on the homepage, replace the <code>banner-video.mp4</code> file in the <code>/media/</code> folder (this cannot be done through the admin portal).</li>
            </ol>
            
            <a href="index.php" class="back-link">&larr; Back to Help Menu</a>
        </div>
    </main>

    
        <?php require_once '../php/footer-help.php'; ?>
    

   
</body>
</html>