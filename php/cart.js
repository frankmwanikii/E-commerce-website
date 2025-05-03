document.addEventListener('DOMContentLoaded', function() {
    // Update cart item quantity
    const quantityInputs = document.querySelectorAll('.quantity input');
    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            const index = this.getAttribute('data-index');
            const quantity = parseInt(this.value);
            
            if (quantity < 1) {
                this.value = 1;
                return;
            }
            
            fetch('includes/functions.php?action=update_cart_item', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `index=${index}&quantity=${quantity}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the subtotal for this item
                    const row = this.closest('tr');
                    if (row) {
                        const price = parseFloat(row.querySelector('.price').textContent.replace('$', ''));
                        const subtotal = row.querySelector('.subtotal');
                        subtotal.textContent = '$' + (price * quantity).toFixed(2);
                    }
                    
                    // Update cart totals
                    updateCartTotals(data.cart_total);
                    
                    // Update cart count in header
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.cart_count;
                    }
                }
            });
        });
    });
    
    // Remove item from cart
    const removeButtons = document.querySelectorAll('.remove-item');
    removeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const index = this.getAttribute('data-index');
            
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                fetch('includes/functions.php?action=remove_from_cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `index=${index}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the row from the table
                        const row = this.closest('tr');
                        if (row) {
                            row.remove();
                        }
                        
                        // Update cart totals
                        updateCartTotals(data.cart_total);
                        
                        // Update cart count in header
                        const cartCount = document.querySelector('.cart-count');
                        if (cartCount) {
                            cartCount.textContent = data.cart_count;
                        }
                        
                        // If cart is empty, show empty cart message
                        if (data.cart_count == 0) {
                            document.querySelector('.cart-items').innerHTML = `
                                <div class="empty-cart">
                                    <i class="fas fa-shopping-cart"></i>
                                    <h2>Your cart is empty</h2>
                                    <p>Looks like you haven't added anything to your cart yet.</p>
                                    <a href="products.php" class="btn">Browse Products</a>
                                </div>
                            `;
                        }
                    }
                });
            }
        });
    });
    
    // Function to update cart totals
    function updateCartTotals(cartTotal) {
        const subtotalElements = document.querySelectorAll('.summary-row:not(.total) span:last-child');
        const totalElements = document.querySelectorAll('.summary-row.total span:last-child');
        
        // Update subtotal
        const subtotal = parseFloat(cartTotal).toFixed(2);
        subtotalElements.forEach(el => {
            if (el.textContent.includes('Subtotal')) {
                el.textContent = '$' + subtotal;
            } else if (el.textContent.includes('Tax')) {
                const tax = (cartTotal * 0.1).toFixed(2);
                el.textContent = '$' + tax;
            }
        });
        
        // Update total
        const total = (cartTotal * 1.1).toFixed(2);
        totalElements.forEach(el => {
            el.textContent = '$' + total;
        });
    }
});