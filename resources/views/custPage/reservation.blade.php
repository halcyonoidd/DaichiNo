<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Reservations & Experiences</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/bulma.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/frontend/reservation.css') }}">
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

    <div class="reserve-modal" id="reserve-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-experience-name">Experience Name</h3>
            </div>
            <div class="modal-body">
                <div class="modal-image">
                    <img id="modal-experience-image" src="" alt="Experience">
                </div>
                <div class="modal-details">
                    <div class="modal-price" id="modal-experience-price">¥0</div>
                    <p id="modal-experience-description">Experience description</p>
                </div>
                
                <div class="form-group">
                    <label for="guest-count">Number of Guests</label>
                    <div class="guest-selector">
                        <button class="qty-btn" id="decrease-guests">-</button>
                        <span class="qty-value" id="guest-count">1</span>
                        <button class="qty-btn" id="increase-guests">+</button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="special-requests">Special Requests (Optional)</label>
                    <textarea class="textarea" id="special-requests" placeholder="Dietary restrictions, allergies, or special occasions..." rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label class="checkbox">
                        <input type="checkbox" id="terms-agreement">
                        I agree to the cancellation policy (48 hours notice required)
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-total">
                    Total: <span class="modal-total-amount" id="modal-total-price">¥0</span>
                </div>
                <div>
                    <button class="button is-light mr-2" id="cancel-reserve">Cancel</button>
                    <button class="button is-primary" id="confirm-reserve">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>

    <section class="reservation-hero">
        <h1>Book Your Experience</h1>
        <p>Select from our curated dining experiences and secure your reservation</p>
    </section>

    <div class="reservation-container">
        <div class="category-sidebar">
            <div class="sidebar-title">
                <h3>Filter Experiences</h3>
            </div>
            
            <div class="category-filters">
                <div class="filter-group">
                    <div class="filter-group-title">
                        <i class="fas fa-clock"></i>
                        <span>Duration</span>
                    </div>
                    <ul class="filter-options">
                        <li class="filter-option active" data-filter="all-duration">
                            <i class="fas fa-star"></i>
                            <span>All Durations</span>
                            <span class="filter-count">6</span>
                        </li>
                        <li class="filter-option" data-filter="short">
                            <i class="fas fa-hourglass-start"></i>
                            <span>Short (1-2 hours)</span>
                            <span class="filter-count">2</span>
                        </li>
                        <li class="filter-option" data-filter="medium">
                            <i class="fas fa-hourglass-half"></i>
                            <span>Medium (2-3 hours)</span>
                            <span class="filter-count">2</span>
                        </li>
                        <li class="filter-option" data-filter="long">
                            <i class="fas fa-hourglass-end"></i>
                            <span>Long (3+ hours)</span>
                            <span class="filter-count">2</span>
                        </li>
                    </ul>
                </div>

                <div class="filter-group">
                    <div class="filter-group-title">
                        <i class="fas fa-utensils"></i>
                        <span>Number of Courses</span>
                    </div>
                    <ul class="filter-options">
                        <li class="filter-option" data-filter="all-courses">
                            <i class="fas fa-star"></i>
                            <span>All Courses</span>
                            <span class="filter-count">6</span>
                        </li>
                        <li class="filter-option" data-filter="few">
                            <i class="fas fa-layer-group"></i>
                            <span>Few (5-8 courses)</span>
                            <span class="filter-count">3</span>
                        </li>
                        <li class="filter-option" data-filter="many">
                            <i class="fas fa-layer-group"></i>
                            <span>Many (8-12 courses)</span>
                            <span class="filter-count">3</span>
                        </li>
                    </ul>
                </div>
                
                <div class="filter-group">
                    <div class="filter-group-title">
                        <i class="fas fa-yen-sign"></i>
                        <span>Price Range</span>
                    </div>
                    <ul class="filter-options">
                        <li class="filter-option" data-filter="all-price">
                            <i class="fas fa-star"></i>
                            <span>All Prices</span>
                            <span class="filter-count">6</span>
                        </li>
                        <li class="filter-option" data-filter="budget">
                            <i class="fas fa-wallet"></i>
                            <span>Budget (under ¥15,000)</span>
                            <span class="filter-count">2</span>
                        </li>
                        <li class="filter-option" data-filter="mid-range">
                            <i class="fas fa-wallet"></i>
                            <span>Mid-Range (¥15,000-¥30,000)</span>
                            <span class="filter-count">2</span>
                        </li>
                        <li class="filter-option" data-filter="premium">
                            <i class="fas fa-gem"></i>
                            <span>Premium (¥30,000+)</span>
                            <span class="filter-count">2</span>
                        </li>
                    </ul>
                </div>
                
                <div class="filter-group">
                    <div class="filter-group-title">
                        <i class="fas fa-crown"></i>
                        <span>Experience Tier</span>
                    </div>
                    <ul class="filter-options">
                        <li class="filter-option" data-filter="all-tier">
                            <i class="fas fa-star"></i>
                            <span>All Tiers</span>
                            <span class="filter-count">6</span>
                        </li>
                        <li class="filter-option" data-filter="bronze">
                            <i class="fas fa-award"></i>
                            <span>Bronze</span>
                            <span class="filter-count">2</span>
                        </li>
                        <li class="filter-option" data-filter="silver">
                            <i class="fas fa-award"></i>
                            <span>Silver</span>
                            <span class="filter-count">1</span>
                        </li>
                        <li class="filter-option" data-filter="gold">
                            <i class="fas fa-award"></i>
                            <span>Gold</span>
                            <span class="filter-count">2</span>
                        </li>
                        <li class="filter-option" data-filter="platinum">
                            <i class="fas fa-award"></i>
                            <span>Platinum</span>
                            <span class="filter-count">1</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="experience-list">
            <div class="section-title">
                <h2>Available Experiences</h2>
                <p class="subtitle">Browse and select from our exclusive dining experiences</p>
            </div>

            <div class="experience-item" data-duration="short" data-courses="few" data-price="budget" data-tier="bronze" data-id="1">
                <div class="experience-image">
                    <img src="source\bg\sakura.jpg">
                </div>
                <div class="experience-content">
                    <div class="experience-header">
                        <div>
                            <div class="experience-title">Sakura Experience</div>
                            <div class="experience-tier bronze-tier">Bronze Tier</div>
                        </div>
                        <div>
                            <div class="experience-price">¥12,500</div>
                            <div class="price-subtitle">per person</div>
                        </div>
                    </div>
                    
                    <div class="experience-details">
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span><strong>Duration:</strong> 1.5 hours</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-utensils"></i>
                            <span><strong>Courses:</strong> 6-course meal</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <span><strong>Group Size:</strong> 2-4 people</span>
                        </div>
                    </div>
                    
                    <div class="experience-features">
                        <ul class="feature-list">
                            <li>Full Yomi Experience</li>
                            <li>Part Mizu Experience</li>
                            <li>Part Daichi Menu</li>
                            <li>Few Gaen Menu</li>
                        </ul>
                    </div>
                    
                    <div class="experience-footer">
                        <div class="experience-tags">
                            <span class="experience-tag">Short Duration</span>
                            <span class="experience-tag">Few Courses</span>
                            <span class="experience-tag">Budget Friendly</span>
                        </div>
                        <button class="reserve-btn" data-id="1">
                            <i class="fas fa-calendar-plus"></i>
                            Reserve Now
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="experience-item" data-duration="medium" data-courses="few" data-price="mid-range" data-tier="silver" data-id="2">
                <div class="experience-image">
                    <img src="source\bg\koi.jpg">
                </div>
                <div class="experience-content">
                    <div class="experience-header">
                        <div>
                            <div class="experience-title">Koi Experience</div>
                            <div class="experience-tier silver-tier">Silver Tier</div>
                        </div>
                        <div>
                            <div class="experience-price">¥18,500</div>
                            <div class="price-subtitle">per person</div>
                        </div>
                    </div>
                    
                    <div class="experience-details">
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span><strong>Duration:</strong> 2 hours</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-utensils"></i>
                            <span><strong>Courses:</strong> 7-course meal</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <span><strong>Group Size:</strong> 2-6 people</span>
                        </div>
                    </div>
                    
                    <div class="experience-features">
                        <ul class="feature-list">
                            <li>Full Yomi Experience</li>
                            <li>Full Mizu Experience</li>
                            <li>Part Kaen Experience</li>
                            <li>Full Gaen Menu</li>
                        </ul>
                    </div>
                    
                    <div class="experience-footer">
                        <div class="experience-tags">
                            <span class="experience-tag">Medium Duration</span>
                            <span class="experience-tag">Few Courses</span>
                            <span class="experience-tag">Mid-Range</span>
                        </div>
                        <button class="reserve-btn" data-id="2">
                            <i class="fas fa-calendar-plus"></i>
                            Reserve Now
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="experience-item" data-duration="medium" data-courses="many" data-price="mid-range" data-tier="gold" data-id="3">
                <div class="experience-image">
                    <img src="source\bg\fuji.jpg">
                </div>
                <div class="experience-content">
                    <div class="experience-header">
                        <div>
                            <div class="experience-title">Fuji Experience</div>
                            <div class="experience-tier gold-tier">Gold Tier</div>
                        </div>
                        <div>
                            <div class="experience-price">¥25,000</div>
                            <div class="price-subtitle">per person</div>
                        </div>
                    </div>
                    
                    <div class="experience-details">
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span><strong>Duration:</strong> 2.5 hours</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-utensils"></i>
                            <span><strong>Courses:</strong> 9-course meal</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <span><strong>Group Size:</strong> 2-8 people</span>
                        </div>
                    </div>
                    
                    <div class="experience-features">
                        <ul class="feature-list">
                            <li>Full Daichi Menu</li>
                            <li>Full Mizu Experience</li>
                            <li>Full Kaen Experience</li>
                            <li>Part Ten Menu</li>
                            <li>Part Yomi Experience</li>
                            <li>Full Gaen Menu</li>
                        </ul>
                    </div>
                    
                    <div class="experience-footer">
                        <div class="experience-tags">
                            <span class="experience-tag">Medium Duration</span>
                            <span class="experience-tag">Many Courses</span>
                            <span class="experience-tag">Mid-Range</span>
                        </div>
                        <button class="reserve-btn" data-id="3">
                            <i class="fas fa-calendar-plus"></i>
                            Reserve Now
                        </button>
                    </div>
                </div>
            </div>

            <div class="experience-item" data-duration="long" data-courses="many" data-price="premium" data-tier="platinum" data-id="4">
                <div class="experience-image">
                    <img src="source\bg\imperial.jpg">
                </div>
                <div class="experience-content">
                    <div class="experience-header">
                        <div>
                            <div class="experience-title">Imperial Experience</div>
                            <div class="experience-tier platinum-tier">Platinum Tier</div>
                        </div>
                        <div>
                            <div class="experience-price">¥38,000</div>
                            <div class="price-subtitle">per person</div>
                        </div>
                    </div>
                    
                    <div class="experience-details">
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span><strong>Duration:</strong> 3.5 hours</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-utensils"></i>
                            <span><strong>Courses:</strong> 12-course omakase</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <span><strong>Group Size:</strong> 2-4 people</span>
                        </div>
                    </div>
                    
                    <div class="experience-features">
                        <ul class="feature-list">
                            <li>Full Mizu Experience</li>
                            <li>Full Daichi Menu</li>
                            <li>Full Gaen Menu & Experience</li>
                            <li>Full Kaen Experience</li>
                            <li>Full Yomi Experience</li>
                            <li>Full Ten Menu</li>
                        </ul>
                    </div>
                    
                    <div class="experience-footer">
                        <div class="experience-tags">
                            <span class="experience-tag">Long Duration</span>
                            <span class="experience-tag">Many Courses</span>
                            <span class="experience-tag">Premium</span>
                        </div>
                        <button class="reserve-btn" data-id="4">
                            <i class="fas fa-calendar-plus"></i>
                            Reserve Now
                        </button>
                    </div>
                </div>
            </div>

            <div class="experience-item" data-duration="short" data-courses="few" data-price="budget" data-tier="bronze" data-id="5">
                <div class="experience-image">
                    <img src="source\bg\zen.jpg">
                </div>
                <div class="experience-content">
                    <div class="experience-header">
                        <div>
                            <div class="experience-title">Zen Experience</div>
                            <div class="experience-tier bronze-tier">Bronze Tier</div>
                        </div>
                        <div>
                            <div class="experience-price">¥9,800</div>
                            <div class="price-subtitle">per person</div>
                        </div>
                    </div>
                    
                    <div class="experience-details">
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span><strong>Duration:</strong> 1 hour</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-utensils"></i>
                            <span><strong>Courses:</strong> 5-course lunch</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <span><strong>Group Size:</strong> 1-8 people</span>
                        </div>
                    </div>
                    
                    <div class="experience-features">
                        <ul class="feature-list">
                            <li>Full Daichi Menu</li>
                            <li>Full Yomi Experience</li>
                            <li>Part Ten Menu</li>
                            <li>Part Gaen Menu</li>
                        </ul>
                    </div>
                    
                    <div class="experience-footer">
                        <div class="experience-tags">
                            <span class="experience-tag">Short Duration</span>
                            <span class="experience-tag">Few Courses</span>
                            <span class="experience-tag">Budget Friendly</span>
                        </div>
                        <button class="reserve-btn" data-id="5">
                            <i class="fas fa-calendar-plus"></i>
                            Reserve Now
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="experience-item" data-duration="long" data-courses="many" data-price="mid-range" data-tier="gold" data-id="6">
                <div class="experience-image">
                    <img src="source\bg\samurai.jpg">
                </div>
                <div class="experience-content">
                    <div class="experience-header">
                        <div>
                            <div class="experience-title">Samurai Experience</div>
                            <div class="experience-tier gold-tier">Gold Tier</div>
                        </div>
                        <div>
                            <div class="experience-price">¥28,500</div>
                            <div class="price-subtitle">per person</div>
                        </div>
                    </div>
                    
                    <div class="experience-details">
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <span><strong>Duration:</strong> 3 hours</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-utensils"></i>
                            <span><strong>Courses:</strong> 10-course meal</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <span><strong>Group Size:</strong> 4-10 people</span>
                        </div>
                    </div>
                    
                    <div class="experience-features">
                        <ul class="feature-list">
                            <li>Full Daichi Menu</li>
                            <li>Full Yomi Experience</li>
                            <li>Full Mizu Experience</li>
                            <li>Full Gaen Menu</li>
                            <li>Part Kaen Experience</li>
                        </ul>
                    </div>
                    
                    <div class="experience-footer">
                        <div class="experience-tags">
                            <span class="experience-tag">Long Duration</span>
                            <span class="experience-tag">Many Courses</span>
                            <span class="experience-tag">Mid-Range</span>
                        </div>
                        <button class="reserve-btn" data-id="6">
                            <i class="fas fa-calendar-plus"></i>
                            Reserve Now
                        </button>
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

    <script src ="{{ asset('js/frontend/reservation.js') }}"></script>
</body>
</html>