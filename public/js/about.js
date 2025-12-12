
        // Navbar scroll effect
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

        // Fixed Pop-up Carousel with Proper Positioning
        document.addEventListener('DOMContentLoaded', function() {
            const carouselContainer = document.getElementById('chef-carousel-container');
            const dotsContainer = document.getElementById('carousel-dots');
            const prevBtn = document.getElementById('prev-chef');
            const nextBtn = document.getElementById('next-chef');
            const playPauseBtn = document.getElementById('play-pause');
            const playPauseIcon = document.getElementById('play-pause-icon');
            const modal = document.getElementById('chef-modal');
            const closeModal = document.getElementById('close-modal');
            
            // Chef data
            const chefsData = [
                {
                    id: 1,
                    name: "Kenji Tanaka",
                    title: "Executive Chef & Owner",
                    bio: "Third-generation master chef with 15 years of experience in Michelin-starred kitchens across Japan and France.",
                    fullBio: "Third-generation master chef Kenji Tanaka took over Daichi No in 2015, bringing with him 15 years of experience working in Michelin-starred kitchens across Japan and France. Under his leadership, Daichi No has received numerous accolades including its third Michelin star in 2020.",
                    achievements: "3 Michelin Stars, World's 50 Best Restaurants 2022, James Beard Award 2021",
                    training: "Tokyo Culinary Institute, Apprenticeship under Chef Masaharu Morimoto, Stage at Le Bernardin (NYC)",
                    specialty: "Modern Kaiseki, Fusion Japanese-French Cuisine",
                    years: "8 years",
                    quote: "\"True culinary art honors tradition while embracing innovation.\"",
                    image: "https://images.unsplash.com/photo-1583394838336-acd977736f90?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=686&q=80"
                },
                {
                    id: 2,
                    name: "Yuki Nakamura",
                    title: "Sushi Master",
                    bio: "Trained for 10 years in Tokyo's Tsukiji market, specializing in Edomae-style sushi and seafood preparation.",
                    fullBio: "Chef Yuki Nakamura began his sushi journey at age 18, training for 10 years in Tokyo's legendary Tsukiji fish market. His expertise in Edomae-style sushi and seafood preparation has made him one of Japan's most respected sushi artisans.",
                    achievements: "Sushi Master of the Year 2019, Certified Master Sushi Chef (Japan Sushi Association)",
                    training: "10-year apprenticeship at Tsukiji Market, Sushi Master Certification (Tokyo)",
                    specialty: "Edomae-style Sushi, Live Seafood Preparation",
                    years: "12 years",
                    quote: "\"The sea offers its gifts; our hands must honor them with respect.\"",
                    image: "https://images.unsplash.com/photo-1581299894007-aaa50297cf16?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                },
                {
                    id: 3,
                    name: "Aiko Sato",
                    title: "Pastry & Dessert Chef",
                    bio: "Former pastry chef at a 3-star Michelin restaurant in Paris, blending French techniques with Japanese flavors.",
                    fullBio: "Former pastry chef at the 3-star Michelin restaurant L'Ambroisie in Paris, Chef Aiko Sato brings a unique fusion of French pastry techniques with traditional Japanese flavors. Her dessert creations are celebrated for their delicate balance of texture and taste.",
                    achievements: "Best Pastry Chef (Asia's 50 Best 2020), World Chocolate Master Finalist 2018",
                    training: "Le Cordon Bleu Paris, Apprenticeship at Pierre Hermé Paris, Stage at L'Ambroisie",
                    specialty: "Japanese-French Fusion Desserts, Molecular Gastronomy Pastry",
                    years: "6 years",
                    quote: "\"Desserts should delight both the eye and the palate in perfect harmony.\"",
                    image: "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=699&q=80"
                },
                {
                    id: 4,
                    name: "Takeshi Yamamoto",
                    title: "Head of Grill & Robata",
                    bio: "Specialist in traditional Japanese grilling techniques with 20 years of experience in premium yakitori establishments.",
                    fullBio: "With 20 years of experience in premium yakitori establishments across Japan, Chef Yamamoto has mastered the art of Japanese grilling. His expertise extends to all aspects of robatayaki, from charcoal selection to temperature control.",
                    achievements: "Yakitori Master Certification, Featured on Netflix's 'Chef's Table'",
                    training: "Traditional apprenticeship in Kagoshima, Specialist training in binchotan charcoal grilling",
                    specialty: "Robatayaki, Yakitori, Charcoal Grilling Techniques",
                    years: "15 years",
                    quote: "\"Fire is not just heat; it's the soul of flavor transformation.\"",
                    image: "https://images.unsplash.com/photo-1600566752355-35792bedcfea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                },
                {
                    id: 5,
                    name: "Haruto Kobayashi",
                    title: "Sous Chef",
                    bio: "Expert in kaiseki cuisine, trained under masters in Kyoto. Brings meticulous attention to seasonal presentation.",
                    fullBio: "Expert in kaiseki cuisine, Chef Kobayashi trained for seven years under masters in Kyoto before joining Daichi No. His meticulous attention to seasonal presentation and balance has earned him recognition as a rising star in Japanese cuisine.",
                    achievements: "Young Chef of the Year 2021, Kaiseki Master Apprentice Certification",
                    training: "7-year kaiseki apprenticeship in Kyoto, Seasonal cuisine specialization",
                    specialty: "Kaiseki, Seasonal Japanese Cuisine, Plating Artistry",
                    years: "5 years",
                    quote: "\"Each ingredient tells a story; our role is to listen and translate it to the plate.\"",
                    image: "https://images.unsplash.com/photo-1595475038784-bbe439ff41e6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                }
            ];
            
            let currentIndex = 2; // Start with middle chef (index 2)
            let isPlaying = true;
            let autoScrollInterval;
            
            // Create chef cards
            function createChefCards() {
                carouselContainer.innerHTML = '';
                
                chefsData.forEach((chef, index) => {
                    const cardWrapper = document.createElement('div');
                    cardWrapper.className = 'chef-card-wrapper';
                    cardWrapper.dataset.index = index;
                    cardWrapper.dataset.chefId = chef.id;
                    
                    const card = document.createElement('div');
                    card.className = 'chef-card';
                    
                    card.innerHTML = `
                        <div class="chef-image">
                            <img src="${chef.image}" alt="${chef.name}">
                            <div class="chef-overlay">
                                <h4 class="title is-5 has-text-white">Click for Details</h4>
                            </div>
                        </div>
                        <div class="chef-info">
                            <h3 class="title is-4">${chef.name}</h3>
                            <div class="chef-title">${chef.title}</div>
                            <p>${chef.bio}</p>
                            <div class="chef-signature">${chef.quote}</div>
                        </div>
                    `;
                    
                    cardWrapper.appendChild(card);
                    carouselContainer.appendChild(cardWrapper);
                });
                
                // Create dots
                dotsContainer.innerHTML = '';
                chefsData.forEach((_, index) => {
                    const dot = document.createElement('div');
                    dot.className = 'carousel-dot';
                    if (index === currentIndex) dot.classList.add('active');
                    dot.dataset.index = index;
                    dotsContainer.appendChild(dot);
                });
                
                updateCarousel();
            }
            
            // Update carousel positions
            function updateCarousel() {
                const totalChefs = chefsData.length;
                const wrappers = document.querySelectorAll('.chef-card-wrapper');
                const dots = document.querySelectorAll('.carousel-dot');
                
                // Reset all wrappers
                wrappers.forEach(wrapper => {
                    wrapper.className = 'chef-card-wrapper';
                });
                
                // Update positions based on current index
                wrappers.forEach((wrapper, index) => {
                    const diff = index - currentIndex;
                    
                    if (diff === 0) {
                        wrapper.classList.add('active');
                    } else if (diff === -1 || (diff === totalChefs - 1 && currentIndex === 0)) {
                        wrapper.classList.add('prev');
                    } else if (diff === 1 || (diff === -totalChefs + 1 && currentIndex === totalChefs - 1)) {
                        wrapper.classList.add('next');
                    } else if (diff === -2 || (currentIndex === 0 && diff === totalChefs - 2) || (currentIndex === 1 && diff === totalChefs - 1)) {
                        wrapper.classList.add('far-left');
                    } else if (diff === 2 || (currentIndex === totalChefs - 1 && diff === -totalChefs + 2) || (currentIndex === totalChefs - 2 && diff === -totalChefs + 1)) {
                        wrapper.classList.add('far-right');
                    }
                });
                
                // Update dots
                dots.forEach((dot, index) => {
                    if (index === currentIndex) {
                        dot.classList.add('active');
                    } else {
                        dot.classList.remove('active');
                    }
                });
            }
            
            // Function to show chef modal
            function showChefModal(chefId) {
                const chef = chefsData.find(c => c.id === chefId);
                if (!chef) return;
                
                document.getElementById('modal-chef-name').textContent = chef.name;
                document.getElementById('modal-chef-title').textContent = chef.title;
                document.getElementById('modal-chef-bio').textContent = chef.fullBio;
                document.getElementById('modal-chef-achievements').textContent = chef.achievements;
                document.getElementById('modal-chef-training').textContent = chef.training;
                document.getElementById('modal-chef-specialty').textContent = chef.specialty;
                document.getElementById('modal-chef-years').textContent = chef.years;
                document.getElementById('modal-chef-quote').textContent = chef.quote;
                document.getElementById('modal-chef-image').src = chef.image;
                document.getElementById('modal-chef-image').alt = chef.name;
                
                modal.classList.add('is-active');
                document.body.style.overflow = 'hidden';
            }
            
            // Function to auto-scroll
            function startAutoScroll() {
                if (autoScrollInterval) clearInterval(autoScrollInterval);
                
                autoScrollInterval = setInterval(() => {
                    currentIndex = (currentIndex + 1) % chefsData.length;
                    updateCarousel();
                }, 4000);
                
                playPauseIcon.className = 'fas fa-pause';
                isPlaying = true;
            }
            
            function stopAutoScroll() {
                if (autoScrollInterval) {
                    clearInterval(autoScrollInterval);
                    autoScrollInterval = null;
                }
                playPauseIcon.className = 'fas fa-play';
                isPlaying = false;
            }
            
            // Event listeners
            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + chefsData.length) % chefsData.length;
                updateCarousel();
                stopAutoScroll();
            });
            
            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % chefsData.length;
                updateCarousel();
                stopAutoScroll();
            });
            
            playPauseBtn.addEventListener('click', () => {
                if (isPlaying) {
                    stopAutoScroll();
                } else {
                    startAutoScroll();
                }
            });
            
            // Chef card clicks
            document.addEventListener('click', (e) => {
                const cardWrapper = e.target.closest('.chef-card-wrapper');
                if (cardWrapper) {
                    const chefId = parseInt(cardWrapper.dataset.chefId);
                    showChefModal(chefId);
                }
            });
            
            // Dot clicks
            dotsContainer.addEventListener('click', (e) => {
                const dot = e.target.closest('.carousel-dot');
                if (dot) {
                    const index = parseInt(dot.dataset.index);
                    currentIndex = index;
                    updateCarousel();
                    stopAutoScroll();
                }
            });
            
            // Modal close
            closeModal.addEventListener('click', () => {
                modal.classList.remove('is-active');
                document.body.style.overflow = 'auto';
            });
            
            modal.querySelector('.modal-background').addEventListener('click', () => {
                modal.classList.remove('is-active');
                document.body.style.overflow = 'auto';
            });
            
            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('is-active')) {
                    modal.classList.remove('is-active');
                    document.body.style.overflow = 'auto';
                } else if (e.key === 'ArrowLeft') {
                    currentIndex = (currentIndex - 1 + chefsData.length) % chefsData.length;
                    updateCarousel();
                    stopAutoScroll();
                } else if (e.key === 'ArrowRight') {
                    currentIndex = (currentIndex + 1) % chefsData.length;
                    updateCarousel();
                    stopAutoScroll();
                }
            });
            
            // Initialize
            createChefCards();
            startAutoScroll();
            
            // Pause on hover
            carouselContainer.addEventListener('mouseenter', stopAutoScroll);
            carouselContainer.addEventListener('mouseleave', () => {
                if (isPlaying) startAutoScroll();
            });
            
            // Handle window resize
            window.addEventListener('resize', updateCarousel);
        });
