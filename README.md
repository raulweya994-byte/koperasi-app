# 🏢 # Sistem Informasi Manajemen DISPERINDAGKOP Kabupaten Tolikara Berbasis Laravel

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0-orange?style=for-the-badge&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

## 📋 Tentang Proyek

Sistem Informasi Manajemen **Dinas Perindustrian, Perdagangan dan Koperasi (DISPERINDAGKOP) Kabupaten Tolikara** adalah aplikasi web berbasis Laravel yang dirancang untuk mengelola data koperasi, anggota, bantuan, pelatihan, dan berbagai kegiatan terkait pemberdayaan koperasi di Kabupaten Tolikara, Papua Pegunungan.

### ✨ Fitur Utama

#### 🔐 Multi-Role Authentication
- **Super Admin** - Akses penuh ke seluruh sistem
- **Admin** - Manajemen data koperasi dan anggota
- **Petugas** - Verifikasi dan monitoring
- **Pimpinan** - Dashboard laporan dan analitik
- **Koperasi** - Portal manajemen koperasi
- **Anggota** - Portal anggota koperasi

#### 📊 Manajemen Data Koperasi
- ✅ Pendaftaran dan verifikasi koperasi
- ✅ Profil lengkap koperasi (data usaha, dokumen, struktur organisasi)
- ✅ Manajemen anggota koperasi
- ✅ Tracking status verifikasi
- ✅ Laporan koperasi per distrik

#### 👥 Manajemen Anggota
- ✅ Registrasi anggota dengan form multi-step
- ✅ Data pribadi, alamat, dan usaha
- ✅ Upload foto dan dokumen
- ✅ Cetak sertifikat keanggotaan
- ✅ Manajemen simpanan anggota

#### 💰 Manajemen Bantuan
- ✅ Pengajuan bantuan oleh koperasi
- ✅ Verifikasi dan approval bertingkat
- ✅ Penjadwalan distribusi bantuan
- ✅ Tracking status bantuan
- ✅ Laporan penerima bantuan

#### 📚 Pelatihan & Kegiatan
- ✅ Jadwal pelatihan koperasi
- ✅ Pendaftaran peserta pelatihan
- ✅ Sertifikat pelatihan digital
- ✅ Dokumentasi kegiatan

#### 📰 Informasi Publik
- ✅ Berita dan pengumuman
- ✅ Galeri foto dan video kegiatan
- ✅ Halaman statis (Profil, Visi Misi, Kontak)
- ✅ FAQ dan bantuan

#### 📈 Laporan & Analitik
- ✅ Dashboard statistik real-time
- ✅ Laporan koperasi per distrik
- ✅ Laporan bantuan dan penerima
- ✅ Laporan pelatihan
- ✅ Export data (Excel, PDF)

#### 🔔 Notifikasi
- ✅ Notifikasi real-time
- ✅ Email notification
- ✅ Activity log system

---

## 🚀 Teknologi yang Digunakan

### Backend
- **Laravel 11.x** - PHP Framework
- **PHP 8.2+** - Programming Language
- **MySQL 8.0** - Database
- **Laravel Sanctum** - API Authentication

### Frontend
- **Blade Template** - Laravel Templating Engine
- **Bootstrap 5** - CSS Framework
- **AdminLTE 3** - Admin Dashboard Template
- **jQuery** - JavaScript Library
- **Font Awesome** - Icon Library
- **Chart.js** - Data Visualization

### Tools & Libraries
- **Composer** - PHP Dependency Manager
- **NPM** - Node Package Manager
- **Vite** - Frontend Build Tool
- **DomPDF** - PDF Generator
- **Intervention Image** - Image Processing

---

## 📦 Instalasi

### Prasyarat
Pastikan sistem Anda sudah terinstall:
- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js & NPM
- Git

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/raulweya994-byte/DISPERINDAGKOP_Tolikara.git
cd DISPERINDAGKOP_Tolikara
```

2. **Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

3. **Konfigurasi Environment**
```bash
# Copy file .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

4. **Konfigurasi Database**

Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=disperindagkop_tolikara
DB_USERNAME=root
DB_PASSWORD=
```

5. **Migrasi Database**
```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder (opsional)
php artisan db:seed
```

6. **Storage Link**
```bash
php artisan storage:link
```

7. **Build Assets**
```bash
# Development
npm run dev

