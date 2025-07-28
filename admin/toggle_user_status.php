<?php
//admin/toggle_user_status.php

session_start();

//admin security check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    die("Access Denied.");
}

//check if a user ID is provided in the URL
if (isset($_GET['id'])) {
    require_once '../php/db_connect.php';
    
    $user_id_to_toggle = (int)$_GET['id'];
    
    //safety check: an admin cannot disable their own account
    if ($user_id_to_toggle == $_SESSION['user_id']) {
        header("Location: users.php?error=self");
        exit();
    }

    //get the current status of the user
    $stmt = $conn->prepare("SELECT is_active FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id_to_toggle);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        //determine the new status (if current is 1, new is 0, and vice-versa)
        $new_status = $user['is_active'] ? 0 : 1;
        
        //update the user's status in the database
        $update_stmt = $conn->prepare("UPDATE users SET is_active = ? WHERE id = ?");
        $update_stmt->bind_param("ii", $new_status, $user_id_to_toggle);
        $update_stmt->execute();
        $update_stmt->close();
    }
    
    $stmt->close();
    $conn->close();
}

//redirect back to the user list
header("Location: users.php");
exit();
?>