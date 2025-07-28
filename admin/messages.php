<?php
// admin/messages.php

session_start();

// Admin security check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    die("Access Denied.");
}

require_once '../php/db_connect.php';

// Fetch all messages, newest first
$sql = "SELECT id, name, email, subject, message, submitted_at, is_read FROM contact_messages ORDER BY submitted_at DESC";
$result = $conn->query($sql);
$messages = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Messages | Admin</title>
    <meta name="description" content="Admin page to view contact form messages for Apex Builds.">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: Roboto, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; }
        .admin-header { background-color: #212529; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .admin-header h1 { font-family: 'Orbitron', sans-serif; font-size: 1.5rem; margin: 0; }
        .admin-header a { color: #f8f9fa; text-decoration: none; margin-left: 1.5rem; }
        .admin-header a:hover { text-decoration: underline; }
        .content-container { max-width: 1200px; margin: 2rem auto; background-color: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .message-card { border: 1px solid #ddd; border-radius: 8px; margin-top: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .message-card.unread { border-left: 5px solid #007bff; }
        .message-header { background-color: #f8f9fa; padding: 1rem; display: flex; justify-content: space-between; border-bottom: 1px solid #ddd; }
        .message-subject { padding: 1rem; font-size: 1.1rem; border-bottom: 1px solid #ddd; font-weight: bold; }
        .message-body { padding: 1rem; white-space: pre-wrap; line-height: 1.6; }
    </style>
</head>
<body>
    <header class="admin-header">
        <h1>APEX BUILDS ADMIN</h1>
        <nav>
            <a href="index.php">Dashboard</a>
            <a href="products.php">Products</a>
            <a href="users.php">Users</a>
            <a href="messages.php">Messages</a>
            <a href="../index.php" target="_blank">View Main Site</a>
            <a href="../logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <div class="content-container">
            <h1>Contact Form Messages</h1>

            <?php if (empty($messages)): ?>
                <p>There are no messages.</p>
            <?php else: ?>
                <?php foreach ($messages as $message): ?>
                    <div class="message-card <?php echo !$message['is_read'] ? 'unread' : ''; ?>">
                        <div class="message-header">
                            <div>
                                <strong>From:</strong> <?php echo htmlspecialchars($message['name']); ?> 
                                (&lt;<?php echo htmlspecialchars($message['email']); ?>&gt;)
                            </div>
                            <div>
                                <strong>Date:</strong> <?php echo date("F j, Y, g:i a", strtotime($message['submitted_at'])); ?>
                            </div>
                        </div>
                        <div class="message-subject">
                            <strong>Subject:</strong> <?php echo htmlspecialchars($message['subject']); ?>
                        </div>
                        <div class="message-body">
                            <?php echo nl2br(htmlspecialchars($message['message'])); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
    

</body>
</html>