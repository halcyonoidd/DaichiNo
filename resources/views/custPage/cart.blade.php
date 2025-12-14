<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-name" content="{{ auth()->user()->name ?? 'Guest User' }}">
    <meta name="user-email" content="{{ auth()->user()->email ?? 'guest@example.com' }}">
    <meta name="user-phone" content="{{ auth()->user()->phone ?? '0000000000' }}">
    <title>Daichi No - Your Cart & Checkout</title>
    <!-- Bulma CSS Framework -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/frontend/cart.css') }}">


    
</head>
<body>
    <nav class="navbar solid" id="navbar">
        <div class="nav-section left">
            <a href="{{ route('about') }}" class="nav-link">About</a>
            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
        </div>
        
        <div class="nav-center">
            <a href="{{ route('home') }}" class="home-link">Daichi No</a>
        </div>
        
        <div class="nav-section right">
            <a href="{{ route('menu') }}" class="nav-link">Menu</a>
            <a href="{{ route('reservation') }}" class="nav-link">Reservations</a>
        </div>
    </nav>

    <!-- Checkout Success Modal -->
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
        <!-- Cart Items Section -->
        <div class="cart-items-section">
            <div class="section-title">
                <h2>Items in Your Cart</h2>
                <p class="subtitle">You have <span id="item-count">3</span> items in your cart</p>
            </div>
            
            <!-- Cart Items -->
            <div class="cart-items" id="cart-items">
                <!-- Cart items will be dynamically added here -->
                
                <!-- Sample Item 1: Experience -->
                <div class="cart-item" data-id="exp-1" data-price="25000" data-type="experience">
                    <div class="cart-item-image">
                        <img src="https://images.unsplash.com/photo-1569718212165-3a8278d5f624?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80" alt="Fuji Experience">
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
                            <p>Luxurious private dining in a traditional tatami room with exclusive 9-course kaiseki menu.</p>
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
                
                <!-- Sample Item 2: Voucher -->
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
                
                <!-- Sample Item 3: Meal Add-on -->
                <div class="cart-item" data-id="addon-3" data-price="5500" data-type="addon">
                    <div class="cart-item-image">
                        <img src="https://images.unsplash.com/photo-1581338834647-b0fb407c6e59?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Sake Pairing">
                    </div>
                    <div class="cart-item-content">
                        <div class="cart-item-header">
                            <div>
                                <div class="cart-item-title">Premium Sake Pairing</div>
                                <span class="cart-item-category category-experience">Meal Add-on</span>
                            </div>
                            <div class="cart-item-price">¥5,500</div>
                        </div>
                        <div class="cart-item-details">
                            <p>Enhanced beverage experience with 5 premium sake tastings and expert pairing guidance.</p>
                            <p><strong>Validity:</strong> 12 months | <strong>For:</strong> 1 person</p>
                        </div>
                        <div class="cart-item-controls">
                            <div class="quantity-controls">
                                <button class="qty-btn decrease-qty">-</button>
                                <span class="qty-value">2</span>
                                <button class="qty-btn increase-qty">+</button>
                                <span class="ml-3">Person(s)</span>
                            </div>
                            <button class="remove-item">
                                <i class="fas fa-trash"></i>
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Empty Cart State (Hidden by default) -->
            <div class="empty-cart" id="empty-cart" style="display: none;">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3>Your Cart is Empty</h3>
                <p>Looks like you haven't added any experiences or vouchers to your cart yet. Browse our experiences or vouchers to start planning your Daichi No journey.</p>
                <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('reservation') }}" class="button is-primary is-medium">
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
            

        </div>
        
        <!-- Order Summary Sidebar -->
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
                
                
                <!-- Pay Now Button -->
                <button class="pay-now-btn" id="pay-now-btn">
                    <i class="fas fa-lock"></i>
                    Pay Now
                </button>
                
                <!-- Continue Shopping Button -->
                <a href="{{ route('reservation') }}" class="continue-shopping">
                    <i class="fas fa-arrow-left"></i>
                    Continue Shopping
                </a>
                
                <!-- Security Note -->
                <div class="has-text-centered mt-4">
                    <p class="is-size-7 has-text-grey">
                        <i class="fas fa-lock mr-1"></i>
                        Secure checkout. Your payment information is encrypted.
                    </p>
                </div>
            </div>
            
            <!-- Need Help Section -->
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
            <div class="columns">
                <div class="column">
                    <h3 class="title is-5 has-text-white">Daichi No</h3>
                    <p>Authentic Japanese dining experiences</p>
                </div>
                <div class="column">
                    <h3 class="title is-5 has-text-white">Order Support</h3>
                    <p><i class="fas fa-phone mr-2"></i> +81 3 1234 5678</p>
                    <p><i class="fas fa-clock mr-2"></i> 9:00 AM - 9:00 PM JST</p>
                </div>
                <div class="column">
                    <h3 class="title is-5 has-text-white">Follow Us</h3>
                    <p>
                        <a href="#" class="has-text-light mr-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="has-text-light mr-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="has-text-light"><i class="fab fa-twitter"></i></a>
                    </p>
                </div>
            </div>
            <hr class="mt-5 mb-5" style="background-color: rgba(255,255,255,0.1);">
            <p>&copy; 2023 Daichi No. All rights reserved.</p>
            <p>All transactions are secured with SSL encryption.</p>
        </div>
    </footer>
</body>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script src="{{ asset('js/frontend/cart.js') }}"></script>
<script src="{{ asset('js/frontend/cart-reservations.js') }}"></script>
</html>