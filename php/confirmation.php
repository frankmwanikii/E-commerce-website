<?php
// Check if order was placed
if (!isset($_SESSION['order_placed']) || !$_SESSION['order_placed']) {
    header("Location: products.php");
    exit();
}

// Clear the cart after order confirmation
unset($_SESSION['cart']);
unset($_SESSION['order_placed']);

$pageTitle = "Order Confirmation";
require_once 'includes/header.php';
?>

<section class="order-confirmation">
    <div class="container">
        <div class="confirmation-content">
            <div class="confirmation-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Thank You for Your Order!</h1>
            <p class="order-number">Order #<?php echo rand(100000, 999999); ?></p>
            <p>Your order has been placed successfully. We've sent a confirmation email with your order details.</p>
            
            <div class="order-details">
                <h2>Order Details</h2>
                <div class="detail-row">
                    <span>Estimated Delivery</span>
                    <span><?php echo date('F j, Y', strtotime('+5 days')); ?></span>
                </div>
                <div class="detail-row">
                    <span>Shipping Address</span>
                    <span>
                        <?php echo htmlspecialchars($_SESSION['order_details']['shipping_address']); ?><br>
                        <?php echo htmlspecialchars($_SESSION['order_details']['shipping_city']); ?>, 
                        <?php echo htmlspecialchars($_SESSION['order_details']['shipping_state']); ?> 
                        <?php echo htmlspecialchars($_SESSION['order_details']['shipping_zip']); ?>
                    </span>
                </div>
                <div class="detail-row">
                    <span>Payment Method</span>
                    <span>
                        <?php 
                        $paymentMethod = $_SESSION['order_details']['payment_method'];
                        echo $paymentMethod === 'credit_card' ? 'Credit Card ending in ****' . substr($_SESSION['order_details']['card_number'], -4) : ucfirst($paymentMethod);
                        ?>
                    </span>
                </div>
            </div>
            
            <div class="confirmation-actions">
                <a href="products.php" class="btn btn-outline">Continue Shopping</a>
                <a href="index.php" class="btn">Back to Home</a>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>