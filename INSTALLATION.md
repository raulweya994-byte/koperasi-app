# 📦 Panduan Instalasi Lengkap

## Daftar Isi
- [Prasyarat Sistem](#prasyarat-sistem)
- [Instalasi di Windows](#instalasi-di-windows)
- [Instalasi di Linux/Ubuntu](#instalasi-di-linuxubuntu)
- [Instalasi di macOS](#instalasi-di-macos)
- [Konfigurasi Database](#konfigurasi-database)
- [Troubleshooting](#troubleshooting)

---

## Prasyarat Sistem

### Minimum Requirements
- **PHP**: >= 8.2
- **MySQL**: >= 8.0 atau MariaDB >= 10.3
- **Composer**: Latest version
- **Node.js**: >= 18.x
- **NPM**: >= 9.x
- **Memory**: 512MB RAM (minimum)
- **Disk Space**: 500MB free space

### Recommended Requirements
- **PHP**: 8.3
- **MySQL**: 8.0
- **Memory**: 1GB RAM
- **Disk Space**: 1GB free space

---

## Instalasi di Windows

### 1. Install XAMPP
Download dan install [XAMPP](https://www.apachefriends.org/download.html) yang sudah include PHP dan MySQL.

### 2. Install Composer
1. Download [Composer](https://getcomposer.org/download/)
2. Jalankan installer
3. Verifikasi instalasi:
```bash
composer --version
```

### 3. Install Node.js
1. Download [Node.js](https://nodejs.org/)
2. Install dengan default settings
3. Verifikasi instalasi:
```bash
node --version
npm --version
```

### 4. Clone Project
```bash
cd C:\xampp\htdocs
git clone https://github.com/raulweya994-byte/DISPERINDAGKOP_Tolikara.git
cd DISPERINDAGKOP_Tolikara
```

### 5. Install Dependencies
```bash
composer install
npm install
```

### 6. Setup Environment
```bash
copy .env.example .env
php artisan key:generate
```

### 7. Konfigurasi Database
1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Buat database baru: `disperindagkop_tolikara`
3. Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=disperindagkop_tolikara
DB_USERNAME=root
DB_PASSWORD=
```

### 8. Migrasi Database
```bash
php artisan migrate
php artisan db:seed
```

### 9. Storage Link
```bash
php artisan storage:link
```

### 10. Build Assets
```bash
npm run build
```

### 11. Jalankan Server
```bash
php artisan serve
```

Buka browser: `http://localhost:8000`

---

## Instalasi di Linux/Ubuntu

### 1. Update System
```bash
sudo apt update
sudo apt upgrade -y
```

### 2. Install PHP 8.2
```bash
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.2 php8.2-cli php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd php8.2-intl -y
```

### 3. Install MySQL
```bash
sudo apt install mysql-server -y
sudo mysql_secure_installation
```

### 4. Install Composer
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

### 5. Install Node.js & NPM
```bash
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install nodejs -y
node --version
npm --version
```

### 6. Clone Project
```bash
cd /var/www/html
sudo git clone https://github.com/raulweya994-byte/DISPERINDAGKOP_Tolikara.git
cd DISPERINDAGKOP_Tolikara
sudo chown -R $USER:$USER .
```

### 7. Install Dependencies
```bash
composer install
npm install
```

### 8. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 9. Konfigurasi Database
```bash
# Login ke MySQL
sudo mysql -u root -p

# Buat database dan user
CREATE DATABASE disperindagkop_tolikara;
CREATE USER 'disperindagkop'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON disperindagkop_tolikara.* TO 'disperindagkop'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=disperindagkop_tolikara
DB_USERNAME=disperindagkop
DB_PASSWORD=password123
```

### 10. Migrasi Database
```bash
php artisan migrate
php artisan db:seed
```

### 11. Set Permissions
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### 12. Storage Link
```bash
php artisan storage:link
```

### 13. Build Assets
```bash
npm run build
```

### 14. Jalankan Server
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

---

## Instalasi di macOS

### 1. Install Homebrew
```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

### 2. Install PHP
```bash
brew install php@8.2
brew link php@8.2
php --version
```

### 3. Install MySQL
```bash
brew install mysql
brew services start mysql
mysql_secure_installation
```

### 4. Install Composer
```bash
brew install composer
composer --version
```

### 5. Install Node.js
```bash
brew install node
node --version
npm --version
```

### 6. Clone & Setup Project
```bash
cd ~/Sites
git clone https://github.com/raulweya994-byte/DISPERINDAGKOP_Tolikara.git
cd DISPERINDAGKOP_Tolikara
composer install
npm install
cp .env.example .env
php artisan key:generate
```

### 7. Setup Database
```bash
mysql -u root -p
CREATE DATABASE disperindagkop_tolikara;
EXIT;
```

Edit `.env` sesuai konfigurasi database Anda.

### 8. Migrasi & Seed
```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
npm run build
```

### 9. Jalankan Server
```bash
php artisan serve
```

---

## Konfigurasi Database

### MySQL Configuration
Edit file `my.cnf` atau `my.ini`:
```ini
[mysqld]
max_allowed_packet=64M
innodb_buffer_pool_size=256M
```

### Import Database (Jika Ada Backup)
```bash
mysql -u username -p database_name < backup.sql
```

### Export Database
```bash
mysqldump -u username -p database_name > backup.sql
```

---

## Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
php artisan clear-compiled
php artisan cache:clear
```

### Error: "Permission denied"
```bash
# Linux/macOS
sudo chown -R $USER:$USER storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Windows (Run as Administrator)
icacls storage /grant Users:F /t
icacls bootstrap\cache /grant Users:F /t
```

### Error: "SQLSTATE[HY000] [2002] Connection refused"
- Pastikan MySQL service berjalan
- Cek konfigurasi `.env`
- Cek firewall settings

### Error: "npm ERR! code ELIFECYCLE"
```bash
rm -rf node_modules package-lock.json
npm cache clean --force
npm install
```

### Error: "Vite manifest not found"
```bash
npm run build
```

### Error: "The stream or file could not be opened"
```bash
# Linux/macOS
sudo chmod -R 775 storage
sudo chown -R www-data:www-data storage

# Windows
icacls storage /grant Users:F /t
```

### Clear All Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
composer dump-autoload
```

---

## Optimasi Production

### 1. Cache Configuration
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Optimize Autoloader
```bash
composer install --optimize-autoloader --no-dev
```

### 3. Build Production Assets
```bash
npm run build
```

### 4. Set Environment
Edit `.env`:
```env
APP_ENV=production
APP_DEBUG=false
```

---

## Update Aplikasi

### Pull Latest Changes
```bash
git pull origin main
composer install
npm install
php artisan migrate
npm run build
php artisan cache:clear
```

---

## Backup & Restore

### Backup Database
```bash
php artisan backup:run
```

### Backup Files
```bash
tar -czf backup-$(date +%Y%m%d).tar.gz storage/ .env
```

### Restore
```bash
tar -xzf backup-20260410.tar.gz
mysql -u username -p database_name < backup.sql
```

---

## Support

Jika mengalami masalah, silakan:
1. Cek [dokumentasi Laravel](https://laravel.com/docs)
2. Buat issue di [GitHub](https://github.com/raulweya994-byte/DISPERINDAGKOP_Tolikara/issues)
3. Hubungi developer: raulweya994@gmail.com