# Production
npm run build
```

8. **Jalankan Aplikasi**
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

---

## 👤 Default User Credentials

Setelah menjalankan seeder, gunakan kredensial berikut untuk login:

| Role | Email | Password |
|------|-------|----------|
| Super Admin | superadmin@disperindagkop.go.id | password |
| Admin | admin@disperindagkop.go.id | password |
| Petugas | petugas@disperindagkop.go.id | password |
| Pimpinan | pimpinan@disperindagkop.go.id | password |

> ⚠️ **Penting:** Segera ubah password default setelah login pertama kali!

---

## 📁 Struktur Folder

```
DISPERINDAGKOP_Tolikara/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Controller untuk admin
│   │   │   ├── Anggota/        # Controller untuk anggota
│   │   │   ├── Auth/           # Controller autentikasi
│   │   │   ├── Koperasi/       # Controller untuk koperasi
│   │   │   ├── Petugas/        # Controller untuk petugas
│   │   │   └── Pimpinan/       # Controller untuk pimpinan
│   │   └── Middleware/         # Custom middleware
│   ├── Models/                 # Eloquent models
│   └── Notifications/          # Notification classes
├── database/
│   ├── migrations/             # Database migrations
│   ├── seeders/                # Database seeders
│   └── factories/              # Model factories
├── public/
│   ├── assets/                 # Static assets
│   └── storage/                # Public storage (symlink)
├── resources/
│   ├── views/
│   │   ├── admin/              # Admin views
│   │   ├── anggota/            # Anggota views
│   │   ├── auth/               # Auth views
│   │   ├── koperasi/           # Koperasi views
│   │   ├── layouts/            # Layout templates
│   │   ├── petugas/            # Petugas views
│   │   ├── pimpinan/           # Pimpinan views
│   │   └── public/             # Public views
│   ├── css/                    # CSS files
│   └── js/                     # JavaScript files
├── routes/
│   ├── web.php                 # Web routes
│   └── api.php                 # API routes
├── storage/
│   ├── app/                    # Application storage
│   ├── framework/              # Framework storage
│   └── logs/                   # Log files
├── .env.example                # Environment example
├── composer.json               # PHP dependencies
├── package.json                # Node dependencies
└── README.md                   # This file
```

---

## 🔧 Konfigurasi

### Email Configuration
Edit file `.env` untuk konfigurasi email:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@disperindagkop.go.id
MAIL_FROM_NAME="DISPERINDAGKOP Tolikara"
```

### File Upload Limits
Edit `php.ini` untuk mengatur batas upload:
```ini
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
```

---

## 📸 Screenshots

### Dashboard Admin
![Dashboard](https://via.placeholder.com/800x400?text=Dashboard+Admin)

### Manajemen Koperasi
![Koperasi](https://via.placeholder.com/800x400?text=Manajemen+Koperasi)

### Form Anggota
![Form Anggota](https://via.placeholder.com/800x400?text=Form+Anggota)

### Galeri Kegiatan
![Galeri](https://via.placeholder.com/800x400?text=Galeri+Kegiatan)

---

## 🧪 Testing

Jalankan test dengan perintah:
```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=UserTest
```

---

## 📝 API Documentation

API endpoint tersedia di `/api/v1/`. Dokumentasi lengkap dapat diakses setelah login sebagai admin.

### Authentication
```bash
POST /api/login
POST /api/logout
POST /api/register
```

### Koperasi
```bash
GET    /api/koperasi
GET    /api/koperasi/{id}
POST   /api/koperasi
PUT    /api/koperasi/{id}
DELETE /api/koperasi/{id}
```

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan ikuti langkah berikut:

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

---

## 🐛 Bug Reports

Jika menemukan bug, silakan buat issue di [GitHub Issues](https://github.com/raulweya994-byte/DISPERINDAGKOP_Tolikara/issues) dengan detail:
- Deskripsi bug
- Langkah untuk reproduce
- Expected behavior
- Screenshots (jika ada)
- Environment (OS, PHP version, dll)

---

## 📄 License

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## 👨‍💻 Developer

**Raul Weya**
- GitHub: [@raulweya994-byte](https://github.com/raulweya994-byte)
- Email: raulweya994@gmail.com

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [AdminLTE](https://adminlte.io) - Admin Dashboard Template
- [Bootstrap](https://getbootstrap.com) - CSS Framework
- [Font Awesome](https://fontawesome.com) - Icon Library

---

## 📞 Kontak

**DISPERINDAGKOP Kabupaten Tolikara**
- 📍 Alamat: Jl. Raya Karubaga, Kab. Tolikara, Papua Pegunungan
- 📞 Telepon: 0746 (123456)
- 📧 Email: info@disperindagkop-tolikara.go.id
- 🌐 Website: www.disperindagkop-tolikara.go.id

---

<p align="center">
  Made with ❤️ by <a href="https://github.com/raulweya994-byte">Raul Weya</a>
</p>

<p align="center">
  <sub>© 2026 DISPERINDAGKOP Kabupaten Tolikara. All rights reserved.</sub>
</p>

## Fitur Pengelolaan Data Anggota Koperasi
Fitur ini memungkinkan Admin untuk mengelola data anggota dari setiap koperasi terdaftar, mencakup penambahan anggota baru (dengan validasi NIK untuk mencegah duplikasi), pengeditan data, serta pengubahan status keanggotaan (aktif/nonaktif). Data anggota mencakup informasi identitas lengkap seperti NIK, nama, tanggal lahir, dan alamat yang divalidasi saat proses input.

URL: http://127.0.0.1:8000/admin/anggota
