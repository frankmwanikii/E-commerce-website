<?php
$pageTitle = "Shopping Cart";
require_once 'includes/header.php';
?>

<section class="shopping-cart">
    <div class="container">
        <h1>Your Shopping Cart</h1>
        
        <?php if (empty(getCartItems())): ?>
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h2>Your cart is empty</h2>
                <p>Looks like you haven't added anything to your cart yet.</p>
                <a href="products.php" class="btn">Browse Products</a>
            </div>
        <?php else: ?>
            <div class="cart-grid">
                <div class="cart-items">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (getCartItems() as $index => $item): ?>
                                <tr>
                                    <td class="product-info">
                                        <div class="product-image">
                                            <?php if ($item['custom_design']): ?>
                                                <img src="<?php echo SITE_URL; ?>/assets/uploads/<?php echo $item['custom_design']; ?>" alt="Custom Design">
                                            <?php else: ?>
                                                <img src="<?php echo SITE_URL; ?>/assets/images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="product-details">
                                            <h3><?php echo $item['name']; ?></h3>
                                            <?php if ($item['custom_design']): ?>
                                                <p class="custom-design-label">Custom Design</p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="price">$<?php echo number_format($item['price'], 2); ?></td>
                                    <td class="quantity">
                                        <input type="number" min="1" value="<?php echo $item['quantity']; ?>" data-index="<?php echo $index; ?>">
                                    </td>
                                    <td class="subtotal">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                    <td class="remove">
                                        <button class="remove-item" data-index="<?php echo $index; ?>"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="cart-summary">
                    <h2>Order Summary</h2>
                    <div class="summary-details">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>$<?php echo number_format(getCartTotal(), 2); ?></span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax</span>
                            <span>$<?php echo number_format(getCartTotal() * 0.1, 2); ?></span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span>$<?php echo number_format(getCartTotal() * 1.1, 2); ?></span>
                        </div>
                    </div>
                    <a href="checkout.php" class="btn checkout-btn">Proceed to Checkout</a>
                    <a href="products.php" class="continue-shopping">Continue Shopping</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>