<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Menu</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/bulma.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/frontend/menu.css') }}">
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
            <a href="#menu" class="nav-link light">Menu</a>
            <a href="{{ route('reservation') }}" class="nav-link light">Reservation</a>
            <a href="{{ route('cart') }}" class="nav-link light">Cart(0)</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>The Menu</h1>
            <p>Explore The Variations of Culinary Delights offered in Our Experience</p>
            <a href="#parallax-menu" class="btn" style="margin-top: 20px;">Discover Menu</a>
        </div>
    </section>

    <section class="spacing"></section>

    <section class="menu-nav" id="parallax-menu">
        <div class="container">
            <div class="section-title">
                <h2>Navigate</h2>
                <p>Select a category to view dishes</p>
            </div>
            <div class="menu-categories" id="menu-categories">
                <div class="menu-category active" data-category="sushi_and_sashimi">Sushi &amp; Sashimi</div>
                <div class="menu-category" data-category="ramen_and_noodles">Ramen &amp; Noodles</div>
                <div class="menu-category" data-category="grilled_specialties">Grilled Specialties</div>
                <div class="menu-category" data-category="appetizer">Appetizer</div>
                <div class="menu-category" data-category="dessert">Dessert</div>
                <div class="menu-category" data-category="drink">Drink</div>
            </div>
        </div>
    </section>

    <section class="menu-section" id="menu">
        <div class="container">
            <div class="section-title">
                <h2>Our Menu</h2>
            </div>

            <div class="category-description-section">
                <div class="category-description active" id="sushi_and_sashimi-description">
                    <h3 class="category-title"><i class="fas fa-fish"></i> Sushi &amp; Sashimi</h3>
                    <p class="category-text">
                        Every part of the sea we could get our hands on. Starting from the most abundant delicacy crafted with
                        masterful hands, to a unique and downright strange creature captured then served for a wild tongue.
                        Every single bite of fish will leave your senses tingling with melty and velvety texture alongside
                        magnificent taste.
                    </p>
                    <div class="category-features">
                        <span class="feature-tag">Fresh Daily Delivery</span>
                        <span class="feature-tag">Traditional Edomae Style</span>
                        <span class="feature-tag">Fish and seafood</span>
                    </div>
                </div>
                
                <div class="category-description" id="ramen_and_noodles-description">
                    <h3 class="category-title"><i class="fas fa-utensils"></i> Ramen &amp; Noodles</h3>
                    <p class="category-text">
                        Warm your soul with our handcrafted ramen bowls and fried dishes, where broth simmers for over 24 hours
                        to develop deep, complex flavors and frying is perfected. Our noodles are made fresh daily using
                        traditional techniques, resulting in the perfect texture and chew. From rich tonkotsu to crispy donburi,
                        each bowl is a comforting masterpiece that represents the heart of Japanese comfort food.
                    </p>
                    <div class="category-features">
                        <span class="feature-tag">24-Hour Broth Simmering</span>
                        <span class="feature-tag">Fresh Daily Noodles</span>
                        <span class="feature-tag">Fried and broth products</span>
                    </div>
                </div>

                <div class="category-description" id="grilled_specialties-description">
                    <h3 class="category-title"><i class="fas fa-fire"></i> Grilled Specialties</h3>
                    <p class="category-text">
                        Discover the smoky, savory flavors of Japanese grilled cuisine. Using premium ingredients and traditional
                        binchotan charcoal, our grill masters create dishes that highlight natural flavors with minimal seasoning.
                        From perfectly charred yakitori to succulent wagyu, each piece is cooked to perfection over controlled heat
                        for maximum flavor development.
                    </p>
                    <div class="category-features">
                        <span class="feature-tag">Binchotan Charcoal Grill</span>
                        <span class="feature-tag">Premium Ingredients</span>
                        <span class="feature-tag">Grilled</span>
                    </div>
                </div>

                <div class="category-description" id="appetizer-description">
                    <h3 class="category-title"><i class="fas fa-seedling"></i> Appetizer</h3>
                    <p class="category-text">
                        Begin your culinary journey with our carefully curated selection of small plates. These dishes are designed
                        to awaken your palate and prepare you for the main course. From traditional favorites like edamame and gyoza
                        to innovative creations, each appetizer showcases seasonal ingredients and balanced flavors that reflect
                        Japanese culinary philosophy.
                    </p>
                    <div class="category-features">
                        <span class="feature-tag">Seasonal Ingredients</span>
                        <span class="feature-tag">Palate Preparation</span>
                        <span class="feature-tag">Appetizers</span>
                    </div>
                </div>

                <div class="category-description" id="dessert-description">
                    <h3 class="category-title"><i class="fas fa-ice-cream"></i> Dessert</h3>
                    <p class="category-text">
                        Conclude your meal with our exquisite Japanese-inspired desserts that balance sweetness with subtlety.
                        Unlike Western desserts, our creations focus on natural flavors, elegant presentation, and light textures.
                        From traditional matcha preparations to modern fusion desserts, each sweet treat provides a perfect ending
                        to your dining experience.
                    </p>
                    <div class="category-features">
                        <span class="feature-tag">Subtle Sweetness</span>
                        <span class="feature-tag">Artistic Presentation</span>
                        <span class="feature-tag">Desserts</span>
                    </div>
                </div>

                <div class="category-description" id="drink-description">
                    <h3 class="category-title"><i class="fas fa-glass-whiskey"></i> Drink</h3>
                    <p class="category-text">
                        Complement your meal with our carefully selected beverage program. From premium sake curated by our sommelier
                        to traditional teas and innovative cocktails, each drink is chosen to enhance your dining experience. Our sake
                        selection includes rare finds and regional specialties, while our tea service follows traditional Japanese
                        ceremony principles.
                    </p>
                    <div class="category-features">
                        <span class="feature-tag">Premium Sake Selection</span>
                        <span class="feature-tag">Traditional Tea Ceremony</span>
                        <span class="feature-tag">Beverages</span>
                    </div>
                </div>
            </div>

            <div class="menu-items active" id="sushi_and_sashimi-items">
                @php $items = $products->where('category', 'sushi_and_sashimi'); @endphp
                @forelse($items as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ $product->image_path ? asset($product->image_path) : asset('img/products/placeholder.jpg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'No description provided.' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="no-items">Belum ada produk tersedia.</p>
                @endforelse
            </div>
            
            <div class="menu-items" id="ramen_and_noodles-items">
                @php $items = $products->where('category', 'ramen_and_noodles'); @endphp
                @forelse($items as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ $product->image_path ? asset($product->image_path) : asset('img/products/placeholder.jpg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'No description provided.' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="no-items">Belum ada produk tersedia.</p>
                @endforelse
            </div>

            <div class="menu-items" id="grilled_specialties-items">
                @php $items = $products->where('category', 'grilled_specialties'); @endphp
                @forelse($items as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ $product->image_path ? asset($product->image_path) : asset('img/products/placeholder.jpg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'No description provided.' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="no-items">Belum ada produk tersedia.</p>
                @endforelse
            </div>

            <div class="menu-items" id="appetizer-items">
                @php $items = $products->where('category', 'appetizer'); @endphp
                @forelse($items as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ $product->image_path ? asset($product->image_path) : asset('img/products/placeholder.jpg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'No description provided.' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="no-items">Belum ada produk tersedia.</p>
                @endforelse
            </div>

            <div class="menu-items" id="dessert-items">
                @php $items = $products->where('category', 'dessert'); @endphp
                @forelse($items as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ $product->image_path ? asset($product->image_path) : asset('img/products/placeholder.jpg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'No description provided.' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="no-items">Belum ada produk tersedia.</p>
                @endforelse
            </div>

            <div class="menu-items" id="drink-items">
                @php $items = $products->where('category', 'drink'); @endphp
                @forelse($items as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ $product->image_path ? asset($product->image_path) : asset('img/products/placeholder.jpg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'No description provided.' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="no-items">Belum ada produk tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

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

    <script src="{{ asset('js/frontend/menu.js') }}"></script>
</body>
</html>
