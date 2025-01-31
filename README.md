# Fullstack Application: Laravel Backend + VueJS Inertia Frontend

## Prasyarat

-   PHP 8.1+
-   Composer
-   Node.js 18+
-   npm atau yarn
-   MySQL/PostgreSQL

## Arsitektur Teknologi

-   **Backend**: Laravel 11
-   **Frontend**: Vue.js 3 Inertia
-   **Authentikasi**: Laravel Sanctum
-   **Styling**: Tailwind CSS

## Instalasi Proyek

### Kloning Repositori

```bash
git clone https://https://github.com/muhfurqans35/test-1.git
cd nama-proyek
```

### Setup Backend (Laravel)

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
```

### Konfigurasi Environment Backend

Edit file `.env` dengan detail koneksi database Anda:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
```

### Setup Frontend (Vue.js)

```bash
npm install
```

## Menjalankan Aplikasi

### Jalankan Backend (Laravel)

```bash
php artisan serve
# Berjalan di http://localhost:8000
```

### Jalankan Frontend (Vue.js)

```bash
npm run dev
# Berjalan di http://localhost
```

## Struktur Proyek

```
nama-proyek/
│
├── backend/                # Direktori Laravel
    ├── app/
    ├── config/
    ├── database/
    └── routes/
    └── resources/      *Frontend VueJS+Inertia
        └── css/
        └── js/
            └── Components/
            └── Layouts/
            └── Pages/
        └── views/
```

## Kontak

-   Muhammad Furqan
-   Email: muhfurqans35@gmail.com
-   Tautan Proyek: [[URL Repositori](https://github.com/muhfurqans35/test-1)]
