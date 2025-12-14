# Flow Reservasi ke Cart dan Checkout dengan Midtrans

## 📋 Overview
Dokumentasi ini menjelaskan alur lengkap dari customer memilih reservasi hingga checkout menggunakan Midtrans.

---

## 🔄 Alur Lengkap

### 1. **Customer Memilih Reservasi** (`reservation.blade.php` / `reservation.js`)

**Langkah-langkah:**
1. Customer membuka halaman `/reservation`
2. Sistem memuat daftar reservasi yang tersedia dari API `/api/reservation-offers`
3. Customer mengklik tombol **"Reserve"** pada reservasi yang dipilih
4. Modal reservasi terbuka dengan form:
   - Full Name *
   - Email *
   - Phone Number *
   - Reservation Date *
   - Start Time *
   - End Time *
   - Number of Guests (1-10)
   - Special Requests (optional)
   - Terms Agreement checkbox *

**Validasi:**
```javascript
// File: reservation.js, line ~371
- Checkbox terms harus dicentang
- Semua field yang required harus diisi
- Date tidak boleh di masa lalu
```

### 2. **Add to Cart** (`reservation.js` line ~445)

Ketika customer klik **"Add to Cart"**:

```javascript
function addToCart(item) {
    // 1. Simpan data reservasi ke sessionStorage
    const pendingReservations = JSON.parse(sessionStorage.getItem('pendingReservations')) || [];
    pendingReservations.push(item);
    sessionStorage.setItem('pendingReservations', JSON.stringify(pendingReservations));
    
    // 2. Tutup modal
    closeReserveModal();
    
    // 3. Tampilkan notifikasi sukses
    showToast('Reservasi ditambahkan ke cart! Mengarahkan ke checkout...', 'success');
    
    // 4. Redirect ke halaman cart setelah 800ms
    setTimeout(() => {
        window.location.href = '/cart';
    }, 800);
}
```

**Data yang disimpan:**
```javascript
{
    id: reservation.id,
    name: "Experience Name",
    title: "Experience Title",
    type: "reservation",
    quantity: guestCount,
    special_request: "dietary restrictions...",
    totalPrice: price * quantity,
    price: basePrice,
    full_name: "Customer Name",
    email: "customer@email.com",
    phone: "08123456789",
    date: "2025-12-20",
    time_start: "19:00",
    time_end: "21:00",
    room: "Garden Room",
    duration: "07:00 - 09:00"
}
```

### 3. **Cart Page Load** (`cart.blade.php` / `cart.js` line ~308)

Ketika halaman `/cart` dimuat:

```javascript
document.addEventListener('DOMContentLoaded', () => {
    // 1. Ambil pending reservations dari sessionStorage
    const pendingReservations = JSON.parse(sessionStorage.getItem('pendingReservations')) || [];
    
    if (pendingReservations.length > 0) {
        // 2. Konversi cart ke object format jika diperlukan
        if (Array.isArray(cart)) {
            const tempCart = {};
            cart.forEach((item, idx) => {
                tempCart[`item-${idx}`] = item;
            });
            cart = tempCart;
        }
        
        // 3. Tambahkan reservasi ke cart dengan key unik
        pendingReservations.forEach(reservation => {
            const cartKey = `reservation-${reservation.id}-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`;
            cart[cartKey] = { 
                ...reservation,
                _key: cartKey
            };
        });
        
        // 4. Simpan cart ke localStorage
        saveCart();
        
        // 5. Hapus sessionStorage
        sessionStorage.removeItem('pendingReservations');
        
        // 6. Tampilkan notifikasi sukses
        const notification = document.createElement('div');
        notification.className = 'notification is-success';
        notification.innerHTML = `
            <strong>Reservasi berhasil ditambahkan!</strong><br>
            <small>Silakan lanjutkan ke pembayaran</small>
        `;
        document.body.appendChild(notification);
    }
    
    // 7. Update tampilan cart
    updateCartDisplay();
});
```

