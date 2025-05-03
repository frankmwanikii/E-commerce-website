<?php
session_start();
require_once 'config.php';
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' . SITE_NAME : SITE_NAME; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITE_URL; ?>">Koraa</a>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/products.php">Products</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/design-upload.php">Custom Design</a></li>
                </ul>
            </nav>
            <div class="cart-icon">
                <a href="<?php echo SITE_URL; ?>/cart.php">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-count">
                        <?php 
                        $cartCount = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $item) {
                                $cartCount += $item['quantity'];
                            }
                        }
                        echo $cartCount;
                        ?>
                    </span>
                </a>
            </div>
            <div class="mobile-menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>
    <nav class="mobile-nav">
        <ul>
            <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
            <li><a href="<?php echo SITE_URL; ?>/products.php">Products</a></li>
            <li><a href="<?php echo SITE_URL; ?>/design-upload.php">Custom Design</a></li>
            <li><a href="<?php echo SITE_URL; ?>/cart.php">Cart</a></li>
        </ul>
    </nav>
    <main>