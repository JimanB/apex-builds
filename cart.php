<?php
//cart.php
require_once 'php/header.php'; //includes session_start()

$cart_items = isset($_SESSION['cart']) && is_array($_SESSION['cart']) ? $_SESSION['cart'] : [];
$grand_total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Apex Builds</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css" id="theme-stylesheet">
    <script src="js/main.js" defer></script>

     <style>
        .content-container { max-width: 900px; margin: 2rem auto; background-color: var(--secondary-bg-color); padding: 2rem; border-radius: 8px; }
        .admin-table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        .admin-table th, .admin-table td { border: 1px solid var(--border-color); padding: 12px; text-align: left; }
        .admin-table th { background-color: var(--accent-color); color: var(--secondary-bg-color); }
        .admin-table tfoot th { font-size: 1.2rem; }
        .grand-total-box { text-align: right; margin-top: 2rem; border-top: 2px solid var(--accent-color); padding-top: 1.5rem; }
        .grand-total-box h3 { font-size: 1.8rem; margin-bottom: 1rem; }
        .cta-button { text-decoration: none; }
        .build-header { display: flex; justify-content: space-between; align-items: center; margin-top: 2rem; border-bottom: 2px solid var(--border-color); padding-bottom: 0.5rem; }
        .remove-link { color: #e76f51; font-size: 0.9rem; font-weight: bold; text-decoration: none; }
        .quantity-control { display: flex; align-items: center; gap: 0.8rem; }
        .qty-btn { display: inline-block; text-decoration: none; font-weight: bold; color: var(--primary-text-color); border: 1px solid var(--border-color); width: 25px; height: 25px; line-height: 23px; text-align: center; border-radius: 50%; }
        .qty-btn:hover { background-color: var(--accent-color); color: var(--secondary-bg-color); }
        .qty-text { font-weight: bold; font-size: 1.2rem; }
    </style>
</head>
<body>

    <?php require_once 'php/header.php'; ?>

    <main>
        <div class="content-container">
            <h1>Shopping Cart</h1>

            <?php if (empty($cart_items)): ?>
                <p>Your shopping cart is empty! Go to the <a href="builder.php">PC Builder</a> to configure a rig!</p>
            <?php else: ?>
                <?php foreach ($cart_items as $key => $item): ?>
                    <?php 
                        $build = $item['build'];
                        $quantity = $item['quantity'];
                        $build_total = 0;
                        foreach ($build as $component) {
                            if (isset($component['price']) && is_numeric($component['price'])) {
                                $build_total += $component['price'];
                            }
                        }
                        $sub_total = $build_total * $quantity;
                        $grand_total += $sub_total;
                    ?>
                    <div class="build-header">
                        <h2>Custom Build</h2>
                        <div class="quantity-control">
                            <a href="php/update_cart_quantity.php?key=<?php echo $key; ?>&change=-1" class="qty-btn">-</a>
                            <span class="qty-text"><?php echo $quantity; ?></span>
                            <a href="php/update_cart_quantity.php?key=<?php echo $key; ?>&change=1" class="qty-btn">+</a>
                        </div>
                        <a href="php/remove_from_cart.php?key=<?php echo $key; ?>" class="remove-link" onclick="return confirm('Are you sure?');">Remove</a>
                    </div>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Component</th>
                                <th>Selection</th>
                                <th style="text-align: right;">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($build as $component): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($component['category']); ?></td>
                                    <td><?php echo htmlspecialchars($component['name']); ?></td>
                                    <td style="text-align: right;">$<?php echo number_format($component['price'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" style="text-align: right;">Subtotal (<?php echo $quantity; ?> @ $<?php echo number_format($build_total, 2); ?> each):</th>
                                <th style="text-align: right;">$<?php echo number_format($sub_total, 2); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                <?php endforeach; ?>

                <div class="grand-total-box">
                    <h3>Grand Total: $<?php echo number_format($grand_total, 2); ?></h3>
                    <a href="checkout.php" class="cta-button">Proceed to Checkout</a>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php require_once 'php/footer.php'; ?>
    
   
</body>
</html>