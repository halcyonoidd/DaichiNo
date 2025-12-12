<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Contact Us</title>
    <!-- Bulma CSS Framework -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>
    <nav class="navbar transparent" id="navbar">
        <div class="nav-section left">
            <a href="{{ route('home') }}" class="nav-link light">Home</a>
            <a href="{{ route('about') }}" class="nav-link light">About</a>
            <a href="{{ route('menu') }}" class="nav-link light">Menu</a>
        </div>
        
        <div class="nav-center">
            <a href="{{ route('home') }}" class="home-link dark">Daichi No</a>
        </div>
        
        <div class="nav-section right">
            <a href="{{ route('reservation') }}" class="nav-link light">Reservation</a>
            <a href="#contact-form" class="nav-link light">Contact</a>
        </div>
    </nav>

    <section class="contact-hero">
        <h1>Get In Touch</h1>
        <p>Connect with us through our unique 3D sushi contact interface</p>
    </section>

    <section class="sushi-contact-section" id="contact">
        <div class="container">
            <div class="wooden-base">
                <div class="sushi-grid">
                    <!-- Phone Contact (Nigiri with Salmon) -->
                    <div class="sushi-contact-item" style="top: 100px; left: 100px;">
                        <div class="sushi-shape nigiri">
                            <div class="nigiri-rice"></div>
                            <div class="nigiri-fish salmon"></div>
                        </div>
                        <div class="sushi-info">
                            <div class="info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <h3 class="info-title">Phone</h3>
                            <div class="info-details">
                                <p><strong>Reservations:</strong> +81 3 1234 5678</p>
                                <p><strong>General Inquiries:</strong> +81 3 1234 5679</p>
                                <p>Monday - Sunday: 10:00 AM - 10:00 PM</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Email Contact (Nigiri with Tuna) -->
                    <div class="sushi-contact-item" style="top: 250px; left: 300px;">
                        <div class="sushi-shape nigiri">
                            <div class="nigiri-rice"></div>
                            <div class="nigiri-fish tuna"></div>
                        </div>
                        <div class="sushi-info">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h3 class="info-title">Email</h3>
                            <div class="info-details">
                                <p><strong>Reservations:</strong><br>
                                <a href="mailto:reservations@daichino.com">reservations@daichino.com</a></p>
                                <p><strong>General:</strong><br>
                                <a href="mailto:info@daichino.com">info@daichino.com</a></p>
                                <p><strong>Events:</strong><br>
                                <a href="mailto:events@daichino.com">events@daichino.com</a></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Location Contact (Maki with Avocado) -->
                    <div class="sushi-contact-item" style="top: 100px; left: 500px;">
                        <div class="sushi-shape maki">
                            <div class="maki-nori"></div>
                            <div class="maki-rice"></div>
                            <div class="maki-filling avocado"></div>
                        </div>
                        <div class="sushi-info">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3 class="info-title">Location</h3>
                            <div class="info-details">
                                <p><strong>Daichi No Restaurant</strong></p>
                                <p>123 Sakura Street, Ginza<br>
                                Tokyo 104-0061, Japan</p>
                                <p>Nearest Station: Ginza Station (Exit A5)</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media Contact (Nigiri with Salmon) -->
                    <div class="sushi-contact-item" style="top: 250px; left: 700px;">
                        <div class="sushi-shape nigiri">
                            <div class="nigiri-rice"></div>
                            <div class="nigiri-fish salmon"></div>
                        </div>
                        <div class="sushi-info">
                            <div class="info-icon">
                                <i class="fas fa-hashtag"></i>
                            </div>
                            <h3 class="info-title">Social Media</h3>
                            <div class="info-details">
                                <p><strong>Follow us for updates:</strong></p>
                                <p><i class="fab fa-instagram"></i> @daichino.tokyo</p>
                                <p><i class="fab fa-facebook"></i> /daichinotokyo</p>
                                <p><i class="fab fa-twitter"></i> @daichino_tokyo</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Hours Contact (Maki with Avocado) -->
                    <div class="sushi-contact-item" style="top: 100px; left: 900px;">
                        <div class="sushi-shape maki">
                            <div class="maki-nori"></div>
                            <div class="maki-rice"></div>
                            <div class="maki-filling avocado"></div>
                        </div>
                        <div class="sushi-info">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h3 class="info-title">Hours</h3>
                            <div class="info-details">
                                <p><strong>Lunch Service:</strong><br>
                                11:30 AM - 2:30 PM</p>
                                <p><strong>Dinner Service:</strong><br>
                                5:30 PM - 10:00 PM</p>
                                <p><strong>Closed:</strong> Tuesday</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Private Events Contact (Nigiri with Tuna) -->
                    <div class="sushi-contact-item" style="top: 250px; left: 1100px;">
                        <div class="sushi-shape nigiri">
                            <div class="nigiri-rice"></div>
                            <div class="nigiri-fish tuna"></div>
                        </div>
                        <div class="sushi-info">
                            <div class="info-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <h3 class="info-title">Private Events</h3>
                            <div class="info-details">
                                <p><strong>Capacity:</strong><br>
                                Up to 50 guests</p>
                                <p><strong>Contact:</strong><br>
                                <a href="mailto:events@daichino.com">events@daichino.com</a></p>
                                <p><strong>Phone:</strong><br>
                                +81 3 1234 5680</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="has-text-centered mt-6">
                <p class="subtitle is-5 has-text-grey">Hover over the sushi pieces to reveal contact information</p>
            </div>
        </div>
    </section>

    <section class="contact-form-section" id="contact-form">
        <div class="container">
            <div class="section-title">
                <h2 class="title is-2">Send Us a Message</h2>
                <p class="subtitle is-5 has-text-grey">Have questions or special requests? We'd love to hear from you</p>
            </div>
            
            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="box p-6">
                        <form id="contactForm">
                            <div class="columns">
                                <div class="column">
                                    <div class="field">
                                        <label class="label">First Name</label>
                                        <div class="control">
                                            <input class="input" type="text" placeholder="Your first name">
                                        </div>
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="field">
                                        <label class="label">Last Name</label>
                                        <div class="control">
                                            <input class="input" type="text" placeholder="Your last name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="field">
                                <label class="label">Email Address</label>
                                <div class="control">
                                    <input class="input" type="email" placeholder="your.email@example.com">
                                </div>
                            </div>
                            
                            <div class="field">
                                <label class="label">Phone Number</label>
                                <div class="control">
                                    <input class="input" type="tel" placeholder="+81 3 1234 5678">
                                </div>
                            </div>
                            
                            <div class="field">
                                <label class="label">Subject</label>
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select>
                                            <option>Select a subject</option>
                                            <option>Reservation Inquiry</option>
                                            <option>General Question</option>
                                            <option>Private Event</option>
                                            <option>Feedback</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="field">
                                <label class="label">Message</label>
                                <div class="control">
                                    <textarea class="textarea" placeholder="Your message..." rows="6"></textarea>
                                </div>
                            </div>
                            
                            <div class="field">
                                <div class="control">
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        I agree to receive updates and promotions from Daichi No
                                    </label>
                                </div>
                            </div>
                            
                            <div class="field is-grouped is-grouped-centered">
                                <div class="control">
                                    <button class="button is-primary is-large">
                                        <span class="icon">
                                            <i class="fas fa-paper-plane"></i>
                                        </span>
                                        <span>Send Message</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div class="container">
            <div class="section-title">
                <h2 class="title is-2">Find Us</h2>
                <p class="subtitle is-5 has-text-grey">Visit our restaurant in the heart of Tokyo's Ginza district</p>
            </div>
            
            <div class="map-container">
                <!-- Map placeholder - in a real site, you'd embed Google Maps -->
                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%); display: flex; align-items: center; justify-content: center; color: #666;">
                    <div class="has-text-centered">
                        <i class="fas fa-map-marked-alt fa-4x mb-4"></i>
                        <p class="title is-5">Interactive Map Location</p>
                        <p class="subtitle is-6">123 Sakura Street, Ginza, Tokyo</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <h3 class="title is-5 has-text-white">Daichi No</h3>
                    <p>Authentic Japanese cuisine with modern flair</p>
                </div>
                <div class="column">
                    <h3 class="title is-5 has-text-white">Quick Links</h3>
                    <p><a href="home.html" class="has-text-light">Home</a></p>
                    <p><a href="menu.html" class="has-text-light">Menu</a></p>
                    <p><a href="about.html" class="has-text-light">About</a></p>
                    <p><a href="#contact" class="has-text-light">Contact</a></p>
                </div>
                <div class="column">
                    <h3 class="title is-5 has-text-white">Connect</h3>
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
<script serc="{{ asset('js/contact.js') }}"></script>
</html>