<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>How to Use the PC Builder | Apex Builds Help</title>
    <meta name="description"
        content="A step-by-step guide on how to use the Apex Builds PC Builder tool to select components and get a real-time price quote.">
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
            /* We use h2 for step numbers */
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

        .responsive-video {
            width: 100%;
            height: auto;
            display: block;
        }

    </style>

</head>

<body>

    
        <?php require_once '../php/header-help.php'; ?>
    
    <main>
        <div class="content-container">
            <h1>How to Use the PC Builder</h1>
            <p>This guide will walk you through the simple process of designing your custom PC and getting an instant
                price estimate.</p>

            <ol class="step-guide">
                <li>
                    <h2>Step 1: Select Your Components</h2>
                    <p>On the left side of the PC Builder page, you'll see a list of component categories like
                        "Processor," "Graphics Card," and "Memory." Click on the dropdown menu for each category to see
                        the available options and their prices. Simply select the part you want for each category.</p>
                    <video class="responsive-video" autoplay loop muted>
                        <source src="../media/builder-tutorial_1.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </li>
                <li>
                    <h2>Step 2: Watch Your Quote Update in Real-Time</h2>
                    <p>As you select components, look at the "Estimated Quote" box on the right. The total price will
                        automatically update with every change you make. There's no need to refresh the page!</p>
                    <video class="responsive-video" autoplay loop muted>
                        <source src="../media/builder-tutorial_2.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </li>
                <li>
                    <h2>Step 3: Convert to Your Local Currency</h2>
                    <p>Below the total price, you'll find a "View in:" dropdown. You can select USD or EURO to see an
                        approximate price in that currency, based on live exchange rates. This is for estimation
                        purposes only.</p>
                    <video class="responsive-video" autoplay loop muted>
                        <source src="../media/builder-tutorial_3.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </li>
                <li>
                    <h2>Step 4: Finalize Your Build</h2>
                    <p>Once you are happy with all your selections, you can click the "Add to Cart" button to finalize
                        your configuration.</p>
                </li>
            </ol>

            <a href="index.php" class="back-link">&larr; Back to Help Menu</a>
        </div>
    </main>

        <?php require_once '../php/footer-help.php'; ?>

    
</body>

</html>