# BookNest - Digital Library System

Platform e-library modern berbasis Laravel 11 dengan fitur lengkap untuk mengelola perpustakaan digital.

## Fitur Utama

### User Features
- Authentication (Login & Register)
- Browse katalog buku dengan pagination
- Search & filter buku (by nama & kategori)
- Detail buku lengkap
- Baca buku full text
- Tambah/hapus buku favorit
- Dashboard user dengan list favorit
- Trending books berdasarkan views
- Profile management
- Download PDF (jika tersedia)

### Admin Features
- Admin dashboard dengan statistik
- CRUD buku lengkap
- Upload cover & PDF file
- CRUD kategori
- Manage isi buku (full text)

### Design & UI
- Modern responsive design (mobile & desktop)
- Font: Inter
- Color theme: Black, Gold, White, Grey
- Smooth animations & transitions

## Tech Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript (Vanilla)
- **Server**: Laragon (Windows)

## Struktur Database

### Tabel users
| Field | Type | Description |
|-------|------|-------------|
| id_user | BIGINT | Primary Key |
| nama | VARCHAR(255) | Nama lengkap |
| email | VARCHAR(255) | Email (unique) |
| password | VARCHAR(255) | Password (hashed) |
| role | ENUM | admin/user |

### Tabel categories
| Field | Type | Description |
|-------|------|-------------|
| id_kategori | BIGINT | Primary Key |
| nama_kategori | VARCHAR(255) | Nama kategori |

### Tabel books
| Field | Type | Description |
|-------|------|-------------|
| id_buku | BIGINT | Primary Key |
| judul | VARCHAR(255) | Judul buku |
| penulis | VARCHAR(255) | Nama penulis |
| tahun | YEAR | Tahun terbit |
| kategori | BIGINT | Foreign Key ke categories |
| file_pdf | VARCHAR(255) | Path file PDF |
| cover | VARCHAR(255) | Path cover image |
| deskripsi | TEXT | Deskripsi buku |
| isi_buku | TEXT | Isi lengkap buku |
| views | INT | Jumlah views |

### Tabel favorites
| Field | Type | Description |
|-------|------|-------------|
| id | BIGINT | Primary Key |
| id_user | BIGINT | Foreign Key ke users |
| id_buku | BIGINT | Foreign Key ke books |

## Instalasi

### Persyaratan
- Laragon (dengan PHP 8.2+, MySQL, Composer)
- Web Browser Modern

### Langkah Instalasi

1. **Clone/Download Project**
   \`\`\`bash
   # Letakkan folder booknest di:
   C:\laragon\www\booknest
   \`\`\`

2. **Buka Terminal Laragon**
   - Klik kanan icon Laragon di system tray
   - Pilih "Terminal"

3. **Install Dependencies**
   \`\`\`bash
   cd C:\laragon\www\booknest
   composer install
   \`\`\`

4. **Setup Environment**
   \`\`\`bash
   # Copy file environment
   copy .env.example .env
   
   # Generate app key
   php artisan key:generate
   \`\`\`

5. **Konfigurasi Database**
   - Buka Laragon Database (HeidiSQL atau MySQL)
   - Buat database baru dengan nama: `booknest`
   
   Atau via terminal:
   \`\`\`bash
   mysql -u root -e "CREATE DATABASE booknest"
   \`\`\`

6. **Edit File .env**
   \`\`\`
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=booknest
   DB_USERNAME=root
   DB_PASSWORD=
   \`\`\`

7. **Jalankan Migration & Seeder**
   \`\`\`bash
   php artisan migrate
   php artisan db:seed
   \`\`\`

8. **Setup Storage Link**
   \`\`\`bash
   php artisan storage:link
   \`\`\`

9. **Buat Folder Upload**
   \`\`\`bash
   mkdir public\uploads
   mkdir public\uploads\covers
   mkdir public\uploads\pdfs
   \`\`\`

10. **Jalankan Server**
    \`\`\`bash
    php artisan serve
    \`\`\`
    
    Atau gunakan Laragon:
    - Start All di Laragon
    - Akses: http://booknest.test

## Default Login

### Admin
- Email: `admin@booknest.com`
- Password: `admin123`

### User
- Email: `user@booknest.com`
- Password: `user123`

## Struktur Folder

\`\`\`
booknest/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── BookController.php
│   │   │   ├── AdminController.php
│   │   │   ├── DashboardController.php
│   │   │   └── FavoriteController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       └── UserMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Book.php
│       ├── Category.php
│       └── Favorite.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── app.js
│   └── uploads/
│       ├── covers/
│       └── pdfs/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── user/
│       │   ├── home.blade.php
│       │   ├── books.blade.php
│       │   ├── detail.blade.php
│       │   ├── read.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── about.blade.php
│       │   └── profile.blade.php
│       └── admin/
│           ├── dashboard.blade.php
│           └── books/
│               ├── index.blade.php
│               ├── create.blade.php
│               └── edit.blade.php
└── routes/
    └── web.php
\`\`\`

## Halaman & Fitur

### Public Pages
- **/** - Home page dengan hero, search bar, latest & trending books
- **/books** - Katalog semua buku dengan search & filter
- **/books/trending** - Buku trending berdasarkan views
- **/books/{id}** - Detail buku
- **/about** - Tentang BookNest
- **/login** - Login page
- **/register** - Register page

### User Pages (Authenticated)
- **/dashboard** - Dashboard user dengan list favorit
- **/books/{id}/read** - Baca buku full text
- **/profile** - Edit profil & ganti password

### Admin Pages (Admin Only)
- **/admin/dashboard** - Dashboard admin dengan statistik
- **/admin/books** - Kelola buku (CRUD)
- **/admin/books/create** - Tambah buku baru
- **/admin/books/{id}/edit** - Edit buku
- **/admin/categories** - Kelola kategori

## API Endpoints

### Favorites (AJAX)
\`\`\`javascript
POST /favorites/toggle
Body: { book_id: integer }
Response: { status: 'added'|'removed', message: string }
\`\`\`

## Troubleshooting

### Error: Class not found
\`\`\`bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
\`\`\`

### Error: Storage link
\`\`\`bash
php artisan storage:link
\`\`\`

### Error: Permission denied (Linux/Mac)
\`\`\`bash
chmod -R 775 storage bootstrap/cache
\`\`\`

### Database connection error
- Pastikan MySQL di Laragon sudah running
- Cek konfigurasi .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

### Gambar tidak muncul
- Jalankan: `php artisan storage:link`
- Pastikan folder storage/app/public ada
- Cek permission folder

## Development Notes

### Menambah Sample Data
\`\`\`bash
php artisan db:seed
\`\`\`

### Reset Database
\`\`\`bash
php artisan migrate:fresh --seed
\`\`\`

### Clear Cache
\`\`\`bash
php artisan optimize:clear
\`\`\`

## Fitur Mendatang (Roadmap)

- [ ] Review & rating buku
- [ ] Reading history tracking
- [ ] Social sharing
- [ ] Reading progress tracker
- [ ] Multiple format support (EPUB, MOBI)
- [ ] Advanced search filters
- [ ] User comments & discussions
- [ ] Recommendation system

## Credits

Developed with Laravel 11, designed with modern UI/UX principles.

## License

This project is open-sourced for educational purposes.

---

**BookNest** - Jelajahi Dunia Literasi Digital 📚✨
\`\`\`

```text file="CARA_INSTALL.txt"
========================================
BOOKNEST - PANDUAN INSTALASI LENGKAP
========================================

