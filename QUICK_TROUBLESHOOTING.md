# 🔧 QUICK TROUBLESHOOTING GUIDE

Jika Anda mengalami masalah, gunakan guide ini untuk quick diagnosis dan fix.

---

## ⚠️ Error: "Snap token tidak tersedia"

### Diagnosis
Midtrans script tidak ter-load atau client key salah.

### Solution
1. **Buka browser console (F12)**
2. **Check:**
   ```javascript
   console.log(window.snap)
   ```
   - Jika `undefined` → Snap script belum load
   - Jika object → Snap script loaded OK

3. **Fix:**
   ```javascript
   // Jika undefined, cek:
   console.log(document.currentScript)
   
   // Di Network tab, search: "snap.js"
   // Harus ada 1-2 entries dengan status 200 OK
   ```

4. **Langkah perbaikan:**
   - [ ] Check MIDTRANS_CLIENT_KEY di .env ada isinya
   - [ ] Refresh page (Ctrl+F5 hard refresh)
   - [ ] Clear browser cache
   - [ ] Cek CDN: https://app.sandbox.midtrans.com/snap/snap.js accessible
   - [ ] Restart Laravel server

---

## ⚠️ Error: "Form validation error"

### Diagnosis
Salah satu form field tidak valid atau kosong.

### Solution
1. **Cek console error:**
   ```javascript
   // Di browser console, lihat error message
   ```

2. **Common issues:**
   - Email field: pastikan format valid (nama@domain.com)
   - Phone field: pastikan hanya angka, min 10 digit
   - Date field: pastikan date lebih besar dari hari ini
   - Time field: pastikan time_end > time_start
   - Guests: pastikan 1-10

3. **Fix:**
   - Isi semua field yang required (ada asterisk *)
   - Validate format sebelum submit
   - Baca error message yang tampil

---

## ⚠️ Error: "Slot sudah terisi"

### Diagnosis
Room + date + time sudah di-book oleh user lain.

### Solution
1. **Choose different:**
   - [ ] Different room
   - [ ] Different date
   - [ ] Different time

2. **Verifikasi availability:**
   - [ ] Cek calendar/schedule jika ada
   - [ ] Pilih waktu yang lebih awal/akhir
   - [ ] Pilih tanggal lain

---

## ⚠️ Error: "Payment failed"

### Diagnosis
Pembayaran ditolak oleh Midtrans.

### Solution
1. **Check error message** di Midtrans popup
2. **Common reasons:**
   - Kartu credit invalid/expired
   - Saldo tidak cukup
   - Bank block transaksi
   - Test card expired

3. **Try:**
   - [ ] Gunakan test card yang benar
   - [ ] Cek apakah card masih valid
   - [ ] Coba card lain
   - [ ] Cek bank/kartu settings

**Test Cards yang bekerja:**
```
4111 1111 1111 1111  (Visa)
5410 1111 1111 1114  (Mastercard)
3530 1113 3330 0000  (JCB)
```

---

## ⚠️ Error: "Booking tidak tersimpan di database"

### Diagnosis
Payment berhasil tapi data tidak ada di database.

### Solution
1. **Check database:**
   ```bash
   # Di terminal, run:
   php artisan tinker
   
   # Di tinker shell:
   >>> DB::table('reservation_bookings')->count()
   # Should show number > 0
   
   >>> exit
   ```

2. **If kosong:**
   - [ ] Check API response di Console → Network tab
   - [ ] POST /api/reservations status harus 201 atau 200
   - [ ] CSRF token must be present
   - [ ] Verify ReservationBooking model fillable

3. **Fix:**
   - [ ] Run: `php artisan config:cache`
   - [ ] Restart server: `php artisan serve`
   - [ ] Try payment again

---

## ⚠️ Error: "Cannot POST /api/reservations"

### Diagnosis
Route tidak tersedia atau method salah.

### Solution
1. **Verify route exists:**
   ```bash
   php artisan route:list | grep reservations
   ```
   Should show:
   ```
   POST   /api/reservations
   ```

