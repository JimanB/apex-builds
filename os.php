<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--SEO meta tags-->
    <title>Operating Systems | Apex Builds</title>
    <meta name="description"
        content="Choose your operating system. We offer the latest versions of Windows for your custom gaming PC.">
    <meta name="keywords" content="operating system, os, windows 11, windows 11 pro">

    <!--favicon-->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">

    <!--main stylesheet-->
    <link rel="stylesheet" href="css/style.css" id="theme-stylesheet">

    <!--javaScript file-->
    <script src="js/main.js" defer></script>

    <!--page-specific styles-->
    <style>
        .product-card p {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--primary-text-color);
            margin-top: 1rem;
        }
    </style>
</head>

<body data-category="OS">

    <!--header section-->
    
        <?php require_once 'php/header.php'; ?>
    

    <!--main content area-->
    <main>
        <h1 id="category-title">Loading Products...</h1>
        <div id="product-listing-grid" class="product-grid">
            <!--product cards will be dynamically inserted here by javaScript-->
        </div>
    </main>

    <!--footer section-->
    <?php require_once 'php/footer-comp.php'; ?>

    

</body>

</html>