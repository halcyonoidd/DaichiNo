<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Your Cart & Checkout</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/cart.css') }}">
</head>
<body>
    <nav class="navbar transparent" id="navbar">
        <div class="nav-section left">
            <a href="{{ route('about') }}" class="nav-link light">About</a>
            <a href="{{ route('contact') }}" class="nav-link light">Contact</a>
            <a href="{{ route('voucher') }}" class="nav-link light">Voucher</a>
        </div>
        
        <div class="nav-center">
            <a href="{{ route('home') }}" class="home-link dark">Daichi No</a>
        </div>
        
        <div class="nav-section right">
            <a href="{{ route('menu') }}" class="nav-link light">Menu</a>
            <a href="{{ route('reservation') }}" class="nav-link light">Reservation</a>
            <a href="{{ route('cart') }}" class="nav-link light">Cart(0)</a>
        </div>
    </nav>

    <div class="checkout-modal" id="checkout-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Payment Successful!</h3>
            </div>
            <div class="modal-body">
                <div class="modal-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h4>Thank You for Your Purchase</h4>
                <p>Your order has been confirmed and you will receive a confirmation email shortly.</p>
                
                <div class="confirmation-details">
                    <div class="confirmation-row">
                        <span class="confirmation-label">Order ID:</span>
                        <span class="confirmation-value" id="order-id">DN-8492-2023</span>
                    </div>
                    <div class="confirmation-row">
                        <span class="confirmation-label">Total Amount:</span>
                        <span class="confirmation-value" id="order-total">¥0</span>
                    </div>
                    <div class="confirmation-row">
                        <span class="confirmation-label">Payment Method:</span>
                        <span class="confirmation-value" id="order-payment">Credit Card</span>
                    </div>
                    <div class="confirmation-row">
                        <span class="confirmation-label">Estimated Email:</span>
                        <span class="confirmation-value">Within 5 minutes</span>
                    </div>
                </div>
                
                <p><strong>Voucher codes</strong> for your experiences will be sent in a separate email.</p>
            </div>
            <div class="modal-footer">
                <button class="button is-light" id="continue-shopping-btn">Continue Shopping</button>
                <button class="button is-primary" id="view-orders-btn">View My Orders</button>
            </div>
        </div>
    </div>

    <section class="cart-hero">
        <h1>Your Shopping Cart</h1>
        <p>Review your selected experiences and proceed to checkout</p>
    </section>

    <div class="cart-container">
        <div class="cart-items-section">
            <div class="section-title">
                <h2>Items in Your Cart</h2>
                <p class="subtitle">You have <span id="item-count">2</span> items in your cart</p>
            </div>
            
            <div class="cart-items" id="cart-items">
                <div class="cart-item" data-id="exp-1" data-price="25000" data-type="experience">
                    <div class="cart-item-image">
                        <img src="source\bg\fuji.jpg">
                    </div>
                    <div class="cart-item-content">
                        <div class="cart-item-header">
                            <div>
                                <div class="cart-item-title">Fuji Experience</div>
                                <span class="cart-item-category category-experience">Dining Experience</span>
                            </div>
                            <div class="cart-item-price">¥25,000</div>
                        </div>
                        <div class="cart-item-details">
                            <p><strong>Duration:</strong> 2.5 hours | <strong>Group Size:</strong> 2-8 people | <strong>Date:</strong> Flexible booking</p>
                        </div>
                        <div class="cart-item-controls">
                            <div class="quantity-controls">
                                <button class="qty-btn decrease-qty">-</button>
                                <span class="qty-value">1</span>
                                <button class="qty-btn increase-qty">+</button>
                                <span class="ml-3">Guest(s)</span>
                            </div>
                            <button class="remove-item">
                                <i class="fas fa-trash"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="cart-item" data-id="voucher-2" data-price="8000" data-type="voucher">
                    <div class="cart-item-image voucher">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="cart-item-content">
                        <div class="cart-item-header">
                            <div>
                                <div class="cart-item-title">20% Off Any Experience</div>
                                <span class="cart-item-category category-voucher">Discount Voucher</span>
                            </div>
                            <div class="cart-item-price">¥8,000</div>
                        </div>
                        <div class="cart-item-details">
                            <p>Significant savings on any dining experience. Valid for up to 6 people.</p>
                            <p><strong>Validity:</strong> 6 months | <strong>Discount:</strong> 20% off total bill</p>
                        </div>
                        <div class="cart-item-controls">
                            <div class="quantity-controls">
                                <button class="qty-btn decrease-qty">-</button>
                                <span class="qty-value">1</span>
                                <button class="qty-btn increase-qty">+</button>
                                <span class="ml-3">Voucher(s)</span>
                            </div>
                            <button class="remove-item">
                                <i class="fas fa-trash"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="empty-cart" id="empty-cart" style="display: none;">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3>Your Cart is Empty</h3>
                <p>Looks like you haven't added any experiences or vouchers to your cart yet. Browse our experiences or vouchers to start planning your Daichi No journey.</p>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <a href="reservations.html" class="button is-primary is-medium">
                        <span class="icon">
                            <i class="fas fa-utensils"></i>
                        </span>
                        <span>Browse Experiences</span>
                    </a>
                    <a href="vouchers.html" class="button is-light is-medium">
                        <span class="icon">
                            <i class="fas fa-gift"></i>
                        </span>
                        <span>Browse Vouchers</span>
                    </a>
                </div>
            </div>
            
            <div class="promo-section">
                <div class="promo-title">Apply Promo Code</div>
                <div class="promo-input-group">
                    <input type="text" class="promo-input" id="promo-code" placeholder="Enter promo code (e.g. DAICHI10)">
                    <button class="apply-promo-btn" id="apply-promo">Apply</button>
                </div>
                <div class="promo-message" id="promo-message"></div>
            </div>
        </div>
        
        <div class="summary-sidebar">
            <div class="summary-card">
                <div class="summary-title">Order Summary</div>
                
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span class="summary-amount" id="subtotal">¥43,500</span>
                </div>
                
                <div class="summary-row">
                    <span>Discount <span class="discount-badge" id="discount-badge" style="display: none;">-10%</span></span>
                    <span class="summary-amount" id="discount">-¥0</span>
                </div>
                
                <div class="summary-row">
                    <span>Tax (10%)</span>
                    <span class="summary-amount" id="tax">¥4,350</span>
                </div>
                
                <div class="summary-row">
                    <span>Service Fee</span>
                    <span class="summary-amount" id="service-fee">¥500</span>
                </div>
                
                <div class="summary-row total">
                    <span>Total</span>
                    <span class="summary-amount" id="total">¥48,350</span>
                </div>
                
                <div class="payment-methods">
                    <div class="payment-title">Select Payment Method</div>
                    <div class="payment-options">
                        <div class="payment-option selected" data-method="credit-card">
                            <div class="payment-icon">
                                <i class="far fa-credit-card"></i>
                            </div>
                            <div class="payment-details">
                                <div class="payment-name">Credit / Debit Card</div>
                                <div class="payment-desc">Visa, Mastercard, American Express</div>
                            </div>
                            <div class="checkmark">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        
                        <div class="payment-option" data-method="paypal">
                            <div class="payment-icon">
                                <i class="fab fa-paypal"></i>
                            </div>
                            <div class="payment-details">
                                <div class="payment-name">PayPal</div>
                                <div class="payment-desc">Secure online payments</div>
                            </div>
                            <div class="checkmark">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                        
                        <div class="payment-option" data-method="bank-transfer">
                            <div class="payment-icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="payment-details">
                                <div class="payment-name">Bank Transfer</div>
                                <div class="payment-desc">Domestic bank transfers only</div>
                            </div>
                            <div class="checkmark">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button class="pay-now-btn" id="pay-now-btn">
                    <i class="fas fa-lock"></i>
                    Pay Now
                </button>
                
                <a href="reservations.html" class="continue-shopping">
                    <i class="fas fa-arrow-left"></i>
                    Continue Shopping
                </a>

                <div class="has-text-centered mt-4">
                    <p class="is-size-7 has-text-grey">
                        <i class="fas fa-lock mr-1"></i>
                        Secure checkout. Your payment information is encrypted.
                    </p>
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-title">Need Help?</div>
                <div class="content">
                    <p class="mb-3">Have questions about your order or need assistance?</p>
                    <div class="mb-3">
                        <p><strong><i class="fas fa-phone mr-2"></i> Phone Support</strong></p>
                        <p class="is-size-7">+81 3 1234 5678 (9AM-9PM JST)</p>
                    </div>
                    <div>
                        <p><strong><i class="fas fa-envelope mr-2"></i> Email Support</strong></p>
                        <p class="is-size-7">support@daichino.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Daichi No</h3>
                    <p>Experience the authentic taste of Japan with our carefully crafted dishes made from the finest ingredients.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="about.html">About Us</a></li>
                        <li><a href="menu.html">Our Menu</a></li>
                        <li><a href="reservation.html">Reservations</a></li>
                        <li><a href="voucher.html">Gift Vouchers</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Opening Hours</h3>
                    <ul class="footer-links">
                        <li>Monday - Friday: 11:00 AM - 10:00 PM</li>
                        <li>Saturday - Sunday: 11:00 AM - 11:00 PM</li>
                        <li>Holidays: 12:00 PM - 9:00 PM</li>
                    </ul>
                </div>
        </div>
    </footer>

    <div class="panel-overlay" id="panel-overlay"></div>

    <div class="floating-user-btn" id="floating-user-btn">
        <i class="fas fa-user"></i>
    </div>

    <div class="user-panel" id="user-panel">
        <div class="user-panel-header">
            <h3>My Account</h3>
            <button class="close-panel" id="close-panel">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="user-info">
            <div class="user-avatar">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="user-name" id="user-name">Takashi Yamada</div>
            <div class="user-email" id="user-email">takashi.yamada@email.com</div>
            
            <div class="user-stats">
                <div class="stat-item">
                    <div class="stat-value" id="reservation-count">3</div>
                    <div class="stat-label">Reservations</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="points-earned">1,250</div>
                    <div class="stat-label">Points</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="vouchers-owned">2</div>
                    <div class="stat-label">Vouchers</div>
                </div>
            </div>
        </div>
        
        <div class="panel-actions">
            <a href="profile.html" class="panel-btn panel-btn-primary">
                <i class="fas fa-user-circle mr-2"></i> View Profile
            </a>
            <a href="reservation.html" class="panel-btn panel-btn-secondary">
                <i class="fas fa-calendar-alt mr-2"></i> My Reservations
            </a>
            <a href="voucher.html" class="panel-btn panel-btn-secondary">
                <i class="fas fa-gift mr-2"></i> My Vouchers
            </a>
            <button class="panel-btn panel-btn-logout" id="logout-btn">
                <i class="fas fa-sign-out-alt mr-2"></i> Log Out
            </button>
        </div>
    </div>

    <script src ="{{ asset('js/custPage/cart.js') }}"></script>
</body>
</html>