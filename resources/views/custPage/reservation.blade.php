<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Reservations & Experiences</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/bulma.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/frontend/reservation.css') }}">
</head>
<body>
    <nav class="navbar transparent" id="navbar">
        <div class="nav-section left">
            <a href="{{ route('about') }}" class="nav-link light">About</a>
            <a href="{{ route('contact') }}" class="nav-link light">Contact</a>
        </div>
        
        <div class="nav-center">
            <a href="{{ route('home') }}" class="home-link dark">Daichi No</a>
        </div>
        
        <div class="nav-section right">
            <a href="{{ route('menu') }}" class="nav-link light">Menu</a>
            <a href="{{ route('reservation') }}" class="nav-link light">Reservation</a>
            <a href="{{ route('cart') }}" class="nav-link light">Cart</a>
        </div>
    </nav>

    <div class="cart-notification" id="cart-notification">
        <i class="fas fa-check-circle"></i>
        <span>Added to cart!</span>
    </div>

    <div class="cart-sidebar" id="cart-sidebar">
        <div class="cart-header">
            <h3>Your Reservation Cart</h3>
            <button class="close-cart" id="close-cart">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="cart-items" id="cart-items">
            <div class="has-text-centered py-6" id="empty-cart-message">
                <i class="fas fa-shopping-cart fa-3x mb-4 has-text-grey-light"></i>
                <p class="subtitle is-6 has-text-grey">Your cart is empty</p>
                <p class="is-size-7 has-text-grey">Add reservations to get started</p>
            </div>
        </div>
        <div class="cart-footer">
            <div class="cart-total">
                <span>Total:</span>
                <span class="total-amount" id="cart-total">Rp0</span>
            </div>
            <button class="button is-primary is-fullwidth is-large" id="checkout-btn">
                <span class="icon">
                    <i class="fas fa-credit-card"></i>
                </span>
                <span>Proceed to Checkout</span>
            </button>
        </div>
    </div>

    <button class="view-cart-btn" id="view-cart-btn">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-count">0</span>
    </button>

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
                    <label for="full-name">Full Name *</label>
                    <input type="text" class="input" id="full-name" placeholder="Enter your full name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="input" id="email" placeholder="Enter your email" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="tel" class="input" id="phone" placeholder="Enter your phone number" required>
                </div>
                
                <div class="form-group">
                    <label for="reservation-date">Reservation Date *</label>
                    <input type="date" class="input" id="reservation-date" required>
                </div>
                
                <div class="form-group">
                    <label for="time-start">Start Time *</label>
                    <input type="time" class="input" id="time-start" required>
                </div>
                
                <div class="form-group">
                    <label for="time-end">End Time *</label>
                    <input type="time" class="input" id="time-end" required>
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
                <i class="fas fa-user-circle "></i>
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

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script src="{{ asset('js/frontend/reservation.js') }}"></script>
</body>
</html>