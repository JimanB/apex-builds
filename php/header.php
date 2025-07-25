<?php
//php/header.php

//start the session on every page that includes this header
session_start();

?>
<header>
    <div class="header-container">
        <a href="index.php" class="logo">APEX BUILDS</a>
        <nav class="main-nav">
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="components.php">Components</a></li>
                <li><a href="builder.php">PC Builder</a></li>
                <li><a href="about.php">About</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="profile.php">My Profile</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php endif; ?>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="help/index.php">Help</a></li>
            </ul>
        </nav>

        <div class="header-controls">
            <a href="cart.php" class="cart-icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <span id="cart-item-count" class="cart-badge" style="display: none;">0</span>
            </a>
            
            <div class="theme-switcher">
                <label for="theme-select">Theme:</label>
                <select id="theme-select">
                    <option value="css/style.css" data-key="default">Default Dark</option>
                    <option value="css/synthwave.css" data-key="synthwave">Synthwave</option>
                    <option value="css/light.css" data-key="light">Minimalist Light</option>
                </select>
            </div>
            
            <div class="hamburger-menu">&#9776;</div>
        </div>
    </div>
</header>