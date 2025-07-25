<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Headsets | Apex Builds</title>
    <meta name="description"
        content="Immerse yourself in the game with crystal-clear audio from our selection of wired and wireless gaming headsets.">
    <meta name="keywords" content="headset, gaming headset, wireless headset, headphones">

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/style.css" id="theme-stylesheet">

    <script src="js/main.js" defer></script>

    <style>
        .product-card p {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--primary-text-color);
            margin-top: 1rem;
        }
    </style>
</head>

<body data-category="Headset">

    
       <?php require_once 'php/header.php'; ?>
    

    <main>
        <h1 id="category-title">Loading Products...</h1>
        <div id="product-listing-grid" class="product-grid">
        </div>
    </main>

    <?php require_once 'php/footer-comp.php'; ?>

    

</body>

</html>