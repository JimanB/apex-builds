<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Help Center | Apex Builds</title>
    <meta name="description"
        content="Find tutorials, guides, and support documentation for using the Apex Builds website and PC Builder tool.">
    <meta name="keywords" content="help, support, documentation, pc builder guide, faq">

    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css" id="theme-stylesheet">

    <script src="../js/main.js" defer></script>

     <style>
        .content-container {
            background-color: var(--secondary-bg-color);
            padding: 2rem;
            border-radius: 8px;
        }

        .help-menu {
            list-style: none;
            margin-top: 2rem;
            padding: 0;
        }

        .help-menu li {
            margin-bottom: 1rem;
        }

        .help-menu a {
            display: block;
            background-color: var(--primary-bg-color);
            padding: 1.5rem;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1.1rem;
            border-left: 5px solid var(--accent-color);
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .help-menu a:hover {
            text-decoration: none;
            transform: translateX(5px);
            background-color: var(--accent-color);
            color: var(--primary-bg-color);
        }
    </style>
</head>

<body>
    
        <?php require_once '../php/header-help.php'; ?>
   
    
    <main>
        <div class="content-container">
            <h1>Help & Documentation</h1>
            <p>Welcome to the Apex Builds Help Center. Choose a topic below to learn more about how our site works, from
                using the builder to updating content.</p>

            <ul class="help-menu">
                <li><a href="how-to-use-the-builder.php">How to Use the PC Builder</a></li>
                <li><a href="accounts-and-orders.php">User Accounts & Orders</a></li>
                <li><a href="understanding-components.php">Understanding PC Components</a></li>
                <li><a href="changing-themes.php">How to Change Website Themes</a></li>
                <li><a href="contact-and-support.php">Contacting Support</a></li>
                <li><a href="admin-guide.php">Administrator's Guide</a></li>
            </ul>
        </div>
    </main>

        <?php require_once '../php/footer-help.php'; ?>

</body>
</html>