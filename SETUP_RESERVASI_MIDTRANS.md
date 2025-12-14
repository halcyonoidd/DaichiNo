# Panduan Setup Sistem Reservasi dengan Pembayaran Midtrans

## 📋 Overview
Sistem ini memungkinkan pelanggan untuk:
1. Memilih paket reservasi dari halaman `/reservation`
2. Menambahkan ke cart
3. Checkout melalui halaman `/cart`
4. Melakukan pembayaran menggunakan Midtrans

## 🔧 Konfigurasi yang Diperlukan

### 1. Environment Variables (.env)
Pastikan file `.env` Anda memiliki konfigurasi Midtrans:

```env
MIDTRANS_SERVER_KEY=your_server_key_here
MIDTRANS_CLIENT_KEY=your_client_key_here
MIDTRANS_IS_PRODUCTION=false  # Set to true untuk production
MIDTRANS_IS_3DS=true
MIDTRANS_IS_SANITIZED=true
```

**Cara mendapatkan keys:**
1. Daftar di https://midtrans.com
2. Masuk ke dashboard
3. Ambil Server Key dan Client Key dari Sandbox (untuk development)

### 2. Database Seeding (Jika belum ada data)

Jalankan seeder untuk membuat data reservasi dummy:

```bash
php artisan db:seed --class=ReservationSeeder
```

## 📁 File-File yang Dimodifikasi/Dibuat

### Backend

#### 1. Routes
- **api.php** - API endpoints untuk reservasi dan pembayaran
  - `POST /api/reservations` - Simpan booking
  - `POST /api/reservations/availability` - Cek ketersediaan
  - `GET /api/reservation-offers` - Daftar paket reservasi
  - `POST /api/payments/reservation` - Create payment token

#### 2. Controllers

**ReservationController.php** (`app/Http/Controllers/Api/`)
- `store()` - Menyimpan reservation booking
- `index()` - Listing reservasi
- `checkAvailability()` - Cek slot availability

**ReservationOfferController.php** (`app/Http/Controllers/Api/`)
- `index()` - Ambil daftar paket reservasi

**PaymentController.php** (`app/Http/Controllers/Api/`)
- `createReservationPayment()` - Generate Snap token untuk pembayaran

#### 3. Models
- `Reservation` - Model untuk paket/penawaran reservasi
- `ReservationBooking` - Model untuk booking pelanggan

### Frontend

#### 1. Views
- **reservation.blade.php** - Halaman display paket reservasi
  - Modal form untuk booking details
  - Cart sidebar
  - Filter options

- **cart.blade.php** - Halaman checkout
  - Order summary
  - Reservation items display
  - Payment button

#### 2. JavaScript

**reservation.js** - Menangani logic di halaman reservasi
- Load paket dari API
- Buka modal booking
- Handle form submission
- Simpan ke sessionStorage
- Redirect ke cart

**cart-reservations.js** (FILE BARU) - Menangani reservasi di cart
- Load pending reservations dari sessionStorage
- Display reservation items
- Update quantity
- Handle pembayaran via Midtrans
- Simpan booking ke database setelah payment sukses

**cart.js** - General cart functionality
- Manage product items
- Update cart display
- Calculate totals

## 🔄 Flow Lengkap

### User Journey

1. **Halaman Reservasi** (`/reservation`)
   - User browsing paket reservasi
   - Klik "Reserve Now"
   - Isi form: nama, email, telepon, tanggal, jam, guests
   - Klik "Confirm Reserve"
   - Data disimpan ke `sessionStorage.pendingReservations`
   - Redirect ke `/cart`

2. **Halaman Cart** (`/cart`)
   - Script `cart-reservations.js` membaca `sessionStorage`
   - Menampilkan reservation items di cart
   - User dapat mengubah quantity atau hapus item
   - Order summary menghitung total harga

3. **Pembayaran** (via Midtrans)
   - User klik "Pay Now"
   - Call API `/api/payments/reservation`
   - Dapatkan Snap Token dari server
   - Tampilkan Midtrans payment popup
   - User mengisi payment details
   - Midtrans process payment

4. **Post-Payment**
   - Jika sukses:
     - Call API `/api/reservations` untuk setiap item
     - Simpan booking ke database
     - Clear cart
     - Show success message
   - Jika pending/gagal:
     - Tetap simpan booking
     - Show appropriate message

