<?php
//admin/index.php

session_start();

//admin security check
//check if the user is logged in and if they have the 'admin' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    //if not an admin, send a "403 Forbidden" header and exit
    header("HTTP/1.1 403 Forbidden");
    die("Access Denied. You do not have permission to view this page.");
}

//if the script continues, the user is a logged-in admin
$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Apex Builds</title>
    <link rel="stylesheet" href="../css/style.css" id="theme-stylesheet">
    <script src="../js/main.js" defer></script>
</head>
<body>

    <main>
        <div class="content-container">
            <h1>Admin Dashboard</h1>
            <p>Welcome, <?php echo htmlspecialchars($username); ?>!</p>
            
            <ul class="admin-menu">
                <li><a href="products.php">Manage Products</a></li>
                <li><a href="users.php">Manage Users</a></li>
                <li><a href="status.php">Website Status</a></li> <li><a href="../index.php">Return to Main Site</a></li>
            </ul>
        </div>
    </main>
    
    <style>
        body { background-color: var(--primary-bg-color); color: var(--secondary-text-color); }
        .content-container { max-width: 900px; margin: 2rem auto; background-color: var(--secondary-bg-color); padding: 2rem; border-radius: 8px; }
        .admin-menu { list-style: none; padding: 0; margin-top: 2rem; }
        .admin-menu li { margin-bottom: 1rem; }
        .admin-menu a { display: block; background-color: var(--primary-bg-color); padding: 1rem; border-radius: 5px; font-weight: bold; }
        .admin-menu a:hover { background-color: var(--accent-color); color: var(--primary-bg-color); text-decoration: none; }
    </style>
</body>
</html>