# Quick Testing Guide - Reservasi ke Cart & Checkout

## 🚀 Cara Testing

### Method 1: Automated Testing Page
1. Buka browser dan akses: `http://localhost:8000/test-reservation-flow.html`
2. Jalankan semua test secara berurutan:
   - API Endpoints Test
   - Storage Management Test
   - Cart Flow Simulation
   - Price Calculation Test

### Method 2: Manual Testing

#### A. Test Reservasi Page
```bash
# 1. Jalankan server
php artisan serve

# 2. Buka browser
http://localhost:8000/reservation
```

**Steps:**
1. ✅ Pastikan reservasi muncul di halaman
2. ✅ Klik tombol "Reserve" pada salah satu reservasi
3. ✅ Modal reservasi terbuka
4. ✅ Isi form:
   - Full Name: John Doe
   - Email: john@example.com
   - Phone: 08123456789
   - Date: [pilih tanggal besok]
   - Time Start: 19:00
   - Time End: 21:00
   - Guests: 2
   - Special Requests: No peanuts
   - ✅ Centang checkbox Terms
5. ✅ Klik "Add to Cart"
6. ✅ Toast notification muncul: "Reservasi ditambahkan ke cart! Mengarahkan ke checkout..."
7. ✅ Redirect ke `/cart` dalam 800ms

#### B. Test Cart Page
```bash
# Setelah redirect dari reservasi
http://localhost:8000/cart
```

**Checks:**
1. ✅ Notifikasi sukses muncul: "Reservasi berhasil ditambahkan!"
2. ✅ Reservasi muncul di cart dengan detail:
   - Title & Badge
   - Tanggal & Waktu (formatted)
   - Ruangan
   - Jumlah guests
   - Special requests
   - Price
3. ✅ Cart badge menunjukkan jumlah item
4. ✅ Summary section menunjukkan:
   - Subtotal
   - Tax (10%)
   - Service Fee (Rp 5.000)
   - Total

**Test Actions:**
1. ✅ Klik (+) untuk increase quantity → harga update
2. ✅ Klik (-) untuk decrease quantity → harga update
3. ✅ Klik "Remove" → item terhapus dari cart

#### C. Test Checkout
```bash
# Di cart page
```

**Steps:**
1. ✅ Pastikan ada minimal 1 item di cart
2. ✅ Klik tombol "Pay Now"
3. ✅ Button menunjukkan loading state
4. ✅ Midtrans Snap popup terbuka
5. ✅ Form payment muncul dengan detail:
   - Order ID (format: RESV-timestamp-xxxx)
   - Amount (subtotal + tax + service fee)
   - Items list
   - Customer details

**Test Payment Success:**
```
# Di Midtrans sandbox, gunakan test card:
Card Number: 4811 1111 1111 1114
CVV: 123
Exp: 01/25
OTP: 112233
```

**Expected:**
1. ✅ Payment success popup muncul
2. ✅ Alert: "✅ Pembayaran berhasil! Order ID: RESV-xxxx..."
3. ✅ Cart dikosongkan
4. ✅ Redirect ke home dalam 2 detik

---

## 🔍 Browser Console Testing

### 1. Check SessionStorage
```javascript
// Cek pending reservations
console.log(sessionStorage.getItem('pendingReservations'));

// Add mock reservation
const mockRes = {
    id: 1, 
    name: "Test", 
    price: 100000, 
    quantity: 2,
    full_name: "Test User",
    email: "test@test.com",
    phone: "08123456789"
};
sessionStorage.setItem('pendingReservations', JSON.stringify([mockRes]));
```

### 2. Check LocalStorage (Cart)
```javascript
// Cek cart
console.log(localStorage.getItem('cart'));

// Parse dan lihat isi
const cart = JSON.parse(localStorage.getItem('cart'));
console.table(Object.values(cart));

// Clear cart
localStorage.removeItem('cart');
```

### 3. Test API Call
```javascript
// Test fetch reservation offers
fetch('/api/reservation-offers')
    .then(r => r.json())
    .then(d => console.log('Offers:', d));

// Test payment endpoint (should fail validation)
fetch('/api/payments/reservation', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({})
})
    .then(r => r.json())
    .then(d => console.log('Validation:', d));
```

---

## 🐛 Debug Checklist

### Issue: Reservasi tidak muncul di cart

**Debug Steps:**
```javascript
// 1. Check sessionStorage before redirect
console.log('Before redirect:', sessionStorage.getItem('pendingReservations'));

// 2. Check if redirect happened
console.log('Current URL:', window.location.href);

// 3. Check DOMContentLoaded fired
console.log('DOM loaded');

// 4. Check cart after processing
console.log('Cart after:', localStorage.getItem('cart'));
```

**Common Causes:**
- ❌ SessionStorage tidak tersimpan → check browser privacy settings
- ❌ Redirect tidak jalan → check console errors
- ❌ Cart handler tidak jalan → check DOMContentLoaded event

