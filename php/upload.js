document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('design-upload-form');
    const previewContainer = document.querySelector('.preview-container');
    const uploadForm = document.querySelector('.upload-form');
    const successMessage = document.querySelector('.success-message');
    const designPreview = document.getElementById('design-preview');
    const productPreviewImage = document.getElementById('product-preview-image');
    const backToUploadBtn = document.querySelector('.back-to-upload');
    const proceedToCartBtn = document.querySelector('.proceed-to-cart');
    
    let uploadedDesign = null;
    let selectedProductId = null;
    
    // Form submission for design upload
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            selectedProductId = formData.get('product_id');
            
            fetch('includes/upload-design.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    uploadedDesign = data.file_path;
                    
                    // Update preview
                    designPreview.src = data.file_url;
                    
                    // If product is already selected, update product preview
                    if (selectedProductId) {
                        updateProductPreview(selectedProductId);
                    }
                    
                    // Show preview step
                    goToStep(2);
                } else {
                    alert('Error uploading design: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while uploading the design.');
            });
        });
    }
    
    // Back to upload button
    if (backToUploadBtn) {
        backToUploadBtn.addEventListener('click', function() {
            goToStep(1);
        });
    }
    
    // Proceed to cart button
    if (proceedToCartBtn) {
        proceedToCartBtn.addEventListener('click', function() {
            if (!selectedProductId || !uploadedDesign) {
                alert('Please complete all steps first.');
                return;
            }
            
            // Add to cart
            fetch('includes/functions.php?action=add_to_cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `product_id=${selectedProductId}&custom_design=${uploadedDesign}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart count
                    const cartCount = document.querySelector('.cart-count');
                    if (cartCount) {
                        cartCount.textContent = data.cart_count;
                    }
                    
                    // Show success message
                    goToStep(3);
                } else {
                    alert('Error adding design to cart.');
                }
            });
        });
    }
    
    // Design preview controls
    const designSize = document.getElementById('design-size');
    const designOpacity = document.getElementById('design-opacity');
    const designPositionX = document.getElementById('design-position-x');
    const designPositionY = document.getElementById('design-position-y');
    
    if (designSize && designOpacity && designPositionX && designPositionY) {
        designSize.addEventListener('input', updateDesignPreview);
        designOpacity.addEventListener('input', updateDesignPreview);
        designPositionX.addEventListener('input', updateDesignPreview);
        designPositionY.addEventListener('input', updateDesignPreview);
    }
    
    // Function to update design preview
    function updateDesignPreview() {
        if (!designPreview) return;
        
        const size = designSize.value;
        const opacity = designOpacity.value / 100;
        const posX = designPositionX.value;
        const posY = designPositionY.value;
        
        designPreview.style.width = size + '%';
        designPreview.style.opacity = opacity;
        designPreview.style.left = posX + '%';
        designPreview.style.top = posY + '%';
        designPreview.style.transform = `translate(-${posX}%, -${posY}%)`;
    }
    
    // Function to update product preview image
    function updateProductPreview(productId) {
        fetch('includes/functions.php?action=get_product&id=' + productId)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    productPreviewImage.src = 'assets/images/' + data.product.image;
                }
            });
    }
    
    // Function to navigate between steps
    function goToStep(step) {
        document.querySelectorAll('.step').forEach(stepEl => {
            if (parseInt(stepEl.getAttribute('data-step')) <= step) {
                stepEl.classList.add('active');
            } else {
                stepEl.classList.remove('active');
            }
        });
        
        document.querySelectorAll('.step-content').forEach(content => {
            if (parseInt(content.getAttribute('data-step')) === step) {
                content.classList.add('active');
            } else {
                content.classList.remove('active');
            }
        });
    }
    
    // Initialize design preview if coming back to page
    if (designPreview && designPreview.src) {
        updateDesignPreview();
    }
});