# 🔑 MIDTRANS CONFIGURATION GUIDE

## 📋 Cara Mendapatkan Midtrans Keys

### Step 1: Buat Account di Midtrans

1. Buka https://midtrans.com
2. Klik **"Sign Up"**
3. Pilih tipe bisnis: **"E-Commerce"** atau **"Hospitality"**
4. Isi form dengan data bisnis Anda
5. Terima verification email
6. Confirm email

### Step 2: Login ke Dashboard

1. Buka https://dashboard.midtrans.com
2. Login dengan email yang sudah didaftar
3. Verify phone number (OTP)
4. Selesai login

### Step 3: Dapatkan Keys

**Untuk Development (Sandbox):**

1. Di dashboard, cari **Environment Selector** (biasanya di atas)
2. Pilih **"SANDBOX"** (bukan Production)
3. Klik **"Settings"** di menu kiri
4. Pilih **"Access Keys"**
5. Copy:
   - **Server Key** → Untuk .env `MIDTRANS_SERVER_KEY`
   - **Client Key** → Untuk .env `MIDTRANS_CLIENT_KEY`
6. Simpan kedua keys

**Untuk Production (Nanti):**

1. Switch ke **"PRODUCTION"** environment
2. Ikuti proses verifikasi bisnis
3. Setelah approved, ambil Production keys
4. Update .env dengan Production keys

### Step 4: Update .env

```env
# .env

# Midtrans Configuration
MIDTRANS_SERVER_KEY=SB-Mid-server-xxxxxxxxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=SB-Mid-client-xxxxxxxxxxxxxxxxxx
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_3DS=true
MIDTRANS_IS_SANITIZED=true
```

**Note:** Keys dimulai dengan:
- Sandbox: `SB-Mid-...`
- Production: `Mid-...` (tanpa SB)

---

## 🧪 Testing dengan Midtrans

### Test Card Numbers (Sandbox Only)

#### Visa Success
```
Card Number: 4811 1111 1111 1114
Expiry: 08/25 (any future date)
CVV: 123
Cardholder Name: APPROVED
```

#### Visa Pending
```
Card Number: 4111 1111 1111 1111
Expiry: 08/25
CVV: 123
Cardholder Name: CHALLENGE
```

#### Visa Deny
```
Card Number: 5105 1051 0510 5100
Expiry: 08/25
CVV: 123
Cardholder Name: REJECTED
```

#### Mastercard Success
```
Card Number: 5410 1111 1111 1114
Expiry: 08/25
CVV: 123
```

### E-Wallet Testing

**Go-Pay / OVO / Dana:**
1. Pilih metode e-wallet di popup
2. Scan QR code (or simulate)
3. Approve transaction
4. Return otomatis setelah approval

**Bank Transfer:**
1. Pilih "Bank Transfer"
2. Pilih bank
3. Sistem akan generate virtual account
4. Simulate transfer
5. Konfirmasi transaksi

### OTP Testing

OTP untuk semua test: **123456** atau **111111**

---

## ✅ Verification Checklist

Setelah setup, verifikasi dengan:

```bash
# 1. Cek .env sudah benar
cat .env | grep MIDTRANS

# Expected output:
# MIDTRANS_SERVER_KEY=SB-Mid-...
# MIDTRANS_CLIENT_KEY=SB-Mid-...
# MIDTRANS_IS_PRODUCTION=false
```

```bash
# 2. Cek config/midtrans.php loaded
php artisan config:show | grep midtrans

# Expected: config values sudah terbaca
```

```bash
# 3. Test API endpoint
curl -X GET "http://localhost:8000/api/reservation-offers"

# Expected: JSON response dengan daftar paket
```

```bash
# 4. Test payment endpoint (production code)
# Di browser console, buka /cart dan klik "Pay Now"
# Console harus show: "Snap token generated"
# Midtrans popup harus muncul
```

---

## 🚀 Configuration untuk Production

Ketika siap deploy ke production:

### Step 1: Get Production Keys

1. Di Midtrans dashboard, switch ke **PRODUCTION**
2. Complete business verification (sesuai requirement Midtrans)
3. Tunggu approval (biasanya 1-3 hari kerja)
4. Get production keys dari Settings → Access Keys

### Step 2: Update Environment

```env
# .env.production

MIDTRANS_SERVER_KEY=Mid-prod-xxxxxxxxxxxxx
MIDTRANS_CLIENT_KEY=Mid-prod-xxxxxxxxxxxxx
MIDTRANS_IS_PRODUCTION=true
```

