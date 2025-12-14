window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    const scrollPosition = window.scrollY;
    
    if (scrollPosition > 100) {
        navbar.classList.remove('transparent');
        navbar.classList.add('solid');
    } else {
        navbar.classList.remove('solid');
        navbar.classList.add('transparent');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Load cart from localStorage or initialize empty
    let cart = JSON.parse(localStorage.getItem('cart')) || {};
    
    const cartSidebar = document.getElementById('cart-sidebar');
    const viewCartBtn = document.getElementById('view-cart-btn');
    const closeCartBtn = document.getElementById('close-cart');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const cartCount = document.querySelector('.cart-count');
    const emptyCartMessage = document.getElementById('empty-cart-message');
    const cartNotification = document.getElementById('cart-notification');
    const checkoutBtn = document.getElementById('checkout-btn');
    const typeCards = document.querySelectorAll('.type-card');
    const voucherCards = document.querySelectorAll('.voucher-card');
    const addToCartBtns = document.querySelectorAll('.add-to-cart-btn');

    // Save cart to localStorage
    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartBadge();
    }

    // Update cart badge on navbar and other pages
    function updateCartBadge() {
        const cartBadges = document.querySelectorAll('.cart-count, #cart-badge');
        let totalItems = 0;
        Object.values(cart).forEach(item => {
            totalItems += item.quantity;
        });
        cartBadges.forEach(badge => {
            badge.textContent = totalItems;
        });
    }

    typeCards.forEach(card => {
        card.addEventListener('click', function() {
            const type = this.dataset.type;
            
            typeCards.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            
            voucherCards.forEach(voucher => {
                if (type === 'all' || voucher.dataset.type === type) {
                    voucher.style.display = 'flex';
                } else {
                    voucher.style.display = 'none';
                }
            });
        });
    });

    addToCartBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const voucherId = parseInt(this.dataset.id);
            const voucherPrice = parseInt(this.dataset.price);
            const voucherTitle = this.dataset.title;
            const voucherCard = this.closest('.voucher-card');
            const voucherType = voucherCard.dataset.type;
            const voucherBadge = voucherCard.querySelector('.voucher-tier').textContent.trim();
            const voucherDescription = voucherCard.querySelector('.voucher-description').textContent.trim();
            
            const voucherData = {
                id: voucherId,
                name: voucherTitle,
                price: voucherPrice,
                type: voucherType,
                description: voucherDescription,
                badge: voucherBadge
            };
            
            addToCart(voucherData);
        });
    });

    function addToCart(item) {
        const cartKey = `voucher-${item.id}`;
        
        if (cart[cartKey]) {
            cart[cartKey].quantity += 1;
            cart[cartKey].totalPrice += item.price;
        } else {
            cart[cartKey] = { 
                ...item,
                quantity: 1, 
                totalPrice: item.price 
            };
        }
        
        saveCart();
        updateCartDisplay();
        showNotification();
    }

    function updateCartDisplay() {
        let totalItems = 0;
        let totalPrice = 0;
        
        Object.values(cart).forEach(item => {
            totalItems += item.quantity;
            totalPrice += item.totalPrice;
        });
        
        if (cartCount) {
            cartCount.textContent = totalItems;
        }
        cartTotal.textContent = `Rp${totalPrice.toLocaleString('id-ID')}`;
        
        cartItems.innerHTML = '';
        
        if (totalItems === 0) {
            cartItems.appendChild(emptyCartMessage);
            emptyCartMessage.style.display = 'block';
        } else {
            emptyCartMessage.style.display = 'none';
            
            Object.entries(cart).forEach(([cartKey, item]) => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                
                let icon = 'fa-gift';
                if (item.type === 'experience') icon = 'fa-utensils';
                if (item.type === 'discount') icon = 'fa-percentage';
                if (item.type === 'meal') icon = 'fa-wine-glass-alt';
                
                cartItem.innerHTML = `
                    <div class="cart-item-image">
                        <i class="fas ${icon}"></i>
                    </div>
                    <div class="cart-item-details">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-info">${item.badge}</div>
                        <div class="cart-item-price">Rp${item.price.toLocaleString('id-ID')}</div>
                    </div>
                    <div class="cart-item-qty">
                        <button class="decrease-cart" data-key="${cartKey}">-</button>
                        <span>${item.quantity}</span>
                        <button class="increase-cart" data-key="${cartKey}">+</button>
                    </div>
                `;
                cartItems.appendChild(cartItem);
            });
            
            document.querySelectorAll('.decrease-cart').forEach(btn => {
                btn.addEventListener('click', function() {
                    const key = this.dataset.key;
                    if (cart[key].quantity > 1) {
                        cart[key].quantity--;
                        cart[key].totalPrice = cart[key].price * cart[key].quantity;
                    } else {
                        delete cart[key];
                    }
                    saveCart();
                    updateCartDisplay();
                });
            });
            
            document.querySelectorAll('.increase-cart').forEach(btn => {
                btn.addEventListener('click', function() {
                    const key = this.dataset.key;
                    if (cart[key].quantity < 10) {
                        cart[key].quantity++;
                        cart[key].totalPrice = cart[key].price * cart[key].quantity;
                        saveCart();
                        updateCartDisplay();
                    }
                });
            });
        }
    }

    function showNotification() {
        cartNotification.style.display = 'flex';
        setTimeout(() => {
            cartNotification.style.display = 'none';
        }, 3000);
    }

    // Cart sidebar functionality
    if (closeCartBtn) {
        closeCartBtn.addEventListener('click', function() {
            cartSidebar.classList.remove('open');
        });
    }

    // Cart link in navbar
    const cartLink = document.querySelector('.nav-section.right a[href*="cart"]');
    if (cartLink) {
        cartLink.addEventListener('click', function(e) {
            e.preventDefault();
            cartSidebar.classList.add('open');
        });
    }

    checkoutBtn.addEventListener('click', function() {
        if (Object.keys(cart).length === 0) {
            alert('Keranjang Anda kosong');
            return;
        }
        
        let totalPrice = 0;
        let cartItems = [];
        
        Object.values(cart).forEach(item => {
            totalPrice += item.totalPrice;
            cartItems.push({
                name: item.name,
                quantity: item.quantity,
                price: item.price
            });
        });
        
        let message = `Pesanan Dikonfirmasi!\n\nTotal: Rp${totalPrice.toLocaleString('id-ID')}\n\nDetail:\n`;
        cartItems.forEach(item => {
            message += `\n- ${item.name}\n  Qty: ${item.quantity} x Rp${item.price.toLocaleString('id-ID')}`;
        });
        message += `\n\nAnda akan menerima email konfirmasi dalam beberapa saat.`;
        
        alert(message);
        
        // Clear cart and save
        cart = {};
        saveCart();
        updateCartDisplay();
        
        cartSidebar.classList.remove('open');
    });

    // Initialize cart display on page load
    updateCartDisplay();
    updateCartBadge();
});

