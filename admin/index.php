<?php
//admin/index.php

session_start();

//admin security check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("HTTP/1.1 403 Forbidden");
    die("Access Denied. You do not have permission to view this page.");
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Apex Builds</title>
    <meta name="description" content="The main dashboard for managing the Apex Builds website.">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <h1>Admin Dashboard</h1>
            <p>Welcome, <?php echo htmlspecialchars($username); ?>!</p>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <h2>Total Orders</h2>
                    <p id="total-orders">Loading...</p>
                </div>
                <div class="stat-card">
                    <h2>Total Revenue</h2>
                    <p id="total-revenue">Loading...</p>
                </div>
            </div>
            
            <div class="dashboard-grid">
                <div class="menu-panel">
                    <h2>Navigation</h2>
                    <ul class="admin-menu">
                        <li><a href="products.php">Manage Products</a></li>
                        <li><a href="users.php">Manage Users</a></li>
                        <li><a href="messages.php">View Messages</a></li>
                        <li><a href="status.php">Website Status</a></li>
                        <li><a href="../index.php">Return to Main Site</a></li>
                    </ul>
                </div>

                <div class="chart-panel">
                    <h2>Products per Category</h2>
                    <canvas id="productsChart"></canvas>
                </div>
            </div>
        </div>
    </main>
    
       <script>
            document.addEventListener('DOMContentLoaded', function() {
                fetch('../php/api_admin_stats.php')
                    .then(response => response.json())
                    .then(data => {
                        //update stat cards
                        document.getElementById('total-orders').textContent = data.total_orders;
                        document.getElementById('total-revenue').textContent = '$' + parseFloat(data.total_revenue).toFixed(2);

                        //build the chart with new stock data
                        const productStats = data.products_per_category;
                        const labels = productStats.map(item => item.category);
                        const counts = productStats.map(item => item.total_stock); //use total_stock now

                        const ctx = document.getElementById('productsChart').getContext('2d');
                        const productsChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                label: 'Total Items in Stock',//new label
                                data: counts,
                                backgroundColor: 'rgba(75, 192, 192, 0.5)',//turquoise colour
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                            },
                            options: { scales: { y: { beginAtZero: true } } }
                        });
                    })
                    .catch(error => console.error('Error fetching dashboard data:', error));
            });
    </script>
    
    <style>
        body { font-family: Roboto, sans-serif; background-color: #f4f4f4; color: #333; margin: 0; }
        .admin-header { background-color: #212529; color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .admin-header h1 { font-family: 'Orbitron', sans-serif; font-size: 1.5rem; margin: 0; }
        .admin-header a { color: #f8f9fa; text-decoration: none; margin-left: 1.5rem; }
        .admin-header a:hover { text-decoration: underline; }
        .content-container { max-width: 1200px; margin: 2rem auto; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-top: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background-color: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .stat-card h2 { margin-top: 0; }
        .stat-card p { font-size: 2rem; font-weight: bold; margin-bottom: 0; }
        .dashboard-grid { display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; }
        .menu-panel, .chart-panel { background-color: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .admin-menu { list-style: none; padding: 0; }
        .admin-menu li { margin-bottom: 1rem; }
        .admin-menu a { display: block; background-color: #f8f9fa; padding: 1rem; border-radius: 5px; text-decoration: none; color: #333; font-weight: bold; }
        .admin-menu a:hover { background-color: #007bff; color: white; }
    </style>
</body>
</html>
