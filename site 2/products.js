document.addEventListener('DOMContentLoaded', () => {
    const productGrid = document.getElementById('featured-products');
    
    if (productGrid) {
      // Display first 4 products as featured
      const featured = products.slice(0, 4);
      
      featured.forEach(product => {
        productGrid.innerHTML += `
          <div class="product-card">
            <img src="assets/images/${product.image}" alt="${product.name}">
            <h3>${product.name}</h3>
            <p class="price">$${product.price.toFixed(2)}</p>
            <a href="product-detail.html?id=${product.id}" class="btn">View Details</a>
          </div>
        `;
      });
    }
  });