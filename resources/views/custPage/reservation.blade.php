<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Reservations & Experiences</title>
    <!-- Bulma CSS Framework -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/reservation.css') }}">
</head>
<body>
    <nav class="navbar transparent" id="navbar">
        <div class="nav-section left">
            <a href="{{ route('home') }}" class="nav-link light">Home</a>
            <a href="{{ route('about') }}" class="nav-link light">About</a>
            <a href="{{ route('menu') }}" class="nav-link light">Menu</a>
            <a href="{{ route('contact') }}" class="nav-link light">Contact</a>
        </div>
        
        <div class="nav-center">
            <a href="{{ route('home') }}" class="home-link dark">Daichi No</a>
        </div>
        
        <div class="nav-section right">
            <a href="#" class="nav-link light" id="view-cart-btn">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>
        </div>
    </nav>

    <!-- Cart Notification -->
    <div class="cart-notification" id="cart-notification">
        <i class="fas fa-check-circle"></i>
        <span>Added to cart!</span>
    </div>

    <!-- Cart Sidebar -->
    <div class="cart-sidebar" id="cart-sidebar">
        <div class="cart-header">
            <h3>Your Experience Cart</h3>
            <button class="close-cart" id="close-cart">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="cart-items" id="cart-items">
            <!-- Cart items will be dynamically added here -->
            <div class="has-text-centered py-6" id="empty-cart-message">
                <i class="fas fa-shopping-cart fa-3x mb-4 has-text-grey-light"></i>
                <p class="subtitle is-6 has-text-grey">Your cart is empty</p>
                <p class="is-size-7 has-text-grey">Add experience tickets to get started</p>
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

    <!-- Reserve Modal -->
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
        <!-- Category Sidebar -->
        <div class="category-sidebar">
            <div class="sidebar-title">
                <h3>Filter Experiences</h3>
            </div>
            
            <div class="category-filters">
                <!-- Duration Filter -->
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
                
                <!-- Courses Filter -->
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
                
                <!-- Price Filter -->
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
                
                <!-- Tier Filter -->
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
        
        <!-- Experience List -->
        <div class="experience-list">
            <div class="section-title">
                <h2>Available Experiences</h2>
                <p class="subtitle">Browse and select from our exclusive dining experiences</p>
            </div>
            
            <!-- Experience 1: Sakura Experience -->
            <div class="experience-item" data-duration="short" data-courses="few" data-price="budget" data-tier="bronze" data-id="1">
                <div class="experience-image">
                    <img src="https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=627&q=80" alt="Sakura Experience">
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
                            <li>Seasonal appetizer selection</li>
                            <li>Premium sushi tasting</li>
                            <li>Miso soup & pickled vegetables</li>
                            <li>Green tea or house sake</li>
                            <li>Traditional Japanese dessert</li>
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
            
            <!-- Experience 2: Koi Experience -->
            <div class="experience-item" data-duration="medium" data-courses="few" data-price="mid-range" data-tier="silver" data-id="2">
                <div class="experience-image">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80" alt="Koi Experience">
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
                            <li>Seasonal kaiseki appetizers</li>
                            <li>Sashimi & nigiri selection</li>
                            <li>Grilled fish of the day</li>
                            <li>Premium sake pairing</li>
                            <li>Chef's special dessert</li>
                            <li>Live cooking demonstration</li>
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
            
            <!-- Experience 3: Fuji Experience -->
            <div class="experience-item" data-duration="medium" data-courses="many" data-price="mid-range" data-tier="gold" data-id="3">
                <div class="experience-image">
                    <img src="https://images.unsplash.com/photo-1569718212165-3a8278d5f624?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80" alt="Fuji Experience">
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
                            <li>Exclusive kaiseki menu</li>
                            <li>Premium seafood selection</li>
                            <li>Wagyu beef dish</li>
                            <li>Sake sommelier service</li>
                            <li>Seasonal hot pot</li>
                            <li>Artisanal dessert platter</li>
                            <li>Private tatami room</li>
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
            
            <!-- Experience 4: Imperial Experience -->
            <div class="experience-item" data-duration="long" data-courses="many" data-price="premium" data-tier="platinum" data-id="4">
                <div class="experience-image">
                    <img src="https://images.unsplash.com/photo-1585969009662-1ad1fa8123ba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Imperial Experience">
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
                            <li>Exclusive omakase menu</li>
                            <li>Rare & seasonal ingredients</li>
                            <li>A5 Wagyu beef preparation</li>
                            <li>Premium sake & wine pairing</li>
                            <li>Live sashimi preparation</li>
                            <li>Truffle-infused dishes</li>
                            <li>Chef's table experience</li>
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
            
            <!-- Experience 5: Zen Experience -->
            <div class="experience-item" data-duration="short" data-courses="few" data-price="budget" data-tier="bronze" data-id="5">
                <div class="experience-image">
                    <img src="https://images.unsplash.com/photo-1563245372-f21724e3856d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80" alt="Zen Experience">
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
                            <li>Daily lunch special</li>
                            <li>Fresh salad & miso soup</li>
                            <li>Chef's choice bento box</li>
                            <li>Assorted sushi selection</li>
                            <li>Green tea & dessert</li>
                            <li>Quick lunch option</li>
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
            
            <!-- Experience 6: Samurai Experience -->
            <div class="experience-item" data-duration="long" data-courses="many" data-price="mid-range" data-tier="gold" data-id="6">
                <div class="experience-image">
                    <img src="https://images.unsplash.com/photo-1626645735466-7864d0430faa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Samurai Experience">
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
                            <li>Group kaiseki experience</li>
                            <li>Shared hot pot dining</li>
                            <li>Assorted grilled dishes</li>
                            <li>Premium sake tasting flight</li>
                            <li>Live tempura station</li>
                            <li>Seasonal dessert platter</li>
                            <li>Group photo & digital album</li>
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
            <div class="columns">
                <div class="column">
                    <h3 class="title is-5 has-text-white">Daichi No</h3>
                    <p>Authentic Japanese dining experiences</p>
                </div>
                <div class="column">
                    <h3 class="title is-5 has-text-white">Reservation Info</h3>
                    <p><i class="fas fa-phone mr-2"></i> +81 3 1234 5678</p>
                    <p><i class="fas fa-clock mr-2"></i> Open daily from 11:30 AM</p>
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
            <p>Experience the art of Japanese cuisine</p>
        </div>
    </footer>
</body>
<script src="{{ asset('js/reservation.js') }}"></script>
</html>