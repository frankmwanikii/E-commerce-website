<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: products.php");
    exit();
}

$productId = intval($_GET['id']);
$product = getProductById($productId);

if (!$product) {
    header("Location: products.php");
    exit();
}

$pageTitle = $product['name'];
require_once 'includes/header.php';
?>

<section class="product-detail">
    <div class="container">
        <div class="product-detail-grid">
            <div class="product-images">
                <div class="main-image">
                    <img src="<?php echo SITE_URL; ?>/assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                </div>
            </div>
            <div class="product-info">
                <h1><?php echo $product['name']; ?></h1>
                <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                <p class="description"><?php echo $product['description']; ?></p>
                
                <div class="product-options">
                    <div class="option">
                        <label for="size">Size:</label>
                        <select id="size">
                            <option value="S">Small</option>
                            <option value="M" selected>Medium</option>
                            <option value="L">Large</option>
                            <option value="XL">X-Large</option>
                        </select>
                    </div>
                    <div class="option">
                        <label for="color">Color:</label>
                        <select id="color">
                            <option value="white">White</option>
                            <option value="black">Black</option>
                            <option value="gray">Gray</option>
                            <option value="blue">Blue</option>
                            <option value="red">Red</option>
                        </select>
                    </div>
                    <div class="option">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" min="1" value="1">
                    </div>
                </div>
                
                <div class="product-actions">
                    <button class="btn add-to-cart" data-id="<?php echo $product['id']; ?>">Add to Cart</button>
                    <a href="design-upload.php?product_id=<?php echo $product['id']; ?>" class="btn btn-outline">Upload Custom Design</a>
                </div>
                
                <div class="product-meta">
                    <p><strong>Category:</strong> <?php echo ucfirst($product['category']); ?></p>
                    <p><strong>Material:</strong> <?php echo $product['material']; ?></p>
                    <p><strong>Availability:</strong> In Stock</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="related-products">
    <div class="container">
        <h2>Related Products</h2>
        <div class="product-grid">
            <?php
            $relatedProducts = getProducts($product['category']);
            $relatedProducts = array_filter($relatedProducts, function($p) use ($productId) {
                return $p['id'] != $productId;
            });
            $relatedProducts = array_slice($relatedProducts, 0, 4);
            
            if (empty($relatedProducts)): ?>
                <p class="no-products">No related products found.</p>
            <?php else:
                foreach ($relatedProducts as $relatedProduct): ?>
                    <div class="product-card">
                        <img src="<?php echo SITE_URL; ?>/assets/images/<?php echo $relatedProduct['image']; ?>" alt="<?php echo $relatedProduct['name']; ?>">
                        <h3><?php echo $relatedProduct['name']; ?></h3>
                        <p class="price">$<?php echo number_format($relatedProduct['price'], 2); ?></p>
                        <a href="product-detail.php?id=<?php echo $relatedProduct['id']; ?>" class="btn">View Details</a>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>