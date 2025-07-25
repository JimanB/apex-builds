<?php
//admin/change_user_role.php

session_start();

//admin security check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    die("Access Denied.");
}

//check if the required data was sent
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']) && isset($_POST['new_role'])) {
    require_once '../php/db_connect.php';
    
    $user_id_to_change = (int)$_POST['user_id'];
    $new_role = $_POST['new_role'];

    //make sure the new role is either 'customer' or 'admin'
    if ($new_role === 'customer' || $new_role === 'admin') {
        
        //safety check: an admin cannot change their own role
        if ($user_id_to_change == $_SESSION['user_id']) {
            header("Location: users.php?error=self_role_change");
            exit();
        }

        //update the user's role in the database
        $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $new_role, $user_id_to_change);
        $stmt->execute();
        $stmt->close();
    }
    
    $conn->close();
}

//redirect back to the user list
header("Location: users.php");
exit();
?>