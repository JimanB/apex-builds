<?php
//help/admin-guide.php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Guide | Apex Builds Help</title>
    <meta name="description" content="A guide for admins on how to use the site's features.">
    <meta name="keywords" content="help, support, documentation, admin guide">

    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css" id="theme-stylesheet">

    <script src="../js/main.js" defer></script>

     <style>
        .content-container { background-color: var(--secondary-bg-color); padding: 2rem; border-radius: 8px; }
        .component-definitions h2 { margin-top: 2rem; border-bottom: 2px solid var(--border-color); padding-bottom: 0.5rem; }
        .back-link { display: inline-block; margin-top: 2rem; font-weight: bold; }
        code { background-color: var(--primary-bg-color); padding: 2px 5px; border-radius: 4px; }
    </style>
</head>
<body>

    
        <?php require_once '../php/header-help.php'; ?>
    

    <main>
        <div class="content-container">
            <h1>Administrator's Guide</h1>
            <p>This guide explains how to use the site's administration panel to manage content and users.</p>

            <div class="component-definitions">
                <h2>Accessing the Admin Dashboard</h2>
                <p>To access the admin panel, your account's 'role' must be set to 'admin' in the database. Once logged in as an admin, you can navigate directly to the <code>/admin/</code> directory to access the dashboard. You must first be logged into to the website before following the provided link to the admin site.</p>

                <h2>Managing Products</h2>
                <p>From the "Manage Products" page, you have full control over the product catalog (Create, Read, Update, Delete).</p>
                <ul>
                    <li><strong>Add Product:</strong> Click the "Add New Product" link and fill out all fields in the form. The image path must correspond to a file uploaded to the <code>/images/</code> folder.</li>
                    <li><strong>Edit Product:</strong> Click the "Edit" link next to any product. The form will be pre-filled with the existing data. Make your changes and click "Update Product".</li>
                    <li><strong>Delete Product:</strong> Click the "Delete" link next to any product. A confirmation box will appear before the product is permanently removed.</li>
                </ul>

                <h2>Managing Users</h2>
                <p>The "Manage Users" page allows you to oversee all registered accounts.</p>
                <ul>
                    <li><strong>Change Role:</strong> Use the dropdown menu to change a user's role between 'Customer' and 'Admin'. Click "Save Role" to apply the change.</li>
                    <li><strong>Disable/Enable Account:</strong> Click the "Disable" link to prevent a user from logging in. The link will change to "Enable," allowing you to reactivate the account at any time.</li>
                </ul>
                
                <h2>Website Status Page</h2>
                <p>The "Website Status" page provides a live check of the site's core services. 'ONLINE' indicates the service is working correctly, while 'OFFLINE' indicates a potential problem that needs investigation.</p>
            </div>
            
            <a href="index.php" class="back-link">&larr; Back to Help Menu</a>
        </div>
    </main>

    <?php require_once '../php/footer-help.php'; ?>
    
   
</body>
</html>