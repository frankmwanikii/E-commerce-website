document.addEventListener('DOMContentLoaded', () => {
    const cartItemsEl = document.getElementById('cart-items');
    const cartSummaryEl = document.getElementById('cart-summary');
    const cart = getCart();
  
    // Render cart items
    if (cartItemsEl) {
      if (cart.length === 0) {
        cartItemsEl.innerHTML = `
          <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <h2>Your cart is empty</h2>
            <p>Looks like you haven't added anything to your cart yet.</p>
            <a href="products.html" class="btn">Browse Products</a>
          </div>
        `;
      } else {
        cartItemsEl.innerHTML = `
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
              ${cart.map((item, index) => `
                <tr>
                  <td class="product-info">
                    <div class="product-image">
                      <img src="assets/images/${item.image}" alt="${item.name}">
                    </div>
                    <div class="product-details">
                      <h3>${item.name}</h3>
                      ${item.customDesign ? '<p class="custom-design-label">Custom Design</p>' : ''}
                    </div>
                  </td>
                  <td class="price">$${item.price.toFixed(2)}</td>
                  <td class="quantity">
                    <input type="number" min="1" value="${item.quantity}" data-index="${index}">
                  </td>
                  <td class="subtotal">$${(item.price * item.quantity).toFixed(2)}</td>
                  <td class="remove">
                    <button class="remove-item" data-index="${index}"><i class="fas fa-times"></i></button>
                  </td>
                </tr>
              `).join('')}
            </tbody>
          </table>
        `;
      }
    }
  
    // Render summary
    if (cartSummaryEl) {
      const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
      const tax = subtotal * 0.1;
      const total = subtotal + tax;
  
      cartSummaryEl.innerHTML = `
        <div class="summary-row">
          <span>Subtotal</span>
          <span>$${subtotal.toFixed(2)}</span>
        </div>
        <div class="summary-row">
          <span>Shipping</span>
          <span>Free</span>
        </div>
        <div class="summary-row">
          <span>Tax</span>
          <span>$${tax.toFixed(2)}</span>
        </div>
        <div class="summary-row total">
          <span>Total</span>
          <span>$${total.toFixed(2)}</span>
        </div>
      `;
    }
  });