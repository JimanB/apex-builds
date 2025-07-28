<?php
//help/accounts-and-orders.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts | Apex Builds Help</title>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css" id="theme-stylesheet">
    <script src="../js/main.js" defer></script>

    <style>
        .content-container { background-color: var(--secondary-bg-color); padding: 2rem; border-radius: 8px; }
        .component-definitions h2 { margin-top: 2rem; border-bottom: 2px solid var(--border-color); padding-bottom: 0.5rem; }
        .back-link { display: inline-block; margin-top: 2rem; font-weight: bold; }
    </style>
</head>
<body>

  
        <?php require_once '../php/header-help.php'; ?>
    

    <main>
        <div class="content-container">
            <h1>User Accounts & Orders</h1>
            <p>Creating an account allows you to save your builds and view your order history.</p>

            <div class="component-definitions">
                <h2>How to Register</h2>
                <p>To create an account, simply navigate to the <a href="../register.php">Register</a> page from the main menu. You'll need to provide a unique username, a valid email address, and a password that is at least 8 characters long.</p>

                <h2>How to Log In</h2>
                <p>Once you have an account, you can sign in on the <a href="../login.php">Login</a> page. After a successful login, you'll be taken to your personal profile page, and the main menu will update to show links to your profile and a logout option.</p>

                <h2>Your Profile Page</h2>
                <p>The profile page is your personal hub. Currently, it serves as a welcome page, but in the future, you'll be able to view your complete order history and manage your account details here.</p>
            </div>
            
            <a href="index.php" class="back-link">&larr; Back to Help Menu</a>
        </div>
    </main>

    <?php require_once '../php/footer-help.php'; ?>
    
    
</body>
</html>