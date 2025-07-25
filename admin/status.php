<?php
//admin/status.php

session_start();

//admin security check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    die("Access Denied.");
}

//status check

//database Connection Check
$db_status = 'OFFLINE';
$db_message = 'Failed to connect.';
//use @ to suppress warnings on failure, we handle it manually
@include_once '../php/db_connect.php';
if (isset($conn) && $conn->ping()) {
    $db_status = 'ONLINE';
    $db_message = 'Connection successful.';
    $conn->close();
}

//external API Checks
function checkApiStatus($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5); //5-second timeout
    curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return ($http_code == 200) ? 'ONLINE' : 'OFFLINE';
}

$openWeatherApiKey = 'b7636538f6afd603a22c35a7b06e2a16';
$weatherApiUrl = "https://api.openweathermap.org/data/2.5/weather?lat=42.31&lon=-83.03&appid={$openWeatherApiKey}";
$exchangeApiUrl = 'https://api.exchangerate-api.com/v4/latest/CAD';

$weather_api_status = checkApiStatus($weatherApiUrl);
$exchange_api_status = checkApiStatus($exchangeApiUrl);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Status | Admin</title>
    <meta name="description" content="Live status monitor for the Apex Builds website's core services.">
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
        .content-container { max-width: 900px; margin: 2rem auto; background-color: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 1.5rem; }
        .admin-table th, .admin-table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .admin-table th { background-color: #f2f2f2; }
        .status-online { color: #28a745; font-weight: bold; }
        .status-offline { color: #dc3545; font-weight: bold; }
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
            <h1>Website Service Status</h1>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Database Connection</td>
                        <td><span class="status-<?php echo strtolower($db_status); ?>"><?php echo $db_status; ?></span></td>
                        <td><?php echo $db_message; ?></td>
                    </tr>
                    <tr>
                        <td>OpenWeatherMap API</td>
                        <td><span class="status-<?php echo strtolower($weather_api_status); ?>"><?php echo $weather_api_status; ?></span></td>
                        <td>Responds to requests.</td>
                    </tr>
                    <tr>
                        <td>ExchangeRate-API</td>
                        <td><span class="status-<?php echo strtolower($exchange_api_status); ?>"><?php echo $exchange_api_status; ?></span></td>
                        <td>Responds to requests.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    
    
</body>
</html>