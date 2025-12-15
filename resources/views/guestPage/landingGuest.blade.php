<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Japanese Restaurant</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/bulma.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/frontend/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend/mobile-responsive.css') }}">
</head>
<body>
    <nav class="navbar transparent" id="navbar">
        <div class="nav-section left">
            <a href="{{ route('login') }}" class="nav-link light">About</a>
            <a href="{{ route('login') }}" class="nav-link light">Contact</a>
        </div>
        
        <div class="nav-center">
            <a href="{{ route('login') }}" class="home-link dark">Daichi No</a>
        </div>
        
        <div class="nav-section right">
            <a href="{{ route('login') }}" class="nav-link light">Menu</a>
            <a href="{{ route('login') }}" class="nav-link light">Reservation</a>
            <a href="{{ route('login') }}" class="nav-link light">Login</a>
        </div>
    </nav>

    <section class="hero light">
        <h1>A Fragment of <b style="color: #ebc34c">Everything</b>,</h1>
        <h1>On earth that are Delicious</h1>
        <div class="hero-buttons">
            <a href="{{ route('login') }}" class="btn">Make Reservation</a>
            <a href="{{ route('login') }}" class="btn" style="background-color: transparent; border: 2px solid white; margin-left: 15px;">View Menu</a>
        </div>
    </section>

    <section class="section about" id="aboutUs">
        <div class="container">
            <div class="section-title">
                <h2>A Fragment of a Tale</h2>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <h3 class="title is-3">We serve experience, not food!</h3>
                    <p>Daichi No brings the authentic taste and experience of Nihon to your doorstep.</p>
                    <p>We differ in the way we serve our customers.</p>
                    <p>Customers must move to different area to enjoy specific dishes.</p>
                    <p>We believe this service pushes the already magnificent quality of our food.</p><br>
                    <p>Ouringredients directly sourced from the rising sun.</p>
                    <p>Also Handled by our best chefs who have trained for years</p>
                    <p>In Tokyo and Kyoto, To perfect their crafts.</p>
                    <p>In doing so, creating something that is both</p>
                    <p><b style="color:var(--primary-color)">Unique</b> yet amazingly, feel <b style="color:var(--light-accent)">home.</b></p>
                    <a href="{{ route('about') }}" class="btn" style="margin-top: 20px;">More</a>
                </div>
                <div class="about-image">
                    <div class="carousel-container">
                        <div class="carousel-track">
                            <div class="carousel-slide">
                                <img src="../img/landingImage/crsl1.jpg">
                                <div class="slide-caption">
                                    <h2 class="title is-4 has-text-white">Appetizer Area</h2>
                                    <p>Traditional skewers stand</p>
                                </div>
                            </div>

                            <div class="carousel-slide">
                                <img src="../img/landingImage/crsl2.jpg">
                                <div class="slide-caption">
                                    <h2 class="title is-4 has-text-white">Mitarashi Dango</h2>
                                    <p>Sweet doughy dessert that can be found in Ten Area</p>
                                </div>
                            </div>
                            
                            <div class="carousel-slide">
                                <img src="../img/landingImage/crsl3.jpg">
                                <div class="slide-caption">
                                    <h2 class="title is-4 has-text-white">Lake View</h2>
                                    <p>Tranquil lake that will certainly soothe minds</p>
                                </div>
                            </div>
                            
                            <div class="carousel-slide">
                                <img src="../img/landingImage/crsl4.jpg">
                                <div class="slide-caption">
                                    <h2 class="title is-4 has-text-white">Tonkotsu Ramen</h2>
                                    <p>The best of bone broth ramen, testament of the earth</p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section menu" id="menu">
        <div class="container">
            <div class="section-title">
                <h2>The Menu</h2>
            </div>
            <div class="menu-categories">
                <div class="menu-category active" data-category="mizu">Mizu</div>
                <div class="menu-category" data-category="danpen">Danpen</div>
                <div class="menu-category" data-category="kaen">Kaen</div>
                <div class="menu-category" data-category="yomi">Yomi</div>
                <div class="menu-category" data-category="ten">Ten</div>
            </div>
            <div class="menu-category-content active" id="mizu-content">
                <div class="menu-items">
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/salmon_sashimi.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Salmon Sashimi</h3>
                                <span class="menu-item-price">$18</span>
                            </div>
                            <p class="menu-item-description">Fresh Atlantic salmon, thinly sliced and served with wasabi and soy sauce.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/saba_sushi.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Saba Sushi</h3>
                                <span class="menu-item-price">$22</span>
                            </div>
                            <p class="menu-item-description">Tightly packed slices of pickled mackarel and rice wrapped in bamboo leaves.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/uni_gunkan.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Uni Gunkan</h3>
                                <span class="menu-item-price">$26</span>
                            </div>
                            <p class="menu-item-description">Rich and fresh uni placed atop of rice and wrapped loosely in nori.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/hosomaki.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Hosomaki</h3>
                                <span class="menu-item-price">$12</span>
                            </div>
                            <p class="menu-item-description">Modest variety piece of salmon, tuna, and cucumber wrapped in rice and nori.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-category-content" id="danpen-content">
                <div class="menu-items">
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/inarizushi.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Inarizushi</h3>
                                <span class="menu-item-price">$8</span>
                            </div>
                            <p class="menu-item-description">Sweet soy bean curd filled with rice and topped with sesame seed.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/ten_don.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Ten Don</h3>
                                <span class="menu-item-price">$17</span>
                            </div>
                            <p class="menu-item-description">Fried vegetables variety and shrimp atop bowl of rice.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/crsl4.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Tonkotsu Ramen</h3>
                                <span class="menu-item-price">$21</span>
                            </div>
                            <p class="menu-item-description">Rich bone broth with ramen noodle topped with slices of chashu pork and bamboo shoot.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/katsu.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Katsu</h3>
                                <span class="menu-item-price">$12</span>
                            </div>
                            <p class="menu-item-description">Flatten chicken, breaded and fired to a perfection of juiciness and crispiness.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-category-content" id="kaen-content">
                <div class="menu-items">
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/isobeyaki.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Isobeyaki</h3>
                                <span class="menu-item-price">$11</span>
                            </div>
                            <p class="menu-item-description">Plain grilled mochi with cripy outside and the gooey inside, brushed off with soy sauce for extra savouriness.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/yakitori.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Yakitori</h3>
                                <span class="menu-item-price">$14</span>
                            </div>
                            <p class="menu-item-description">Grilled chicken skewers with teriyaki glaze. Tender and juicy.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/unagi_don.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Unagi Don</h3>
                                <span class="menu-item-price">$25</span>
                            </div>
                            <p class="menu-item-description">Grilled grade A eel with kabayaki sauce over rice.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/yakiniku.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Yakiniku</h3>
                                <span class="menu-item-price">$30</span>
                            </div>
                            <p class="menu-item-description">Slices of beef grilled to perfection over rice and with variety of sides.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="menu-category-content" id="yomi-content">
                <div class="menu-items">
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/edamame.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Edamame</h3>
                                <span class="menu-item-price">$5</span>
                            </div>
                            <p class="menu-item-description">Young soy bean steamed and flavoured with salt.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/agedashi_tofu.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Agedashi Tofu</h3>
                                <span class="menu-item-price">$10</span>
                            </div>
                            <p class="menu-item-description">Fried silken tofu served with tentsuyu. Topped with grated daikon radish and chopped spring onion.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/chawanmushi.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Chawanmushi</h3>
                                <span class="menu-item-price">$15</span>
                            </div>
                            <p class="menu-item-description">Steamed silky custard egg filled with various svaoury filling.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/gyoza.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Gyoza</h3>
                                <span class="menu-item-price">$15</span>
                            </div>
                            <p class="menu-item-description">Soft dumpling pan-fried until crispy at the bottom. Served with ponzu sauce.</p>
                        </div>
                    </div>
                </div>
            </div>

        <div class="menu-category-content" id="ten-content">
                <div class="menu-items">
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/crsl2.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Mitarashi Dango</h3>
                                <span class="menu-item-price">$8</span>
                            </div>
                            <p class="menu-item-description">Dumpling made of glutinous rice formed into a ball. Skewered and served with sweet syrup.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/mochi.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Mochi</h3>
                                <span class="menu-item-price">$6</span>
                            </div>
                            <p class="menu-item-description">Colourful glutinous rice cakes fromed into balls with sweet fillings.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/strb_icecream.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Strawberry Cream Parfait</h3>
                                <span class="menu-item-price">$16</span>
                            </div>
                            <p class="menu-item-description">Sweet cream, strawberries, crumbles stacked to form a faux cake in a glass.</p>
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-image">
                            <img src="../img/landingImage/flan_cake.jpg">
                        </div>
                        <div class="menu-item-content">
                            <div class="menu-item-header">
                                <h3 class="menu-item-name">Flan Cake</h3>
                                <span class="menu-item-price">$17</span>
                            </div>
                            <p class="menu-item-description">Flan or custard base with a layer of clear caramel atop.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="menu-down">
            <a href="{{ route('menu') }}" class="btn" style="padding: 8px 15px; font-size: 0.9rem;">More Items</a>
        </div>
    </section>

    <section class="section testimonials">
        <div class="container">
            <div class="section-title">
                <h2>Our Rep.</h2>
            <div class="trapezoid">
                <div class="testimonial-slider">
                    <div class="testimonial-track">
                        <div class="testimonial">
                            <p class="testimonial-text">The best Japanese food I've had outside of Japan. The sushi was incredibly fresh and the service was impeccable. Will definitely be returning soon!</p>
                            <p class="testimonial-author">- Sarah Johnson</p>
                        </div>

                        <div class="testimonial">
                            <p class="testimonial-text">An unforgettable dining experience. Each dish was a work of art, perfectly balanced and beautifully presented. The omakase menu exceeded all expectations.</p>
                            <p class="testimonial-author">- Michael Tanaka</p>
                        </div>

                        <div class="testimonial">
                            <p class="testimonial-text">The attention to detail is remarkable. From the ambiance to the exquisite flavors, every aspect of the meal was carefully curated. Truly worthy of its Michelin stars.</p>
                            <p class="testimonial-author">- Elena Rodriguez</p>
                        </div>

                        <div class="testimonial">
                            <p class="testimonial-text">I've dined at many Michelin-starred restaurants worldwide, but this one stands out. The chef's creativity with traditional Japanese techniques is simply brilliant.</p>
                            <p class="testimonial-author">- David Chen</p>
                        </div>
                    </div>

                    <div class="slider-indicators">
                        <div class="indicator-s active" data-slide="0"></div>
                        <div class="indicator-s" data-slide="1"></div>
                        <div class="indicator-s" data-slide="2"></div>
                        <div class="indicator-s" data-slide="3"></div>
                    </div>
                    
                </div>
                <div class="michelin ">
                    <div class="michelin-word">
                        <p><b>Certified</b></p><br>
                        <p><b>Two <i>Michelin Star</i></b></p><br>
                        <p><b>2020</b></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section location" id="contact">
        <div class="container">
            <div class="section-title">
                <h2>Visit Us</h2>
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

    <script src="{{ asset('js/frontend/landing.js') }}"></script>
</body>
</html>