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

document.addEventListener('DOMContentLoaded', function() {
    const indicators = document.querySelectorAll('.indicator');
    const track = document.querySelector('.carousel-track');
    
    function updateIndicators() {
        const computedStyle = window.getComputedStyle(track);
        const matrix = new DOMMatrixReadOnly(computedStyle.transform);
        const currentSlide = Math.round(-matrix.m41 / track.offsetWidth);
        
        indicators.forEach((indicator, index) => {
            if (index === currentSlide) {
                indicator.classList.add('active');
            } else {
                indicator.classList.remove('active');
            }
        });
    }
    
    setInterval(updateIndicators, 100);
});

document.addEventListener('DOMContentLoaded', function() {
    const menuCategories = document.querySelectorAll('.menu-category');
    const menuContents = document.querySelectorAll('.menu-category-content');

    let activeCategory = 'mizu';
    
    function switchCategory(categoryId) {
        menuCategories.forEach(cat => {
            if (cat.getAttribute('data-category') === categoryId) {
                cat.classList.add('active');
            } else {
                cat.classList.remove('active');
            }
        });
        
        menuContents.forEach(content => {
            if (content.id === `${categoryId}-content`) {
                content.classList.add('active');
            } else {
                content.classList.remove('active');
            }
        });
        
        activeCategory = categoryId;
    }

    menuCategories.forEach(category => {
        category.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-category');
            switchCategory(categoryId);
        });
    });

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
});

document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.testimonial-track');
    const slides = document.querySelectorAll('.testimonial');
    const indicators = document.querySelectorAll('.indicator-s');
    const totalSlides = slides.length;
    
    let currentSlide = 0;
    const slideInterval = 6000;
    
    function goToSlide(slideIndex) {
        track.style.transform = `translateX(-${slideIndex * 100}%)`;
        
        indicators.forEach(indicator => {
            indicator.classList.remove('active');
        });
        indicators[slideIndex].classList.add('active');

        currentSlide = slideIndex;
    }
    
    function nextSlide() {
        let nextIndex = (currentSlide + 1) % totalSlides;
        goToSlide(nextIndex);
    }

    function initCarousel() {
        setInterval(nextSlide, slideInterval);

        indicators.forEach((indicator, index) => {
        });

        goToSlide(0);
    }

    initCarousel();
});

//l
document.addEventListener('DOMContentLoaded', function() {
    const floatingUserBtn = document.getElementById('floating-user-btn');
    const userPanel = document.getElementById('user-panel');
    const closePanelBtn = document.getElementById('close-panel');
    const panelOverlay = document.getElementById('panel-overlay');
    const logoutBtn = document.getElementById('logout-btn');

    function openUserPanel() {
        userPanel.classList.add('open');
        panelOverlay.classList.add('active');
        floatingUserBtn.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeUserPanel() {
        userPanel.classList.remove('open');
        panelOverlay.classList.remove('active');
        floatingUserBtn.classList.remove('active');
        document.body.style.overflow = '';
    }

    floatingUserBtn.addEventListener('click', openUserPanel);

    closePanelBtn.addEventListener('click', closeUserPanel);

    panelOverlay.addEventListener('click', closeUserPanel);
    
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && userPanel.classList.contains('open')) {
            closeUserPanel();
        }
    });
    
    logoutBtn.addEventListener('click', function() {
        if (confirm('Are you sure you want to log out?')) {
            alert('You have been logged out successfully.');
            setTimeout(() => {
                window.location.href = 'login.html';
            }, 1000);
            
            closeUserPanel();
        }
    });
    
    //data
    function updateUserStats() {
        const userName = "Takashi Yamada";
        const userEmail = "takashi.yamada@email.com";
        const reservations = 3;
        const points = 1250;
        const vouchers = 2;
        
        document.getElementById('user-name').textContent = userName;
        document.getElementById('user-email').textContent = userEmail;
        document.getElementById('reservation-count').textContent = reservations;
        document.getElementById('points-earned').textContent = points.toLocaleString();
        document.getElementById('vouchers-owned').textContent = vouchers;
    }

    updateUserStats();
    
    let panelTouchStartY = 0;
    let panelTouchStartTime = 0;
    
    userPanel.addEventListener('touchstart', e => {
        panelTouchStartY = e.touches[0].clientY;
        panelTouchStartTime = Date.now();
    });
    
    userPanel.addEventListener('touchend', e => {
        const panelTouchEndY = e.changedTouches[0].clientY;
        const panelTouchDeltaY = panelTouchEndY - panelTouchStartY;
        const panelTouchDuration = Date.now() - panelTouchStartTime;

        if (panelTouchDeltaY > 100 || (panelTouchDeltaY > 50 && panelTouchDuration < 300)) {
            closeUserPanel();
        }
    });

    window.addEventListener('scroll', function() {
        const scrollIndicator = document.querySelector('.scroll-indicator');
        const scrollPosition = window.scrollY;
        
        if (scrollPosition > 100) {
            scrollIndicator.innerHTML = '<i class="fas fa-check mr-2"></i> Button stays visible';
        } else {
            scrollIndicator.innerHTML = '<i class="fas fa-arrow-down mr-2"></i> Scroll to test';
        }
    });
});