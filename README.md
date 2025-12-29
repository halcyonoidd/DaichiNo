# DaichiNo 🍱

<div align="center">

**Website Restoran Jepang Premium**

Daichi No adalah website untuk restoran bertemakan Jepang yang menyajikan pengalaman kuliner autentik dengan bahan-bahan alami dan segar. 

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)

</div>

---

## 📖 Tentang Project

Website Daichi No merupakan desain konsep untuk restoran premium bertemakan Jepang yang berlokasi di Indonesia. Website ini menghadirkan pengalaman digital yang selaras dengan nilai-nilai restoran melalui navigasi interaktif, palet warna earthy tones, dan elemen visual yang terinspirasi alam.

### Konsep Restoran

Daichi No bukan hanya restoran biasa - ini adalah pengalaman kuliner yang mendalam. Restoran ini: 
- 🎯 Berfokus pada pelanggan kelas atas
- 🍣 Menyajikan masakan tradisional dan modern Jepang
- 🏛️ Memiliki area terpisah untuk setiap kategori makanan
- ✨ Menawarkan pengalaman makan eksklusif berdasarkan tier

---

## ✨ Fitur Utama

### 🎨 Interface & Navigation
- **Navbar Dinamis** - Navbar transparan yang menjadi solid saat scroll
- **Navbar Konsisten** - Tampilan navbar seragam di semua halaman (kecuali login/register)
- **Footer Informatif** - Footer dengan informasi dasar dan quick links
- **Floating Account Button** - Pop-under berisi info akun, cek reservasi, dan logout

### 🏠 Homepage
- **Carousel Interaktif** - Perkenalan restoran dan testimoni pelanggan
- **Iframe Lokasi** - Peta interaktif menunjukkan lokasi restoran

### 🍜 Menu
- **Deskripsi Kategori** - Informasi lengkap setiap kategori makanan
- **Daftar Menu Lengkap** - Semua menu dikelompokkan berdasarkan kategori (Mizu: seafood & sushi, dll)

### 👨‍🍳 About
- **Carousel Chef** - Info head chef dengan efek fade in/out
- **Pop-up Detail** - Informasi detail chef saat card diklik

### 🎫 Reservation
- **Daftar Tiket Pengalaman** - Berbagai pilihan pengalaman dikelompokkan berdasarkan: 
  - Tier pengalaman
  - Lama waktu pengalaman
  - Jumlah spread makanan
- **Input Jumlah Pengunjung** - Sesuaikan reservasi dengan jumlah tamu

### 🛒 Shopping Features
- **Cart System** - Keranjang untuk menyimpan pesanan sebelum checkout
- **Checkout** - Proses pembayaran terintegrasi

### 📞 Contact
- **Desain Unik** - Interface berbentuk sushi interaktif
- **Informasi Kontak** - Email, telepon, dan media sosial restoran

### 🔐 User Management
- **Registration** - Pendaftaran akun pengguna baru
- **Login** - Autentikasi pengguna

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **PHP** - Bahasa pemrograman utama
- **Laravel** - Framework PHP untuk backend
- **PostgreSQL** - Database management system

### Frontend
- **HTML5** - Struktur halaman
- **CSS** - Styling dengan earthy tones theme
- **JavaScript** - Logika interaktif
- **Bulma** - Framework CSS

### Development Tools
- **Visual Studio Code** - IDE utama
- **Postman** - API testing platform
- **Render** - Cloud hosting platform

---

## 📦 Instalasi Manual

### Prasyarat

Pastikan sistem Anda sudah terinstal:
- PHP >= 8.0
- Composer
- Node. js & NPM
- PostgreSQL
- Git

### Langkah Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/halcyonoidd/DaichiNo.git
   cd DaichiNo
   ```

2. **Install Dependencies PHP**
   ```bash
   composer install
   ```

3. **Install Dependencies JavaScript**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Konfigurasi Database**
   
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=daichino
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

7. **Buat Database**
   
   Buat database baru di PostgreSQL:
   ```sql
   CREATE DATABASE daichino;
   ```

8. **Jalankan Migrasi Database**
   ```bash
   php artisan migrate
   ```

9. **Seed Database (Opsional)**
   ```bash
   php artisan db: seed
   ```

10. **Build Assets Frontend**
    ```bash
    npm run build
    ```
    
    Atau untuk development:
    ```bash
    npm run dev
    ```

11. **Generate Storage Link**
    ```bash
    php artisan storage:link
    ```

12. **Jalankan Server**
    
    Di terminal pertama, jalankan Laravel:
    ```bash
    php artisan serve
    ```
    
    Di terminal kedua (jika menggunakan npm run dev), jalankan:
    ```bash
    npm run dev
    ```

13. **Akses Website**
    
    Buka browser dan akses: 
    ```
    http://localhost:8000
    ```

---

## 📄 Struktur Halaman

| Halaman | Deskripsi | Akses |
|---------|-----------|-------|
| **Home** | Landing page dengan perkenalan restoran dan testimoni | Publik |
| **Login** | Autentikasi pengguna | Publik |
| **Register** | Pendaftaran akun baru | Publik |
| **Menu** | Daftar menu restoran dengan kategori 3D | Perlu Login |
| **About** | Informasi restoran, visi, misi, dan chef | Perlu Login |
| **Reservation** | Pemesanan pengalaman makan | Perlu Login |
| **Cart** | Keranjang pesanan dan checkout | Perlu Login |
| **Contact** | Informasi kontak dengan desain sushi interaktif | Perlu Login |

---

## 🚀 Cara Menggunakan Website

1. **Kunjungi** halaman home dan jelajahi informasi restoran
2. **Eksplorasi** menu dan halaman about untuk mengenal lebih dalam
3. **Registrasi** akun baru jika belum memiliki akun
4. **Login** menggunakan kredensial yang sudah dibuat
5. **Pilih** pengalaman makan di halaman reservation
6. **Masukkan** jumlah pengunjung dan permintaan khusus
7. **Review** pesanan di halaman cart
8. **Checkout** untuk menyelesaikan pembayaran
9. **Hubungi** restoran melalui halaman contact untuk informasi lebih lanjut

---

## 🎨 Design Philosophy

Website ini mengusung konsep **"Digital Meets Traditional"**:
- ⛰️ **Earthy Tones** - Palet warna natural yang menenangkan
- 🎌 **Japanese Aesthetics** - Elemen visual terinspirasi budaya Jepang
- 💎 **Premium Experience** - Interface yang elegan dan eksklusif
- 🌿 **Natural Elements** - Filosofi "Dari Bumi" tercermin dalam setiap detail

---

## 👤 Author

- **Agri Azzukhruf - 24051204085**
- **Pratama Rizalekta Yudhayana - 24051204097**
- **Agus Prasetya - 24051204098**

---

## 📝 License

Project ini dibuat untuk keperluan pemenuhan tugas project akhir - Pemrograman Berbasis Platform. 

---

<div align="center">

**Daichi No - Pengalaman Kuliner Autentik Jepang** 🍱

*From Earth, to You*

</div>
