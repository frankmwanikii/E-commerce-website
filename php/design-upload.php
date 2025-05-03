<?php
$productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : null;
$product = $productId ? getProductById($productId) : null;

$pageTitle = $product ? "Custom Design for " . $product['name'] : "Upload Your Design";
require_once 'includes/header.php';
?>

<section class="design-upload">
    <div class="container">
        <h1><?php echo $pageTitle; ?></h1>
        
        <div class="upload-steps">
            <div class="step active" data-step="1">
                <span>1</span>
                <p>Upload Design</p>
            </div>
            <div class="step" data-step="2">
                <span>2</span>
                <p>Preview</p>
            </div>
            <div class="step" data-step="3">
                <span>3</span>
                <p>Add to Cart</p>
            </div>
        </div>
        
        <div class="upload-container">
            <div class="upload-form step-content active" data-step="1">
                <form id="design-upload-form" enctype="multipart/form-data">
                    <?php if ($product): ?>
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <?php else: ?>
                        <div class="form-group">
                            <label for="product-select">Select Product:</label>
                            <select id="product-select" name="product_id" required>
                                <option value="">-- Select a product --</option>
                                <?php
                                $products = getProducts();
                                foreach ($products as $prod): ?>
                                    <option value="<?php echo $prod['id']; ?>"><?php echo $prod['name']; ?> ($<?php echo number_format($prod['price'], 2); ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="design-file">Upload Design:</label>
                        <input type="file" id="design-file" name="design_file" accept="image/*" required>
                        <p class="help-text">Accepted formats: JPG, PNG, GIF. Max size: 5MB.</p>
                    </div>
                    
                    <div class="form-group">
                        <label for="design-name">Design Name:</label>
                        <input type="text" id="design-name" name="design_name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="design-notes">Special Instructions:</label>
                        <textarea id="design-notes" name="design_notes" rows="4"></textarea>
                    </div>
                    
                    <button type="submit" class="btn">Preview Design</button>
                </form>
            </div>
            
            <div class="preview-container step-content" data-step="2">
                <div class="preview-wrapper">
                    <div class="product-preview">
                        <img id="product-preview-image" src="<?php echo $product ? SITE_URL . '/assets/images/' . $product['image'] : ''; ?>" alt="Product Preview">
                        <div class="design-overlay">
                            <img id="design-preview" src="" alt="Design Preview">
                        </div>
                    </div>
                    <div class="preview-controls">
                        <div class="control-group">
                            <label for="design-size">Design Size:</label>
                            <input type="range" id="design-size" min="50" max="150" value="100">
                        </div>
                        <div class="control-group">
                            <label for="design-opacity">Opacity:</label>
                            <input type="range" id="design-opacity" min="50" max="100" value="100">
                        </div>
                        <div class="control-group">
                            <label for="design-position-x">Position X:</label>
                            <input type="range" id="design-position-x" min="0" max="100" value="50">
                        </div>
                        <div class="control-group">
                            <label for="design-position-y">Position Y:</label>
                            <input type="range" id="design-position-y" min="0" max="100" value="50">
                        </div>
                    </div>
                </div>
                
                <div class="preview-actions">
                    <button class="btn btn-outline back-to-upload">Back</button>
                    <button class="btn proceed-to-cart">Add to Cart</button>
                </div>
            </div>
            
            <div class="success-message step-content" data-step="3">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2>Design Added to Cart!</h2>
                <p>Your custom design has been successfully added to your shopping cart.</p>
                <div class="success-actions">
                    <a href="products.php" class="btn btn-outline">Continue Shopping</a>
                    <a href="cart.php" class="btn">View Cart</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>