### Step 3: Update Snap Script URL

Di Blade templates, ubah dari:
```html
<!-- Sandbox -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.client_key') }}"></script>
```

Ke:
```html
<!-- Production -->
<script src="https://app.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('midtrans.client_key') }}"></script>
```

Atau gunakan conditional:
```html
@if(config('midtrans.is_production'))
    <script src="https://app.midtrans.com/snap/snap.js" 
            data-client-key="{{ config('midtrans.client_key') }}"></script>
@else
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" 
            data-client-key="{{ config('midtrans.client_key') }}"></script>
@endif
```

### Step 4: SSL Certificate

- Install SSL certificate (HTTPS)
- Update `APP_URL` di .env ke HTTPS
- Verifikasi SSL di browser

### Step 5: Monitor & Test

- Monitor transactions di Midtrans dashboard
- Test dengan real payment methods
- Setup webhook untuk handle async notifications
- Configure email notifications

---

## 📊 Common Key Issues

### Issue 1: Keys Not Loading
```
Error: "Snap token tidak tersedia"

Solution:
- Pastikan keys di .env sudah benar
- Run: php artisan config:cache
- Restart server
- Cek browser console untuk error
```

### Issue 2: Sandbox vs Production
```
Error: "Transaction not found"

Solution:
- Pastikan MIDTRANS_IS_PRODUCTION=false untuk sandbox
- Gunakan sandbox keys untuk sandbox
- Gunakan production keys untuk production
- Jangan mix keduanya
```

### Issue 3: HTTPS Required (Production)
```
Error: "Insecure content blocked"

Solution:
- Install valid SSL certificate
- Update APP_URL ke HTTPS
- All resources harus HTTPS (no mixed content)
```

---

## 🔐 Security Best Practices

✅ **DO:**
- Keep server key private (never expose to frontend)
- Use environment variables for keys
- Rotate keys regularly
- Monitor suspicious transactions
- Verify webhook signatures
- Use HTTPS always

❌ **DON'T:**
- Hardcode keys di code
- Push keys ke git repository
- Share keys via email/chat
- Use same keys for multiple environments
- Expose keys di browser console

---

## 📱 Webhook Configuration (Optional)

Untuk production, setup webhook:

1. Di Midtrans dashboard → **Settings → Webhooks**
2. Add endpoint: `https://yoursite.com/api/midtrans-webhook`
3. Select event: `charge.success`, `charge.pending`, `charge.deny`
4. Save

Contoh webhook handler:
```php
// routes/api.php
Route::post('/midtrans-webhook', [PaymentController::class, 'handleWebhook']);

// PaymentController.php
public function handleWebhook(Request $request) {
    $payload = $request->all();
    $signature = $request->get('signature_key');
    
    // Verify signature
    $hash = hash('sha512', 
        $payload['order_id'] . 
        $payload['status_code'] . 
        $payload['gross_amount'] . 
        config('midtrans.server_key')
    );
    
    if ($signature !== $hash) {
        return response()->json(['status' => 'invalid'], 403);
    }
    
    // Handle transaction
    // Update booking status, send emails, etc
    
    return response()->json(['status' => 'ok']);
}
```

---

## 📞 Support & Contacts

- **Midtrans Website**: https://midtrans.com
- **Documentation**: https://docs.midtrans.com
- **Dashboard**: https://dashboard.midtrans.com
- **Status Page**: https://status.midtrans.com
- **Email Support**: support@midtrans.com
- **Live Chat**: Available in dashboard

---

## ✨ Checklist Lengkap

### Sandbox Setup
- [ ] Account created di Midtrans
- [ ] Email verified
- [ ] Dashboard login successful
- [ ] Sandbox keys copied
- [ ] Keys added to .env
- [ ] .env config verified
- [ ] Server restarted
- [ ] Test card added to wallet
- [ ] Test payment successful

### Production Setup
- [ ] Production keys obtained
- [ ] Keys updated in .env
- [ ] SSL certificate installed
- [ ] APP_URL updated to HTTPS
- [ ] Snap script URL updated
- [ ] config:cache ran
- [ ] Test with real payment
- [ ] Webhook configured
- [ ] Email notifications setup
- [ ] Monitoring enabled

---

**Last Updated: 2025-12-14**
**For more info: https://docs.midtrans.com**
