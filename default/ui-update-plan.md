# Plan: Update UI to Modern Soft Minimalist

## Objective
Memperbarui seluruh antarmuka pengguna (UI) dari Sistem Pengaduan SMK Palapa agar tampil lebih "proper dan minimalis" menggunakan gaya **Modern Soft Minimalist**. Tampilan baru akan mengedepankan latar belakang yang lebih lembut, elemen membulat (rounded-xl/2xl), jarak (white space) yang lebih lega, serta penggunaan badge modern untuk penanda status dan kategori.

## Scope & Impact
Pembaruan ini akan difokuskan pada tiga area utama sesuai pilihan Anda:
1. **Layout & Landing Page**: Peningkatan Header, Footer, dan halaman utama.
2. **Form & Interaksi**: Pembaruan desain input, tombol, dan card form pada halaman Login dan Pengaduan.
3. **Tabel & Data View**: Modernisasi tampilan tabel pada halaman Status Siswa dan Dashboard Admin dengan penggunaan komponen badge.

## Key Files & Context
- `resources/views/layouts/app.blade.php`: Layout utama aplikasi.
- `resources/views/landing.blade.php`: Halaman depan / Landing page.
- `resources/views/repschool/login.blade.php`: Form login.
- `resources/views/repschool/index.blade.php`: Form input pengaduan/aspirasi.
- `resources/views/repschool/status.blade.php` & `_status_table.blade.php`: Halaman status laporan.
- `resources/views/repschool/admin.blade.php` & `_admin_table.blade.php`: Halaman dashboard admin.

## Implementation Steps

### Tahap 1: Layout Utama & Landing Page
- **Layout (`app.blade.php`)**:
  - Mengubah warna dasar menjadi `bg-slate-50` untuk kesan yang lebih modern.
  - Memperbarui header dengan latar transparan/putih dan shadow sangat halus (`shadow-sm` atau efek blur ringan).
  - Merapikan desain navigasi dan tombol interaktif pada navbar.
- **Landing Page (`landing.blade.php`)**:
  - Mendesain ulang area "Hero" menjadi lebih lega dan menonjolkan tipografi besar namun lembut (`text-slate-900` dengan font bold).
  - Menambahkan pill/badge kecil di atas judul (misal: "Sistem Pengaduan v2").
  - Memperhalus desain tombol panggil aksi (Call to Action) dengan sudut lebih membulat (rounded-full/2xl) dan interaksi hover yang mulus.

### Tahap 2: Form & Interaksi
- **Login (`login.blade.php`) & Form Pengaduan (`index.blade.php`)**:
  - Membungkus form dalam Card putih dengan sudut `rounded-2xl` atau `rounded-3xl` dan border super tipis (`border-slate-100`).
  - Mengubah desain input (teks, select, file) dengan border halus dan *focus ring* berwarna aksen (misal: `focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500`).
  - Memberi jarak yang lebih lapang antar elemen input untuk meminimalkan kesan padat.
  - Mempercantik tombol submit dengan desain solid dan efek hover transisi warna.

### Tahap 3: Tabel & Data View
- **Halaman Status (`status.blade.php` & `_status_table.blade.php`)**:
  - Mengubah tampilan tabel standar menjadi lebih clean, mungkin mirip list card atau mempertahankan format tabel dengan padding (px/py) yang jauh lebih lega.
  - Mengganti teks pewarna (misal `text-green-600`) menjadi komponen badge dengan latar belakang lembut (misal `bg-emerald-50 text-emerald-700` untuk "Selesai", `bg-amber-50 text-amber-700` untuk "Proses").
  - Memperbaiki representasi gambar (foto bukti) agar lebih terintegrasi dengan gaya UI yang baru.
- **Dashboard Admin (`admin.blade.php` & `_admin_table.blade.php`)**:
  - Memperbarui komponen filter pencarian agar selaras dengan desain form yang baru (menggunakan desain input yang konsisten).
  - Merapikan tabel admin dengan heading yang jelas (`uppercase`, `text-xs`, `tracking-wider`), padding luas, dan badge status serta tombol "Update" yang lebih elegan.

## Verification & Testing
- Mengakses setiap halaman (Landing, Login, Input Pengaduan, Status Laporan, Dashboard Admin) untuk memastikan layout tidak rusak.
- Mensimulasikan kondisi *responsive* pada layar ponsel / mobile untuk memastikan tabel tidak terpotong dan form tetap mudah digunakan.
- Menguji fungsi modal gambar, filter pencarian, dan pembaruan status oleh Admin agar transisi UI tidak mengganggu fungsionalitas utama.
