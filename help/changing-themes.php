<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>How to Change Themes | Apex Builds Help</title>
    <meta name="description"
        content="Learn how to change the visual theme of the Apex Builds website using the theme switcher.">
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

        .step-guide {
            list-style: none;
            padding-left: 0;
            margin-top: 2rem;
        }

        .step-guide li {
            margin-bottom: 2.5rem;
        }

        .step-guide h2 {
            margin-bottom: 0.5rem;
        }

        .help-image {
            max-width: 100%;
            border-radius: 5px;
            border: 1px solid var(--border-color);
            margin-top: 1rem;
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            font-weight: bold;
        }
    </style>
</head>

<body>

<?php require_once '../php/header-help.php'; ?>

    <main>
        <div class="content-container">
            <h1>How to Change Website Themes</h1>
            <p>You can change the visual appearance of our entire website with just two clicks. Your preference will
                even be saved for your next visit!</p>

            <ol class="step-guide">
                <li>
                    <h2>Step 1: Locate the Theme Switcher</h2>
                    <p>In the top-right corner of the page header, you will find a dropdown menu labeled "Theme:".</p>
                    <img src="../images/help_theme_switcher.png" alt="A screenshot pointing to the theme switcher." class="help-image">
                </li>
                <li>
                    <h2>Step 2: Select Your Preferred Theme</h2>
                    <p>Click the dropdown menu and select one of the available options: "Default Dark," "Synthwave," or
                        "Minimalist Light." The website's look and feel will instantly change.</p>
                </li>
            </ol>

            <a href="index.php" class="back-link">&larr; Back to Help Menu</a>
        </div>
    </main>

    
    <?php require_once '../php/footer-help.php'; ?>
    



</body>

</html>