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
    // Persisted cart (shared with vouchers/products)
    let cart = JSON.parse(localStorage.getItem('cart')) || {};

    // Dynamic experiences loaded from API (admin-created offerings)
    const experiences = {};

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
    let experienceItems = document.querySelectorAll('.experience-item');
    const reserveModal = document.getElementById('reserve-modal');
    const reserveBtns = document.querySelectorAll('.reserve-btn');
    const cancelReserveBtn = document.getElementById('cancel-reserve');
    const confirmReserveBtn = document.getElementById('confirm-reserve');
    const decreaseGuestsBtn = document.getElementById('decrease-guests');
    const increaseGuestsBtn = document.getElementById('increase-guests');
    const guestCountElement = document.getElementById('guest-count');
    const termsCheckbox = document.getElementById('terms-agreement');
    const specialRequests = document.getElementById('special-requests');
    const fullNameInput = document.getElementById('full-name');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const dateInput = document.getElementById('reservation-date');
    const timeStartInput = document.getElementById('time-start');
    const timeEndInput = document.getElementById('time-end');

    let toastTimeout;

    function showToast(message, type = 'success') {
        if (!cartNotification) return;

        const icon = cartNotification.querySelector('i');
        const text = cartNotification.querySelector('span');
        const iconClass = type === 'error'
            ? 'fas fa-exclamation-circle'
            : type === 'info'
                ? 'fas fa-info-circle'
                : 'fas fa-check-circle';

        cartNotification.classList.remove('success', 'error', 'info');
        cartNotification.classList.add(type);

        if (icon) icon.className = iconClass;
        if (text) text.textContent = message;

        cartNotification.style.display = 'flex';
        requestAnimationFrame(() => cartNotification.classList.add('visible'));

        clearTimeout(toastTimeout);
        toastTimeout = setTimeout(() => {
            cartNotification.classList.remove('visible');
            setTimeout(() => {
                cartNotification.style.display = 'none';
            }, 250);
        }, 2800);
    }

    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartBadge();
    }

    function updateCartBadge() {
        const cartBadges = document.querySelectorAll('.cart-count, #cart-badge');
        let totalItems = 0;
        Object.values(cart).forEach(item => {
            totalItems += item.quantity || 1;
        });
        cartBadges.forEach(badge => {
            badge.textContent = totalItems;
        });
    }

    let currentReserveExperience = null;
    let guestCount = 1;

    function markUnavailable(reservationItems) {
        const listEl = document.querySelector('.experience-list');
        reservationItems.forEach(item => {
            const el = document.querySelector(`.experience-item[data-id="${item.id}"]`);
            if (el) {
                el.remove();
            }
            delete experiences[item.id];
        });

        if (listEl && listEl.querySelectorAll('.experience-item').length === 0) {
            const empty = document.createElement('div');
            empty.className = 'experience-placeholder';
            empty.innerHTML = '<p>Belum ada reservasi yang tersedia.</p>';
            listEl.innerHTML = '';
            listEl.appendChild(empty);
        }
    }

    function closeReserveModal() {
        if (reserveModal) {
            reserveModal.classList.remove('active');
        }
        document.body.style.overflow = '';
        currentReserveExperience = null;
    }

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

    function openReserve(experienceId) {
        currentReserveExperience = experiences[experienceId];
        if (!currentReserveExperience || !reserveModal) return;

        const imageSrc = currentReserveExperience.image_url || currentReserveExperience.image || currentReserveExperience.image_path || 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=800&q=80';

        document.getElementById('modal-experience-name').textContent = currentReserveExperience.title || currentReserveExperience.name || 'Reservation';
        const imgElement = document.getElementById('modal-experience-image');
        imgElement.src = imageSrc;
        imgElement.alt = currentReserveExperience.title || currentReserveExperience.name || 'Reservation';
        imgElement.onerror = function() {
            this.src = 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=800&q=80';
        };
        document.getElementById('modal-experience-price').textContent = `Rp${Number(currentReserveExperience.price || 0).toLocaleString('id-ID')}`;
        document.getElementById('modal-experience-description').textContent = currentReserveExperience.menu || currentReserveExperience.description || '';

        // Reset form fields
        guestCount = 1;
        guestCountElement.textContent = guestCount;
        termsCheckbox.checked = false;
        specialRequests.value = '';
        fullNameInput.value = '';
        emailInput.value = '';
        phoneInput.value = '';
        dateInput.value = '';
        timeStartInput.value = '';
        timeEndInput.value = '';
        
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        dateInput.min = today;
        
        updateModalTotal();

        reserveModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    // Delegate clicks for reserve buttons (covers dynamically loaded offers)
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.reserve-btn');
        if (btn && btn.dataset.id) {
            const experienceId = parseInt(btn.dataset.id);
            openReserve(experienceId);
        }
    });

    async function loadReservationOffers() {
        try {
            const response = await fetch('/api/reservation-offers');
            const payload = await response.json();
            const items = payload.data || [];

            const listEl = document.querySelector('.experience-list');
            if (!listEl) return;

            // Clear all content so only admin-provided offers render
            listEl.innerHTML = '';

            if (!items.length) {
                const empty = document.createElement('div');
                empty.className = 'experience-placeholder';
                empty.innerHTML = '<p>Belum ada reservasi yang tersedia.</p>';
                listEl.appendChild(empty);
                return;
            }

            items.forEach(offer => {
                // Prioritize image_url from API (full storage URL), fallback to image_path, then default
                const image = offer.image_url || offer.image_path || offer.image || 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=800&q=80';

                // cache in experiences map
                experiences[offer.id] = {
                    id: offer.id,
                    title: offer.title,
                    badge: offer.badge,
                    duration: offer.duration,
                    room: offer.room,
                    price: offer.price,
                    capacity: offer.capacity,
                    menu: offer.menu,
                    image,
                    image_url: offer.image_url,
                    image_path: offer.image_path
                };

                const item = document.createElement('div');
                item.className = 'experience-item';
                item.dataset.duration = 'n/a';
                item.dataset.courses = 'n/a';
                item.dataset.price = 'n/a';
                item.dataset.tier = offer.badge || '';
                item.dataset.id = offer.id;

                item.innerHTML = `
                    <div class="experience-image">
                        <img src="${image}" alt="${offer.title}" onerror="this.src='https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=800&q=80'">
                    </div>
                    <div class="experience-content">
                        <div class="experience-header">
                            <div>
                                <div class="experience-title">${offer.title}</div>
                                <div class="experience-tier ${offer.badge ? offer.badge.toLowerCase() + '-tier' : ''}">${offer.badge || ''}</div>
                            </div>
                            <div>
                                <div class="experience-price">Rp${Number(offer.price).toLocaleString('id-ID')}</div>
                                <div class="price-subtitle">per person</div>
                            </div>
                        </div>
                        <div class="experience-details">
                            <div class="detail-item">
                                <i class="fas fa-clock"></i>
                                <span><strong>Duration:</strong> ${offer.duration || 'N/A'}</span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-door-open"></i>
                                <span><strong>Room:</strong> ${offer.room || 'TBD'}</span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-user-friends"></i>
                                <span><strong>Capacity:</strong> ${offer.capacity} guest(s)</span>
                            </div>
                        </div>
                        <div class="experience-features">
                            <ul class="feature-list">
                                ${(offer.menu || '').split(/[,\n]/).filter(Boolean).slice(0,4).map(m => `<li>${m.trim()}</li>`).join('')}
                            </ul>
                        </div>
                        <div class="experience-footer">
                            <div class="experience-tags">
                                ${offer.badge ? `<span class="experience-tag">${offer.badge}</span>` : ''}
                                <span class="experience-tag">Custom Menu</span>
                            </div>
                            <button class="reserve-btn" data-id="${offer.id}">
                                <i class="fas fa-calendar-plus"></i>
                                Reserve Now
                            </button>
                        </div>
                    </div>
                `;

                listEl.appendChild(item);
            });

            // Rebind buttons and items collection
            experienceItems = document.querySelectorAll('.experience-item');
            // Buttons are handled by delegated listener
        } catch (error) {
            console.error('Failed to load reservation offers', error);
        }
    }

    // Kick off offers loading
    loadReservationOffers();

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
        const total = Number(currentReserveExperience.price) * guestCount;
        document.getElementById('modal-total-price').textContent = `Rp${total.toLocaleString('id-ID')}`;
    }

    cancelReserveBtn.addEventListener('click', function() {
        closeReserveModal();
    });

    confirmReserveBtn.addEventListener('click', async function() {
        if (!currentReserveExperience) return;
        
        if (!termsCheckbox.checked) {
            showToast('Please agree to the cancellation policy before proceeding.', 'error');
            return;
        }

        const fullName = fullNameInput.value.trim();
        const email = emailInput.value.trim();
        const phone = phoneInput.value.trim();
        const date = dateInput.value;
        const timeStart = timeStartInput.value;
        const timeEnd = timeEndInput.value;

        if (!fullName || !email || !phone || !date || !timeStart || !timeEnd) {
            showToast('Mohon lengkapi nama, email, telepon, tanggal, dan jam reservasi.', 'error');
            return;
        }
        
        try {
            const availabilityResp = await fetch('/api/reservations/availability', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    room: currentReserveExperience.room || 'Default',
                    date,
                    time_start: timeStart,
                    time_end: timeEnd
                })
            });

            if (!availabilityResp.ok) {
                const err = await availabilityResp.json();
                showToast(err.message || 'Slot tidak tersedia.', 'error');
                return;
            }

            const availability = await availabilityResp.json();
            if (availability && availability.available === false) {
                showToast('Slot sudah terisi, pilih jam atau ruangan lain.', 'error');
                return;
            }
        } catch (error) {
            showToast('Gagal mengecek ketersediaan. Coba lagi.', 'error');
            return;
        }

        const cartItem = {
            ...currentReserveExperience,
            id: currentReserveExperience.id,
            name: currentReserveExperience.title || currentReserveExperience.name,
            title: currentReserveExperience.title || currentReserveExperience.name,
            type: 'reservation',
            quantity: guestCount,
            special_request: specialRequests.value.trim(),
            totalPrice: Number(currentReserveExperience.price) * guestCount,
            price: Number(currentReserveExperience.price),
            full_name: fullName,
            email,
            phone,
            date,
            time_start: timeStart,
            time_end: timeEnd,
            room: currentReserveExperience.room,
            duration: currentReserveExperience.duration,
            badge: currentReserveExperience.badge,
            menu: currentReserveExperience.menu,
            // Ensure image is saved from database (prioritize image_url from API)
            image_url: currentReserveExperience.image_url,
            image: currentReserveExperience.image || currentReserveExperience.image_url || currentReserveExperience.image_path || 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=800&q=80',
            image_path: currentReserveExperience.image_path
        };
        
        addToCart(cartItem);
        
        closeReserveModal();
    });

    function addToCart(item) {
        // Simpan ke sessionStorage agar ditangani di halaman cart
        const pendingReservations = JSON.parse(sessionStorage.getItem('pendingReservations')) || [];
        pendingReservations.push(item);
        sessionStorage.setItem('pendingReservations', JSON.stringify(pendingReservations));
        
        closeReserveModal();
        
        // Redirect ke halaman cart
        showToast('Reservasi ditambahkan ke cart! Mengarahkan ke checkout...', 'success');
        setTimeout(() => {
            window.location.href = '/cart';
        }, 800);
    }
    
    // Fallback untuk reservasi lama yang masih menggunakan cart object
    function addToCartOld(item) {
        const cartKey = `reservation-${item.id}-${item.date}-${item.time_start}-${item.time_end}-${item.special_request || 'none'}`;
        
        if (cart[cartKey]) {
            cart[cartKey].quantity += item.quantity;
            cart[cartKey].totalPrice += item.totalPrice;
            cart[cartKey].special_request = item.special_request;
        } else {
            cart[cartKey] = { ...item };
        }
        
        cartSidebar?.classList.remove('open');
        saveCart();
        updateCartDisplay();
    }

    function updateCartDisplay() {
        if (!cartItems || !cartTotal) {
            updateCartBadge();
            return;
        }
        let totalItems = 0;
        let totalPrice = 0;
        
        Object.values(cart).forEach(item => {
            totalItems += item.quantity;
            totalPrice += item.totalPrice;
        });
        
        if (cartCount) {
            cartCount.textContent = totalItems;
        }
        cartTotal.textContent = `Rp${totalPrice.toLocaleString('id-ID')}`;
        
        cartItems.innerHTML = '';
        
        if (totalItems === 0) {
            cartItems.appendChild(emptyCartMessage);
            emptyCartMessage.style.display = 'block';
        } else {
            emptyCartMessage.style.display = 'none';
            
            Object.values(cart).forEach(item => {
                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                
                // Format date if available
                let dateDisplay = '';
                if (item.date) {
                    const dateObj = new Date(item.date);
                    dateDisplay = dateObj.toLocaleDateString('id-ID', { 
                        weekday: 'short', 
                        year: 'numeric', 
                        month: 'short', 
                        day: 'numeric' 
                    });
                }
                
                // Get image source
                const imageSrc = item.image_path || item.image || '/img/source/default-reservation.jpg';
                
                cartItem.innerHTML = `
                    <div class="cart-item-image">
                        <img src="${imageSrc}" alt="${item.title || item.name}" onerror="this.src='/img/source/default-reservation.jpg'">
                    </div>
                    <div class="cart-item-details">
                        <div class="cart-item-name">${item.title || item.name}</div>
                        ${item.room ? `<div class="cart-item-info"><i class="fas fa-door-open"></i> ${item.room}</div>` : ''}
                        ${dateDisplay ? `<div class="cart-item-info"><i class="fas fa-calendar"></i> ${dateDisplay}</div>` : ''}
                        ${item.time_start ? `<div class="cart-item-info"><i class="fas fa-clock"></i> ${item.time_start}${item.time_end ? ' - ' + item.time_end : ''}</div>` : ''}
                        <div class="cart-item-info"><i class="fas fa-users"></i> ${item.quantity} guest${item.quantity > 1 ? 's' : ''}</div>
                        ${item.special_request ? `<div class="cart-item-info"><i class="fas fa-comment"></i> <em>${item.special_request.substring(0, 40)}${item.special_request.length > 40 ? '...' : ''}</em></div>` : ''}
                        <div class="cart-item-price">Rp${item.totalPrice.toLocaleString('id-ID')}</div>
                    </div>
                    <div class="cart-item-actions">
                        <button class="remove-cart" data-key="${Object.keys(cart).find(key => cart[key] === item)}" title="Remove">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                cartItems.appendChild(cartItem);
            });
            
            document.querySelectorAll('.remove-cart').forEach(btn => {
                btn.addEventListener('click', function() {
                    const key = this.dataset.key;
                    delete cart[key];
                    saveCart();
                    updateCartDisplay();
                    showToast('Item dihapus dari cart.', 'info');
                });
            });
        }
    }

    if (viewCartBtn) {
        viewCartBtn.addEventListener('click', function(e) {
            e.preventDefault();
            cartSidebar.classList.add('open');
        });
    }

    if (closeCartBtn) {
        closeCartBtn.addEventListener('click', function() {
            cartSidebar.classList.remove('open');
        });
    }

    document.addEventListener('click', function(e) {
        const clickedCartBtn = viewCartBtn && viewCartBtn.contains(e.target);
        if (!cartSidebar.contains(e.target) && !clickedCartBtn && cartSidebar.classList.contains('open')) {
            cartSidebar.classList.remove('open');
        }
        
        if (!document.querySelector('.modal-content').contains(e.target) && !e.target.closest('.reserve-btn') && reserveModal.classList.contains('active')) {
            reserveModal.classList.remove('active');
            currentReserveExperience = null;
        }
    });

    async function persistReservations(reservationItems) {
        const token = document.querySelector('meta[name="csrf-token"]')?.content;
        const results = [];

        for (const item of reservationItems) {
            try {
                const response = await fetch('/api/reservations', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        ...(token ? { 'X-CSRF-TOKEN': token } : {})
                    },
                    body: JSON.stringify({
                        reservation_id: item.id,
                        room: item.room || 'Default',
                        full_name: item.full_name,
                        email: item.email,
                        phone: item.phone,
                        date: item.date,
                        time_start: item.time_start,
                        time_end: item.time_end,
                        guests: item.quantity,
                        special_request: item.special_request || null
                    })
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    results.push({ success: false, message: errorData.message || 'Gagal menyimpan reservasi.' });
                    continue;
                }

                const data = await response.json();
                results.push({ success: true, message: `Reservasi ${data.booking?.full_name || item.full_name} disimpan.` });

                const keyToDelete = Object.keys(cart).find(k => cart[k] === item);
                if (keyToDelete) {
                    delete cart[keyToDelete];
                }
            } catch (error) {
                results.push({ success: false, message: 'Terjadi kesalahan jaringan.' });
            }
        }

        saveCart();
        updateCartDisplay();
        return results;
    }

    async function checkoutReservations() {
        const reservationItems = Object.values(cart).filter(item => item.type === 'reservation');

        if (reservationItems.length === 0) {
            showToast('Tidak ada reservasi di cart.', 'info');
            return;
        }

        const totalPrice = reservationItems.reduce((sum, item) => {
            const lineTotal = item.totalPrice || ((item.price || 0) * (item.quantity || 1));
            return sum + lineTotal;
        }, 0);
        const customer = {
            full_name: reservationItems[0]?.full_name || fullNameInput.value.trim(),
            email: reservationItems[0]?.email || emailInput.value.trim(),
            phone: reservationItems[0]?.phone || phoneInput.value.trim(),
        };

        if (!customer.full_name || !customer.email || !customer.phone) {
            showToast('Lengkapi nama, email, dan telepon sebelum checkout.', 'error');
            return;
        }

        checkoutBtn?.classList.add('is-loading');

        try {
            const response = await fetch('/api/payments/reservation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    amount: totalPrice,
                    customer,
                    items: reservationItems.map(item => ({
                        id: `reservation-${item.id}`,
                        name: item.title || item.name,
                        quantity: item.quantity,
                        price: item.price || Math.round((item.totalPrice || 0) / (item.quantity || 1))
                    }))
                })
            });

            if (!response.ok) {
                const err = await response.json();
                showToast(err.message || 'Gagal memulai pembayaran.', 'error');
                return;
            }

            const data = await response.json();
            if (!window.snap || !data.snap_token) {
                showToast('Snap token tidak tersedia.', 'error');
                return;
            }

            window.snap.pay(data.snap_token, {
                onSuccess: async () => {
                    const results = await persistReservations(reservationItems);
                    const failCount = results.filter(r => !r.success).length;
                    const type = failCount > 0 ? 'info' : 'success';
                    showToast(failCount > 0 ? 'Pembayaran sukses, sebagian data reservasi gagal tersimpan.' : 'Pembayaran sukses dan reservasi tersimpan.', type);
                    markUnavailable(reservationItems);
                    
                    // Clear all reservation items from cart
                    Object.keys(cart).forEach(key => {
                        if (cart[key].type === 'reservation') {
                            delete cart[key];
                        }
                    });
                    saveCart();
                    updateCartDisplay();
                    
                    // Close cart sidebar
                    if (cartSidebar) {
                        cartSidebar.classList.remove('open');
                    }
                },
                onPending: async () => {
                    await persistReservations(reservationItems);
                    showToast('Pembayaran tertunda, reservasi disimpan.', 'info');
                    markUnavailable(reservationItems);
                    
                    // Clear all reservation items from cart
                    Object.keys(cart).forEach(key => {
                        if (cart[key].type === 'reservation') {
                            delete cart[key];
                        }
                    });
                    saveCart();
                    updateCartDisplay();
                    
                    // Close cart sidebar
                    if (cartSidebar) {
                        cartSidebar.classList.remove('open');
                    }
                },
                onError: () => {
                    showToast('Pembayaran gagal. Coba lagi.', 'error');
                },
                onClose: () => {
                    showToast('Jendela pembayaran ditutup.', 'info');
                }
            });
        } catch (error) {
            showToast('Terjadi kesalahan jaringan.', 'error');
        } finally {
            checkoutBtn?.classList.remove('is-loading');
            cartSidebar?.classList.remove('open');
        }
    }

    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function() {
            checkoutReservations();
        });
    }

    updateCartDisplay();
    updateCartBadge();
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