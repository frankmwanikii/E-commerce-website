// Sample product data
const products = [
    {
      id: 1,
      name: "Classic T-Shirt",
      price: 19.99,
      image: "tshirt1.jpg",
      category: "tshirt",
      description: "100% cotton, comfortable fit",
      material: "Cotton"
    },
    {
      id: 2,
      name: "Premium Hoodie", 
      price: 39.99,
      image: "hoodie1.jpg",
      category: "hoodie",
      description: "Warm fleece-lined hoodie",
      material: "Polyester"
    }
  ];
  
  // Cart functions
  function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || [];
  }
  
  function updateCartCount() {
    const cart = getCart();
    const count = cart.reduce((total, item) => total + item.quantity, 0);
    document.querySelectorAll('.cart-count').forEach(el => el.textContent = count);
  }
  
  // Initialize common elements
  document.addEventListener('DOMContentLoaded', () => {
    // Mobile menu toggle
    document.querySelector('.mobile-menu-toggle')?.addEventListener('click', () => {
      document.querySelector('.mobile-nav').classList.toggle('active');
    });
  
    // Set copyright year
    document.getElementById('year').textContent = new Date().getFullYear();
  
    // Update cart count
    updateCartCount();
  });