</main>
    <footer>
        <div class="container">
            <div class="footer-section">
                <h3>About Koraa</h3>
                <p>Your premier destination for custom branded merchandise including t-shirts, hoodies, mugs, and more.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/products.php">Products</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/design-upload.php">Custom Design</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/cart.php">Cart</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@koraa.com</p>
                <p>Phone: +1 (123) 456-7890</p>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> Koraa. All rights reserved.</p>
        </div>
    </footer>
    <script src="<?php echo SITE_URL; ?>/assets/js/script.js"></script>
    <?php if (basename($_SERVER['PHP_SELF']) == 'cart.php'): ?>
        <script src="<?php echo SITE_URL; ?>/assets/js/cart.js"></script>
    <?php endif; ?>
    <?php if (basename($_SERVER['PHP_SELF']) == 'design-upload.php'): ?>
        <script src="<?php echo SITE_URL; ?>/assets/js/upload.js"></script>
    <?php endif; ?>
</body>
</html>