## 🚀 Testing

### Test Credentials (Midtrans Sandbox)

**Untuk credit card:**
```
Card Number: 4111111111111111
Expiry: 08/25
CVV: 123
```

**Untuk e-wallet dan metode lain, cek:** https://docs.midtrans.com/docs/mock-transactions

### Test Flow
1. Buka `/reservation`
2. Pilih paket reservasi, klik "Reserve Now"
3. Isi detail form:
   ```
   Name: Test User
   Email: test@example.com
   Phone: 08123456789
   Date: [tanggal di masa depan]
   Time Start: 18:00
   Time End: 20:00
   Guests: 2
   ```
4. Klik "Confirm Reserve"
5. Di halaman cart, klik "Pay Now"
6. Gunakan test card credentials
7. Verifikasi di database bahwa `reservation_bookings` sudah ter-create

## 📊 Database Structure

### Reservations (paket/penawaran)
```sql
id | title | badge | duration | room | price | capacity | menu | image_path | created_at | updated_at
```

### Reservation Bookings (booking pelanggan)
```sql
id | reservation_id | room | date | time_start | time_end | guests | full_name | email | phone | special_request | status | created_at | updated_at
```

## ⚙️ API Endpoints Reference

### 1. GET /api/reservation-offers
Ambil daftar paket reservasi

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "title": "Kaiseki Experience",
      "badge": "Premium",
      "duration": "2.5 hours",
      "room": "Tatami Room A",
      "price": 250000,
      "capacity": 8,
      "menu": "9-course menu",
      "image_path": "/storage/..."
    }
  ],
  "links": {...},
  "meta": {...}
}
```

### 2. POST /api/reservations/availability
Cek availability slot

**Request:**
```json
{
  "room": "Tatami Room A",
  "date": "2025-12-20",
  "time_start": "18:00",
  "time_end": "20:00"
}
```

**Response:**
```json
{
  "available": true
}
```

### 3. POST /api/reservations
Simpan booking

**Request:**
```json
{
  "reservation_id": 1,
  "room": "Tatami Room A",
  "date": "2025-12-20",
  "time_start": "18:00",
  "time_end": "20:00",
  "guests": 2,
  "full_name": "John Doe",
  "email": "john@example.com",
  "phone": "08123456789",
  "special_request": "Vegetarian menu"
}
```

**Response:**
```json
{
  "message": "Reservasi berhasil disimpan.",
  "booking": {...}
}
```

### 4. POST /api/payments/reservation
Create payment token

**Request:**
```json
{
  "amount": 500000,
  "items": [
    {
      "id": "reservation-1",
      "name": "Kaiseki Experience",
      "quantity": 2,
      "price": 250000
    }
  ],
  "customer": {
    "full_name": "John Doe",
    "email": "john@example.com",
    "phone": "08123456789"
  }
}
```

**Response:**
```json
{
  "snap_token": "0123abcd...",
  "order_id": "RESV-1702505400-1234"
}
```

## 🐛 Troubleshooting

### 1. "Snap token tidak tersedia"
- Pastikan `MIDTRANS_CLIENT_KEY` di env file
- Pastikan Midtrans script di-load dari CDN

### 2. Booking tidak tersimpan di database
- Pastikan API `/api/reservations` return status 201
- Check `reservation_bookings` table existence
- Verify CSRF token in requests

### 3. Payment popup tidak muncul
- Check console untuk error
- Pastikan `window.snap` object tersedia
- Verify Snap script dari https://app.sandbox.midtrans.com/snap/snap.js

### 4. SessionStorage tidak working
- Check browser storage settings
- Ensure JavaScript enabled
- Verify `sessionStorage` API supported

## 📝 Notes

- Semua harga dalam format IDR (Rupiah)
- Reservasi auto-expire jika sudah lewat tanggal/jam
- Status booking: `pending`, `booked`, `completed`, `cancelled`
- Service fee fixed Rp500
- Tax rate 10% dari subtotal

## 🔐 Security

- Validate semua input di backend
- Use CSRF token untuk POST requests
- Sanitize user input
- Verify amount sebelum charge di Midtrans
- Use HTTPS di production

## 📞 Support

Untuk bantuan lebih lanjut:
- Docs Midtrans: https://docs.midtrans.com
- Status Midtrans: https://status.midtrans.com
- Contact: support@midtrans.com
