# 🍱 DaichiNo - Sistem Reservasi Restoran Jepang

Selamat datang di **DaichiNo**, sebuah aplikasi web modern untuk sistem reservasi restoran Jepang. Proyek ini dibangun menggunakan Laravel 12 dan menyediakan fitur lengkap untuk mengelola reservasi pelanggan, menu, dan pembayaran online.

## 📋 Tentang Proyek

DaichiNo adalah platform reservasi restoran yang dirancang khusus untuk restoran Jepang. Aplikasi ini memungkinkan pelanggan untuk melakukan reservasi meja secara online, melihat menu, dan melakukan pembayaran dengan mudah.

## ✨ Fitur Utama

- 🎫 **Sistem Reservasi Online** - Pelanggan dapat memesan meja dengan mudah
- 🍣 **Manajemen Menu** - Tampilkan menu restoran dengan detail lengkap
- 💳 **Pembayaran Terintegrasi** - Menggunakan Midtrans untuk pembayaran yang aman
- 👥 **Manajemen Pelanggan** - Kelola data pelanggan dan riwayat reservasi
- 📱 **Responsive Design** - Tampilan yang optimal di semua perangkat
- 🔐 **Autentikasi & Otorisasi** - Sistem keamanan menggunakan Laravel Sanctum

## 🛠️ Teknologi yang Digunakan

- **Backend**: PHP 8.2+ dengan Laravel 12
- **Frontend**:  Blade Template (38.3%), JavaScript (17.4%), HTML & CSS
- **Database**: MySQL/PostgreSQL (menggunakan Doctrine DBAL)
- **Payment Gateway**: Midtrans
- **Build Tools**: Vite
- **Testing**:  Pest PHP

## 📦 Persyaratan Sistem

Sebelum menginstal, pastikan sistem Anda memiliki: 

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL atau PostgreSQL
- Git

## 🚀 Cara Instalasi


### Instalasi Manual

1. **Clone Repository**
   ```bash
   git clone https://github.com/halcyonoidd/DaichiNo. git
   cd DaichiNo
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   
   Buka file `.env` dan sesuaikan dengan konfigurasi database Anda: 
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=daichino
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Konfigurasi Midtrans**
   
   Tambahkan kredensial Midtrans Anda di file `.env`:
   ```
   MIDTRANS_SERVER_KEY=your_server_key
   MIDTRANS_CLIENT_KEY=your_client_key
   MIDTRANS_IS_PRODUCTION=false
   ```

6. **Migrasi Database**
   ```bash
   php artisan migrate
   ```

7. **Build Assets**
   ```bash
   npm run build
   ```

## 🎯 Menjalankan Aplikasi

### Mode Development

Jalankan server development dengan satu perintah: 

```bash
composer dev
```

Perintah ini akan menjalankan secara bersamaan:
- Laravel development server (http://localhost:8000)
- Queue listener
- Vite hot module replacement

### Mode Production

```bash
php artisan serve --host=0.0.0.0 --port=8000
```

## 🧪 Testing

Jalankan test suite dengan perintah:

```bash
composer test
```

atau

```bash
php artisan test
```

## 📁 Struktur Proyek

```
DaichiNo/
├── app/              # Logika aplikasi (Controllers, Models, dll)
├── bootstrap/        # File bootstrap framework
├── config/           # File konfigurasi
├── database/         # Migrations, seeders, dan factories
├── public/           # Asset publik dan entry point
├── resources/        # Views, CSS, dan JavaScript
├── routes/           # Definisi routing aplikasi
├── storage/          # File storage dan cache
├── tests/            # Test cases
└── vendor/           # Dependencies Composer
```

## 🤝 Kontribusi

Kontribusi selalu diterima! Jika Anda ingin berkontribusi: 

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b fitur-baru`)
3. Commit perubahan Anda (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request



⭐ Jika proyek ini membantu Anda, jangan lupa berikan star di repository ini! 