### 4. **Cart Display** (`cart.js` line ~138)

Cart menampilkan:
- **Gambar/Icon** reservasi
- **Title** dan **Badge** (Bronze/Silver/Gold)
- **Details**:
  - Tanggal dan waktu (formatted)
  - Ruangan
  - Jumlah tamu
  - Special requests
- **Quantity Controls** (+/-)
- **Remove Button**
- **Price per item**

**Summary Section:**
```
Subtotal: Rp xxx.xxx
Tax (10%): Rp xxx.xxx
Service Fee: Rp 5.000
------------------------
Total: Rp xxx.xxx
```

### 5. **Checkout Process** (`cart.js` line ~372)

Ketika customer klik **"Pay Now"**:

```javascript
async function startPayment() {
    // 1. Ambil semua item di cart
    const cartArray = getCartArray();
    
    // 2. Hitung total amount + tax + service fee
    const amount = cartArray.reduce((sum, item) => {
        return sum + (item.totalPrice || (item.price * item.quantity));
    }, 0);
    const tax = amount * 0.10;
    const serviceFee = 5000;
    const totalAmount = amount + tax + serviceFee;
    
    // 3. Ambil customer details dari reservasi atau meta tags
    const firstReservation = cartArray.find(item => item.type === 'reservation');
    const customerDetails = {
        full_name: firstReservation?.full_name || userName,
        email: firstReservation?.email || userEmail,
        phone: firstReservation?.phone || userPhone
    };
    
    // 4. Kirim request ke backend
    const response = await fetch('/api/payments/reservation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            amount: totalAmount,
            customer: customerDetails,
            items: cartArray.map(item => ({
                id: item._key || item.id,
                name: item.title || item.name,
                quantity: item.quantity,
                price: item.price
            }))
        })
    });
    
    // 5. Ambil snap token
    const data = await response.json();
    
    // 6. Buka Midtrans Snap
    window.snap.pay(data.snap_token, {
        onSuccess: (result) => {
            // Clear cart
            cart = {};
            saveCart();
            
            // Show success message
            alert('✅ Pembayaran berhasil!\n\nOrder ID: ' + data.order_id);
            
            // Redirect ke home
            setTimeout(() => {
                window.location.href = '/';
            }, 2000);
        },
        onPending: (result) => {
            // Clear cart
            cart = {};
            saveCart();
            
            alert('⏳ Pembayaran tertunda\n\nOrder ID: ' + data.order_id);
        },
        onError: (result) => {
            alert('❌ Pembayaran gagal\n\nSilakan coba lagi.');
        },
        onClose: () => {
            console.log('Snap closed by user');
        }
    });
}
```

### 6. **Backend Processing** (`PaymentController.php`)

**Endpoint:** `POST /api/payments/reservation`

**Request Validation:**
```php
$validated = $request->validate([
    'amount' => 'required|numeric|min:1000',
    'items' => 'required|array|min:1',
    'items.*.name' => 'required|string',
    'items.*.quantity' => 'required|integer|min:1',
    'items.*.price' => 'required|numeric|min:1',
    'items.*.id' => 'nullable|string',
    'customer' => 'required|array',
    'customer.full_name' => 'required|string',
    'customer.email' => 'required|email',
    'customer.phone' => 'required|string',
]);
```

**Midtrans Configuration:**
```php
Config::$serverKey = config('midtrans.server_key');
Config::$isProduction = config('midtrans.is_production');
Config::$isSanitized = true;
Config::$is3ds = true;
```

**Generate Order ID:**
```php
$orderId = 'RESV-' . time() . '-' . rand(1000, 9999);
// Example: RESV-1702512000-5847
```

**Midtrans Params:**
```php
$params = [
    'transaction_details' => [
        'order_id' => $orderId,
        'gross_amount' => (int) $validated['amount'],
    ],
    'item_details' => [
        [
            'id' => 'reservation-1',
            'price' => 250000,
            'quantity' => 2,
            'name' => 'Gold Experience - 10 Course'
        ],
        // ... more items
    ],
    'customer_details' => [
        'first_name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '08123456789',
    ],
];
```

