// ===============================
// GLOBAL CART STATE
// ===============================
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// ===============================
// SAVE CART
// ===============================
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
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

    cart.forEach(item => {
        subtotal += item.price * item.quantity;
        totalItems += item.quantity;
    });

    const tax = subtotal * 0.10;
    const serviceFee = cart.length > 0 ? 500 : 0;
    const total = subtotal + tax + serviceFee;

    cartBadge.textContent = totalItems;
    itemCountElement.textContent = totalItems;
    subtotalElement.textContent = `¥${subtotal.toLocaleString()}`;
    taxElement.textContent = `¥${tax.toLocaleString()}`;
    serviceFeeElement.textContent = `¥${serviceFee.toLocaleString()}`;
    totalElement.textContent = `¥${total.toLocaleString()}`;

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '';
        emptyCartSection.style.display = 'block';
        return;
    }

    emptyCartSection.style.display = 'none';
    cartItemsContainer.innerHTML = '';

    cart.forEach((item, index) => {
        const cartItem = document.createElement('div');
        cartItem.className = 'cart-item';

        cartItem.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <div class="cart-info">
                <h4>${item.name}</h4>
                <p>¥${item.price.toLocaleString()}</p>
                <div class="qty-control">
                    <button onclick="changeQty(${index}, -1)">-</button>
                    <span>${item.quantity}</span>
                    <button onclick="changeQty(${index}, 1)">+</button>
                </div>
            </div>
            <button onclick="removeItem(${index})">✕</button>
        `;

        cartItemsContainer.appendChild(cartItem);
    });
}

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