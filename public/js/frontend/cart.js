// ===============================
// GLOBAL CART STATE
// ===============================
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// ===============================
// SAVE CART
// ===============================
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartBadge();
}

// ===============================
// UPDATE CART BADGE
// ===============================
function updateCartBadge() {
    const cartBadges = document.querySelectorAll('.cart-count, #cart-badge');
    let totalItems = 0;
    
    // Count from array format (products)
    if (Array.isArray(cart)) {
        cart.forEach(item => {
            totalItems += item.quantity || 1;
        });
    } else {
        // Count from object format (vouchers)
        Object.values(cart).forEach(item => {
            totalItems += item.quantity || 1;
        });
    }
    
    cartBadges.forEach(badge => {
        badge.textContent = totalItems;
    });
}

// ===============================
// FETCH PRODUCTS FROM API
// ===============================
async function loadProducts() {
    try {
        const response = await fetch('/api/products');
        const products = await response.json();

        const productContainer = document.getElementById('product-list');
        productContainer.innerHTML = '';

        products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'product-card';

            productCard.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <h3>${product.name}</h3>
                <p>${product.description || ''}</p>
                <div class="price">¥${Number(product.price).toLocaleString()}</div>
                <button class="add-to-cart-btn" data-id="${product.id}">
                    Add to Cart
                </button>
            `;

            productContainer.appendChild(productCard);
        });

        bindAddToCartButtons(products);
    } catch (error) {
        console.error('Failed to load products:', error);
    }
}

// ===============================
// ADD TO CART BUTTON HANDLER
// ===============================
function bindAddToCartButtons(products) {
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const productId = btn.dataset.id;
            const product = products.find(p => p.id == productId);

            if (!product) return;

            const existingItem = cart.find(item => item.id == product.id);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: Number(product.price),
                    image: product.image,
                    type: product.category || 'product',
                    description: product.description || '',
                    details: product.details || '',
                    quantity: 1
                });
            }

            saveCart();
            updateCartDisplay();
        });
    });
}

// ===============================
// CART UI UPDATE
// ===============================
function updateCartDisplay() {
    const cartItemsContainer = document.getElementById('cart-items');
    const emptyCartSection = document.getElementById('empty-cart');
    const cartBadge = document.getElementById('cart-badge');
    const itemCountElement = document.getElementById('item-count');
    const subtotalElement = document.getElementById('subtotal');
    const taxElement = document.getElementById('tax');
    const serviceFeeElement = document.getElementById('service-fee');
    const totalElement = document.getElementById('total');

    let subtotal = 0;
    let totalItems = 0;
    let cartArray = [];

    // Convert cart object (vouchers) to array format if needed
    if (typeof cart === 'object' && !Array.isArray(cart)) {
        Object.values(cart).forEach(item => {
            cartArray.push({
                id: item.id,
                name: item.name,
                price: item.price,
                quantity: item.quantity,
                type: item.type || 'voucher',
                description: item.description || '',
                badge: item.badge || '',
                image: null
            });
        });
    } else {
        cartArray = cart;
    }

    // Calculate totals
    cartArray.forEach(item => {
        subtotal += (item.price || 0) * (item.quantity || 1);
        totalItems += item.quantity || 1;
    });

    const tax = subtotal * 0.10;
    const serviceFee = cartArray.length > 0 ? 5000 : 0;
    const total = subtotal + tax + serviceFee;

    if (cartBadge) cartBadge.textContent = totalItems;
    if (itemCountElement) itemCountElement.textContent = totalItems;
    if (subtotalElement) subtotalElement.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
    if (taxElement) taxElement.textContent = `Rp ${tax.toLocaleString('id-ID')}`;
    if (serviceFeeElement) serviceFeeElement.textContent = `Rp ${serviceFee.toLocaleString('id-ID')}`;
    if (totalElement) totalElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;

    if (!cartItemsContainer) return;

    if (cartArray.length === 0) {
        cartItemsContainer.innerHTML = '';
        if (emptyCartSection) emptyCartSection.style.display = 'block';
        return;
    }

    if (emptyCartSection) emptyCartSection.style.display = 'none';
    cartItemsContainer.innerHTML = '';

    cartArray.forEach((item, index) => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';

        // Determine icon based on type
        let icon = 'fa-gift';
        let categoryLabel = item.badge || item.type || 'item';
        
        if (item.type === 'experience') icon = 'fa-utensils';
        if (item.type === 'discount' || item.type === 'discount_vouchers') icon = 'fa-percentage';
        if (item.type === 'meal' || item.type === 'meal_add_ons') icon = 'fa-wine-glass-alt';

        let itemImageHtml = item.image 
            ? `<img src="${item.image}" alt="${item.name}">`
            : `<i class="fas ${icon}"></i>`;

        cartItem.innerHTML = `
            <div class="cart-item-image${item.image ? '' : ' voucher'}">
                ${itemImageHtml}
            </div>
            <div class="cart-item-content">
                <div class="cart-item-header">
                    <div>
                        <div class="cart-item-title">${item.name}</div>
                        <span class="cart-item-category">${categoryLabel}</span>
                    </div>
                    <div class="cart-item-price">Rp ${Number(item.price || 0).toLocaleString('id-ID')}</div>
                </div>
                <div class="cart-item-details">
                    <p>${item.description || ''}</p>
                </div>
                <div class="cart-item-controls">
                    <div class="quantity-controls">
                        <button class="qty-btn decrease-qty" onclick="changeQty(${index}, -1)">-</button>
                        <span class="qty-value">${item.quantity}</span>
                        <button class="qty-btn increase-qty" onclick="changeQty(${index}, 1)">+</button>
                    </div>
                    <button class="remove-item" onclick="removeItem(${index})">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
            </div>
        `;

        cartItemsContainer.appendChild(cartItem);
    });
}

// ===============================
// CART ACTIONS
// ===============================
function changeQty(index, delta) {
    // Convert to array if needed
    let cartArray = Array.isArray(cart) ? cart : Object.values(cart);
    
    cartArray[index].quantity += delta;

    if (cartArray[index].quantity <= 0) {
        cartArray.splice(index, 1);
    }

    // Update cart in appropriate format
    if (Array.isArray(cart)) {
        cart = cartArray;
    } else {
        // Convert back to object format if it was originally
        const newCart = {};
        cartArray.forEach(item => {
            newCart[`voucher-${item.id}`] = item;
        });
        cart = newCart;
    }

    saveCart();
    updateCartDisplay();
}

function removeItem(index) {
    // Convert to array if needed
    let cartArray = Array.isArray(cart) ? cart : Object.values(cart);
    
    cartArray.splice(index, 1);

    // Update cart in appropriate format
    if (Array.isArray(cart)) {
        cart = cartArray;
    } else {
        // Convert back to object format if it was originally
        const newCart = {};
        cartArray.forEach(item => {
            newCart[`voucher-${item.id}`] = item;
        });
        cart = newCart;
    }

    saveCart();
    updateCartDisplay();
}

// Init on page load
document.addEventListener('DOMContentLoaded', () => {
    updateCartDisplay();
});

// ===============================
// CART ACTIONS
// ===============================
function changeQty(index, delta) {
    cart[index].quantity += delta;

    if (cart[index].quantity <= 0) {
        cart.splice(index, 1);
    }

    saveCart();
    updateCartDisplay();
}

function removeItem(index) {
    cart.splice(index, 1);
    saveCart();
    updateCartDisplay();
}

// ===============================
// INIT
// ===============================
document.addEventListener('DOMContentLoaded', () => {
    loadProducts();
    updateCartDisplay();
});