PERSYARATAN:
- Laragon (sudah terinstall)
- PHP 8.2 atau lebih tinggi
- MySQL
- Composer

========================================
LANGKAH-LANGKAH INSTALASI:
========================================

1. EKSTRAK PROJECT
   - Ekstrak folder "booknest" ke: C:\laragon\www\
   - Hasil: C:\laragon\www\booknest

2. BUKA LARAGON
   - Jalankan Laragon
   - Klik "Start All"

3. BUKA TERMINAL LARAGON
   - Klik kanan icon Laragon di system tray
   - Pilih "Terminal"

4. MASUK KE FOLDER PROJECT
   cd C:\laragon\www\booknest

5. INSTALL DEPENDENCIES
   composer install
   
   (Tunggu sampai selesai, bisa 2-5 menit)

6. SETUP ENVIRONMENT
   copy .env.example .env
   php artisan key:generate

7. BUAT DATABASE
   - Buka HeidiSQL dari Laragon (icon Database)
   - Klik kanan di sidebar kiri
   - Pilih "Create new" > "Database"
   - Nama database: booknest
   - Klik OK

   ATAU via terminal:
   mysql -u root -e "CREATE DATABASE booknest"

8. EDIT FILE .env
   - Buka file .env dengan notepad
   - Pastikan konfigurasi database seperti ini:
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=booknest
   DB_USERNAME=root
   DB_PASSWORD=
   
   - Save file

9. JALANKAN MIGRATION & SEEDER
   php artisan migrate
   
   (Ketik: yes jika ada konfirmasi)
   
   php artisan db:seed
   
   (Tunggu sampai selesai, akan membuat data contoh)

10. SETUP STORAGE
    php artisan storage:link

11. BUAT FOLDER UPLOAD
    mkdir public\uploads
    mkdir public\uploads\covers
    mkdir public\uploads\pdfs

12. JALANKAN SERVER
    php artisan serve
    
    ATAU langsung akses:
    http://booknest.test
    
    (Jika pakai Laragon, otomatis bisa diakses)

========================================
SELESAI! BUKA BROWSER:
========================================

URL: http://localhost:8000
ATAU: http://booknest.test

LOGIN ADMIN:
Email: admin@booknest.com
Password: admin123

LOGIN USER:
Email: user@booknest.com
Password: user123

========================================
TROUBLESHOOTING:
========================================

Error "Class not found":
- composer dump-autoload
- php artisan config:clear

Error "No application encryption key":
- php artisan key:generate

Database tidak terkoneksi:
- Pastikan MySQL di Laragon sudah running
- Cek file .env, pastikan DB_DATABASE=booknest

Gambar tidak muncul:
- php artisan storage:link
- Pastikan folder storage/app/public ada

Port 8000 sudah dipakai:
- php artisan serve --port=8080
- Akses: http://localhost:8080

========================================
FITUR APLIKASI:
========================================

USER:
✓ Browse katalog buku
✓ Search & filter buku
✓ Baca buku online
✓ Tambah favorit
✓ Dashboard favorit
✓ Download PDF
✓ Profile management

ADMIN:
✓ Tambah/edit/hapus buku
✓ Upload cover & PDF
✓ Kelola kategori
✓ Dashboard statistik
✓ Manage isi buku lengkap

========================================
KONTAK & SUPPORT:
========================================

Jika ada masalah atau error:
1. Cek file README.md untuk panduan lengkap
2. Pastikan semua langkah sudah diikuti
3. Cek error di terminal untuk detail masalah

Happy Coding! 🚀📚