2. **If tidak ada:**
   - [ ] Check `/routes/api.php`
   - [ ] Verify `Route::post('/reservations', ...)` exists
   - [ ] Run: `php artisan route:clear`
   - [ ] Restart server

---

## ⚠️ Error: "CSRF token mismatch"

### Diagnosis
CSRF token tidak dikirim atau tidak valid.

### Solution
1. **Verify meta tag ada:**
   ```html
   <!-- Di halaman HTML, cek ada: -->
   <meta name="csrf-token" content="...">
   ```

2. **Check JS code:**
   ```javascript
   // Di cart-reservations.js, lihat:
   const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
   ```

3. **Fix:**
   - [ ] Pastikan meta tag di blade template
   - [ ] Run: `php artisan view:clear`
   - [ ] Refresh page

---

## ⚠️ Error: "sessionStorage is not defined"

### Diagnosis
Browser tidak support sessionStorage atau ada issue.

### Solution
1. **Check browser support:**
   ```javascript
   // Di console:
   typeof(Storage)
   // Should return: "object"
   ```

2. **If tidak support:**
   - [ ] Update browser ke version terbaru
   - [ ] Disable private/incognito mode
   - [ ] Disable extensions yang block storage

3. **Fix:**
   - [ ] Clear cookies & cache
   - [ ] Update browser
   - [ ] Coba browser lain

---

## ⚠️ Error: "Paket tidak tampil di halaman"

### Diagnosis
API tidak return data atau JavaScript error.

### Solution
1. **Test API:**
   ```bash
   curl http://localhost:8000/api/reservation-offers
   ```
   Should return JSON array

2. **If error:**
   - [ ] Check database: `php artisan tinker`
   - [ ] `>>> App\Models\Reservation::count()` - harus > 0
   - [ ] Run seeder: `php artisan db:seed --class=ReservationSeeder`

3. **If JavaScript error:**
   - [ ] Console (F12) - lihat error detail
   - [ ] Check `loadReservationOffers()` function

---

## ⚠️ Error: "Cart sidebar tidak buka"

### Diagnosis
JavaScript event tidak triggered atau CSS issue.

### Solution
1. **Check element exists:**
   ```javascript
   // Di console:
   document.getElementById('cart-sidebar')
   // Should return HTML element, not null
   ```

2. **If null:**
   - [ ] Check reservation.blade.php ada `<div id="cart-sidebar">`
   - [ ] Run: `php artisan view:clear`

3. **Check event listener:**
   - [ ] Break point di browser DevTools
   - [ ] Click "View Cart" button
   - [ ] Check if event triggered

---

## ⚠️ Error: "Redirect to /cart tidak bekerja"

### Diagnosis
Route tidak ada atau redirect salah.

### Solution
1. **Verify route:**
   ```bash
   php artisan route:list | grep cart
   ```
   Should show:
   ```
   GET  /cart  → custPage.cart
   ```

2. **If tidak ada:**
   - [ ] Check routes/web.php
   - [ ] Verify `Route::get('/cart', ...)->name('cart')`

3. **Check JavaScript:**
   ```javascript
   // Di console:
   window.location.href = '/cart'
   ```
   Should redirect ke /cart

---

## ⚠️ Error: "Checkout tidak jalan"

### Diagnosis
Payment flow tidak triggered atau ada error.

### Solution
1. **Check button element:**
   ```javascript
   // Di console:
   document.getElementById('pay-now-btn')
   // Should return button element
   ```

2. **Check function exists:**
   ```javascript
   // Di console:
   typeof initializePayment
   // Should return: "function"
   ```

3. **Manual trigger:**
   ```javascript
   // Di console, direct call:
   initializePayment()
   // Lihat error yang muncul
   ```

4. **Fix:**
   - [ ] Verify cart-reservations.js loaded
   - [ ] Check for JavaScript errors in console
   - [ ] Restart server & refresh page

