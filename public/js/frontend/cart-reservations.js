/**
 * CART - RESERVATIONS HANDLER
 * Menangani reservasi yang ditambahkan dari halaman reservation
 */

document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.getElementById('cart-items');
    const emptyCartSection = document.getElementById('empty-cart');

    /**
     * Load pending reservations dari sessionStorage
     * dan tambahkan ke halaman cart
     */
    function loadPendingReservations() {
        const pendingReservations = JSON.parse(sessionStorage.getItem('pendingReservations')) || [];

        if (pendingReservations.length === 0) {
            return; // Tidak ada reservasi baru
        }

        // Ambil cart yang sudah ada
        let cart = JSON.parse(localStorage.getItem('cart')) || {};

        // Tambahkan setiap reservasi ke cart
        pendingReservations.forEach(reservation => {
            const cartKey = `reservation-${reservation.id}-${reservation.date}-${reservation.time_start}-${reservation.time_end}-${reservation.special_request || 'none'}`;
            
            cart[cartKey] = {
                type: 'reservation',
                id: reservation.id,
                name: reservation.title || reservation.name,
                title: reservation.title || reservation.name,
                image: reservation.image || reservation.image_path,
                image_path: reservation.image_path || reservation.image,
                price: Number(reservation.price),
                totalPrice: Number(reservation.price) * reservation.quantity,
                quantity: reservation.quantity,
                full_name: reservation.full_name,
                email: reservation.email,
                phone: reservation.phone,
                date: reservation.date,
                time_start: reservation.time_start,
                time_end: reservation.time_end,
                room: reservation.room,
                duration: reservation.duration,
                special_request: reservation.special_request || null,
                badge: reservation.badge || null,
                capacity: reservation.capacity,
                menu: reservation.menu
            };
        });

        // Simpan cart yang sudah diupdate
        localStorage.setItem('cart', JSON.stringify(cart));

        // Clear sessionStorage
        sessionStorage.removeItem('pendingReservations');

        // Update tampilan cart
        updateCartDisplayWithReservations();

        // Show notification
        showNotification(`${pendingReservations.length} reservasi ditambahkan ke cart!`, 'success');
    }

    /**
     * Render cart items termasuk reservasi
     */
    function updateCartDisplayWithReservations() {
        const cart = JSON.parse(localStorage.getItem('cart')) || {};
        let totalItems = 0;
        let totalPrice = 0;

        cartItemsContainer.innerHTML = '';

        // Hitung total
        Object.keys(cart).forEach(key => {
            const item = cart[key];
            totalItems += item.quantity || 1;
            totalPrice += item.totalPrice || ((item.price || 0) * (item.quantity || 1));
        });

        // Jika cart kosong
        if (totalItems === 0) {
            cartItemsContainer.innerHTML = '';
            if (emptyCartSection) {
                emptyCartSection.style.display = 'block';
            }
            updateCartBadge(0);
            updateOrderSummary(0, 0);
            return;
        }

        // Sembunyikan empty state
        if (emptyCartSection) {
            emptyCartSection.style.display = 'none';
        }

        // Render setiap item
        Object.keys(cart).forEach((key, index) => {
            const item = cart[key];
            const linePrice = item.totalPrice || ((item.price || 0) * (item.quantity || 1));

            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.dataset.key = key;
            cartItem.dataset.index = index;

            let itemHTML = `
                <div class="cart-item-image">
                    <img src="${item.image || item.image_path || 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=400&q=80'}" 
                         alt="${item.title || item.name}"
                         onerror="this.src='https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=400&q=80'">
                </div>
                <div class="cart-item-content">
                    <div class="cart-item-header">
                        <div>
                            <div class="cart-item-title">${item.title || item.name}</div>
                            <span class="cart-item-category ${item.type === 'reservation' ? 'category-reservation' : 'category-experience'}">
                                ${item.type === 'reservation' ? 'Reservation' : item.badge || 'Experience'}
                            </span>
                        </div>
                        <div class="cart-item-price">Rp${linePrice.toLocaleString('id-ID')}</div>
                    </div>
                    <div class="cart-item-details">
            `;

            // Tampilkan detail khusus reservasi
            if (item.type === 'reservation') {
                if (item.date) {
                    const dateObj = new Date(item.date);
                    const dateStr = dateObj.toLocaleDateString('id-ID', { 
                        weekday: 'short', 
                        year: 'numeric', 
                        month: 'short', 
                        day: 'numeric' 
                    });
                    itemHTML += `<p><i class="fas fa-calendar"></i> ${dateStr}</p>`;
                }
                if (item.time_start) {
                    itemHTML += `<p><i class="fas fa-clock"></i> ${item.time_start}${item.time_end ? ' - ' + item.time_end : ''}</p>`;
                }
                if (item.room) {
                    itemHTML += `<p><i class="fas fa-door-open"></i> ${item.room}</p>`;
                }
                itemHTML += `<p><i class="fas fa-users"></i> ${item.quantity} guest(s)</p>`;
                if (item.special_request) {
                    itemHTML += `<p><em>Request: ${item.special_request.substring(0, 50)}${item.special_request.length > 50 ? '...' : ''}</em></p>`;
                }
                if (item.duration) {
                    itemHTML += `<p><i class="fas fa-hourglass-half"></i> Duration: ${item.duration}</p>`;
                }
            } else {
                itemHTML += `<p>${item.description || ''}</p>`;
            }

            itemHTML += `
                    </div>
                    <div class="cart-item-controls">
                        <div class="quantity-controls">
                            <button class="qty-btn decrease-qty" data-index="${index}">-</button>
                            <span class="qty-value">${item.quantity || 1}</span>
                            <button class="qty-btn increase-qty" data-index="${index}">+</button>
                        </div>
                        <button class="remove-item" data-key="${key}">
                            <i class="fas fa-trash"></i>
                            Remove
                        </button>
                    </div>
                </div>
            `;

            cartItem.innerHTML = itemHTML;
            cartItemsContainer.appendChild(cartItem);
        });

        // Bind quantity controls
        document.querySelectorAll('.decrease-qty').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = this.dataset.index;
                changeQty(index, -1);
            });
        });

        document.querySelectorAll('.increase-qty').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = this.dataset.index;
                changeQty(index, 1);
            });
        });

        // Bind remove buttons
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const key = this.dataset.key;
                removeItem(key);
            });
        });

        // Update badges and summary
        updateCartBadge(totalItems);
        updateOrderSummary(totalPrice, totalItems);
    }

    /**
     * Ubah quantity item
     */
    function changeQty(index, delta) {
        const cart = JSON.parse(localStorage.getItem('cart')) || {};
        const keys = Object.keys(cart);
        const key = keys[index];

        if (!key) return;

        const item = cart[key];
        const newQty = (item.quantity || 1) + delta;

        if (newQty <= 0) {
            delete cart[key];
        } else {
            item.quantity = newQty;
            item.totalPrice = item.price * newQty;
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplayWithReservations();
    }

    /**
     * Hapus item dari cart
     */
    function removeItem(key) {
        const cart = JSON.parse(localStorage.getItem('cart')) || {};
        delete cart[key];
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplayWithReservations();
        showNotification('Item dihapus dari cart', 'info');
    }

    /**
     * Update cart badge
     */
    function updateCartBadge(count) {
        const badges = document.querySelectorAll('.cart-count, #cart-badge');
        badges.forEach(badge => {
            badge.textContent = count;
        });
    }

    /**
     * Update order summary
     */
    function updateOrderSummary(subtotal, itemCount) {
        const tax = Math.round(subtotal * 0.1); // 10% tax
        const serviceFee = 500; // Fixed service fee
        const total = subtotal + tax + serviceFee;

        // Update item count
        const itemCountElement = document.getElementById('item-count');
        if (itemCountElement) {
            itemCountElement.textContent = itemCount;
        }

        // Update totals
        const subtotalEl = document.getElementById('subtotal');
        const taxEl = document.getElementById('tax');
        const serviceFeeEl = document.getElementById('service-fee');
        const totalEl = document.getElementById('total');
        const discountEl = document.getElementById('discount');

        if (subtotalEl) subtotalEl.textContent = `Rp${subtotal.toLocaleString('id-ID')}`;
        if (taxEl) taxEl.textContent = `Rp${tax.toLocaleString('id-ID')}`;
        if (serviceFeeEl) serviceFeeEl.textContent = `Rp${serviceFee.toLocaleString('id-ID')}`;
        if (totalEl) totalEl.textContent = `Rp${total.toLocaleString('id-ID')}`;
        if (discountEl) discountEl.textContent = '-Rp0';

        // Store total for payment
        window.cartTotal = total;
    }

    /**
     * Show notification
     */
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification is-${type} notification-toast`;
        notification.innerHTML = `
            <button class="delete"></button>
            ${message}
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    /**
     * Initialize payment
     */
    function initializePayment() {
        const cart = JSON.parse(localStorage.getItem('cart')) || {};
        const keys = Object.keys(cart);

        if (keys.length === 0) {
            showNotification('Cart masih kosong', 'danger');
            return;
        }

        const reservationItems = keys
            .map(key => cart[key])
            .filter(item => item.type === 'reservation');

        if (reservationItems.length === 0) {
            showNotification('Tidak ada reservasi di cart', 'warning');
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const userName = document.querySelector('meta[name="user-name"]')?.content || 'Guest User';
        const userEmail = document.querySelector('meta[name="user-email"]')?.content || 'guest@example.com';
        const userPhone = document.querySelector('meta[name="user-phone"]')?.content || '0000000000';

        // Gunakan data dari reservation pertama jika tersedia
        const firstReservation = reservationItems[0];
        const finalName = firstReservation?.full_name || userName;
        const finalEmail = firstReservation?.email || userEmail;
        const finalPhone = firstReservation?.phone || userPhone;

        // Calculate total dari reservasi saja
        const totalAmount = reservationItems.reduce((sum, item) => {
            return sum + (item.totalPrice || (item.price * item.quantity));
        }, 0);

        // Siapkan items untuk Midtrans
        const items = reservationItems.map((item, idx) => ({
            id: `reservation-${item.id}-${idx}`,
            name: item.title || item.name,
            quantity: item.quantity || 1,
            price: item.price || 0
        }));

        // Call payment API
        paymentFlow(csrfToken, totalAmount, items, {
            full_name: finalName,
            email: finalEmail,
            phone: finalPhone
        }, reservationItems);
    }

    /**
     * Payment Flow
     */
    async function paymentFlow(csrfToken, amount, items, customer, reservationItems) {
        const payNowBtn = document.getElementById('pay-now-btn');
        if (!payNowBtn) return;

        payNowBtn.classList.add('is-loading');

        try {
            // Step 1: Create payment token
            const paymentResponse = await fetch('/api/payments/reservation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    ...(csrfToken ? { 'X-CSRF-TOKEN': csrfToken } : {})
                },
                body: JSON.stringify({
                    amount: Math.round(amount),
                    items: items,
                    customer: customer
                })
            });

            if (!paymentResponse.ok) {
                const error = await paymentResponse.json();
                showNotification(error.message || 'Gagal membuat token pembayaran', 'danger');
                return;
            }

            const paymentData = await paymentResponse.json();
            if (!paymentData.snap_token) {
                showNotification('Snap token tidak tersedia', 'danger');
                return;
            }

            // Step 2: Show Midtrans payment popup
            if (!window.snap) {
                showNotification('Midtrans tidak siap. Refresh halaman.', 'danger');
                return;
            }

            window.snap.pay(paymentData.snap_token, {
                onSuccess: async function(result) {
                    await persistReservations(reservationItems, customer);
                    clearCartReservations();
                    updateCartDisplayWithReservations();
                    showNotification('Pembayaran berhasil!', 'success');
                },
                onPending: async function(result) {
                    await persistReservations(reservationItems, customer);
                    clearCartReservations();
                    updateCartDisplayWithReservations();
                    showNotification('Pembayaran tertunda, reservasi dicatat', 'info');
                },
                onError: function(result) {
                    showNotification('Pembayaran gagal. Silakan coba lagi.', 'danger');
                },
                onClose: function() {
                    showNotification('Pembayaran dibatalkan', 'warning');
                }
            });

        } catch (error) {
            console.error('Payment error:', error);
            showNotification('Terjadi kesalahan. Cek koneksi internet.', 'danger');
        } finally {
            payNowBtn.classList.remove('is-loading');
        }
    }

    /**
     * Persist reservasi ke database
     */
    async function persistReservations(reservationItems, customer) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const token = csrfToken;

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
                        full_name: customer.full_name || item.full_name,
                        email: customer.email || item.email,
                        phone: customer.phone || item.phone,
                        date: item.date,
                        time_start: item.time_start,
                        time_end: item.time_end,
                        guests: item.quantity || 1,
                        special_request: item.special_request || null
                    })
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log('Reservasi disimpan:', data);
                } else {
                    const error = await response.json();
                    console.error('Gagal menyimpan reservasi:', error);
                }
            } catch (error) {
                console.error('Error persisting reservation:', error);
            }
        }
    }

    /**
     * Clear cart reservations
     */
    function clearCartReservations() {
        const cart = JSON.parse(localStorage.getItem('cart')) || {};
        const keys = Object.keys(cart);

        keys.forEach(key => {
            if (cart[key].type === 'reservation') {
                delete cart[key];
            }
        });

        localStorage.setItem('cart', JSON.stringify(cart));
    }

    // Bind pay now button
    const payNowBtn = document.getElementById('pay-now-btn');
    if (payNowBtn) {
        payNowBtn.addEventListener('click', initializePayment);
    }

    // Load pending reservations on page load
    loadPendingReservations();

    // Update on storage changes
    window.addEventListener('storage', function(e) {
        if (e.key === 'cart') {
            updateCartDisplayWithReservations();
        }
    });
});
