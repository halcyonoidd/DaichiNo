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
    const hexahedron = document.getElementById('hexahedron');
    const faces = document.querySelectorAll('.face');
    const menuItems = document.querySelectorAll('.menu-items');
    const categoryDescriptions = document.querySelectorAll('.category-description');
    const categoryIndicator = document.getElementById('category-indicator');
    
    const rotateUpBtn = document.getElementById('rotate-up');
    const rotateLeftBtn = document.getElementById('rotate-left');
    const rotateDownBtn = document.getElementById('rotate-down');
    const rotateRightBtn = document.getElementById('rotate-right');
    
    const faceRotations = {
        'sushi': { x: 0, y: 0 },     
        'ramen': { x: 0, y: 180 },
        'grilled': { x: 0, y: -90 }, 
        'appetizers': { x: 0, y: 90 },
        'desserts': { x: -90, y: 0 },
        'beverages': { x: 90, y: 0 }
    };
    
    const navigationMap = {
        'sushi': { up: 'desserts', down: 'beverages', left: 'grilled', right: 'appetizers' },
        'ramen': { up: 'desserts', down: 'beverages', left: 'appetizers', right: 'grilled' },
        'grilled': { up: 'desserts', down: 'beverages', left: 'ramen', right: 'sushi' },
        'appetizers': { up: 'desserts', down: 'beverages', left: 'sushi', right: 'ramen' },
        'desserts': { up: 'ramen', down: 'sushi', left: 'grilled', right: 'appetizers' },
        'beverages': { up: 'sushi', down: 'ramen', left: 'grilled', right: 'appetizers' }
    };
    
    let currentCategory = 'sushi';
    
    rotateToFace('sushi');
    
    function rotateToFace(category) {
        currentCategory = category;
        const targetRotation = faceRotations[category];
        
        hexahedron.style.transform = `rotateX(${targetRotation.x}deg) rotateY(${targetRotation.y}deg)`;
        
        updateActiveFace(category);
        
        const faceText = Array.from(faces).find(f => f.getAttribute('data-category') === category).textContent;
        categoryIndicator.textContent = `Current Category: ${faceText}`;
        
        updateMenuDisplay();

        updateCategoryDescription();
    }
    
    function updateActiveFace(category) {
        faces.forEach((face) => {
            if (face.getAttribute('data-category') === category) {
                face.classList.add('active');
            } else {
                face.classList.remove('active');
            }
        });
    }
    
    function updateMenuDisplay() {
        menuItems.forEach(items => {
            if (items.id === `${currentCategory}-items`) {
                items.classList.add('active');
            } else {
                items.classList.remove('active');
            }
        });
    }
    
    function updateCategoryDescription() {
        categoryDescriptions.forEach(desc => {
            if (desc.id === `${currentCategory}-description`) {
                desc.classList.add('active');
            } else {
                desc.classList.remove('active');
            }
        });
    }
    
    rotateUpBtn.addEventListener('click', () => {
        const nextCategory = navigationMap[currentCategory].up;
        rotateToFace(nextCategory);
    });
    
    rotateLeftBtn.addEventListener('click', () => {
        const nextCategory = navigationMap[currentCategory].left;
        rotateToFace(nextCategory);
    });
    
    rotateDownBtn.addEventListener('click', () => {
        const nextCategory = navigationMap[currentCategory].down;
        rotateToFace(nextCategory);
    });
    
    rotateRightBtn.addEventListener('click', () => {
        const nextCategory = navigationMap[currentCategory].right;
        rotateToFace(nextCategory);
    });
    
    document.addEventListener('keydown', e => {
        switch(e.key) {
            case 'ArrowUp':
                e.preventDefault();
                const upCategory = navigationMap[currentCategory].up;
                rotateToFace(upCategory);
                break;
            case 'ArrowLeft':
                e.preventDefault();
                const leftCategory = navigationMap[currentCategory].left;
                rotateToFace(leftCategory);
                break;
            case 'ArrowDown':
                e.preventDefault();
                const downCategory = navigationMap[currentCategory].down;
                rotateToFace(downCategory);
                break;
            case 'ArrowRight':
                e.preventDefault();
                const rightCategory = navigationMap[currentCategory].right;
                rotateToFace(rightCategory);
                break;
        }
    });
    
    let touchStartX = 0;
    let touchStartY = 0;
    
    hexahedron.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
        touchStartY = e.changedTouches[0].screenY;
    });
    
    hexahedron.addEventListener('touchend', e => {
        const touchEndX = e.changedTouches[0].screenX;
        const touchEndY = e.changedTouches[0].screenY;
        handleSwipe(touchStartX, touchStartY, touchEndX, touchEndY);
    });
    
    function handleSwipe(startX, startY, endX, endY) {
        const swipeThreshold = 50;
        const deltaX = endX - startX;
        const deltaY = endY - startY;
        
        if (Math.abs(deltaX) > Math.abs(deltaY)) {
            if (deltaX < -swipeThreshold) {
                const leftCategory = navigationMap[currentCategory].left;
                rotateToFace(leftCategory);
            } else if (deltaX > swipeThreshold) {
                const rightCategory = navigationMap[currentCategory].right;
                rotateToFace(rightCategory);
            }
        } else {
            if (deltaY < -swipeThreshold) {
                const upCategory = navigationMap[currentCategory].up;
                rotateToFace(upCategory);
            } else if (deltaY > swipeThreshold) {
                const downCategory = navigationMap[currentCategory].down;
                rotateToFace(downCategory);
            }
        }
    }
    
    faces.forEach(face => {
        face.addEventListener('click', () => {
            const category = face.getAttribute('data-category');
            rotateToFace(category);
        });
    });
    
    document.querySelectorAll('.btn-small').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const menuItem = this.closest('.menu-item');
            const itemName = menuItem.querySelector('.menu-item-name').textContent;
            const itemPrice = menuItem.querySelector('.menu-item-price').textContent;
            
            alert(`Added ${itemName} (${itemPrice}) to cart!`);
            
            const originalText = this.textContent;
            this.innerHTML = '<i class="fas fa-check"></i> Added!';
            this.style.backgroundColor = '#2e7d32';
            
            setTimeout(() => {
                this.textContent = originalText;
                this.style.backgroundColor = '';
            }, 2000);
        });
    });
});

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
    
    logoutBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (confirm('Logout sekarang?')) {
            const form = document.getElementById('logout-form');
            if (form) {
                form.submit();
            }
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