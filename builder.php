<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PC Builder | Apex Builds</title>
    <meta name="description"
        content="Use our interactive PC Builder to create your perfect custom gaming computer. Select components and get an instant real-time price quote.">
    <meta name="keywords" content="pc builder, price calculator, custom pc quote, computer parts picker">

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/style.css" id="theme-stylesheet">

    <script src="js/main.js" defer></script>
</head>

<body>

        <?php require_once 'php/header.php'; ?>

    <main>
        <div class="builder-header">
            <h1>Build Your Custom PC</h1>
            <a href="help/how-to-use-the-builder.php" class="help-link" title="How to use the builder">?</a>
        </div>

        <div class="builder-container">
            <form id="builder-form" class="component-selector" onsubmit="handleAddToCart(event)">
                <h2>1. Select Components</h2>
            </form>

            <div id="quote-summary" class="quote-summary">
                <h2>2. Estimated Quote</h2>
                <div class="price-display">
                    <p>Total (CAD):</p>
                    <span id="total-price">$0.00</span>
                </div>

                <div class="currency-converter">
                    <label for="currency-select">View in:</label>
                    <select id="currency-select">
                        <option value="CAD">CAD</option>
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                    </select>
                    <p id="converted-price-display"></p>
                </div>

                <button type="submit" form="builder-form" class="cta-button">Add to Cart</button>
            </div>
        </div>
    </main>

        <?php require_once 'php/footer.php'; ?>

</body>

</html>