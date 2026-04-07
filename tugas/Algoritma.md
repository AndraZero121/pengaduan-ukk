# Algoritma Sistem Pelaporan Sekolah (Repschool Palapa)

## 1. Algoritma Akses dan Autentikasi (Siswa & Admin)

1. Mulai
2. Pengguna mengakses "Landing Page" sebagai pintu masuk utama.
3. Pengguna memilih menu "Login" dan diarahkan ke halaman Login.
4. Pengguna memasukkan "Email" dan "Password".
5. Sistem memvalidasi kredensial pada tabel "users".
    - Jika data tidak ditemukan atau password salah, sistem menampilkan pesan error dan tetap di halaman Login.
    - Jika data cocok, sistem membuat sesi (session) autentikasi.
6. Sistem memeriksa "Role" pengguna:
    - Jika "role = admin", sistem melakukan redirect ke "Dashboard Admin".
    - Jika "role = siswa", sistem melakukan redirect ke "Buat Laporan".
7. Selesai

## 2. Algoritma Penginputan Laporan (Siswa)

1. Mulai
2. Siswa yang sudah login mengakses halaman "Buat Laporan".
3. Sistem secara otomatis mendeteksi identitas siswa (Nama dan NIS) dari sesi login aktif.
4. Siswa memilih "Jenis Laporan": "Pengaduan" (Masalah/Kerusakan) atau "Aspirasi" (Saran/Ide).
5. Siswa mengisi data laporan: "Kategori", "Lokasi" (hanya untuk Pengaduan), dan "Deskripsi Laporan".
6. Siswa menekan tombol "Kirim Laporan".
7. Sistem menjalankan validasi input:
    - Mengecek kekosongan dan panjang karakter.
    - "Cek Duplikasi": Sistem mengecek apakah sudah ada laporan serupa yang masih berstatus "Menunggu" atau "Proses":
        - Untuk "Pengaduan": Mengecek apakah sudah ada laporan dengan "Tipe", "Kategori", "Lokasi", dan "Deskripsi" yang serupa.
        - Untuk "Aspirasi": Mengecek apakah sudah ada laporan dengan "Tipe", "Kategori", dan "Deskripsi" yang serupa.
    - Jika duplikasi ditemukan, sistem menghentikan proses dan menampilkan pesan peringatan "Laporan serupa sedang ditangani".
8. Jika valid dan bukan duplikat, sistem menjalankan "Database Transaction":
    - Menyimpan data pelaporan ke tabel "input_aspirasi" dengan kolom "tipe".
    - Membuat data status baru di tabel "aspirasi" dengan status awal "Menunggu".
9. Sistem menampilkan notifikasi sukses dan melakukan redirect ke Dashboard.
10. Selesai

## 3. Algoritma Pencarian & Monitoring Laporan Publik (Siswa)

1. Mulai
2. Siswa mengakses menu "Cek Status".
3. Sistem memuat seluruh laporan siswa secara default (Publik) agar siswa bisa memantau perbaikan yang sedang berjalan.
4. Siswa dapat memilih "Filter Tampilan": "Semua Laporan" atau "Laporan Saya".
5. (Fitur Pencarian) Siswa dapat memasukkan kata kunci berupa "Nama Pelapor", "Lokasi", atau "Kategori" pada kolom pencarian.
6. Sistem melakukan filter data berdasarkan kata kunci tersebut menggunakan operator "LIKE".
7. Sistem menampilkan hasil dalam tabel: Tanggal, Pelapor, Tipe, Kategori, Lokasi & Deskripsi, Status, dan Tanggapan Admin.
8. Selesai

## 4. Algoritma Pengelolaan & Tindak Lanjut (Admin)

1. Mulai
2. Admin mengakses "Dashboard Admin".
3. Sistem menampilkan daftar seluruh laporan (Pengaduan & Aspirasi) dari semua siswa.
4. Admin dapat melakukan filter berdasarkan "Tipe" (Pengaduan/Aspirasi), "Status", atau "Kategori".
5. Admin dapat mencari laporan spesifik dengan memasukkan "NIS" atau "Nama Siswa".
6. Admin memilih laporan yang akan ditindaklanjuti.
7. Admin melakukan update:
    - Mengubah "Status" (dari Menunggu menjadi Proses atau Selesai).
    - Menambahkan "Feedback" (tanggapan) tertulis untuk siswa.
8. Sistem memperbarui data pada tabel "aspirasi".
9. Selesai

## 5. Algoritma Logout (Siswa & Admin)

1. Mulai
2. Pengguna menekan tombol "Keluar" (Logout) pada navigasi header.
3. Sistem menerima permintaan logout.
4. Sistem menghapus data sesi (session) yang tersimpan di server.
5. Sistem menghapus token autentikasi pada browser pengguna.
6. Sistem melakukan redirect (pengalihan) pengguna kembali ke "Landing Page" atau halaman "Login".
7. Akses ke halaman Dashboard ditutup kembali hingga pengguna login lagi.
8. Selesai

## 6. Algoritma Pengarsipan Otomatis (Scheduler)

1. Mulai
2. Sistem menjalankan "Task Scheduler" secara berkala.
3. Sistem mencari data pada tabel "aspirasi" dengan kriteria: Status "Selesai" dan waktu update > 30 hari.
4. Jika ditemukan, sistem mengisi kolom "archived_at" dengan waktu saat ini.
5. Selesai