### Issue: Checkout tidak berfungsi

**Debug Steps:**
```javascript
// 1. Check Snap script loaded
console.log('Snap available:', typeof window.snap);

// 2. Check meta tags
console.log('CSRF:', document.querySelector('meta[name="csrf-token"]')?.content);
console.log('Client Key:', document.querySelector('script[data-client-key]')?.dataset.clientKey);

// 3. Check request payload
// Add this before fetch in cart.js:
console.log('Payment payload:', {
    amount: totalAmount,
    customer: customerDetails,
    items: cartArray
});

// 4. Check response
// Add this after fetch:
console.log('Payment response:', data);
```

**Common Causes:**
- ❌ Snap script tidak load → check internet connection
- ❌ Client key salah → check .env file
- ❌ Server key salah → check Midtrans dashboard
- ❌ CSRF token missing → check blade template

---

## 📊 Expected Results

### Successful Flow
```
1. Reservation Page
   └─> Customer fills form
       └─> Click "Add to Cart"
           └─> Save to sessionStorage
               └─> Show toast notification
                   └─> Redirect to /cart (800ms)
                       
2. Cart Page
   └─> DOMContentLoaded fires
       └─> Read sessionStorage
           └─> Add to cart (localStorage)
               └─> Clear sessionStorage
                   └─> Show success notification
                       └─> Display cart items
                       
3. Checkout
   └─> Click "Pay Now"
       └─> Calculate totals
           └─> Fetch /api/payments/reservation
               └─> Receive snap_token
                   └─> Open Snap popup
                       └─> Customer pays
                           └─> onSuccess callback
                               └─> Clear cart
                                   └─> Show success message
                                       └─> Redirect to home
```

### Storage State at Each Step

**After "Add to Cart" (Reservation Page):**
```json
sessionStorage.pendingReservations = [
    {
        "id": 1,
        "name": "Gold Experience",
        "price": 250000,
        "quantity": 2,
        "totalPrice": 500000,
        "full_name": "John Doe",
        "email": "john@example.com",
        "phone": "08123456789",
        "date": "2025-12-25",
        "time_start": "19:00",
        "time_end": "21:00"
    }
]
```

**After Cart Page Load:**
```json
sessionStorage.pendingReservations = null

localStorage.cart = {
    "reservation-1-1702512000-abc123": {
        "id": 1,
        "name": "Gold Experience",
        "_key": "reservation-1-1702512000-abc123",
        ...rest of data
    }
}
```

**After Payment Success:**
```json
localStorage.cart = {}
```

---

## ✅ Test Checklist

### Pre-Testing
- [ ] Server running (`php artisan serve`)
- [ ] Database migrated and seeded
- [ ] `.env` configured with Midtrans keys
- [ ] Browser console open (F12)

### Reservation Page
- [ ] Page loads without errors
- [ ] Reservations displayed from API
- [ ] Filter berfungsi
- [ ] Modal opens on "Reserve" click
- [ ] Form validation works
- [ ] Date picker rejects past dates
- [ ] Guest counter works (1-10)
- [ ] Terms checkbox required
- [ ] "Add to Cart" saves to sessionStorage
- [ ] Toast notification appears
- [ ] Redirects to /cart

### Cart Page
- [ ] Pending reservations processed
- [ ] Success notification appears
- [ ] Items displayed correctly
- [ ] All details shown (date, time, guests, etc.)
- [ ] Quantity controls work
- [ ] Remove button works
- [ ] Price calculations correct
- [ ] Cart badge updates
- [ ] Cart persists on page refresh

### Checkout
- [ ] "Pay Now" button enabled when cart has items
- [ ] Loading state appears
- [ ] API request successful
- [ ] Snap token received
- [ ] Snap popup opens
- [ ] Payment form shows correct details
- [ ] Test payment works
- [ ] Success callback fires
- [ ] Cart cleared
- [ ] Success message shown
- [ ] Redirects to home

### Edge Cases
- [ ] Empty cart shows empty message
- [ ] Multiple reservations work
- [ ] Mixed cart (reservations + products) works
- [ ] Decimal prices handled correctly
- [ ] Large numbers format correctly (Indonesian format)
- [ ] Special characters in form handled
- [ ] Network error handled gracefully

---

## 🎯 Performance Expectations

- Page load: < 2s
- API response: < 500ms
- Cart processing: < 100ms
- Snap popup: < 2s
- Payment confirmation: < 3s

---

## 📝 Notes

1. **Sandbox Testing**: Gunakan Midtrans sandbox untuk testing, jangan gunakan production
2. **Test Cards**: Selalu gunakan test card numbers dari Midtrans documentation
3. **Clear Storage**: Clear browser storage jika ada masalah cache
4. **Check Logs**: Selalu check Laravel logs untuk error backend

---

**Testing Date:** December 14, 2025
**Tested By:** [Your Name]
**Status:** [ ] Pass / [ ] Fail
