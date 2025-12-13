<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Menu</title>
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
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
            <a href="{{ route('cart') }}" class="nav-link light">Cart</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>Culinary Dimensions</h1>
            <p>Explore our interactive 3D hexahedron menu</p>
            <a href="#parallax-menu" class="btn" style="margin-top: 20px;">Discover Menu</a>
        </div>
    </section>

    <section class="parallax-section" id="parallax-menu">
        <div class="parallax-bg"></div>
        <div class="parallax-content">
            <h2>Interactive 3D Menu</h2>
            <p>Navigate through our culinary dimensions using the controls below</p>
            
            <div class="hexahedron-container">
                <div class="hexahedron" id="hexahedron">
                    <div class="face face-front active" data-category="sushi">Sushi & Sashimi</div>
                    <div class="face face-back" data-category="ramen">Ramen & Noodles</div>
                    <div class="face face-right" data-category="grilled">Grilled Specialties</div>
                    <div class="face face-left" data-category="appetizers">Appetizers</div>
                    <div class="face face-top" data-category="desserts">Desserts</div>
                    <div class="face face-bottom" data-category="beverages">Beverages</div>
                </div>
            </div>
            
            <div class="category-indicator" id="category-indicator">Current Category: Sushi & Sashimi</div>
            
            <div class="hexahedron-controls">
                <button class="control-btn" id="rotate-up"><i class="fas fa-arrow-up"></i></button>
                <button class="control-btn" id="rotate-left"><i class="fas fa-arrow-left"></i></button>
                <button class="control-btn" id="rotate-down"><i class="fas fa-arrow-down"></i></button>
                <button class="control-btn" id="rotate-right"><i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
    </section>

    <section class="menu-section" id="menu">
        <div class="container">
            <div class="section-title">
                <h2>Our Menu</h2>
                <p>Select a category using the 3D hexahedron controls</p>
            </div>
            
            <!-- Sushi & Sashimi Category -->
            <div class="menu-items active" id="sushi-items">
                @forelse($products->where('category', 'sushi_and_sashimi') as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ asset($product->image_path ?? 'img/placeholders/placeholder-sushi.svg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'A delicious Japanese specialty' }}</p>
                            <a href="#cart" class="btn btn-small">Add to Cart</a>
                        </div>
                    </div>
                @empty
                    <div class="menu-item">
                        <p style="text-align: center; padding: 2rem;">No items available in this category</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Ramen & Noodles Category -->
            <div class="menu-items" id="ramen-items">
                @forelse($products->where('category', 'ramen_and_noodles') as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ asset($product->image_path ?? 'img/placeholders/placeholder-ramen.svg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'A delicious Japanese specialty' }}</p>
                            <a href="#cart" class="btn btn-small">Add to Cart</a>
                        </div>
                    </div>
                @empty
                    <div class="menu-item">
                        <p style="text-align: center; padding: 2rem;">No items available in this category</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Grilled Specialties Category -->
            <div class="menu-items" id="grilled-items">
                @forelse($products->where('category', 'grilled_specialties') as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ asset($product->image_path ?? 'img/placeholders/placeholder-grilled.svg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'A delicious Japanese specialty' }}</p>
                            <a href="#cart" class="btn btn-small">Add to Cart</a>
                        </div>
                    </div>
                @empty
                    <div class="menu-item">
                        <p style="text-align: center; padding: 2rem;">No items available in this category</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Appetizer Category -->
            <div class="menu-items" id="appetizers-items">
                @forelse($products->where('category', 'appetizer') as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ asset($product->image_path ?? 'img/placeholders/placeholder-appetizer.svg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'A delicious Japanese specialty' }}</p>
                            <a href="#cart" class="btn btn-small">Add to Cart</a>
                        </div>
                    </div>
                @empty
                    <div class="menu-item">
                        <p style="text-align: center; padding: 2rem;">No items available in this category</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Dessert Category -->
            <div class="menu-items" id="desserts-items">
                @forelse($products->where('category', 'dessert') as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ asset($product->image_path ?? 'img/placeholders/placeholder-dessert.svg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'A delicious Japanese specialty' }}</p>
                            <a href="#cart" class="btn btn-small">Add to Cart</a>
                        </div>
                    </div>
                @empty
                    <div class="menu-item">
                        <p style="text-align: center; padding: 2rem;">No items available in this category</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Beverages Category -->
            <div class="menu-items" id="beverages-items">
                @forelse($products->where('category', 'drink') as $product)
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="{{ asset($product->image_path ?? 'img/placeholders/placeholder-drink.svg') }}" alt="{{ $product->name }}">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">{{ $product->name }}</h3>
                                <span class="menu-item-price">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <p class="menu-item-description">{{ $product->description ?? 'A delicious Japanese specialty' }}</p>
                            <a href="#cart" class="btn btn-small">Add to Cart</a>
                        </div>
                    </div>
                @empty
                    <div class="menu-item">
                        <p style="text-align: center; padding: 2rem;">No items available in this category</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Yakitori</h3>
                            <span class="menu-item-price">$12</span>
                        </div>
                        <p class="menu-item-description">Grilled chicken skewers with teriyaki glaze</p>
                        <a href="#cart" class="btn btn-small">Add to Cart</a>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="https://images.unsplash.com/photo-1603360946369-dc9bb6258143?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Unagi">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Grilled Unagi</h3>
                            <span class="menu-item-price">$24</span>
                        </div>
                        <p class="menu-item-description">Freshwater eel grilled with sweet soy-based sauce</p>
                        <a href="#cart" class="btn btn-small">Add to Cart</a>
                    </div>
                </div>
            </div>
            
            <!-- Appetizers Category -->
            <div class="menu-items" id="appetizers-items">
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="https://images.unsplash.com/photo-1563245372-f21724e3856d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80" alt="Edamame">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Edamame</h3>
                            <span class="menu-item-price">$6</span>
                        </div>
                        <p class="menu-item-description">Steamed young soybeans with sea salt</p>
                        <a href="#cart" class="btn btn-small">Add to Cart</a>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="https://images.unsplash.com/photo-1626645735466-7864d0430faa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Gyoza">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Gyoza</h3>
                            <span class="menu-item-price">$8</span>
                        </div>
                        <p class="menu-item-description">Pan-fried pork and vegetable dumplings</p>
                        <a href="#cart" class="btn btn-small">Add to Cart</a>
                    </div>
                </div>
            </div>
            
            <!-- Desserts Category -->
            <div class="menu-items" id="desserts-items">
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Mochi Ice Cream">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Mochi Ice Cream</h3>
                            <span class="menu-item-price">$8</span>
                        </div>
                        <p class="menu-item-description">Ice cream wrapped in sweet rice dough</p>
                        <a href="#cart" class="btn btn-small">Add to Cart</a>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="https://images.unsplash.com/photo-1565809229620-51d1cef46c90?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1112&q=80" alt="Matcha Tiramisu">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Matcha Tiramisu</h3>
                            <span class="menu-item-price">$9</span>
                        </div>
                        <p class="menu-item-description">Japanese twist on the classic Italian dessert</p>
                        <a href="#cart" class="btn btn-small">Add to Cart</a>
                    </div>
                </div>
            </div>
            
            <!-- Beverages Category -->
            <div class="menu-items" id="beverages-items">
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="https://images.unsplash.com/photo-1544787219-7f47ccb76574?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Sake">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Premium Sake</h3>
                            <span class="menu-item-price">$12</span>
                        </div>
                        <p class="menu-item-description">Traditional Japanese rice wine served warm or cold</p>
                        <a href="#cart" class="btn btn-small">Add to Cart</a>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80" alt="Matcha">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Ceremonial Matcha</h3>
                            <span class="menu-item-price">$7</span>
                        </div>
                        <p class="menu-item-description">Traditional Japanese green tea prepared ceremonially</p>
                        <a href="#cart" class="btn btn-small">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 Daichi No. All rights reserved.</p>
            <p>Experience the art of Japanese cuisine</p>
        </div>
    </footer>
</body>

<script src="{{ asset('js/menu.js') }}"></script>
</html>