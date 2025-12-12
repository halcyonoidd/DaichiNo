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

// 3D Hexahedron Menu Selector with FIXED ORIENTATION
document.addEventListener('DOMContentLoaded', function() {
    const hexahedron = document.getElementById('hexahedron');
    const faces = document.querySelectorAll('.face');
    const menuItems = document.querySelectorAll('.menu-items');
    const categoryIndicator = document.getElementById('category-indicator');
    
    const rotateUpBtn = document.getElementById('rotate-up');
    const rotateLeftBtn = document.getElementById('rotate-left');
    const rotateDownBtn = document.getElementById('rotate-down');
    const rotateRightBtn = document.getElementById('rotate-right');
    
    // CORRECTED ROTATION ANGLES - Each face will properly face front
    const faceRotations = {
        'sushi': { x: 0, y: 0 },        // Front face (default)
        'ramen': { x: 0, y: 180 },      // Back face (rotate 180° on Y)
        'grilled': { x: 0, y: -90 },    // Right face (rotate -90° on Y)
        'appetizers': { x: 0, y: 90 },  // Left face (rotate 90° on Y)
        'desserts': { x: -90, y: 0 },   // Top face (rotate -90° on X)
        'beverages': { x: 90, y: 0 }    // Bottom face (rotate 90° on X)
    };
    
    // Navigation logic - which face is next for each direction
    const navigationMap = {
        'sushi': { up: 'desserts', down: 'beverages', left: 'grilled', right: 'appetizers' },
        'ramen': { up: 'desserts', down: 'beverages', left: 'appetizers', right: 'grilled' },
        'grilled': { up: 'desserts', down: 'beverages', left: 'ramen', right: 'sushi' },
        'appetizers': { up: 'desserts', down: 'beverages', left: 'sushi', right: 'ramen' },
        'desserts': { up: 'ramen', down: 'sushi', left: 'grilled', right: 'appetizers' },
        'beverages': { up: 'sushi', down: 'ramen', left: 'grilled', right: 'appetizers' }
    };
    
    let currentCategory = 'sushi';
    
    // Initialize with proper rotation
    rotateToFace('sushi');
    
    // Function to rotate to a specific face
    function rotateToFace(category) {
        currentCategory = category;
        const targetRotation = faceRotations[category];
        
        // Apply the rotation
        hexahedron.style.transform = `rotateX(${targetRotation.x}deg) rotateY(${targetRotation.y}deg)`;
        
        // Update active face
        updateActiveFace(category);
        
        // Update category indicator
        const faceText = Array.from(faces).find(f => f.getAttribute('data-category') === category).textContent;
        categoryIndicator.textContent = `Current Category: ${faceText}`;
        
        // Update menu items display
        updateMenuDisplay();
    }
    
    // Function to update active face
    function updateActiveFace(category) {
        faces.forEach((face) => {
            if (face.getAttribute('data-category') === category) {
                face.classList.add('active');
            } else {
                face.classList.remove('active');
            }
        });
    }
    
    // Function to update menu display based on active category
    function updateMenuDisplay() {
        menuItems.forEach(items => {
            if (items.id === `${currentCategory}-items`) {
                items.classList.add('active');
            } else {
                items.classList.remove('active');
            }
        });
    }
    
    // Event listeners for navigation buttons
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
    
    // Keyboard navigation
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
    
    // Touch swipe functionality
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
            // Horizontal swipe
            if (deltaX < -swipeThreshold) {
                // Swipe left
                const leftCategory = navigationMap[currentCategory].left;
                rotateToFace(leftCategory);
            } else if (deltaX > swipeThreshold) {
                // Swipe right
                const rightCategory = navigationMap[currentCategory].right;
                rotateToFace(rightCategory);
            }
        } else {
            // Vertical swipe
            if (deltaY < -swipeThreshold) {
                // Swipe up
                const upCategory = navigationMap[currentCategory].up;
                rotateToFace(upCategory);
            } else if (deltaY > swipeThreshold) {
                // Swipe down
                const downCategory = navigationMap[currentCategory].down;
                rotateToFace(downCategory);
            }
        }
    }
    
    // Direct click on cube faces
    faces.forEach(face => {
        face.addEventListener('click', () => {
            const category = face.getAttribute('data-category');
            rotateToFace(category);
        });
    });
});