# ✅ PRE-TESTING CHECKLIST

Sebelum testing sistem reservasi, pastikan semua langkah ini sudah selesai:

---

## 📋 STEP 1: Environment Configuration

- [ ] Buka file `.env` di root project
- [ ] Cari bagian `MIDTRANS_`
- [ ] Pastikan sudah terisi:
  ```env
  MIDTRANS_SERVER_KEY=SB-Mid-xxxxxxxxxxxxx
  MIDTRANS_CLIENT_KEY=SB-Mid-xxxxxxxxxxxxx
  MIDTRANS_IS_PRODUCTION=false
  ```

**Jika kosong atau ada error:**
1. Buka https://midtrans.com
2. Daftar account baru
3. Login ke https://dashboard.midtrans.com
4. Copy Server Key & Client Key dari Settings → Access Keys
5. Paste ke .env file

⚠️ **JANGAN SKIP STEP INI** - Tanpa keys, payment tidak akan bekerja

---

## 📦 STEP 2: Database Migration

Run command:
```bash
php artisan migrate
```

Expected output:
```
Migrating: 0001_01_01_000000_create_users_table
Migrating: 2025_12_11_082923_create_products_table
Migrating: 2025_12_11_082923_create_reservation.php
...
Migrated:  0001_01_01_000000_create_users_table (...]
```

**Jika ada error:**
- [ ] Pastikan database connection benar di .env
- [ ] Pastikan database sudah created
- [ ] Jalankan `php artisan migrate:fresh` (akan clear semua data)

---

## 🌱 STEP 3: Database Seeding (Optional)

Jika ingin test data paket reservasi:
```bash
php artisan db:seed --class=ReservationSeeder
```

Expected: Muncul 3-5 paket reservasi di database

**Ini optional tapi sangat membantu untuk testing**

---

## 🔍 STEP 4: Verify Files

Pastikan semua file sudah ada:

- [ ] `/app/Http/Controllers/Api/ReservationController.php` ✓
- [ ] `/app/Http/Controllers/Api/ReservationOfferController.php` ✓
- [ ] `/app/Http/Controllers/Api/PaymentController.php` ✓
- [ ] `/app/Models/Reservation.php` ✓
- [ ] `/app/Models/ReservationBooking.php` ✓
- [ ] `/public/js/frontend/reservation.js` ✓
- [ ] `/public/js/frontend/cart.js` ✓
- [ ] `/public/js/frontend/cart-reservations.js` ✓ (BARU)
- [ ] `/resources/views/custPage/reservation.blade.php` ✓
- [ ] `/resources/views/custPage/cart.blade.php` ✓
- [ ] `/config/midtrans.php` ✓
- [ ] `/routes/api.php` (dengan endpoints) ✓

**Semua file harus ada** untuk flow bekerja

---

## 🔄 STEP 5: Start Development Server

```bash
php artisan serve
```

Expected output:
```
Laravel development server started: http://127.0.0.1:8000
```

Jangan close terminal ini - server harus keep running saat testing

---

## 🌐 STEP 6: Browser Verification

1. Open http://localhost:8000
2. Check di console (F12 → Console tab):
   - [ ] No red errors
   - [ ] No CORS warnings
   - [ ] CSS loaded (no 404)
   - [ ] No security warnings

**Tips:**
- Clear browser cache: Ctrl+Shift+Delete
- Disable browser extensions jika ada error
- Use Chrome, Firefox, atau Safari

---

## 📝 STEP 7: User Authentication

Pilih salah satu:

**Option A: Use existing account**
- [ ] Login dengan akun existing user
- [ ] Check `/profile` page accessible

**Option B: Create new account**
```bash
# Quick Laravel Tinker
php artisan tinker

# Di tinker shell:
>>> App\Models\User::create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => bcrypt('password123')
])
>>> exit
```

Kemudian login dengan:
- Email: test@example.com
- Password: password123

⚠️ **USER HARUS LOGIN** untuk access reservation page

---

## 🎯 STEP 8: Navigation Check

Pastikan bisa navigasi ke:

