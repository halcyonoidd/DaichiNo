
        // Navbar scroll effect - matching reservation page
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

        // Voucher System
        document.addEventListener('DOMContentLoaded', function() {
            // Cart state
            let cart = {};
            
            // Voucher data
            const vouchers = {
                1: { 
                    id: 1, 
                    name: "Complete Sakura Experience", 
                    price: 11500, 
                    type: "experience",
                    description: "Full 6-course dining experience for one person",
                    details: "Includes 6-course meal, drinks, dessert",
                    validity: "12 months",
                    discount: "Save ¥1,000 (8% discount)",
                    originalPrice: 12500
                },
                2: { 
                    id: 2, 
                    name: "20% Off Any Experience", 
                    price: 8000, 
                    type: "discount",
                    description: "Significant savings on any dining experience",
                    details: "20% off total bill for up to 6 people",
                    validity: "6 months",
                    discount: "Save up to ¥15,200",
                    originalPrice: null
                },
                3: { 
                    id: 3, 
                    name: "Premium Sake Pairing", 
                    price: 5500, 
                    type: "meal",
                    description: "Enhanced beverage experience with your meal",
                    details: "Includes 5 premium sake tastings with expert guidance",
                    validity: "12 months",
                    discount: "Save ¥1,000 (15% discount)",
                    originalPrice: 6500
                },
                4: { 
                    id: 4, 
                    name: "Custom Amount Gift Card", 
                    price: 15000, 
                    type: "experience",
                    description: "Flexible gift amount for any Daichi No experience",
                    details: "Customizable amount with premium gift packaging",
                    validity: "18 months",
                    discount: "Choose amount at checkout",
                    originalPrice: null,
                    custom: true
                },
                5: { 
                    id: 5, 
                    name: "A5 Wagyu Beef Upgrade", 
                    price: 10500, 
                    type: "meal",
                    description: "Upgrade your experience with premium Wagyu",
                    details: "150g A5 Wagyu steak prepared teppanyaki or traditional",
                    validity: "12 months",
                    discount: "Save ¥1,500 (12.5% discount)",
                    originalPrice: 12000
                },
                6: { 
                    id: 6, 
                    name: "Anniversary Celebration Package", 
                    price: 12000, 
                    type: "discount",
                    description: "Special package for anniversary celebrations",
                    details: "Includes champagne, dessert, and professional photo session for couples",
                    validity: "3 months",
                    discount: "Save ¥3,000 (20% discount)",
                    originalPrice: 15000
                }
            };

            // DOM Elements
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
            const giftCardAmountSelect = document.getElementById('gift-card-amount');

            // Filter by type
            typeCards.forEach(card => {
                card.addEventListener('click', function() {
                    const type = this.dataset.type;
                    
                    // Update active state
                    typeCards.forEach(c => c.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Filter vouchers
                    voucherCards.forEach(voucher => {
                        if (type === 'all' || voucher.dataset.type === type) {
                            voucher.style.display = 'flex';
                        } else {
                            voucher.style.display = 'none';
                        }
                    });
                });
            });

            // Add to cart functionality
            addToCartBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const voucherId = parseInt(this.dataset.id);
                    const isCustom = this.dataset.custom === 'true';
                    
                    let voucherData = { ...vouchers[voucherId] };
                    
                    // Handle custom gift card amount
                    if (isCustom && voucherId === 4) {
                        const selectedAmount = parseInt(giftCardAmountSelect.value);
                        voucherData.price = selectedAmount;
                        voucherData.name = `¥${selectedAmount.toLocaleString()} Gift Card`;
                    }
                    
                    addToCart(voucherData);
                });
            });

            // Cart functions
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
                
                updateCartDisplay();
                showNotification();
            }

            function updateCartDisplay() {
                // Update cart count
                let totalItems = 0;
                let totalPrice = 0;
                
                Object.values(cart).forEach(item => {
                    totalItems += item.quantity;
                    totalPrice += item.totalPrice;
                });
                
                cartCount.textContent = totalItems;
                cartTotal.textContent = `¥${totalPrice.toLocaleString()}`;
                
                // Update cart items
                cartItems.innerHTML = '';
                
                if (totalItems === 0) {
                    cartItems.appendChild(emptyCartMessage);
                    emptyCartMessage.style.display = 'block';
                } else {
                    emptyCartMessage.style.display = 'none';
                    
                    Object.values(cart).forEach(item => {
                        const cartItem = document.createElement('div');
                        cartItem.className = 'cart-item';
                        
                        // Determine icon based on voucher type
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
                                <div class="cart-item-info">${item.description}</div>
                                <div class="cart-item-info">Valid: ${item.validity}</div>
                                <div class="cart-item-price">¥${item.totalPrice.toLocaleString()}</div>
                            </div>
                            <div class="cart-item-qty">
                                <button class="decrease-cart" data-key="${Object.keys(cart).find(key => cart[key] === item)}">-</button>
                                <span>${item.quantity}</span>
                                <button class="increase-cart" data-key="${Object.keys(cart).find(key => cart[key] === item)}">+</button>
                            </div>
                        `;
                        cartItems.appendChild(cartItem);
                    });
                    
                    // Add event listeners to cart quantity controls
                    document.querySelectorAll('.decrease-cart').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const key = this.dataset.key;
                            if (cart[key].quantity > 1) {
                                cart[key].quantity--;
                                cart[key].totalPrice = cart[key].price * cart[key].quantity;
                            } else {
                                delete cart[key];
                            }
                            updateCartDisplay();
                        });
                    });
                    
                    document.querySelectorAll('.increase-cart').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const key = this.dataset.key;
                            if (cart[key].quantity < 10) {
                                cart[key].quantity++;
                                cart[key].totalPrice = cart[key].price * cart[key].quantity;
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

            // Cart sidebar controls
            viewCartBtn.addEventListener('click', function(e) {
                e.preventDefault();
                cartSidebar.classList.add('open');
            });

            closeCartBtn.addEventListener('click', function() {
                cartSidebar.classList.remove('open');
            });

            // Close cart when clicking outside
            document.addEventListener('click', function(e) {
                if (!cartSidebar.contains(e.target) && !viewCartBtn.contains(e.target) && cartSidebar.classList.contains('open')) {
                    cartSidebar.classList.remove('open');
                }
            });

            // Checkout functionality
            checkoutBtn.addEventListener('click', function() {
                if (Object.keys(cart).length === 0) {
                    alert('Your cart is empty');
                    return;
                }
                
                // Calculate total
                let totalPrice = 0;
                let voucherCodes = [];
                
                Object.values(cart).forEach(item => {
                    totalPrice += item.totalPrice;
                    // Generate a sample voucher code
                    const code = `DN-${item.id.toString().padStart(3, '0')}-${Math.random().toString(36).substr(2, 6).toUpperCase()}`;
                    voucherCodes.push({ name: item.name, code: code });
                });
                
                // Show confirmation with voucher codes
                let message = `Purchase confirmed!\n\nTotal: ¥${totalPrice.toLocaleString()}\n\nYour voucher codes:\n`;
                voucherCodes.forEach(vc => {
                    message += `\n${vc.name}: ${vc.code}`;
                });
                message += `\n\nYou will receive an email with digital vouchers shortly.`;
                
                alert(message);
                
                // Clear cart
                cart = {};
                updateCartDisplay();
                
                // Close sidebar
                cartSidebar.classList.remove('open');
            });

            // Initialize cart display
            updateCartDisplay();
            
            // Update gift card button text with selected amount
            if (giftCardAmountSelect) {
                giftCardAmountSelect.addEventListener('change', function() {
                    const amount = parseInt(this.value);
                    const giftCardBtn = document.querySelector('[data-id="4"]');
                    if (giftCardBtn) {
                        giftCardBtn.querySelector('i').nextSibling.textContent = ` Add to Cart (¥${amount.toLocaleString()})`;
                    }
                });
            }
        });
