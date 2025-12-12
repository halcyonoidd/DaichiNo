<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - About Us</title>
    <!-- Bulma CSS Framework -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>
<body>
    <nav class="navbar transparent" id="navbar">
        <div class="nav-section left">
            <a href="{{ route('home') }}" class="nav-link light">Home</a>
            <a href="{{ route('menu') }}" class="nav-link light">Menu</a>
        </div>
        
        <div class="nav-center">
            <a href="{{ route('home') }}" class="home-link dark">Daichi No</a>
        </div>
        
        <div class="nav-section right">
            <a href="{{ route('reservation') }}" class="nav-link light">Reservation</a>
            <a href="{{ route('contact') }}" class="nav-link light">Contact</a>
        </div>
    </nav>

    <section class="about-hero">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-8">
                    <h1 class="title is-1 has-text-white mb-4">Our Story</h1>
                    <p class="subtitle is-4 has-text-light">Where tradition meets innovation in the art of Japanese cuisine</p>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section history-section" id="history">
        <div class="container">
            <div class="section-title">
                <h2 class="title is-2">Our History</h2>
                <p class="subtitle is-5 has-text-grey">A journey of culinary excellence spanning three decades</p>
            </div>
            
            <div class="timeline-container">
                <div class="timeline-item">
                    <div class="timeline-year">
                        <div class="year-box">1990</div>
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
                        <div class="year-box">1998</div>
                    </div>
                    <div class="timeline-content">
                        <div class="box">
                            <h3 class="title is-4">First Michelin Star</h3>
                            <p>After eight years of dedication to culinary perfection, Daichi No received its first Michelin star. This recognition validated Chef Tanaka's vision of bringing traditional Japanese cooking techniques to a modern audience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section vision-section" id="vision">
        <div class="container">
            <div class="section-title">
                <h2 class="title is-2">Our Vision & Philosophy</h2>
                <p class="subtitle is-5 has-text-grey">More than just a restaurant - a culinary experience</p>
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
                        <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Restaurant Philosophy">
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <section class="chefs-section" id="chefs">
        <div class="container">
            <div class="section-title">
                <h2 class="title is-2">Meet Our Master Chefs</h2>
                <p class="subtitle is-5 has-text-grey">The culinary artists behind Daichi No's exceptional dishes</p>
            </div>
        </div>
        
        <!-- Fixed Pop-up Carousel -->
        <div class="chef-carousel-wrapper">
            <div class="chef-carousel-container" id="chef-carousel-container">
                <!-- Chef cards will be dynamically positioned -->
            </div>
        </div>
        
        <div class="container">
            <div class="carousel-controls">
                <button class="carousel-btn" id="prev-chef">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                <button class="carousel-btn carousel-play-pause" id="play-pause">
                    <i class="fas fa-pause" id="play-pause-icon"></i>
                </button>
                
                <button class="carousel-btn" id="next-chef">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            
            <div class="carousel-dots" id="carousel-dots">
                <!-- Dots will be dynamically added -->
            </div>
        </div>
    </section>

    <!-- Chef Details Modal -->
    <div class="modal chef-modal" id="chef-modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title" id="modal-chef-name">Chef Name</p>
                <button class="delete" aria-label="close" id="close-modal"></button>
            </header>
            <section class="modal-card-body">
                <div class="modal-image">
                    <img id="modal-chef-image" src="" alt="Chef">
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
            <p>&copy; 2023 Daichi No. All rights reserved.</p>
            <p>Honoring tradition, embracing innovation</p>
        </div>
    </footer>
</body>
<script src="{{ asset('js/about.js') }}"></script>
</html>