**Response:**
```json
{
    "message": "Snap token generated",
    "snap_token": "xxxxx-xxxxx-xxxxx",
    "order_id": "RESV-1702512000-5847"
}
```

---

## 🎯 Testing Checklist

### Frontend Testing

- [ ] **Reservasi Page Load**
  - Reservasi ditampilkan dengan benar
  - Filter berfungsi
  - Modal reserve bisa dibuka

- [ ] **Reservasi Form**
  - Semua field validasi berfungsi
  - Date picker tidak bisa pilih tanggal lalu
  - Guest counter berfungsi (1-10)
  - Terms checkbox wajib dicentang

- [ ] **Add to Cart**
  - Toast notification muncul
  - Redirect ke cart page (800ms delay)
  - Data tersimpan di sessionStorage

- [ ] **Cart Page**
  - Reservasi muncul di cart
  - Detail lengkap ditampilkan
  - Quantity controls berfungsi
  - Remove item berfungsi
  - Calculation benar (subtotal + tax + service fee)
  - Cart badge update

- [ ] **Checkout**
  - Button "Pay Now" berfungsi
  - Loading state muncul
  - Midtrans Snap popup terbuka
  - Payment success: cart cleared, redirect ke home
  - Payment pending: cart cleared, alert ditampilkan
  - Payment error: alert ditampilkan, cart tidak cleared

### Backend Testing

- [ ] **API Endpoint**
  - `/api/reservation-offers` return data dengan benar
  - `/api/payments/reservation` validasi berfungsi
  - Snap token generated dengan benar

- [ ] **Midtrans Configuration**
  - Server key configured
  - Client key configured di blade
  - Sandbox/Production mode sesuai

---

## 🐛 Common Issues & Solutions

### Issue 1: Reservasi tidak muncul di cart
**Solusi:**
- Check browser console untuk error
- Verify sessionStorage: `sessionStorage.getItem('pendingReservations')`
- Pastikan redirect ke `/cart` berfungsi

### Issue 2: Snap token tidak generate
**Solusi:**
- Check `.env` file untuk Midtrans keys
- Verify network request di browser DevTools
- Check Laravel logs: `storage/logs/laravel.log`

### Issue 3: Cart calculation salah
**Solusi:**
- Verify item price dan quantity
- Check function `getCartArray()` output
- Console.log di `startPayment()` untuk debug

### Issue 4: Payment callback tidak jalan
**Solusi:**
- Check Snap script loaded: `<script src="https://app.sandbox.midtrans.com/snap/snap.js">`
- Verify client key: `data-client-key="{{ config('midtrans.client_key') }}"`
- Check browser console untuk error

---

## 🔧 Development Notes

### Storage Format

**sessionStorage (temporary):**
```javascript
pendingReservations: [
    { id: 1, name: "...", ... },
    { id: 2, name: "...", ... }
]
```

**localStorage (persistent):**
```javascript
cart: {
    "reservation-1-1702512000-abc123": { id: 1, _key: "...", ... },
    "reservation-2-1702512000-def456": { id: 2, _key: "...", ... }
}
```

### Key Functions

- **reservation.js**
  - `loadReservationOffers()` - Load offers from API
  - `openReserve(id)` - Open reservation modal
  - `addToCart(item)` - Save to sessionStorage & redirect

- **cart.js**
  - `getCartArray()` - Convert cart object to array
  - `updateCartDisplay()` - Render cart items
  - `startPayment()` - Handle checkout with Midtrans
  - `saveCart()` - Persist to localStorage

---

## 📞 Support

Jika ada masalah:
1. Check browser console untuk error
2. Check network tab untuk failed requests
3. Check Laravel logs: `storage/logs/laravel.log`
4. Verify Midtrans dashboard untuk transaction logs

---

**Last Updated:** December 14, 2025
