<?php
//login.php

//start the session at the very beginning
session_start();

//include the database connection file
require_once 'php/db_connect.php';

$errors = [];

//check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    //validation
    if (empty($username)) {
        $errors[] = 'Username is required.';
    }
    if (empty($password)) {
        $errors[] = 'Password is required.';
    }

    //if there are no validation errors, proceed to check credentials
    if (empty($errors)) {
        //prepare a statement to select the user by username
        $stmt = $conn->prepare("SELECT id, username, nickname, password_hash, role FROM users WHERE username = ? AND is_active = 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        //check if a user was found
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            //verify the submitted password against the stored hash
            if (password_verify($password, $user['password_hash'])) {
                //password is correct
                session_regenerate_id(true);

                //store user data in the session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nickname'] = $user['nickname'];
                $_SESSION['role'] = $user['role'];

                //redirect to a profile page
                header("Location: profile.php");
                exit(); 
            } else {
                $errors[] = 'Invalid username or password.';
            }
        } else {
            $errors[] = 'Invalid username or password.';
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
    <title>Login | Apex Builds</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css" id="theme-stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="js/main.js" defer></script>

    <style>
        .content-container { max-width: 600px; margin: 2rem auto; background-color: var(--secondary-bg-color); padding: 2rem; border-radius: 8px; }
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        .form-group input { width: 100%; box-sizing: border-box; padding: 0.8rem; background-color: var(--primary-bg-color); color: var(--secondary-text-color); border: 1px solid var(--border-color); border-radius: 5px; font-size: 1rem; }
        .feedback-error { margin-bottom: 1.5rem; padding: 1rem; border-radius: 5px; text-align: center; font-weight: bold; background-color: #e76f51; color: white; }
        
        /*password container styles*/
        .password-container {
            position: relative;
            width: 100%;
        }

        /*input field styling - hides default browser icons*/
        .password-container input[type="password"],
        .password-container input[type="text"] {
            width: 100%;
            padding-right: 35px;
            box-sizing: border-box;
        }
        
        /*hide browser's default password toggle*/
        .password-container input::-ms-reveal,
        .password-container input::-ms-clear,
        .password-container input::-webkit-contacts-auto-fill-button,
        .password-container input::-webkit-credentials-auto-fill-button {
            display: none !important;
            visibility: hidden !important;
            width: 0;
            height: 0;
        }

        /*custom eye icon styling with blue color*/
        .password-container .fa-eye,
        .password-container .fa-eye-slash {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #4285f4; /*blue color*/
            z-index: 2;
            font-size: 1rem;
            opacity: 0.8;
            transition: all 0.2s ease;
        }

        .password-container .fa-eye:hover,
        .password-container .fa-eye-slash:hover {
            opacity: 1;
            color: #3367d6; /*slightly darker blue on hover*/
        }
    </style>
</head>
<body>
    <?php require_once 'php/header.php'; ?>

    <main>
        <div class="content-container">
            <h1>Log In</h1>
            
            <?php if (!empty($errors)): ?>
                <div class="feedback-error">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="post" id="login-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" required>
                        <i class="fa-solid fa-eye" id="togglePassword"></i>
                    </div>
                </div>
                <button type="submit" class="cta-button">Log In</button>
            </form>
            <p style="margin-top: 1rem;">Don't have an account? <a href="register.php">Register here</a>.</p>
        </div>
    </main>

    <?php require_once 'php/footer.php'; ?>
</body>
</html>
