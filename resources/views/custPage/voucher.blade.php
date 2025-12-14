<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Gift Vouchers & Experiences</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/bulma.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/frontend/voucher.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/logout-notification.css') }}">
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

    <div class="cart-notification" id="cart-notification">
        <i class="fas fa-check-circle"></i>
        <span>Added to cart!</span>
    </div>

    <div class="cart-sidebar" id="cart-sidebar">
        <div class="cart-header">
            <h3>Your Voucher Cart</h3>
            <button class="close-cart" id="close-cart">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="cart-items" id="cart-items">
            <div class="has-text-centered py-6" id="empty-cart-message">
                <i class="fas fa-shopping-cart fa-3x mb-4 has-text-grey-light"></i>
                <p class="subtitle is-6 has-text-grey">Your cart is empty</p>
                <p class="is-size-7 has-text-grey">Add vouchers to get started</p>
            </div>
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                <span>Total:</span>
                <span class="total-amount" id="cart-total">¥0</span>
            </div>
            <button class="button is-primary is-fullwidth is-large" id="checkout-btn">
                <span class="icon">
                    <i class="fas fa-credit-card"></i>
                </span>
                <span>Proceed to Checkout</span>
            </button>
        </div>
    </div>

    <section class="vouchers-hero">
        <h1>Gift Vouchers</h1>
        <p>Share the Daichi No experience with loved ones or treat yourself</p>
    </section>

    <div class="vouchers-container">
        <div class="section-title">
            <h2>Choose Voucher Type</h2>
            <p class="subtitle">Select from different voucher categories to find the perfect gift or discount</p>
        </div>
        
        <div class="voucher-types" id="voucher-types">
            <div class="type-card active" data-type="all">
                <div class="type-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <h3>All Vouchers</h3>
                <p>Browse our complete collection of gift vouchers and discounts</p>
            </div>
            
            <div class="type-card" data-type="experience">
                <div class="type-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <h3>Experience Vouchers</h3>
                <p>Pre-booked dining experiences for special occasions</p>
            </div>
            
            <div class="type-card" data-type="discount">
                <div class="type-icon">
                    <i class="fas fa-percentage"></i>
                </div>
                <h3>Discount Vouchers</h3>
                <p>Percentage or fixed amount discounts on your meal</p>
            </div>
            
            <div class="type-card" data-type="meal">
                <div class="type-icon">
                    <i class="fas fa-wine-glass-alt"></i>
                </div>
                <h3>Meal Add-ons</h3>
                <p>Enhance your experience with premium additions</p>
            </div>
        </div>
        
        <div class="section-title">
            <h2>Available Vouchers</h2>
            <p class="subtitle">Each voucher can be applied to your dining experience for discounts or enhancements</p>
        </div>
        
        <div class="vouchers-grid" id="vouchers-grid">
            <div class="voucher-card" data-type="experience" data-id="1">
                <div class="voucher-header">
                    <div class="voucher-tier experience-voucher">Experience Voucher</div>
                    <h3 class="voucher-title">Complete Sakura Experience</h3>
                    <p class="voucher-description">Full 6-course dining experience for one person</p>
                </div>
                <div class="voucher-body">
                    <div class="voucher-details">
                        <div class="detail-item">
                            <i class="fas fa-utensils"></i>
                            <span><strong>Includes:</strong> 6-course meal, drinks, dessert</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span><strong>Duration:</strong> 1.5 hours</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-calendar"></i>
                            <span><strong>Validity:</strong> 12 months from purchase</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <span><strong>For:</strong> 1 person (can combine multiple)</span>
                        </div>
                    </div>
                    <div class="original-price">¥12,500</div>
                    <div class="voucher-price">¥11,500</div>
                    <div class="value-info">Save ¥1,000 (8% discount)</div>
                </div>
                <div class="voucher-footer">
                    <button class="add-to-cart-btn" data-id="1">
                        <i class="fas fa-cart-plus"></i>
                        Add to Cart
                    </button>
                </div>
            </div>

            <div class="voucher-card" data-type="discount" data-id="2">
                <div class="voucher-header">
                    <div class="voucher-tier discount-voucher">Discount Voucher</div>
                    <h3 class="voucher-title">20% Off Any Experience</h3>
                    <p class="voucher-description">Significant savings on any dining experience</p>
                </div>
                <div class="voucher-body">
                    <div class="voucher-details">
                        <div class="detail-item">
                            <i class="fas fa-percentage"></i>
                            <span><strong>Discount:</strong> 20% off total bill</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span><strong>Validity:</strong> 6 months from purchase</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <span><strong>Max Group:</strong> Up to 6 people</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-exclamation-circle"></i>
                            <span><strong>Note:</strong> Cannot combine with other offers</span>
                        </div>
                    </div>
                    <div class="voucher-price">¥8,000</div>
                    <div class="value-info">Save up to ¥15,200 on Platinum Experience</div>
                </div>
                <div class="voucher-footer">
                    <button class="add-to-cart-btn" data-id="2">
                        <i class="fas fa-cart-plus"></i>
                        Add to Cart
                    </button>
                </div>
            </div>

            <div class="voucher-card" data-type="meal" data-id="3">
                <div class="voucher-header">
                    <div class="voucher-tier meal-voucher">Meal Add-on</div>
                    <h3 class="voucher-title">Premium Sake Pairing</h3>
                    <p class="voucher-description">Enhanced beverage experience with your meal</p>
                </div>
                <div class="voucher-body">
                    <div class="voucher-details">
                        <div class="detail-item">
                            <i class="fas fa-wine-glass-alt"></i>
                            <span><strong>Includes:</strong> 5 premium sake tastings</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-concierge-bell"></i>
                            <span><strong>Served with:</strong> Expert pairing guidance</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-calendar"></i>
                            <span><strong>Validity:</strong> 12 months from purchase</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <span><strong>For:</strong> 1 person (additional available)</span>
                        </div>
                    </div>
                    <div class="original-price">¥6,500</div>
                    <div class="voucher-price">¥5,500</div>
                    <div class="value-info">Save ¥1,000 (15% discount)</div>
                </div>
                <div class="voucher-footer">
                    <button class="add-to-cart-btn" data-id="3">
                        <i class="fas fa-cart-plus"></i>
                        Add to Cart
                    </button>
                </div>
            </div>
            
            <div class="voucher-card" data-type="experience" data-id="4">
                <div class="voucher-header">
                    <div class="voucher-tier gift-voucher">Gift Card</div>
                    <h3 class="voucher-title">Custom Amount Gift Card</h3>
                    <p class="voucher-description">Flexible gift amount for any Daichi No experience</p>
                </div>
                <div class="voucher-body">
                    <div class="voucher-details">
                        <div class="detail-item">
                            <i class="fas fa-yen-sign"></i>
                            <span><strong>Amount:</strong> Customizable (min ¥5,000)</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-calendar"></i>
                            <span><strong>Validity:</strong> 18 months from purchase</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-gift"></i>
                            <span><strong>Includes:</strong> Premium gift packaging</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-credit-card"></i>
                            <span><strong>Redemption:</strong> Online or in-restaurant</span>
                        </div>
                    </div>
                    <div class="voucher-price">Custom</div>
                    <div class="value-info">Choose amount at checkout</div>
                    <div class="field mt-4">
                        <label class="label is-small">Select Amount (¥)</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select id="gift-card-amount">
                                    <option value="5000">¥5,000</option>
                                    <option value="10000">¥10,000</option>
                                    <option value="15000" selected>¥15,000</option>
                                    <option value="20000">¥20,000</option>
                                    <option value="30000">¥30,000</option>
                                    <option value="50000">¥50,000</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="voucher-footer">
                    <button class="add-to-cart-btn" data-id="4" data-custom="true">
                        <i class="fas fa-cart-plus"></i>
                        Add to Cart
                    </button>
                </div>
            </div>

            <div class="voucher-card" data-type="meal" data-id="5">
                <div class="voucher-header">
                    <div class="voucher-tier meal-voucher">Meal Add-on</div>
                    <h3 class="voucher-title">A5 Wagyu Beef Upgrade</h3>
                    <p class="voucher-description">Upgrade your experience with premium Wagyu</p>
                </div>
                <div class="voucher-body">
                    <div class="voucher-details">
                        <div class="detail-item">
                            <i class="fas fa-drumstick-bite"></i>
                            <span><strong>Includes:</strong> 150g A5 Wagyu steak</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-mortar-pestle"></i>
                            <span><strong>Preparation:</strong> Teppanyaki or traditional</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-calendar"></i>
                            <span><strong>Validity:</strong> 12 months from purchase</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <span><strong>For:</strong> 1 person (additional available)</span>
                        </div>
                    </div>
                    <div class="original-price">¥12,000</div>
                    <div class="voucher-price">¥10,500</div>
                    <div class="value-info">Save ¥1,500 (12.5% discount)</div>
                </div>
                <div class="voucher-footer">
                    <button class="add-to-cart-btn" data-id="5">
                        <i class="fas fa-cart-plus"></i>
                        Add to Cart
                    </button>
                </div>
            </div>
            
            <div class="voucher-card" data-type="discount" data-id="6">
                <div class="voucher-header">
                    <div class="voucher-tier discount-voucher">Special Offer</div>
                    <h3 class="voucher-title">Anniversary Celebration Package</h3>
                    <p class="voucher-description">Special package for anniversary celebrations</p>
                </div>
                <div class="voucher-body">
                    <div class="voucher-details">
                        <div class="detail-item">
                            <i class="fas fa-glass-cheers"></i>
                            <span><strong>Includes:</strong> Champagne & dessert</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-camera"></i>
                            <span><strong>Bonus:</strong> Professional photo session</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-calendar"></i>
                            <span><strong>Validity:</strong> 3 months from purchase</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <span><strong>For:</strong> Couples (2 people)</span>
                        </div>
                    </div>
                    <div class="original-price">¥15,000</div>
                    <div class="voucher-price">¥12,000</div>
                    <div class="value-info">Save ¥3,000 (20% discount)</div>
                </div>
                <div class="voucher-footer">
                    <button class="add-to-cart-btn" data-id="6">
                        <i class="fas fa-cart-plus"></i>
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
        
        <div class="how-it-works">
            <div class="section-title">
                <h2>How Vouchers Work</h2>
                <p class="subtitle">Simple steps to purchase and redeem your Daichi No vouchers</p>
            </div>
            
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h4>Purchase Voucher</h4>
                    <p>Select your preferred voucher type and add to cart. Complete checkout to receive your digital voucher.</p>
                </div>
                
                <div class="step">
                    <div class="step-number">2</div>
                    <h4>Receive Voucher</h4>
                    <p>Get instant digital delivery via email with beautiful printable option. Perfect for last-minute gifts.</p>
                </div>
                
                <div class="step">
                    <div class="step-number">3</div>
                    <h4>Book Experience</h4>
                    <p>Use voucher code when booking your dining experience online or mention it when making phone reservations.</p>
                </div>
                
                <div class="step">
                    <div class="step-number">4</div>
                    <h4>Enjoy Your Meal</h4>
                    <p>Present your voucher on arrival. Discounts apply automatically, add-ons enhance your dining experience.</p>
                </div>
            </div>
        </div>
        
        <div class="section-title">
            <h2>Frequently Asked Questions</h2>
            <p class="subtitle">Get answers to common questions about our vouchers</p>
        </div>
        
        <div class="content" style="max-width: 800px; margin: 0 auto 60px;">
            <div class="box">
                <h4 class="title is-5" style="color: var(--primary-color);">Can I use multiple vouchers for one reservation?</h4>
                <p>Yes, you can combine one experience voucher with up to two add-on vouchers. However, only one discount voucher can be applied per reservation.</p>
            </div>
            
            <div class="box">
                <h4 class="title is-5" style="color: var(--primary-color);">What if my voucher expires?</h4>
                <p>We offer a 30-day grace period after expiration where you can still use your voucher, though we recommend using it before the expiry date for the best experience.</p>
            </div>
            
            <div class="box">
                <h4 class="title is-5" style="color: var(--primary-color);">Are vouchers refundable?</h4>
                <p>Vouchers are non-refundable but fully transferable. You can gift them to someone else if you cannot use them yourself.</p>
            </div>
            
            <div class="box">
                <h4 class="title is-5" style="color: var(--primary-color);">Can I purchase vouchers for specific dates?</h4>
                <p>Experience vouchers are valid for any available reservation date within their validity period. You'll need to book your preferred date separately.</p>
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
            @auth
                <div class="user-name" id="user-name">{{ auth()->user()->name }}</div>
                <div class="user-email" id="user-email">{{ auth()->user()->email }}</div>
            @else
                <div class="user-name" id="user-name">Guest</div>
                <div class="user-email" id="user-email">Please log in</div>
            @endauth
        </div>
        
        <div class="panel-actions">
            <a href="{{ route('profile') }}" class="panel-btn panel-btn-primary">
                <i class="fas fa-user-circle mr-2"></i> View Profile
            </a>
            <button class="panel-btn panel-btn-logout" id="logout-btn">
                <i class="fas fa-sign-out-alt mr-2"></i> Log Out
            </button>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>

    <!-- Logout Confirmation Modal -->
    <div id="logout-modal" class="logout-modal">
        <div class="logout-modal-overlay"></div>
        <div class="logout-modal-content">
            <div class="logout-modal-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <h2 class="logout-modal-title">Konfirmasi Logout</h2>
            <p class="logout-modal-text">Apakah Anda yakin ingin keluar?</p>
            <div class="logout-modal-buttons">
                <button id="cancel-logout" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button id="confirm-logout" class="btn-confirm">
                    <i class="fas fa-check"></i> Ya, Logout
                </button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/frontend/voucher.js') }}"></script>

</body>
</html>