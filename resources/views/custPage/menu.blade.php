<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daichi No - Menu</title>
    <link rel="stylesheet" href="{{ asset('css/vendors/bulma.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/frontend/menu.css') }}">
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

    <section class="spacing">
    </section>

    <section class="parallax-section" id="parallax-menu">
        <div class="parallax-bg"></div>
        <div class="parallax-content">
            <h2>Navigate</h2>
            <p>through our culinary dimensions using the controls below</p>
            
            <div class="hexahedron-container">
                <div class="hexahedron" id="hexahedron">
                    <div class="face face-front active" data-category="sushi">水 (Mizu)</div>
                    <div class="face face-back" data-category="ramen">大地 (Daichi)</div>
                    <div class="face face-right" data-category="grilled">火炎 (Kaen)</div>
                    <div class="face face-left" data-category="appetizers">黄泉 (Yomi)</div>
                    <div class="face face-top" data-category="desserts">天 (Ten)</div>
                    <div class="face face-bottom" data-category="beverages">側 (Gawa)</div>
                </div>
            </div>
            
            <div class="category-indicator" id="category-indicator">Current Category: 水 (Mizu)</div>
            
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
            </div>

            <div class="category-description-section">
                <div class="category-description active" id="sushi-description">
                    <h3 class="category-title"><i class="fas fa-fish"></i> 水 (Mizu)</h3>
                    <p class="category-text">
                        Every part of the sea we could get our hands on. Starting from the most abundant delicacy crafted With
                        masterful hands, to a unique and downright strange creature captured then served for a wild tounge.
                        Every single bite of fish will leave your senses tingling with melty and velvety texture alongside
                        magnificent taste.
                    </p>
                    <div class="category-features">
                        <span class="feature-tag">Fresh Daily Delivery</span>
                        <span class="feature-tag">Traditional Edomae Style</span>
                        <span class="feature-tag">Fish and seafood</span>
                    </div>
                </div>
                
                <div class="category-description" id="ramen-description">
                    <h3 class="category-title"><i class="fas fa-utensils"></i> 大地 (Daichi)</h3>
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
                
                <div class="category-description" id="grilled-description">
                    <h3 class="category-title"><i class="fas fa-fire"></i> 火炎 (Kaen)</h3>
                    <p class="category-text">
                        Discover the smoky, savory flavors of Japanese grilled cuisine. Using premium ingredients 
                        and traditional binchotan charcoal, our grill masters create dishes that highlight natural 
                        flavors with minimal seasoning. From perfectly charred yakitori to succulent wagyu, each 
                        piece is cooked to perfection over controlled heat for maximum flavor development.
                    </p>
                    <div class="category-features">
                        <span class="feature-tag">Binchotan Charcoal Grill</span>
                        <span class="feature-tag">Premium Ingredients</span>
                        <span class="feature-tag">Grilled</span>
                    </div>
                </div>
                
                <div class="category-description" id="appetizers-description">
                    <h3 class="category-title"><i class="fas fa-seedling"></i> 黄泉 (Yomi)</h3>
                    <p class="category-text">
                        Begin your culinary journey with our carefully curated selection of small plates. These 
                        dishes are designed to awaken your palate and prepare you for the main course. From 
                        traditional favorites like edamame and gyoza to innovative creations, each appetizer 
                        showcases seasonal ingredients and balanced flavors that reflect Japanese culinary philosophy.
                    </p>
                    <div class="category-features">
                        <span class="feature-tag">Seasonal Ingredients</span>
                        <span class="feature-tag">Palate Preparation</span>
                        <span class="feature-tag">Appetizers</span>
                    </div>
                </div>
                
                <div class="category-description" id="desserts-description">
                    <h3 class="category-title"><i class="fas fa-ice-cream"></i> 天 (Ten)</h3>
                    <p class="category-text">
                        Conclude your meal with our exquisite Japanese-inspired desserts that balance sweetness 
                        with subtlety. Unlike Western desserts, our creations focus on natural flavors, elegant 
                        presentation, and light textures. From traditional matcha preparations to modern fusion 
                        desserts, each sweet treat provides a perfect ending to your dining experience.
                    </p>
                    <div class="category-features">
                        <span class="feature-tag">Subtle Sweetness</span>
                        <span class="feature-tag">Artistic Presentation</span>
                        <span class="feature-tag">Desserts</span>
                    </div>
                </div>
                
                <div class="category-description" id="beverages-description">
                    <h3 class="category-title"><i class="fas fa-glass-whiskey"></i> 側 (Gawa)</h3>
                    <p class="category-text">
                        Complement your meal with our carefully selected beverage program. From premium sake 
                        curated by our sommelier to traditional teas and innovative cocktails, each drink is 
                        chosen to enhance your dining experience. Our sake selection includes rare finds and 
                        regional specialties, while our tea service follows traditional Japanese ceremony principles.
                    </p>
                    <div class="category-features">
                        <span class="feature-tag">Premium Sake Selection</span>
                        <span class="feature-tag">Traditional Tea Ceremony</span>
                        <span class="feature-tag">Beverages</span>
                    </div>
                </div>
            </div>

            <div class="menu-items active" id="sushi-items">
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\salmon_sashimi.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Salmon Sashimi</h3>
                        </div>
                        <p class="menu-item-description">Fresh Atlantic salmon, thinly sliced and served with wasabi and soy sauce</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\saba-sushi.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Saba Sushi</h3>
                        </div>
                        <p class="menu-item-description">Tightly packed slices of pickled mackarel and rice wrapped in bamboo leaves</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\cali-roll.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">California Roll</h3>
                        </div>
                        <p class="menu-item-description">California roll topped with light roe covering</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\tuna-nig.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Bluefin Tuna Nigiri</h3>
                        </div>
                        <p class="menu-item-description">Premium bluefin tuna over vinegar rice with a touch of wasabi</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\uni-gunkan.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Uni Gunkan</h3>
                        </div>
                        <p class="menu-item-description">Rich and fresh uni placed atop of rice and wrapped loosely in nori</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\ebi-roll.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Ebi Roll</h3>
                        </div>
                        <p class="menu-item-description">Fried ebi rolled into a sushi with cucumber and nori, topped with it's tail and breadcrumbs</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\tako-nig.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Tako Nigiri</h3>
                        </div>
                        <p class="menu-item-description">Freshly cut and cleaned octopus tentacle over rice</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\ikura-gunkan.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Ikura Gunkan</h3>
                        </div>
                        <p class="menu-item-description">Cured flying fish roe with rice and wrapped loosely with nori</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\unagi-nig.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Unagi Nigiri</h3>
                        </div>
                        <p class="menu-item-description">Rich lightly grilled eel over rice</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\hosomaki.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Hosomaki</h3>
                        </div>
                        <p class="menu-item-description">Modest variety piece of salmon, tuna, and cucumber wrapped in rice and nori</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\flounder-nig.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Flounder Nigiri</h3>
                        </div>
                        <p class="menu-item-description">Freshly cut flounder fillet served with rice</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\mizu\shirako.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Shirako</h3>
                        </div>
                        <p class="menu-item-description">Fish sperm sack soaked in soy sauce atop with radish and green onion</p>
                    </div>
                </div>
            </div>
            
            <div class="menu-items" id="ramen-items">
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\inarizushi.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Inarizushi</h3>
                        </div>
                        <p class="menu-item-description">Sweet soy bean curd filled with rice and topped with sesame seed</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\chi-curry.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Chicken Katsu Curry</h3>
                        </div>
                        <p class="menu-item-description">Crispy and tender chicken cutlet paired with rice and heart curry</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\hamburg-don.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Hamburger Donburi</h3>
                        </div>
                        <p class="menu-item-description">Hamburger patty on a bowl of rice and optionally paired with raw pasteurized egg yolk</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\crsl4.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Tonkotsu Ramen</h3>
                        </div>
                        <p class="menu-item-description">Rich bone broth with ramen noodle topped with slices of chashu pork and bamboo shoot</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\ten-don.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Ten Don</h3>
                        </div>
                        <p class="menu-item-description">Fried vegetables variety and shrimp atop bowl of rice.</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\kitsune-udon.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Kitsune Udon</h3>
                        </div>
                        <p class="menu-item-description">Udon noodle paired with traditonal dashi soup and topped with fried sweet soy bean curd</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\oden.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Oden</h3>
                        </div>
                        <p class="menu-item-description">Traditional soup made with dashi soup and featuring konnyaku, boiled egg, and fish cakes</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\teppanyaki.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Teppanyaki</h3>
                        </div>
                        <p class="menu-item-description">Quick cooking session in front of customers, serving warm yakisoba or yakimeshi</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\okayodon.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Okayodon</h3>
                        </div>
                        <p class="menu-item-description">Stir fried chicken pieces and egg over rice. Mother and Son</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\gyu soba.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Gyu Soba</h3>
                        </div>
                        <p class="menu-item-description">Buckwheat string noodle with dashi and topped with grilled beef</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\katsu.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Katsu</h3>
                        </div>
                        <p class="menu-item-description">Flatten chicken, breaded and fired to a perfection of juiciness and crispiness</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\danpen\pork-katsu.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Pork Katsu</h3>
                        </div>
                        <p class="menu-item-description">Flatten porkchop, fried within breadcrumb until tender yet still juicy</p>
                    </div>
                </div>
            </div>

            <div class="menu-items" id="grilled-items">
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\yakitori.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Yakitori</h3>
                        </div>
                        <p class="menu-item-description">Grilled chicken skewers with teriyaki glaze. Tender and juicy</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\unagi-don.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Unagi Don</h3>
                        </div>
                        <p class="menu-item-description">Grilled grade A eel with kabayaki sauce over rice.</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\a5-wagyu.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">A5 Wagyu Steak</h3>
                        </div>
                        <p class="menu-item-description">Premium Japanese wagyu beef grilled to perfection</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\yakiniku.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Yakiniku</h3>
                        </div>
                        <p class="menu-item-description">Slices of beef grilled to perfection over rice and with variety of sides.</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\isobeyaki.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Isobeyaki</h3>
                        </div>
                        <p class="menu-item-description">Plain grilled mochi with cripy outside and the gooey inside, brushed off with soy sauce for extra savouriness</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\grill-tako.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Grilled Ika</h3>
                        </div>
                        <p class="menu-item-description">Savoury grilled squid served with lemon slices and variety of sauces</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\kushiyaki.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">kushiyaki</h3>
                        </div>
                        <p class="menu-item-description">Sliced and grilled aubergine glazed with sweet soy sauce</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\mush-yaki.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Mushroom Yaki</h3>
                        </div>
                        <p class="menu-item-description">Grilled and sliced pieces of variety savoury mushroom</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\grill-onigiri.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Grilled Onigiri</h3>
                        </div>
                        <p class="menu-item-description">Ball of rice filled with fermented persimmons. Served Grilled and with Nori</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\shioyaki.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Saba no Shioyaki</h3>
                        </div>
                        <p class="menu-item-description">Grilled halibut glazed with sweet soy sauce</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\tsukune.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Tsukune</h3>
                        </div>
                        <p class="menu-item-description">Based on the mythical snake. It's a skewer of ground meat that have been grilled</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\kaen\sishamo.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Sishamo</h3>
                        </div>
                        <p class="menu-item-description">Grilled and glazed egg filled fish. Served on a skewer</p>
                    </div>
                </div>
            </div>

            <div class="menu-items" id="appetizers-items">
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\yomi\edamame.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Edamame</h3>
                        </div>
                        <p class="menu-item-description">Young soy bean steamed and flavoured with salt</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\yomi\gyosa.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Gyoza</h3>
                        </div>
                        <p class="menu-item-description">Soft dumpling pan-fried until crispy at the bottom. Served with ponzu sauce</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\yomi\agedashi-tofu.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Agedashi Tofu</h3>
                        </div>
                        <p class="menu-item-description">Fried silken tofu served with tentsuyu. Topped with grated daikon radish and chopped spring onion</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\yomi\okonomi.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Okonomiyaki</h3>
                        </div>
                        <p class="menu-item-description">Fried batter of shredded cabbage and onion, topped with katsuobushi</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                    <img src="source\yomi\chawanmushi.jpg">
                    </div>
                    <div class="menu-item-content">
                    <div class="menu-item-header">
                        <h3 class="menu-item-name">Chawanmushi</h3>
                    </div>
                    <p class="menu-item-description">Steamed silky custard egg filled with various svaoury filling.</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\yomi\takoyaki.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Takoyaki</h3>
                        </div>
                        <p class="menu-item-description">Fried batter formed into balls and stuffed with pieces of octopus</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\yomi\egg-sand.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Egg Sando</h3>
                        </div>
                        <p class="menu-item-description">Egg mayo salad sandwich with soft boiled egg in the middle</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\yomi\musubi.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Spam Musubi</h3>
                        </div>
                        <p class="menu-item-description">Childhood spam musubi. Thick slice of spam on rice, wrapped in nori</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\yomi\tempura.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Tempura</h3>
                        </div>
                        <p class="menu-item-description">Crispy fried tempura, soft on the inside and perfectly delicious</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\yomi\croq.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Potato Croquette</h3>
                        </div>
                        <p class="menu-item-description">Japanese croquette deep fried into perfect crispiness and soft insides</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\yomi\katsu-sand.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Katsu Sando</h3>
                        </div>
                        <p class="menu-item-description">Deep fried prok katsu sandwiched between white soft bread and some mayo and cabbages</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\yomi\agemochi.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Agemochi</h3>
                        </div>
                        <p class="menu-item-description">Savoury mochi on a skewer. Deep fried alongside nori slices</p>
                    </div>
                </div>
                
            </div>

            <div class="menu-items" id="desserts-items">
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\ten\mochi.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Mochi</h3>
                        </div>
                        <p class="menu-item-description">Colourful glutinous rice cakes fromed into balls with sweet fillings.</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\ten\matcha.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Matcha Tiramisu</h3>
                        </div>
                        <p class="menu-item-description">Japanese twist on the classic Italian dessert</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\ten\dorayaki.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Dorayaki</h3>
                        </div>
                        <p class="menu-item-description">Japanese pancake sandwich filled with sweet red bean paste</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\ten\crsl2.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Mitarashi Dango</h3>
                        </div>
                        <p class="menu-item-description">Dumpling made of glutinous rice formed into a ball. Skewered and served with sweet syrup.</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\ten\strb-cream-parfait.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Strawberry Cream Parfait</h3>
                        </div>
                        <p class="menu-item-description">Sweet cream, strawberries, crumbles stacked to form a faux cake in a glass.</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\ten\flan-cake.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Flan Cake</h3>
                        </div>
                        <p class="menu-item-description">Flan or custard base with a layer of clear caramel atop.</p>
                    </div>
                </div>
            </div>

            <div class="menu-items" id="beverages-items">
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\gaen\sake.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Premium Sake</h3>
                        </div>
                        <p class="menu-item-description">Traditional Japanese rice wine served warm or cold</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\gaen\matcha.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Ceremonial Matcha</h3>
                        </div>
                        <p class="menu-item-description">Traditional Japanese green tea prepared ceremonially</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\gaen\whiskey.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Japanese Whiskey</h3>
                        </div>
                        <p class="menu-item-description">Award-winning Japanese single malt whiskey</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\gaen\cappucino.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Cappucino</h3>
                        </div>
                        <p class="menu-item-description">Hot mixed espresso and milk, savoury with distinct frothed milk decoration</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\gaen\spring.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Spring Water</h3>
                        </div>
                        <p class="menu-item-description">Premium spring water in a glass bottle. Very refreshing</p>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="source\gaen\asahi.jpg">
                    </div>
                    <div class="menu-item-content">
                        <div class="menu-item-header">
                            <h3 class="menu-item-name">Asahi Beer</h3>
                        </div>
                        <p class="menu-item-description">popular japanese beer</p>
                    </div>
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

    <script src="{{ asset('js/frontend/menu.js') }}"></script>
</body>
</html>