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
    const cartItemsContainer = document.getElementById('cart-items');
    const emptyCartSection = document.getElementById('empty-cart');
    const cartBadge = document.getElementById('cart-badge');
    const itemCountElement = document.getElementById('item-count');
    const subtotalElement = document.getElementById('subtotal');
    const discountElement = document.getElementById('discount');
    const discountBadge = document.getElementById('discount-badge');
    const taxElement = document.getElementById('tax');
    const serviceFeeElement = document.getElementById('service-fee');
    const totalElement = document.getElementById('total');
    const promoCodeInput = document.getElementById('promo-code');
    const applyPromoBtn = document.getElementById('apply-promo');
    const promoMessage = document.getElementById('promo-message');
    const paymentOptions = document.querySelectorAll('.payment-option');
    const payNowBtn = document.getElementById('pay-now-btn');
    const checkoutModal = document.getElementById('checkout-modal');
    const continueShoppingBtn = document.getElementById('continue-shopping-btn');
    const viewOrdersBtn = document.getElementById('view-orders-btn');
    const orderTotalElement = document.getElementById('order-total');
    const orderPaymentElement = document.getElementById('order-payment');
    const orderIdElement = document.getElementById('order-id');
    
    let cart = [
        { id: 'exp-1', name: 'Fuji Experience', price: 25000, quantity: 1, type: 'experience', image: 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80' },
        { id: 'voucher-2', name: '20% Off Any Experience', price: 8000, quantity: 1, type: 'voucher', icon: 'fa-percentage' },
        { id: 'addon-3', name: 'Premium Sake Pairing', price: 5500, quantity: 2, type: 'addon', image: 'https://images.unsplash.com/photo-1581338834647-b0fb407c6e59?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80' }
    ];

    const validPromoCodes = {
        'DAICHI10': 10,
        'SAKURA15': 15,
        'WELCOME5': 5 
    };
    
    let appliedPromoCode = null;
    let selectedPaymentMethod = 'credit-card';
    
    updateCartDisplay();
    
    function updateCartDisplay() {
        let subtotal = 0;
        let totalItems = 0;
        
        cart.forEach(item => {
            subtotal += item.price * item.quantity;
            totalItems += item.quantity;
        });
        
        let discount = 0;
        if (appliedPromoCode && validPromoCodes[appliedPromoCode]) {
            discount = subtotal * (validPromoCodes[appliedPromoCode] / 100);
        }
        
        const tax = (subtotal - discount) * 0.10;
        const serviceFee = 500;
        const total = subtotal - discount + tax + serviceFee;
        
        cartBadge.textContent = totalItems;
        itemCountElement.textContent = totalItems;
        subtotalElement.textContent = `¥${subtotal.toLocaleString()}`;
        
        if (discount > 0) {
            discountElement.textContent = `-¥${discount.toLocaleString()}`;
            discountBadge.textContent = `-${validPromoCodes[appliedPromoCode]}%`;
            discountBadge.style.display = 'inline-block';
            discountElement.style.color = 'var(--success)';
        } else {
            discountElement.textContent = '-¥0';
            discountBadge.style.display = 'none';
            discountElement.style.color = 'var(--accent-color)';
        }
        
        taxElement.textContent = `¥${tax.toLocaleString()}`;
        serviceFeeElement.textContent = `¥${serviceFee.toLocaleString()}`;
        totalElement.textContent = `¥${total.toLocaleString()}`;
        
        if (cart.length === 0) {
            cartItemsContainer.style.display = 'none';
            emptyCartSection.style.display = 'block';
        } else {
            cartItemsContainer.style.display = 'block';
            emptyCartSection.style.display = 'none';
        }
        
        updateCartItemsDisplay();
    }
    
    function updateCartItemsDisplay() {
        const existingItems = cartItemsContainer.querySelectorAll('.cart-item');
        existingItems.forEach(item => item.remove());
        
        cart.forEach((item, index) => {
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.dataset.id = item.id;
            cartItem.dataset.price = item.price;
            cartItem.dataset.type = item.type;
            
            let imageHtml = '';
            if (item.type === 'voucher') {
                imageHtml = `<div class="cart-item-image voucher">
                                <i class="fas ${item.icon || 'fa-gift'}"></i>
                            </div>`;
            } else {
                imageHtml = `<div class="cart-item-image">
                                <img src="${item.image}" alt="${item.name}">
                            </div>`;
            }
            
            let categoryClass = 'category-experience';
            if (item.type === 'voucher') categoryClass = 'category-voucher';
            if (item.type === 'addon') categoryClass = 'category-experience';
            
            cartItem.innerHTML = `
                ${imageHtml}
                <div class="cart-item-content">
                    <div class="cart-item-header">
                        <div>
                            <div class="cart-item-title">${item.name}</div>
                            <span class="cart-item-category ${categoryClass}">
                                ${item.type === 'experience' ? 'Dining Experience' : 
                                  item.type === 'voucher' ? 'Discount Voucher' : 
                                  'Meal Add-on'}
                            </span>
                        </div>
                        <div class="cart-item-price">¥${item.price.toLocaleString()}</div>
                    </div>
                    <div class="cart-item-details">
                        <p>${getItemDescription(item)}</p>
                        <p>${getItemDetails(item)}</p>
                    </div>
                    <div class="cart-item-controls">
                        <div class="quantity-controls">
                            <button class="qty-btn decrease-qty">-</button>
                            <span class="qty-value">${item.quantity}</span>
                            <button class="qty-btn increase-qty">+</button>
                            <span class="ml-3">${getQuantityLabel(item)}</span>
                        </div>
                        <button class="remove-item" data-index="${index}">
                            <i class="fas fa-trash"></i>
                            Remove
                        </button>
                    </div>
                </div>
            `;
            
            cartItemsContainer.appendChild(cartItem);
        });
        
        addCartItemEventListeners();
    }
    
    function getItemDescription(item) {
        if (item.id === 'exp-1') return 'Luxurious private dining in a traditional tatami room with exclusive 9-course kaiseki menu.';
        if (item.id === 'voucher-2') return 'Significant savings on any dining experience. Valid for up to 6 people.';
        if (item.id === 'addon-3') return 'Enhanced beverage experience with 5 premium sake tastings and expert pairing guidance.';
        return 'Premium Daichi No experience.';
    }
    
    function getItemDetails(item) {
        if (item.id === 'exp-1') return '<strong>Duration:</strong> 2.5 hours | <strong>Group Size:</strong> 2-8 people | <strong>Date:</strong> Flexible booking';
        if (item.id === 'voucher-2') return '<strong>Validity:</strong> 6 months | <strong>Discount:</strong> 20% off total bill';
        if (item.id === 'addon-3') return '<strong>Validity:</strong> 12 months | <strong>For:</strong> 1 person';
        return '';
    }
    
    function getQuantityLabel(item) {
        if (item.type === 'experience') return 'Guest(s)';
        if (item.type === 'voucher') return 'Voucher(s)';
        return 'Person(s)';
    }
    
    function addCartItemEventListeners() {
        document.querySelectorAll('.decrease-qty').forEach(btn => {
            btn.addEventListener('click', function() {
                const cartItem = this.closest('.cart-item');
                const itemId = cartItem.dataset.id;
                const itemIndex = cart.findIndex(item => item.id === itemId);
                
                if (itemIndex !== -1) {
                    if (cart[itemIndex].quantity > 1) {
                        cart[itemIndex].quantity--;
                        updateCartDisplay();
                    }
                }
            });
        });
        
        document.querySelectorAll('.increase-qty').forEach(btn => {
            btn.addEventListener('click', function() {
                const cartItem = this.closest('.cart-item');
                const itemId = cartItem.dataset.id;
                const itemIndex = cart.findIndex(item => item.id === itemId);
                
                if (itemIndex !== -1) {
                    if (cart[itemIndex].quantity < 10) {
                        cart[itemIndex].quantity++;
                        updateCartDisplay();
                    }
                }
            });
        });
        
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const itemIndex = parseInt(this.dataset.index);
                
                if (confirm('Are you sure you want to remove this item from your cart?')) {
                    cart.splice(itemIndex, 1);
                    updateCartDisplay();
                }
            });
        });
    }
    
    applyPromoBtn.addEventListener('click', applyPromoCode);
    promoCodeInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            applyPromoCode();
        }
    });
    
    function applyPromoCode() {
        const code = promoCodeInput.value.trim().toUpperCase();
        
        if (!code) {
            promoMessage.textContent = 'Please enter a promo code';
            promoMessage.className = 'promo-message promo-error';
            return;
        }
        
        if (validPromoCodes[code]) {
            appliedPromoCode = code;
            promoMessage.textContent = `Success! ${validPromoCodes[code]}% discount applied`;
            promoMessage.className = 'promo-message promo-success';
            updateCartDisplay();
        } else {
            promoMessage.textContent = 'Invalid promo code. Please try again.';
            promoMessage.className = 'promo-message promo-error';
            appliedPromoCode = null;
            updateCartDisplay();
        }
    }

    paymentOptions.forEach(option => {
        option.addEventListener('click', function() {
            paymentOptions.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            selectedPaymentMethod = this.dataset.method;
        });
    });

    payNowBtn.addEventListener('click', function() {
        if (cart.length === 0) {
            alert('Your cart is empty. Please add items before proceeding to checkout.');
            return;
        }
        
        let subtotal = 0;
        cart.forEach(item => {
            subtotal += item.price * item.quantity;
        });
        
        let discount = 0;
        if (appliedPromoCode && validPromoCodes[appliedPromoCode]) {
            discount = subtotal * (validPromoCodes[appliedPromoCode] / 100);
        }
        
        const tax = (subtotal - discount) * 0.10;
        const serviceFee = 500;
        const total = subtotal - discount + tax + serviceFee;
        
        orderTotalElement.textContent = `¥${total.toLocaleString()}`;
        
        let paymentMethodText = 'Credit Card';
        if (selectedPaymentMethod === 'paypal') paymentMethodText = 'PayPal';
        if (selectedPaymentMethod === 'bank-transfer') paymentMethodText = 'Bank Transfer';
        orderPaymentElement.textContent = paymentMethodText;
        
        const orderId = `DN-${Math.floor(1000 + Math.random() * 9000)}-2023`;
        orderIdElement.textContent = orderId;
        
        checkoutModal.classList.add('active');
    });
    
    continueShoppingBtn.addEventListener('click', function() {
        checkoutModal.classList.remove('active');
        cart = [];
        appliedPromoCode = null;
        updateCartDisplay();
        window.location.href = 'home.html';
    });
    
    viewOrdersBtn.addEventListener('click', function() {
        alert('Order tracking page would open here. In a real application, this would redirect to your account orders page.');
        checkoutModal.classList.remove('active');
        cart = [];
        appliedPromoCode = null;
        updateCartDisplay();
    });
    
    checkoutModal.addEventListener('click', function(e) {
        if (e.target === checkoutModal) {
            checkoutModal.classList.remove('active');
        }
    });
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
    
    logoutBtn.addEventListener('click', function() {
        if (confirm('Are you sure you want to log out?')) {
            alert('You have been logged out successfully.');
            setTimeout(() => {
                window.location.href = 'login.html';
            }, 1000);
            
            closeUserPanel();
        }
    });
    
    //data
    function updateUserStats() {
        const userName = "Takashi Yamada";
        const userEmail = "takashi.yamada@email.com";
        const reservations = 3;
        const points = 1250;
        const vouchers = 2;
        
        document.getElementById('user-name').textContent = userName;
        document.getElementById('user-email').textContent = userEmail;
        document.getElementById('reservation-count').textContent = reservations;
        document.getElementById('points-earned').textContent = points.toLocaleString();
        document.getElementById('vouchers-owned').textContent = vouchers;
    }

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