<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>All Components | Apex Builds</title>
    <meta name="description"
        content="Browse all available component categories for your custom PC build, including CPUs, GPUs, RAM, and more.">
    <meta name="keywords" content="components, pc parts, catalogue, all products">

    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="css/style.css" id="theme-stylesheet">

    <script src="js/main.js" defer></script>

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

   
        <?php require_once 'php/header.php'; ?>
    

    <main>
        <div class="content-container">
            <h1>All Components</h1>
            <p>Select a category below to see all available options.</p>

            <ul class="help-menu">
                <li><a href="cpu.php">Processors (CPU)</a></li>
                <li><a href="gpu.php">Graphics Cards (GPU)</a></li>
                <li><a href="motherboard.php">Motherboards</a></li>
                <li><a href="ram.php">Memory (RAM)</a></li>
                <li><a href="ssd.php">Solid State Drives (SSD)</a></li>
                <li><a href="psu.php">Power Supplies (PSU)</a></li>
                <li><a href="case.php">PC Cases</a></li>
                <li><a href="cooler.php">CPU Coolers</a></li>
                <li><a href="fans.php">Case Fans</a></li>
                <li><a href="os.php">Operating Systems</a></li>
                <li><a href="hdd.php">Hard Drives</a></li>
                <li><a href="monitor.php">Monitors</a></li>
                <li><a href="keyboard.php">Keyboards</a></li>
                <li><a href="mouse.php">Mice</a></li>
                <li><a href="headset.php">Headsets</a></li>
                <li><a href="webcam.php">Webcams</a></li>
                <li><a href="microphone.php">Microphones</a></li>
                <li><a href="speakers.php">Speakers</a></li>
                <li><a href="wifi.php">Wi-Fi Adapters</a></li>
                <li><a href="cables.php">Custom Cables</a></li>
            </ul>
        </div>
    </main>

       <?php require_once 'php/footer.php'; ?>


</body>

</html>