<?php
// register.php

// Include the database connection file.
require_once 'php/db_connect.php';

// Start a session to manage user login state.
session_start();

$errors = [];
$success_message = '';

// Check if the form has been submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize user input.
    $username = trim($_POST['username']);
    $nickname = trim($_POST['nickname']); // This line was missing
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // --- Validation ---
    if (empty($username)) {
        $errors[] = 'Username is required.';
    }
    if (empty($nickname)) {
        $errors[] = 'Nickname is required.';
    }
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }
    if (empty($password)) {
        $errors[] = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters long.';
    }
    if ($password !== $password_confirm) {
        $errors[] = 'Passwords do not match.';
    }

    // If there are no validation errors, proceed to check the database.
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = 'Username or email already taken.';
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $insert_stmt = $conn->prepare("INSERT INTO users (username, nickname, email, password_hash) VALUES (?, ?, ?, ?)");
            $insert_stmt->bind_param("ssss", $username, $nickname, $email, $password_hash);

            if ($insert_stmt->execute()) {
                $success_message = 'Registration successful! You can now log in.';
            } else {
                $errors[] = 'Error: Could not register. Please try again later.';
            }
            $insert_stmt->close();
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Apex Builds</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css" id="theme-stylesheet">
    <script src="js/main.js" defer></script>

    <style>
        .content-container { max-width: 600px; margin: 2rem auto; background-color: var(--secondary-bg-color); padding: 2rem; border-radius: 8px; }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        .form-group input { width: 100%; padding: 0.8rem; background-color: var(--primary-bg-color); color: var(--secondary-text-color); border: 1px solid var(--border-color); border-radius: 5px; font-size: 1rem; }
        .feedback-success, .feedback-error { margin-bottom: 1.5rem; padding: 1rem; border-radius: 5px; text-align: center; font-weight: bold; }
        .feedback-success { background-color: #2a9d8f; color: white; }
        .feedback-error { background-color: #e76f51; color: white; }
    </style>
</head>
<body>
    <?php require_once 'php/header.php'; ?>

    <main>
        <div class="content-container">
            <h1>Create an Account</h1>
            
            <?php if (!empty($success_message)): ?>
                <div class="feedback-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if (!empty($errors)): ?>
                <div class="feedback-error">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="register.php" method="post" id="register-form">
                <div class="form-group">
                    <label for="nickname">Nickname (how your name will be displayed)</label>
                    <input type="text" id="nickname" name="nickname" required>
                </div>
                <div class="form-group">
                    <label for="username">Username (for logging in)</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password (min. 8 characters)</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirm Password</label>
                    <input type="password" id="password_confirm" name="password_confirm" required>
                </div>
                <button type="submit" class="cta-button">Register</button>
            </form>
            <p style="margin-top: 1rem;">Already have an account? <a href="login.php">Log in here</a>.</p>
        </div>
    </main>

    <?php require_once 'php/footer.php'; ?>
</body>
</html>