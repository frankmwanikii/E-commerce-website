<?php
$pageTitle = "Home";
require_once 'includes/header.php';
?>

<section class="hero">
    <div class="container">
        <h1>Custom Branded Merchandise</h1>
        <p>Create your own unique designs on our premium quality products</p>
        <a href="products.php" class="btn">Shop Now</a>
        <a href="design-upload.php" class="btn btn-outline">Upload Your Design</a>
    </div>
</section>

<section class="featured-products">
    <div class="container">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <?php
            $products = getProducts();
            $featuredProducts = array_slice($products, 0, 4); // Get first 4 products as featured
            foreach ($featuredProducts as $product): ?>
                <div class="product-card">
                    <img src="<?php echo SITE_URL; ?>/assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                    <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn">View Details</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="categories">
    <div class="container">
        <h2>Shop By Category</h2>
        <div class="category-grid">
            <a href="products.php?category=tshirt" class="category-card">
                <img src="<?php echo SITE_URL; ?>/assets/images/tshirt-category.jpg" alt="T-Shirts">
                <h3>T-Shirts</h3>
            </a>
            <a href="products.php?category=hoodie" class="category-card">
                <img src="<?php echo SITE_URL; ?>/assets/images/hoodie-category.jpg" alt="Hoodies">
                <h3>Hoodies</h3>
            </a>
            <a href="products.php?category=mug" class="category-card">
                <img src="<?php echo SITE_URL; ?>/assets/images/mug-category.jpg" alt="Mugs">
                <h3>Mugs</h3>
            </a>
            <a href="products.php?category=cap" class="category-card">
                <img src="<?php echo SITE_URL; ?>/assets/images/cap-category.jpg" alt="Caps">
                <h3>Caps</h3>
            </a>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>