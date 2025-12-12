
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

        // Enhanced 3D Sushi Hover Effects
        document.addEventListener('DOMContentLoaded', function() {
            const sushiItems = document.querySelectorAll('.sushi-contact-item');
            
            sushiItems.forEach(item => {
                // Add rotation effect on hover
                item.addEventListener('mouseenter', function() {
                    const sushiShape = this.querySelector('.sushi-shape');
                    sushiShape.style.transform = 'rotateY(15deg) rotateX(5deg)';
                    
                    // Add subtle bounce effect
                    this.style.animation = 'bounce 0.5s ease';
                });
                
                item.addEventListener('mouseleave', function() {
                    const sushiShape = this.querySelector('.sushi-shape');
                    sushiShape.style.transform = 'rotateY(0) rotateX(0)';
                    this.style.animation = '';
                });
                
                // Add click event for mobile
                item.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        this.classList.toggle('active');
                        
                        const info = this.querySelector('.sushi-info');
                        if (this.classList.contains('active')) {
                            info.style.opacity = '1';
                            info.style.transform = 'translateX(-50%) translateY(-80px) scale(1)';
                        } else {
                            info.style.opacity = '0';
                            info.style.transform = 'translateX(-50%) translateY(-30px) scale(0.8)';
                        }
                    }
                });
            });
            
            // Add CSS animation for bounce
            const style = document.createElement('style');
            style.textContent = `
                @keyframes bounce {
                    0%, 100% { transform: translateZ(0) scale(1); }
                    50% { transform: translateZ(60px) scale(1.25); }
                }
                
                /* Add subtle ambient rotation to sushi items */
                .sushi-contact-item {
                    animation: float 6s ease-in-out infinite;
                }
                
                .sushi-contact-item:nth-child(2) { animation-delay: -1s; }
                .sushi-contact-item:nth-child(3) { animation-delay: -2s; }
                .sushi-contact-item:nth-child(4) { animation-delay: -3s; }
                .sushi-contact-item:nth-child(5) { animation-delay: -4s; }
                .sushi-contact-item:nth-child(6) { animation-delay: -5s; }
                
                @keyframes float {
                    0%, 100% { transform: translateZ(0) rotateY(0); }
                    50% { transform: translateZ(20px) rotateY(5deg); }
                }
            `;
            document.head.appendChild(style);
            
            // Form submission
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('Thank you for your message! We will get back to you soon.');
                    this.reset();
                });
            }
        });
