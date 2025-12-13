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
    let cart = {};
    const experiences = {
        1: { 
            id: 1, 
            name: "Sakura Experience", 
            price: 12500, 
            tier: "Bronze", 
            duration: "1.5 hours",
            courses: "6-course meal",
            image: "https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=627&q=80",
            description: "Perfect introduction to Japanese cuisine with a curated selection of seasonal dishes."
        },
        2: { 
            id: 2, 
            name: "Koi Experience", 
            price: 18500, 
            tier: "Silver", 
            duration: "2 hours",
            courses: "7-course meal",
            image: "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80",
            description: "Enhanced dining experience with live cooking demonstrations and premium sake pairing."
        },
        3: { 
            id: 3, 
            name: "Fuji Experience", 
            price: 25000, 
            tier: "Gold", 
            duration: "2.5 hours",
            courses: "9-course meal",
            image: "https://images.unsplash.com/photo-1569718212165-3a8278d5f624?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1160&q=80",
            description: "Luxurious private dining in a traditional tatami room with exclusive kaiseki menu."
        },
        4: { 
            id: 4, 
            name: "Imperial Experience", 
            price: 38000, 
            tier: "Platinum", 
            duration: "3.5 hours",
            courses: "12-course omakase",
            image: "https://images.unsplash.com/photo-1585969009662-1ad1fa8123ba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80",
            description: "Ultimate culinary journey with chef's table experience and rare seasonal ingredients."
        },
        5: { 
            id: 5, 
            name: "Zen Experience", 
            price: 9800, 
            tier: "Bronze", 
            duration: "1 hour",
            courses: "5-course lunch",
            image: "https://images.unsplash.com/photo-1563245372-f21724e3856d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80",
            description: "Perfect quick lunch option with chef's choice bento box and traditional flavors."
        },
        6: { 
            id: 6, 
            name: "Samurai Experience", 
            price: 28500, 
            tier: "Gold", 
            duration: "3 hours",
            courses: "10-course meal",
            image: "https://images.unsplash.com/photo-1626645735466-7864d0430faa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80",
            description: "Group dining adventure with shared dishes, live stations, and premium sake tasting."
        }
    };

    const cartSidebar = document.getElementById('cart-sidebar');
    const viewCartBtn = document.getElementById('view-cart-btn');
    const closeCartBtn = document.getElementById('close-cart');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const cartCount = document.querySelector('.cart-count');
    const emptyCartMessage = document.getElementById('empty-cart-message');
    const cartNotification = document.getElementById('cart-notification');
    const checkoutBtn = document.getElementById('checkout-btn');
    const filterOptions = document.querySelectorAll('.filter-option');
    const experienceItems = document.querySelectorAll('.experience-item');
    const reserveModal = document.getElementById('reserve-modal');
    const reserveBtns = document.querySelectorAll('.reserve-btn');
    const cancelReserveBtn = document.getElementById('cancel-reserve');
    const confirmReserveBtn = document.getElementById('confirm-reserve');
    const decreaseGuestsBtn = document.getElementById('decrease-guests');
    const increaseGuestsBtn = document.getElementById('increase-guests');
    const guestCountElement = document.getElementById('guest-count');
    const termsCheckbox = document.getElementById('terms-agreement');
    const specialRequests = document.getElementById('special-requests');

    let currentReserveExperience = null;
    let guestCount = 1;

    filterOptions.forEach(option => {
        option.addEventListener('click', function() {
            const filterGroup = this.closest('.filter-group');
            const filterType = filterGroup.querySelector('.filter-group-title span').textContent;
            const filterValue = this.dataset.filter;

            filterGroup.querySelectorAll('.filter-option').forEach(opt => {
                opt.classList.remove('active');
            });
            this.classList.add('active');
            
            applyFilters();
        });
    });

    function applyFilters() {
        const activeFilters = {};
        document.querySelectorAll('.filter-group').forEach(group => {
            const activeOption = group.querySelector('.filter-option.active');
            if (activeOption) {
                const filterType = group.querySelector('.filter-group-title span').textContent;
                const filterValue = activeOption.dataset.filter;
                
                if (filterType === 'Duration') {
                    activeFilters.duration = filterValue;
                } else if (filterType === 'Number of Courses') {
                    activeFilters.courses = filterValue;
                } else if (filterType === 'Price Range') {
                    activeFilters.price = filterValue;
                } else if (filterType === 'Experience Tier') {
                    activeFilters.tier = filterValue;
                }
            }
        });

        experienceItems.forEach(item => {
            let showItem = true;
            
            if (activeFilters.duration && activeFilters.duration !== 'all-duration') {
                if (item.dataset.duration !== activeFilters.duration.replace('all-', '')) {
                    showItem = false;
                }
            }
            
            if (activeFilters.courses && activeFilters.courses !== 'all-courses') {
                if (item.dataset.courses !== activeFilters.courses) {
                    showItem = false;
                }
            }
            
            if (activeFilters.price && activeFilters.price !== 'all-price') {
                if (item.dataset.price !== activeFilters.price) {
                    showItem = false;
                }
            }
            
            if (activeFilters.tier && activeFilters.tier !== 'all-tier') {
                if (item.dataset.tier !== activeFilters.tier) {
                    showItem = false;
                }
            }
            
            item.style.display = showItem ? 'flex' : 'none';
        });
    }

    reserveBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const experienceId = parseInt(this.dataset.id);
            currentReserveExperience = experiences[experienceId];
            
            if (!currentReserveExperience) return;
            
            document.getElementById('modal-experience-name').textContent = currentReserveExperience.name;
            document.getElementById('modal-experience-image').src = currentReserveExperience.image;
            document.getElementById('modal-experience-image').alt = currentReserveExperience.name;
            document.getElementById('modal-experience-price').textContent = `¥${currentReserveExperience.price.toLocaleString()}`;
            document.getElementById('modal-experience-description').textContent = currentReserveExperience.description;
            
            guestCount = 1;
            guestCountElement.textContent = guestCount;
            termsCheckbox.checked = false;
            specialRequests.value = '';
            updateModalTotal();
            
            reserveModal.classList.add('active');
        });
    });

    decreaseGuestsBtn.addEventListener('click', function() {
        if (guestCount > 1) {
            guestCount--;
            guestCountElement.textContent = guestCount;
            updateModalTotal();
        }
    });

    increaseGuestsBtn.addEventListener('click', function() {
        if (guestCount < 10) {
            guestCount++;
            guestCountElement.textContent = guestCount;
            updateModalTotal();
        }
    });

    function updateModalTotal() {
        if (!currentReserveExperience) return;
        const total = currentReserveExperience.price * guestCount;
        document.getElementById('modal-total-price').textContent = `¥${total.toLocaleString()}`;
    }

    cancelReserveBtn.addEventListener('click', function() {
        reserveModal.classList.remove('active');
        currentReserveExperience = null;
    });

    confirmReserveBtn.addEventListener('click', function() {
        if (!currentReserveExperience) return;
        
        if (!termsCheckbox.checked) {
            alert('Please agree to the cancellation policy before proceeding.');
            return;
        }
        
        const cartItem = {
            ...currentReserveExperience,
            quantity: guestCount,
            specialRequests: specialRequests.value,
            totalPrice: currentReserveExperience.price * guestCount
        };
        
        addToCart(cartItem);
        
        reserveModal.classList.remove('active');
        currentReserveExperience = null;
    });

    function addToCart(item) {
        const cartKey = `${item.id}-${item.specialRequests}`;
        
        if (cart[cartKey]) {
            cart[cartKey].quantity += item.quantity;
            cart[cartKey].totalPrice += item.totalPrice;
            cart[cartKey].specialRequests = item.specialRequests;
        } else {
            cart[cartKey] = { ...item };
        }
        
        updateCartDisplay();
        showNotification();
    }

    function updateCartDisplay() {
        let totalItems = 0;
        let totalPrice = 0;
        
        Object.values(cart).forEach(item => {
            totalItems += item.quantity;
            totalPrice += item.totalPrice;
        });
        
        cartCount.textContent = totalItems;
        cartTotal.textContent = `¥${totalPrice.toLocaleString()}`;
        
        cartItems.innerHTML = '';
        
        if (totalItems === 0) {
            cartItems.appendChild(emptyCartMessage);
            emptyCartMessage.style.display = 'block';
        } else {
            emptyCartMessage.style.display = 'none';
            
            Object.values(cart).forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <div class="cart-item-image">
                        <img src="${item.image}" alt="${item.name}">
                    </div>
                    <div class="cart-item-details">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-info">${item.duration} • ${item.courses}</div>
                        <div class="cart-item-info">${item.quantity} guest${item.quantity > 1 ? 's' : ''}</div>
                        ${item.specialRequests ? `<div class="cart-item-info"><em>${item.specialRequests.substring(0, 30)}${item.specialRequests.length > 30 ? '...' : ''}</em></div>` : ''}
                        <div class="cart-item-price">¥${item.totalPrice.toLocaleString()}</div>
                    </div>
                    <div class="cart-item-qty">
                        <button class="decrease-cart" data-key="${Object.keys(cart).find(key => cart[key] === item)}">-</button>
                        <span>${item.quantity}</span>
                        <button class="increase-cart" data-key="${Object.keys(cart).find(key => cart[key] === item)}">+</button>
                    </div>
                `;
                cartItems.appendChild(cartItem);
            });
            
            document.querySelectorAll('.decrease-cart').forEach(btn => {
                btn.addEventListener('click', function() {
                    const key = this.dataset.key;
                    if (cart[key].quantity > 1) {
                        cart[key].quantity--;
                        cart[key].totalPrice = cart[key].price * cart[key].quantity;
                    } else {
                        delete cart[key];
                    }
                    updateCartDisplay();
                });
            });
            
            document.querySelectorAll('.increase-cart').forEach(btn => {
                btn.addEventListener('click', function() {
                    const key = this.dataset.key;
                    if (cart[key].quantity < 10) {
                        cart[key].quantity++;
                        cart[key].totalPrice = cart[key].price * cart[key].quantity;
                        updateCartDisplay();
                    }
                });
            });
        }
    }

    function showNotification() {
        cartNotification.style.display = 'flex';
        setTimeout(() => {
            cartNotification.style.display = 'none';
        }, 3000);
    }

    viewCartBtn.addEventListener('click', function(e) {
        e.preventDefault();
        cartSidebar.classList.add('open');
    });

    closeCartBtn.addEventListener('click', function() {
        cartSidebar.classList.remove('open');
    });

    document.addEventListener('click', function(e) {
        if (!cartSidebar.contains(e.target) && !viewCartBtn.contains(e.target) && cartSidebar.classList.contains('open')) {
            cartSidebar.classList.remove('open');
        }
        
        if (!document.querySelector('.modal-content').contains(e.target) && !e.target.closest('.reserve-btn') && reserveModal.classList.contains('active')) {
            reserveModal.classList.remove('active');
            currentReserveExperience = null;
        }
    });

    checkoutBtn.addEventListener('click', function() {
        if (Object.keys(cart).length === 0) {
            alert('Your cart is empty');
            return;
        }
        
        let totalPrice = 0;
        Object.values(cart).forEach(item => {
            totalPrice += item.totalPrice;
        });
        
        alert(`Reservation confirmed!\n\nTotal: ¥${totalPrice.toLocaleString()}\n\nYou will receive a confirmation email shortly.`);
        
        cart = {};
        updateCartDisplay();
        
        cartSidebar.classList.remove('open');
    });

    updateCartDisplay();
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