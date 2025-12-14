// ===============================
// GLOBAL CART STATE
// ===============================
let cart = JSON.parse(localStorage.getItem('cart')) || {};

function getCartArray() {
    if (typeof cart === 'object' && !Array.isArray(cart)) {
        return Object.entries(cart).map(([key, item], idx) => ({
            ...item,
            _key: key || `item-${idx}`
        }));
    }
    return (cart || []).map((item, idx) => ({ ...item, _key: item._key || `item-${idx}` }));
}

// ===============================
// SAVE CART
// ===============================
function saveCart() {
    // Preserve the original format (object or array)
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
                <div class="price">Rp${Number(product.price).toLocaleString('id-ID')}</div>
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

            let cartArray = Array.isArray(cart) ? cart : Object.values(cart);

            const existingItem = cartArray.find(item => item.id == product.id);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cartArray.push({
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

            cart = cartArray;
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

    cartArray = getCartArray().map(item => ({
        ...item,
        type: item.type || 'voucher',
        description: item.description || '',
        badge: item.badge || '',
        image: item.image || null
    }));

    // Calculate totals
    cartArray.forEach(item => {
        const linePrice = item.totalPrice || (item.price || 0) * (item.quantity || 1);
        subtotal += linePrice;
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
        if (item.type === 'reservation') icon = 'fa-calendar';
        if (item.type === 'discount' || item.type === 'discount_vouchers') icon = 'fa-percentage';
        if (item.type === 'meal' || item.type === 'meal_add_ons') icon = 'fa-wine-glass-alt';

        // Get image from multiple possible fields (prioritize image_url from database)
        const itemImage = item.image_url || item.image || item.image_path;
        let itemImageHtml = itemImage 
            ? `<img src="${itemImage}" alt="${item.name || item.title}" onerror="this.onerror=null; this.parentElement.innerHTML='<i class=\"fas ${icon}\"></i>';">`
            : `<i class="fas ${icon}"></i>`;

        const detailLines = [];
        if (item.type === 'reservation') {
            // Format date for display
            if (item.date) {
                const dateObj = new Date(item.date);
                const formattedDate = dateObj.toLocaleDateString('id-ID', { 
                    weekday: 'short', 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric' 
                });
                let timeStr = '';
                if (item.time_start) {
                    timeStr = item.time_start;
                    if (item.time_end) {
                        timeStr += ` - ${item.time_end}`;
                    }
                }
                detailLines.push(`${formattedDate}${timeStr ? ' ' + timeStr : ''}`);
            } else if (item.time_start || item.time_end) {
                let timeStr = item.time_start || '';
                if (item.time_end) {
                    timeStr += ` - ${item.time_end}`;
                }
                detailLines.push(timeStr);
            }
            
            if (item.room) detailLines.push(`Ruangan: ${item.room}`);
            detailLines.push(`${item.quantity || 1} guest${(item.quantity || 1) > 1 ? 's' : ''}`);
            if (item.special_request) detailLines.push(`Catatan: ${item.special_request}`);
            if (item.description) detailLines.push(item.description);
        } else {
            if (item.description) detailLines.push(item.description);
            if (item.details) detailLines.push(item.details);
        }

        cartItem.innerHTML = `
            <div class="cart-item-image${item.image ? '' : ' voucher'}">
                ${itemImageHtml}
            </div>
            <div class="cart-item-content">
                <div class="cart-item-header">
                    <div>
                        <div class="cart-item-title">${item.title || item.name || 'Item'}</div>
                        <span class="cart-item-category">${categoryLabel}</span>
                    </div>
                    <div class="cart-item-price">Rp ${Number((item.price || Math.round((item.totalPrice || 0) / (item.quantity || 1) || 0))).toLocaleString('id-ID')}</div>
                </div>
                <div class="cart-item-details">
                    ${detailLines.map(line => `<p>${line}</p>`).join('')}
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
    let cartArray = getCartArray();
    
    cartArray[index].quantity += delta;

    if (cartArray[index].quantity <= 0) {
        cartArray.splice(index, 1);
    }

    // Update cart in appropriate format
    if (Array.isArray(cart)) {
        cart = cartArray;
    } else {
        const newCart = {};
        cartArray.forEach(item => {
            const key = item._key || `item-${item.id}`;
            newCart[key] = item;
        });
        cart = newCart;
    }

    saveCart();
    updateCartDisplay();
}

function removeItem(index) {
    // Convert to array if needed
    let cartArray = getCartArray();
    
    cartArray.splice(index, 1);

    if (Array.isArray(cart)) {
        cart = cartArray;
    } else {
        const newCart = {};
        cartArray.forEach(item => {
            const key = item._key || `item-${item.id}`;
            newCart[key] = item;
        });
        cart = newCart;
    }

    saveCart();
    updateCartDisplay();
}

// Init on page load
document.addEventListener('DOMContentLoaded', () => {
    // Check for pending reservations from reservation page
    const pendingReservations = JSON.parse(sessionStorage.getItem('pendingReservations')) || [];
    
    if (pendingReservations.length > 0) {
        // Ensure cart is an object
        if (Array.isArray(cart)) {
            const tempCart = {};
            cart.forEach((item, idx) => {
                tempCart[`item-${idx}`] = item;
            });
            cart = tempCart;
        }
        
        // Add pending reservations to cart
        pendingReservations.forEach(reservation => {
            const cartKey = `reservation-${reservation.id}-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
            cart[cartKey] = { 
                ...reservation,
                _key: cartKey
            };
        });
        
        // Save cart with reservations
        saveCart();
        
        // Clear sessionStorage
        sessionStorage.removeItem('pendingReservations');
        
        // Show success notification
        setTimeout(() => {
            const notification = document.createElement('div');
            notification.className = 'notification is-success';
            notification.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; max-width: 300px;';
            notification.innerHTML = `
                <button class="delete"></button>
                <strong>Reservasi berhasil ditambahkan!</strong><br>
                <small>Silakan lanjutkan ke pembayaran</small>
            `;
            document.body.appendChild(notification);
            notification.querySelector('.delete').addEventListener('click', () => notification.remove());
            setTimeout(() => notification.remove(), 5000);
        }, 300);
    }
    
    loadProducts();
    updateCartDisplay();

    // Listen for cart changes from other tabs/pages
    window.addEventListener('storage', (e) => {
        if (e.key === 'cart') {
            cart = JSON.parse(e.newValue) || {};
            updateCartDisplay();
        }
    });

    const payNowBtn = document.getElementById('pay-now-btn');
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    const userName = document.querySelector('meta[name="user-name"]')?.content || 'Guest User';
    const userEmail = document.querySelector('meta[name="user-email"]')?.content || 'guest@example.com';
    const userPhone = document.querySelector('meta[name="user-phone"]')?.content || '0000000000';

    async function startPayment() {
        const cartArray = getCartArray();
        if (!cartArray.length) {
            alert('Cart masih kosong. Tambahkan item terlebih dahulu.');
            return;
        }

        const amount = cartArray.reduce((sum, item) => {
            const lineTotal = item.totalPrice || (item.price || 0) * (item.quantity || 1);
            return sum + lineTotal;
        }, 0);

        // Add tax and service fee
        const tax = amount * 0.10;
        const serviceFee = 5000;
        const totalAmount = amount + tax + serviceFee;

        if (totalAmount <= 0) {
            alert('Total tidak valid.');
            return;
        }

        // Get customer details from first reservation item or use meta tags
        const firstReservation = cartArray.find(item => item.type === 'reservation');
        const customerDetails = {
            full_name: firstReservation?.full_name || userName,
            email: firstReservation?.email || userEmail,
            phone: firstReservation?.phone || userPhone
        };

        payNowBtn.classList.add('is-loading');

        try {
            const response = await fetch('/api/payments/reservation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                },
                body: JSON.stringify({
                    amount: totalAmount,
                    customer: customerDetails,
                    items: cartArray.map(item => ({
                        id: item._key || item.id || `item-${Math.random().toString(36).substr(2, 9)}`,
                        name: item.title || item.name || 'Reservation',
                        quantity: item.quantity || 1,
                        price: item.price || Math.round((item.totalPrice || 0) / (item.quantity || 1) || 0)
                    }))
                })
            });

            if (!response.ok) {
                const err = await response.json();
                alert(err.message || 'Gagal memulai pembayaran.');
                return;
            }

            const data = await response.json();
            if (!window.snap || !data.snap_token) {
                alert('Snap token tidak tersedia.');
                return;
            }

            window.snap.pay(data.snap_token, {
                onSuccess: (result) => {
                    console.log('Payment success:', result);
                    // Clear cart while preserving format
                    if (Array.isArray(cart)) {
                        cart = [];
                    } else {
                        cart = {};
                    }
                    saveCart();
                    updateCartDisplay();
                    
                    // Show success message
                    alert('✅ Pembayaran berhasil!\n\nOrder ID: ' + data.order_id + '\n\nTerima kasih atas reservasi Anda. Konfirmasi akan dikirim ke email Anda.');
                    
                    // Redirect to home or reservations page
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2000);
                },
                onPending: (result) => {
                    console.log('Payment pending:', result);
                    // Clear cart while preserving format
                    if (Array.isArray(cart)) {
                        cart = [];
                    } else {
                        cart = {};
                    }
                    saveCart();
                    updateCartDisplay();
                    alert('⏳ Pembayaran tertunda\n\nOrder ID: ' + data.order_id + '\n\nSilakan selesaikan pembayaran Anda.');
                },
                onError: (result) => {
                    console.error('Payment error:', result);
                    alert('❌ Pembayaran gagal\n\nSilakan coba lagi atau hubungi customer service.');
                },
                onClose: () => {
                    console.log('Snap closed by user');
                }
            });
        } catch (error) {
            alert('Terjadi kesalahan jaringan.');
        } finally {
            payNowBtn.classList.remove('is-loading');
        }
    }

    if (payNowBtn) {
        payNowBtn.addEventListener('click', startPayment);
    }
});