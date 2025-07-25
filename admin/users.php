<?php
//admin/users.php

session_start();

//admin security check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    die("Access Denied.");
}

require_once '../php/db_connect.php';

//fetch all users from the database except the current admin
$sql = "SELECT id, username, email, role, is_active, created_at FROM users WHERE id != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | Admin</title>
    <meta name="description" content="Admin page to manage user accounts for Apex Builds.">
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
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 1.5rem; }
        .admin-table th, .admin-table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .admin-table th { background-color: #f2f2f2; }
        .admin-table tr:nth-child(even) { background-color: #f9f9f9; }
        .role-form select { padding: 5px; border-radius: 4px; border: 1px solid #ccc; cursor: pointer; }
        .status-active { color: #28a745; font-weight: bold; }
        .status-disabled { color: #6c757d; }
        .action-link { color: #007bff; text-decoration: none; font-weight: bold; }
        .action-link:hover { text-decoration: underline; }
        .action-link.delete { color: #dc3545; }
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
            <h1>Manage Users</h1>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <form action="change_user_role.php" method="post" class="role-form">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <select name="new_role" onchange="this.form.submit()">
                                            <option value="customer" <?php if ($user['role'] == 'customer') echo 'selected'; ?>>Customer</option>
                                            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                        </select>
                                    </form>
                                </td>
                                <td><?php echo $user['is_active'] ? '<span class="status-active">Active</span>' : '<span class="status-disabled">Disabled</span>'; ?></td>
                                <td>
                                    <?php if ($user['is_active']): ?>
                                        <a href="toggle_user_status.php?id=<?php echo $user['id']; ?>" class="action-link delete" onclick="return confirm('Are you sure you want to disable this user?');">Disable</a>
                                    <?php else: ?>
                                        <a href="toggle_user_status.php?id=<?php echo $user['id']; ?>" class="action-link" onclick="return confirm('Are you sure you want to enable this user?');">Enable</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No other users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
    
   
</body>
</html>