- [ ] `/` (Home/Landing)
- [ ] `/menu` (Menu)
- [ ] `/reservation` ← **Start testing dari sini**
- [ ] `/cart`
- [ ] `/profile`

Jika ada 404, berarti ada routing issue

---

## 🔧 STEP 9: API Verification

Test API endpoints dengan Postman atau curl:

```bash
# Test 1: Get reservation offers
curl http://localhost:8000/api/reservation-offers

# Expected: JSON array dengan list paket
# Jika error: check ReservationOfferController
```

```bash
# Test 2: Check availability
curl -X POST http://localhost:8000/api/reservations/availability \
  -H "Content-Type: application/json" \
  -d '{
    "room": "Tatami Room A",
    "date": "2025-12-25",
    "time_start": "18:00",
    "time_end": "20:00"
  }'

# Expected: JSON dengan available: true/false
```

---

## 💳 STEP 10: Midtrans Connection Check

Di halaman `/cart`, buka Console (F12):

```javascript
// Type di console:
console.log(window.snap)

// Expected: Should show object, not undefined
// Jika undefined: Midtrans script belum load
```

---

## ✨ STEP 11: Clean Slate Preparation

Sebelum test flow, pastikan:

- [ ] Browser cache cleared
- [ ] No previous cart data
  ```javascript
  // Di console:
  localStorage.removeItem('cart')
  sessionStorage.removeItem('pendingReservations')
  location.reload()
  ```
- [ ] Fresh login session
- [ ] No browser extensions interfering

---

## 🧪 STEP 12: Ready for Testing?

Checklist final:

- [ ] .env configured dengan Midtrans keys ✓
- [ ] Database migrated ✓
- [ ] Database seeded (optional) ✓
- [ ] All files present ✓
- [ ] Server running ✓
- [ ] Browser cache cleared ✓
- [ ] User logged in ✓
- [ ] Can navigate to /reservation ✓
- [ ] No console errors ✓

**Jika semua ✓, Anda ready untuk START TESTING!**

---

## 🎬 NOW TEST THE FLOW!

**Baca file:** `IMPLEMENTASI_RINGKASAN.md` bagian "TEST FLOW"

atau ikuti langkah manual di bawah:

### Test Steps:

1. **Buka** http://localhost:8000/reservation
2. **Lihat** list paket reservasi
3. **Klik** "Reserve Now" di salah satu paket
4. **Isi form:**
   - Name: John Doe
   - Email: john@example.com
   - Phone: 08123456789
   - Date: 2025-12-25
   - Time Start: 18:00
   - Time End: 20:00
   - Guests: 2
5. **Klik** "Confirm Reserve"
6. **Lihat** success toast & redirect to cart
7. **Di cart, klik** "Pay Now"
8. **Di Midtrans popup:**
   - Pilih "Credit Card"
   - Input test card: 4111111111111111
   - Exp: 08/25, CVV: 123
   - OTP: 123456
9. **Lihat** success message
10. **Verifikasi** di database table `reservation_bookings`

---

## 🐛 Troubleshooting Quick Reference

| Problem | Quick Fix |
|---------|-----------|
| "Snap not defined" | Refresh page, check Midtrans script loaded |
| No paket displayed | Check API: curl http://localhost:8000/api/reservation-offers |
| Form validation error | Check all required fields filled |
| Payment popup blank | Clear cache, disable extensions, switch browser |
| Booking tidak tersimpan | Check console error, verify API response |
| Redirect error | Check route/cart defined in web.php |

---

## 📞 Need Help?

1. Check browser console (F12) for specific error
2. Read full documentation:
   - `SETUP_RESERVASI_MIDTRANS.md` - detailed setup
   - `FLOW_DIAGRAM.md` - visual flow
   - `IMPLEMENTASI_RINGKASAN.md` - technical details
3. Run script helpers:
   - Linux/Mac: `bash setup-reservasi.sh`
   - Windows: `setup-reservasi.bat`

---

## ✅ Completion

Once you completed this checklist, you're ready to:
- ✅ Test development flow
- ✅ Deploy to staging
- ✅ Train customer
- ✅ Go live with production keys

**Good luck! 🚀**

---

**Last Updated: 2025-12-14**
