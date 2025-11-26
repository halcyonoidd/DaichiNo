<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Japanese Restaurant</title>
    <link rel="stylesheet" href="{{ asset('css/bulma.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

</head>
<body>
    <nav class="navbar transparent" id="navbar">
        <div class="nav-section left">
            <a href="#about" class="nav-link light">About</a>
            <a href="#voucher" class="nav-link light">Voucher</a>
            <a href="#contact" class="nav-link light">Contact</a>
        </div>
        
        <div class="nav-center">
            <a href="#" class="home-link dark">Daichi No</a>
        </div>
        
        <div class="nav-section right">
            <a href="#reservation" class="nav-link light">Reservation</a>
            <a href="#cart" class="nav-link light">Cart</a>
            <a href="/register" class="nav-link light">Register</a>
        </div>
    </nav>

    <section class="hero light">
        <h1>A Fragment of <b style="color: var(--light-accent)">Everything</b>,</h1>
        <h1>Things that are Delicious</h1>
        <div class="hero-buttons">
            <a href="#reservation" class="btn">Make Reservation</a>
            <a href="#menu" class="btn" style="background-color: transparent; border: 2px solid white; margin-left: 15px;">View Menu</a>
        </div>
    </section>

    <section class="section about" id="about">
        <div class="container">
            <div class="section-title">
                <h2>Our Story</h2>
                <p class="subtitle">Discover the tradition and passion behind Daichi No</p>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <h3 class="title is-3">Authentic Japanese Cuisine</h3>
                    <p>Founded in 2005, Daichi No brings the authentic taste of Japan to your table. Our chefs have trained in Tokyo and Kyoto, mastering traditional techniques while incorporating modern culinary innovations.</p>
                    <p>We source our ingredients carefully, with many items imported directly from Japan to ensure an authentic dining experience. From the freshest sashimi to perfectly seasoned rice, every dish tells a story of Japanese culinary heritage.</p>
                    <p>At Daichi No, we believe that dining is not just about nourishment, but about creating memorable experiences that engage all the senses.</p>
                    <a href="#reservation" class="btn" style="margin-top: 20px;">Visit Us</a>
                </div>
                <div class="about-image">
                    <img src="/img/restaurantInterior.png" alt="Japanese Restaurant Interior">
                </div>
            </div>
        </div>
    </section>

    <section class="section rekomendasi" id="rekomendasi">
        <div class="container">
            <div class="section-title">
                <h2>Our Recommendation</h2>
                <p class="subtitle">A culinary journey through the flavors of Japan</p>
            </div>
            <div class="menu-categories">
                <div class="menu-category active">Sushi & Sashimi</div>
                <div class="menu-category">Ramen & Noodles</div>
                <div class="menu-category">Grilled Specialties</div>
                <div class="menu-category">Appetizers</div>
                <div class="menu-category">Desserts</div>
            </div>
            <div class="menu-items">
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=627&q=80" alt="Salmon Sashimi">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Salmon Sashimi</h3>
                            <span class="menu-item-price">$18</span>
                        </div>
                        <p class="menu-item-description">Fresh Atlantic salmon, thinly sliced and served with wasabi and soy sauce</p>
                        <a href="#cart" class="btn" style="padding: 8px 15px; font-size: 0.9rem;">Add to Cart</a>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80" alt="Dragon Roll">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Dragon Roll</h3>
                            <span class="menu-item-price">$22</span>
                        </div>
                        <p class="menu-item-description">Eel, cucumber, avocado, and tobiko with eel sauce drizzle</p>
                        <a href="#cart" class="btn" style="padding: 8px 15px; font-size: 0.9rem;">Add to Cart</a>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="https://images.unsplash.com/photo-1569718212165-3a8278d5f624?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80" alt="Tonkotsu Ramen">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Tonkotsu Ramen</h3>
                            <span class="menu-item-price">$16</span>
                        </div>
                        <p class="menu-item-description">Rich pork broth with chashu pork, soft-boiled egg, and bamboo shoots</p>
                        <a href="#cart" class="btn" style="padding: 8px 15px; font-size: 0.9rem;">Add to Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section reservation" id="reservation">
        <div class="container">
            <div class="section-title">
                <h2>Make a Reservation</h2>
                <p class="subtitle">Book your table for an unforgettable dining experience</p>
            </div>
            <div class="reservation-form">
                <form>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" class="form-control" placeholder="Your Phone">
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" id="date" class="form-control">
                            </div>
                        </div>
                        <div class="column">
                            <div class="form-group">
                                <label for="time">Time</label>
                                <input type="time" id="time" class="form-control">
                            </div>
                        </div>
                        <div class="column">
                            <div class="form-group">
                                <label for="guests">Number of Guests</label>
                                <select id="guests" class="form-control">
                                    <option value="1">1 Person</option>
                                    <option value="2">2 People</option>
                                    <option value="3">3 People</option>
                                    <option value="4">4 People</option>
                                    <option value="5">5 People</option>
                                    <option value="6">6 People</option>
                                    <option value="7">7+ People</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="special-requests">Special Requests</label>
                        <textarea id="special-requests" class="form-control" rows="3" placeholder="Any special requirements or requests"></textarea>
                    </div>
                    <button type="submit" class="btn" style="width: 100%;">Book Now</button>
                </form>
            </div>
        </div>
    </section>

    <section class="section testimonials">
        <div class="container">
            <div class="section-title">
                <h2>What Our Customers Say</h2>
                <p class="subtitle">Don't just take our word for it</p>
            </div>
            <div class="testimonial-slider">
                <div class="testimonial">
                    <p class="testimonial-text">The best Japanese food I've had outside of Japan. The sushi was incredibly fresh and the service was impeccable. Will definitely be returning soon!</p>
                    <p class="testimonial-author">- Sarah Johnson</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section location" id="contact">
        <div class="container">
            <div class="section-title">
                <h2>Visit Us</h2>
                <p class="subtitle">Come experience authentic Japanese cuisine</p>
            </div>
            <div class="location-content">
                <div class="location-info">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3 class="title is-5">Address</h3>
                            <p>123 Sakura Street, Downtown<br>Tokyo, Japan 100-0001</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h3 class="title is-5">Opening Hours</h3>
                            <p>Monday - Friday: 11:00 AM - 10:00 PM<br>Saturday - Sunday: 11:00 AM - 11:00 PM</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h3 class="title is-5">Phone</h3>
                            <p>+81 3 1234 5678</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h3 class="title is-5">Email</h3>
                            <p>info@daichino.com</p>
                        </div>
                    </div>
                </div>
                <div class="location-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.747798533325!2d139.7432442152581!3d35.65858048019966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188bb0daa74d31%3A0x6c2ec4f5e9b1bf61!2sShibuya%20Crossing!5e0!3m2!1sen!2sjp!4v1651234567890!5m2!1sen!2sjp" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
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
                        <a href="#"><i class="fab fa-tripadvisor"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#menu">Our Menu</a></li>
                        <li><a href="#reservation">Reservations</a></li>
                        <li><a href="#voucher">Gift Vouchers</a></li>
                        <li><a href="#contact">Contact Us</a></li>
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
                <div class="footer-column">
                    <h3>Newsletter</h3>
                    <p>Subscribe to our newsletter for updates and special offers.</p>
                    <div class="field has-addons" style="margin-top: 15px;">
                        <div class="control">
                            <input class="input" type="email" placeholder="Your email address">
                        </div>
                        <div class="control">
                            <button class="button is-primary">Subscribe</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 Daichi No. All rights reserved. | Designed with <i class="fas fa-heart" style="color: var(--accent-color);"></i></p>
            </div>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            const scrollPosition = window.scrollY;
            
            if (scrollPosition > 100) {
                navbar.classList.remove('transparent');
                navbar.classList.add('solid');
            } else {
                navbar.classList.remove('solid');
                navbar.classList.add('transparent');
            }
        });

        // Simple menu category selection
        document.querySelectorAll('.menu-category').forEach(category => {
            category.addEventListener('click', function() {
                document.querySelectorAll('.menu-category').forEach(cat => {
                    cat.classList.remove('active');
                });
                this.classList.add('active');
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>