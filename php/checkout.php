<?php
// Redirect to products if cart is empty
if (empty(getCartItems())) {
    header("Location: products.php");
    exit();
}

$pageTitle = "Checkout";
require_once 'includes/header.php';
?>

<section class="checkout">
    <div class="container">
        <h1>Checkout</h1>
        
        <div class="checkout-grid">
            <div class="checkout-form">
                <form id="checkout-form">
                    <fieldset>
                        <legend>Contact Information</legend>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                    </fieldset>
                    
                    <fieldset>
                        <legend>Shipping Address</legend>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first-name">First Name</label>
                                <input type="text" id="first-name" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name</label>
                                <input type="text" id="last-name" name="last_name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="address2">Apartment, suite, etc. (optional)</label>
                            <input type="text" id="address2" name="address2">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" id="city" name="city" required>
                            </div>
                            <div class="form-group">
                                <label for="state">State/Province</label>
                                <select id="state" name="state" required>
                                    <option value="">Select</option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <!-- Add all states here -->
                                    <option value="WY">Wyoming</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="zip">ZIP/Postal Code</label>
                                <input type="text" id="zip" name="zip" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select id="country" name="country" required>
                                <option value="US" selected>United States</option>
                                <option value="CA">Canada</option>
                                <!-- Add more countries as needed -->
                            </select>
                        </div>
                    </fieldset>
                    
                    <fieldset>
                        <legend>Payment Method</legend>
                        <div class="payment-methods">
                            <div class="payment-method">
                                <input type="radio" id="credit-card" name="payment_method" value="credit_card" checked>
                                <label for="credit-card">Credit Card</label>
                                <div class="payment-details">
                                    <div class="form-group">
                                        <label for="card-number">Card Number</label>
                                        <input type="text" id="card-number" name="card_number" placeholder="1234 5678 9012 3456">
                                    </div>
                                    <div class="form-group">
                                        <label for="card-name">Name on Card</label>
                                        <input type="text" id="card-name" name="card_name">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="card-expiry">Expiration Date</label>
                                            <input type="text" id="card-expiry" name="card_expiry" placeholder="MM/YY">
                                        </div>
                                        <div class="form-group">
                                            <label for="card-cvv">Security Code</label>
                                            <input type="text" id="card-cvv" name="card_cvv" placeholder="CVV">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-method">
                                <input type="radio" id="paypal" name="payment_method" value="paypal">
                                <label for="paypal">PayPal</label>
                            </div>
                        </div>
                    </fieldset>
                    
                    <div class="form-actions">
                        <a href="cart.php" class="btn btn-outline">Back to Cart</a>
                        <button type="submit" class="btn">Place Order</button>
                    </div>
                </form>
            </div>
            
            <div class="order-summary">
                <h2>Order Summary</h2>
                <div class="order-items">
                    <?php foreach (getCartItems() as $item): ?>
                        <div class="order-item">
                            <div class="item-image">
                                <?php if ($item['custom_design']): ?>
                                    <img src="<?php echo SITE_URL; ?>/assets/uploads/<?php echo $item['custom_design']; ?>" alt="Custom Design">
                                <?php else: ?>
                                    <img src="<?php echo SITE_URL; ?>/assets/images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="item-details">
                                <h3><?php echo $item['name']; ?></h3>
                                <p class="quantity">Qty: <?php echo $item['quantity']; ?></p>
                                <p class="price">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="summary-totals">
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
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>