<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Contact Us</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/contact.css') }}">
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

    <section class="contact-hero">
        <h1>Get In Touch</h1>
        <p>Click one of our sushi to get our attention!</p>
    </section>

    <div class="container">
        <br>
        
        <div class="sushi-board">
            <div class="sushi-piece nigiri salmon-nigiri" data-contact="phone">
                <div class="sushi-type">PHONE</div>
                <div class="sushi-label">Salmon</div>
            </div>
            
            <div class="sushi-piece nigiri tuna-nigiri" data-contact="email">
                <div class="sushi-type">EMAIL</div>
                <div class="sushi-label">Tuna</div>
            </div>
            
            <div class="sushi-piece nigiri ebi-nigiri" data-contact="address">
                <div class="sushi-type">ADDRESS</div>
                <div class="sushi-label">Shrimp</div>
            </div>
            
            <div class="sushi-piece roll california-roll" data-contact="hours">
                <div class="sushi-type">HOURS</div>
                <div class="sushi-label">California</div>
            </div>

            <div class="sushi-piece nigiri unagi-nigiri" data-contact="social">
                <div class="sushi-type">SOCIAL</div>
                <div class="sushi-label">Eel</div>
            </div>
        </div>
    
        <div class="contact-modal">
            <div class="contact-content">
                <div class="close-modal">
                    <i class="fas fa-times"></i>
                </div>
                
                <div class="contact-header">
                    <h2 id="contact-title">Contact Information</h2>
                    <p id="contact-subtitle">Get in touch with us</p>
                </div>
                
                <div class="contact-info">
                    <div class="contact-item phone-contact">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Phone Number</h3>
                            <p>+62 6767 1234 567</p>
                            <p>Available: Mon-Sun, 10AM-10PM</p>
                        </div>
                    </div>
                    
                    <div class="contact-item email-contact">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Email Address</h3>
                            <p>info@daichino.com</p>
                            <p>reservations@daichino.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-item address-contact">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Restaurant Location</h3>
                            <p>123 Graha Natura Park, Surabaya</p>
                            <p>Indonesia</p>
                        </div>
                    </div>
                    
                    <div class="contact-item hours-contact">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Business Hours</h3>
                            <p>Monday - Friday: 11:30AM - 10:00PM</p>
                            <p>Saturday - Sunday: 12:00PM - 11:00PM</p>
                        </div>
                    </div>
                    
                    <div class="contact-item social-contact">
                        <div class="contact-icon">
                            <i class="fas fa-hashtag"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Social Media</h3>
                            <p>Instagram: @daichino_</p>
                            <p>Facebook: /daichino</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="map-section">
        <div class="container">
            <div class="section-title">
                <h2 class="title is-2">Find Us</h2>
            </div>
            <div class="location-content">
                <div class="location-info">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3 class="title" style="color: #c53d13;">Address</h3>
                            <p><b>123, Graha Natura Park<br>Surabaya, Indonesia</b></p>
                        </div>
                    </div>
                </div>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1978.8494529390725!2d112.66829891943792!3d-7.275061392425836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1765610106263!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        <br>
        <br>
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

    <script src="{{ asset('js/frontend/contact.js') }}"></script>
</body>
</html>