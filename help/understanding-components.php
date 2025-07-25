<?php
//help/understanding-components.php
//to be consistent with the user's other files.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Understanding PC Components | Apex Builds Help</title>
    <meta name="description"
        content="Learn what each major PC component does, from the CPU and GPU to RAM and storage. A beginner's guide to computer hardware.">
    <meta name="keywords" content="help, support, documentation, pc builder guide, faq">

    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">

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
            <h1>Understanding PC Components</h1>
            <p>Building a PC can seem complex, but it's easier when you know what each part does. Here’s a quick rundown
                of the core components and peripherals.</p>

            <div class="component-definitions">
                <h2>Processor (CPU)</h2>
                <p>The Central Processing Unit (CPU) is the "brain" of the computer. It performs calculations and executes commands, determining the overall speed of the PC for most tasks.</p>

                <h2>Graphics Card (GPU)</h2>
                <p>The Graphics Processing Unit (GPU) is a specialized processor that renders all the images, videos, and animations you see on your monitor. It is the most important component for high-performance gaming.</p>

                <h2>Memory (RAM)</h2>
                <p>Random Access Memory (RAM) is the PC's high-speed, short-term memory. It holds data for currently running applications. More RAM allows for smoother multitasking and better performance in demanding games.</p>

                <h2>Motherboard</h2>
                <p>The motherboard is the "central nervous system" that connects every component. It's a large circuit board that allows the CPU, GPU, RAM, storage, and other parts to communicate with each other.</p>

                <h2>Storage (SSD/HDD)</h2>
                <p>Storage is the PC's long-term memory, where your operating system, games, and files are saved. Solid State Drives (SSDs) are significantly faster than traditional Hard Disk Drives (HDDs), resulting in much quicker boot times and game loading screens.</p>

                <h2>Power Supply (PSU)</h2>
                <p>The Power Supply Unit (PSU) converts electricity from your wall outlet into usable power for all your components. A high-quality, reliable PSU is essential for system stability and safety.</p>

                <h2>Case Fans</h2>
                <p>These are crucial for managing temperature by moving cool air into the PC case and pushing hot air out. Proper airflow from case fans prevents components from overheating and improves performance and longevity.</p>
                
                <h2>Operating System (OS)</h2>
                <p>The OS is the core software that manages all the hardware and software on your computer. It provides the user interface you interact with. For most gaming PCs, this will be a version of Windows.</p>

                <h2>Monitor</h2>
                <p>Also known as a display, the monitor shows the visual output from the graphics card. For gaming, key features are resolution (like 1080p or 1440p) and refresh rate (measured in Hz), which determines how smooth the motion appears.</p>

                <h2>Keyboard & Mouse</h2>
                <p>These are your primary input devices for controlling the PC. Gaming keyboards often use mechanical switches for better feedback, while gaming mice feature precise sensors for accurate aiming.</p>

                <h2>Headset, Microphone & Speakers</h2>
                <p>These are your audio peripherals. A headset combines headphones for immersive sound with a microphone for voice chat. Standalone microphones offer higher quality for streaming, while speakers provide external audio.</p>

                <h2>Wi-Fi Adapter</h2>
                <p>This component allows your PC to connect to the internet wirelessly. While many motherboards have Wi-Fi built-in, an adapter card can be added to provide or upgrade wireless capabilities.</p>

                <h2>Custom Cables</h2>
                <p>These are replacement power supply cables that are individually sleeved in colored material. Their purpose is purely aesthetic, allowing you to customize the look of your PC's interior and create a cleaner build.</p>
            </div>

            <a href="index.php" class="back-link">&larr; Back to Help Menu</a>
        </div>
    </main>

   
        <?php require_once '../php/footer-help.php'; ?>
    

    
</body>
</html>