document.addEventListener('DOMContentLoaded', function() {
    const floatingUserBtn = document.getElementById('floating-user-btn');
    const userPanel = document.getElementById('user-panel');
    const closePanelBtn = document.getElementById('close-panel');
    const panelOverlay = document.getElementById('panel-overlay');
    const logoutBtn = document.getElementById('logout-btn');

    function openUserPanel() {
        userPanel.classList.add('open');
        panelOverlay.classList.add('active');
        floatingUserBtn.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeUserPanel() {
        userPanel.classList.remove('open');
        panelOverlay.classList.remove('active');
        floatingUserBtn.classList.remove('active');
        document.body.style.overflow = '';
    }

    floatingUserBtn.addEventListener('click', openUserPanel);

    closePanelBtn.addEventListener('click', closeUserPanel);

    panelOverlay.addEventListener('click', closeUserPanel);
    
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && userPanel.classList.contains('open')) {
            closeUserPanel();
        }
    });
    
    logoutBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Logout sekarang?')) {
            const form = document.getElementById('logout-form');
            if (form) {
                form.submit();
            }
        }
    });
    
    //data

    updateUserStats();
    
    let panelTouchStartY = 0;
    let panelTouchStartTime = 0;
    
    userPanel.addEventListener('touchstart', e => {
        panelTouchStartY = e.touches[0].clientY;
        panelTouchStartTime = Date.now();
    });
    
    userPanel.addEventListener('touchend', e => {
        const panelTouchEndY = e.changedTouches[0].clientY;
        const panelTouchDeltaY = panelTouchEndY - panelTouchStartY;
        const panelTouchDuration = Date.now() - panelTouchStartTime;

        if (panelTouchDeltaY > 100 || (panelTouchDeltaY > 50 && panelTouchDuration < 300)) {
            closeUserPanel();
        }
    });

    window.addEventListener('scroll', function() {
        const scrollIndicator = document.querySelector('.scroll-indicator');
        const scrollPosition = window.scrollY;
        
        if (scrollPosition > 100) {
            scrollIndicator.innerHTML = '<i class="fas fa-check mr-2"></i> Button stays visible';
        } else {
            scrollIndicator.innerHTML = '<i class="fas fa-arrow-down mr-2"></i> Scroll to test';
        }
    });
});