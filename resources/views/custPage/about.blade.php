<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - About Us</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/bulma.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/frontend/about.css') }}">
</head>
<body>
    <nav class="navbar transparent" id="navbar">
        <div class="nav-section left">
            <a href="#" class="nav-link light">About</a>
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

    <section class="about-hero">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-8">
                    <h1 class="title is-1 has-text-white mb-4">The Story</h1>
                    <p class="subtitle is-4 has-text-light">Where tradition meets innovation in the art of Japanese cuisine</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section history-section" id="history">
        <div class="container">
            <div class="section-title">
                <h2 class="title is-2">Fragment of History</h2>
            </div>
            
            <div class="timeline-container">
                <div class="timeline-item">
                    <div class="timeline-year">
                        <div class="year-box">2018</div>
                    </div>
                    <div class="timeline-content">
                        <div class="box">
                            <h3 class="title is-4">The Beginning</h3>
                            <p>Daichi No was founded by Master Chef Hiroshi Tanaka in a small Kyoto neighborhood. With just six tables and a commitment to authentic Japanese flavors, the restaurant quickly gained recognition for its exquisite sushi and warm hospitality.</p>
                        </div>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-year">
                        <div class="year-box">2019</div>
                    </div>
                    <div class="timeline-content">
                        <div class="box">
                            <h3 class="title is-4">First Michelin Star</h3>
                            <p>After eight years of dedication to culinary perfection, Daichi No received its first Michelin star. This recognition validated Chef Tanaka's vision of bringing traditional Japanese cooking techniques to a modern audience.</p>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">
                        <div class="year-box">2020</div>
                    </div>
                    <div class="timeline-content">
                        <div class="box">
                            <h3 class="title is-4">Second Michelin Star</h3>
                            <p>Daichi No was founded by Master Chef Hiroshi Tanaka in a small Kyoto neighborhood. With just six tables and a commitment to authentic Japanese flavors, the restaurant quickly gained recognition for its exquisite sushi and warm hospitality.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section vision-section" id="vision">
        <div class="container">
            <div class="section-title">
                <h2 class="title is-2">Vision & Philosophy</h2>
            </div>
            
            <div class="columns is-vcentered">
                <div class="column is-6">
                    <h3 class="title is-3 mb-5">The Daichi No Philosophy</h3>
                    <p class="mb-5">At Daichi No, we believe that exceptional dining is not just about food - it's about creating memorable experiences that engage all the senses. Our philosophy is rooted in three core principles:</p>
                    
                    <div class="vision-points">
                        <article class="media">
                            <figure class="media-left">
                                <span class="icon is-large">
                                    <i class="fas fa-leaf fa-2x"></i>
                                </span>
                            </figure>
                            <div class="media-content">
                                <h4 class="title is-5">Seasonal & Sustainable</h4>
                                <p>We source ingredients at their peak seasonality, working directly with local farmers and fishermen who share our commitment to sustainability.</p>
                            </div>
                        </article>
                        
                        <article class="media">
                            <figure class="media-left">
                                <span class="icon is-large">
                                    <i class="fas fa-hand-sparkles fa-2x"></i>
                                </span>
                            </figure>
                            <div class="media-content">
                                <h4 class="title is-5">Artisanal Craftsmanship</h4>
                                <p>Every dish is prepared with meticulous attention to detail, combining traditional techniques with contemporary creativity.</p>
                            </div>
                        </article>
                    </div>
                </div>
                
                <div class="column is-6">
                    <figure class="image is-16by9">
                        <img src="/img/aboutImage/img.jpg" alt="Vision Image">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="chefs-section" id="chefs">
        <div class="container">
            <div class="section-title">
                <h2 class="title is-2">Meet Our Master Chefs</h2>
            </div>
        </div>
        
        <div class="chef-carousel-wrapper">
            <div class="chef-carousel-container" id="chef-carousel-container">
            </div>
        </div>
        
        <div class="container">
            <div class="carousel-controls">
                <button class="carousel-btn" id="prev-chef">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                <button class="carousel-btn carousel-play-pause" id="play-pause" style="visibility: hidden;">
                </button>
                
                <button class="carousel-btn" id="next-chef">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            
            <div class="carousel-dots" id="carousel-dots">
            </div>
        </div>
    </section>

    <div class="modal chef-modal" id="chef-modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title" id="modal-chef-name">Chef Name</p>
                <button class="delete" aria-label="close" id="close-modal"></button>
            </header>
            <section class="modal-card-body">
                <div class="modal-image">
                    <img id="modal-chef-image" src="/img/aboutImage/img.jpg" alt="Chef">
                </div>
                <div class="modal-content">
                    <div class="modal-title" id="modal-chef-title">Chef Title</div>
                    <p class="mb-5" id="modal-chef-bio">Chef biography goes here...</p>
                    
                    <div class="popup-details">
                        <div class="detail-item">
                            <i class="fas fa-award"></i>
                            <div><strong>Achievements:</strong> <span id="modal-chef-achievements"></span></div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-graduation-cap"></i>
                            <div><strong>Training:</strong> <span id="modal-chef-training"></span></div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-utensils"></i>
                            <div><strong>Specialty:</strong> <span id="modal-chef-specialty"></span></div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-calendar-alt"></i>
                            <div><strong>Years at Daichi No:</strong> <span id="modal-chef-years"></span></div>
                        </div>
                    </div>
                    
                    <p class="chef-signature mt-5" id="modal-chef-quote"></p>
                </div>
            </section>
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

    <script src="{{ asset('js/frontend/about.js') }}"></script>
</body>
</html>