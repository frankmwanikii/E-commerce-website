<?php
require_once 'config.php';

// Function to get products
function getProducts($category = null) {
    global $conn;
    
    $sql = "SELECT * FROM products";
    if ($category) {
        $sql .= " WHERE category = '$category'";
    }
    
    $result = $conn->query($sql);
    $products = array();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    
    return $products;
}

// Function to get product by ID
function getProductById($id) {
    global $conn;
    
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    return null;
}

// Function to add to cart
function addToCart($productId, $quantity = 1, $customDesign = null) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    $product = getProductById($productId);
    
    if ($product) {
        $cartItem = array(
            'id' => $productId,
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'image' => $product['image'],
            'custom_design' => $customDesign
        );
        
        $_SESSION['cart'][] = $cartItem;
        return true;
    }
    
    return false;
}

// Function to get cart items
function getCartItems() {
    return isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
}

// Function to calculate cart total
function getCartTotal() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    return $total;
}

// Function to remove item from cart
function removeFromCart($index) {
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        return true;
    }
    return false;
}

// Function to update cart item quantity
function updateCartItemQuantity($index, $quantity) {
    if (isset($_SESSION['cart'][$index])) {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
        return true;
    }
    return false;
}
?>