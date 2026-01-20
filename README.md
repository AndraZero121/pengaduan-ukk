# Pengaduan UKK (Repschool Aspirasi)

Aplikasi aspirasi/pengaduan sarana sekolah berbasis Laravel. Siswa dapat mengirim laporan kondisi fasilitas, melihat status tindak lanjut, dan admin dapat memproses serta memberi feedback.

## Fitur Utama
- Form aspirasi siswa (NIS, kelas, kategori, lokasi, keterangan)
- Cek status aspirasi berdasarkan NIS
- Dashboard admin untuk filter dan update status + feedback
- Seed data kategori dan akun admin default

## Teknologi
- Laravel 12
- PHP 8.2+
- Tailwind CSS 4 + Vite

## Prasyarat
- PHP 8.2+
- Composer
- Node.js + npm
- Database (MySQL/PostgreSQL/SQLite)

## Instalasi
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
```

Jalankan aplikasi:
```bash
php artisan serve
```

## Akun Admin Default
- Username: `admin`
- Password: `admin123`

## Rute Utama
- `GET /` - Form aspirasi siswa
- `GET /status` - Cek status aspirasi
- `GET /admin/login` - Login admin
- `GET /admin/aspirasi` - Dashboard admin

## Catatan
- Pastikan konfigurasi database di `.env` sudah benar sebelum `migrate --seed`.
- Untuk build produksi frontend: `npm run build`.