---

## ⚠️ Error: Database Connection Error

### Diagnosis
Tidak bisa connect ke database.

### Solution
1. **Verify .env:**
   ```env
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=daichino
   DB_USERNAME=postgres
   DB_PASSWORD=xxxxx
   ```

2. **Test connection:**
   ```bash
   php artisan tinker
   >>> DB::connection()->getPdo()
   # If works, connection OK
   >>> exit
   ```

3. **Fix:**
   - [ ] Check database server running
   - [ ] Verify credentials correct
   - [ ] Check database exists: `createdb daichino`
   - [ ] Run: `php artisan migrate`

---

## ⚠️ Error: 404 Not Found

### Diagnosis
Page atau resource tidak ada.

### Solution
1. **For API endpoints:**
   ```bash
   php artisan route:list
   # Verify endpoint ada
   ```

2. **For views:**
   ```bash
   ls resources/views/custPage/
   # Verify .blade.php files ada
   ```

3. **For static files:**
   ```bash
   ls public/js/frontend/
   # Verify .js files ada
   ```

4. **Fix:**
   - [ ] Run: `php artisan route:clear`
   - [ ] Run: `php artisan view:clear`
   - [ ] Restart server

---

## 🔍 General Debugging Steps

Gunakan urutan ini untuk debug apapun:

1. **Clear Everything**
   ```bash
   php artisan route:clear
   php artisan view:clear
   php artisan config:clear
   php artisan cache:clear
   ```

2. **Refresh Page**
   - Hard refresh: Ctrl+Shift+R (or Cmd+Shift+R Mac)
   - Clear cache: Ctrl+Shift+Delete
   - Or restart browser

3. **Check Console**
   - F12 → Console tab
   - Lihat red/orange messages
   - Search specific error

4. **Check Network**
   - F12 → Network tab
   - Trigger action (click button)
   - Lihat request/response
   - Status harus 200/201, bukan 404/500

5. **Check Database**
   ```bash
   php artisan tinker
   # Verify data exists & correct
   ```

6. **Restart Server**
   ```bash
   php artisan serve
   ```

7. **Test Simple Case**
   - Jangan test dengan kompleks flow dulu
   - Test satu step per satu
   - Verify setiap step bekerja

---

## 📊 Error Checklist

Ketika dapat error, check ini:

- [ ] Browser console: ada error?
- [ ] Network tab: request OK (200/201)?
- [ ] Database: data ada?
- [ ] Routes: endpoint registered?
- [ ] Views: file ada & loaded?
- [ ] JS files: loaded & no error?
- [ ] .env: keys correct & complete?
- [ ] Server: running & latest code?

---

## 🆘 Still Stuck?

Jika masih tidak bisa fix:

1. **Gather information:**
   - [ ] Exact error message (copy-paste)
   - [ ] Screenshot
   - [ ] Browser console error
   - [ ] Network response
   - [ ] Database data

2. **Check documentation:**
   - [ ] SETUP_RESERVASI_MIDTRANS.md
   - [ ] IMPLEMENTASI_RINGKASAN.md
   - [ ] FLOW_DIAGRAM.md

3. **Run diagnostic script:**
   ```bash
   # Linux/Mac:
   bash setup-reservasi.sh
   
   # Windows:
   setup-reservasi.bat
   ```

4. **Contact support:**
   - Midtrans: support@midtrans.com
   - Laravel: https://laravel.com/docs

---

## ✨ Prevention Tips

Hindari error dengan:

- ✅ Always hard refresh page (Ctrl+Shift+R)
- ✅ Check console before testing
- ✅ Follow CHECKLIST_SEBELUM_TESTING.md
- ✅ Restart server setelah code change
- ✅ Test simple case first
- ✅ Keep .env secure & correct
- ✅ Use test credentials, not real card
- ✅ Monitor console while testing

---

**Good luck! Most issues resolve dengan clear cache + restart server + hard refresh! 🚀**
