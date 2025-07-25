<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apex Builds | Custom Gaming PC Builder</title>
    <meta name="description"
        content="Design and build your ultimate custom gaming PC with Apex Builds. Get an instant quote on high-performance PCs tailored to your needs.">
    <meta name="keywords"
        content="custom gaming pc, pc builder, build a pc, gaming computer, custom pc, rtx 4090, amd ryzen">

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
        <section class="hero">
             <video autoplay muted loop id="background-video">
                <source src="media/banner-video.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <div class="hero-content">
                <h1>Craft Your Perfect Gaming Rig</h1>
                <p>Top-tier components, instant quotes, and limitless possibilities. Start building now.</p>
                <a href="builder.php" class="cta-button">Start Building</a>
            </div>
        </section>

        <section class="featured-products">
            <h2>Featured Components</h2>
            <div class="product-grid" id="featured-grid">
            </div>
        </section>
    </main>

    
        <?php require_once 'php/footer.php'; ?>
    
</body>

</html>