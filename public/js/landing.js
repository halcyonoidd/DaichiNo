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
