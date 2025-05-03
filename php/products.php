<?php
$category = isset($_GET['category']) ? $_GET['category'] : null;
$pageTitle = $category ? ucfirst($category) . " Products" : "All Products";
require_once 'includes/header.php';
?>

<section class="products-section">
    <div class="container">
        <div class="section-header">
            <h1><?php echo $pageTitle; ?></h1>
            <div class="sort-options">
                <label for="sort">Sort by:</label>
                <select id="sort">
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                    <option value="name_asc">Name: A to Z</option>
                    <option value="name_desc">Name: Z to A</option>
                </select>
            </div>
        </div>
        
        <div class="product-grid">
            <?php
            $products = getProducts($category);
            if (empty($products)): ?>
                <p class="no-products">No products found in this category.</p>
            <?php else:
                foreach ($products as $product): ?>
                    <div class="product-card">
                        <img src="<?php echo SITE_URL; ?>/assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        <h3><?php echo $product['name']; ?></h3>
                        <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                        <div class="product-actions">
                            <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn">View Details</a>
                            <button class="btn btn-outline add-to-cart" data-id="<?php echo $product['id']; ?>">Add to Cart</button>
                        </div>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>