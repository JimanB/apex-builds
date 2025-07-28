<?php
//contact.php

$feedback_message = '';
$feedback_class = '';

//check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'php/db_connect.php';

    //get form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    //server-side validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $feedback_message = 'Please fill out all fields.';
        $feedback_class = 'feedback-error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $feedback_message = 'Please provide a valid email address.';
        $feedback_class = 'feedback-error';
    } else {
        //insert message into the database
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            $feedback_message = 'Thank you! Your message has been sent successfully.';
            $feedback_class = 'feedback-success';
        } else {
            $feedback_message = 'Sorry, there was an error sending your message. Please try again later.';
            $feedback_class = 'feedback-error';
        }
        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us | Apex Builds</title>
    <meta name="description"
        content="Get in touch with the Apex Builds team for support, sales inquiries, or questions about your custom PC build.">
    <meta name="keywords" content="contact apex builds, pc support, sales inquiry, custom pc help">

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
            max-width: 800px;
            margin: 2rem auto;
             
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            background-color: var(--primary-bg-color);
            color: var(--secondary-text-color);
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 1rem;
            font-family: var(--font-main);
            box-sizing: border-box;
        }
        #form-feedback {
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }
        .feedback-success {
            background-color: #2a9d8f;
            color: white;
        }
        .feedback-error {
            background-color: #e76f51;
            color: white;
        }
        .map-container {
            margin: 2.5rem 0;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
        }
        .map-container h3 {
            padding: 1rem;
            margin: 0;
            background-color: var(--primary-bg-color);
        }
    </style>
</head>

<body>
        <?php require_once 'php/header.php'; ?>

    <main>
        <div class="content-container">
            <h1>Contact Us</h1>
            <p>Have a question about a build? Need help with an order? Or just want to talk specs? Fill out the form
                below and a member of our expert team will get back to you as soon as possible.</p>
            
            <?php if (!empty($feedback_message)): ?>
                <div id="form-feedback" class="<?php echo $feedback_class; ?>"><?php echo $feedback_message; ?></div>
            <?php endif; ?>
            
            <form id="contact-form" action="contact.php" method="post">
                <div class="form-group">
                    <label for="contact-name">Full Name</label>
                    <input type="text" id="contact-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="contact-email">Email Address</label>
                    <input type="email" id="contact-email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="contact-subject">Subject</label>
                    <input type="text" id="contact-subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="contact-message">Message</label>
                    <textarea id="contact-message" name="message" rows="6" required></textarea>
                </div>
                <button type="submit" class="cta-button">Send Message</button>
            </form>
            <div class="map-container">
              <h3>Our Location: Erie Hall</h3>
             <iframe
                   src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2950.7512094283857!2d-83.06786832321188!3d42.30517377119814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x883b2d76fb7a6d77%3A0x75c782520849e124!2sErie%20Hall!5e0!3m2!1sen!2sca!4v1753318359030!5m2!1sen!2sca" 
                   height="450" 
                   style="width:100%; border:0;" 
                   allowfullscreen="" 
                   loading="lazy" 
                   referrerpolicy="no-referrer-when-downgrade">
               </iframe>
             </div>
             <p> If you would like a more personal touch, come visit us at our offices in Erie Hall. we are located at Erie Hall Room 3150, Sunset Ave, Windsor, ON Posal Code: N9B 3P4
             </p>
        </div>
    </main>

        <?php require_once 'php/footer.php'; ?>

    
</body>
</html>