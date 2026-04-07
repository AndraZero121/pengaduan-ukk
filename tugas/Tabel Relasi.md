# Tabel Relasi & Kamus Data - Repschool Palapa

## 1. Tabel Relasi (ER Diagram)

```mermaid
erDiagram
    USERS ||--|| SISWA : "user_id"
    USERS ||--|| ADMINS : "user_id"
    SISWA ||--o{ INPUT_ASPIRASI : "nis"
    KATEGORI ||--o{ INPUT_ASPIRASI : "id_kategori"
    INPUT_ASPIRASI ||--|| ASPIRASI : "id_pelaporan = id_aspirasi"
    KATEGORI ||--o{ ASPIRASI : "id_kategori"

    USERS {
        unsigned_bigint id PK
        string name
        string email UK
        enum role "admin, siswa"
        string password
        timestamp created_at
    }

    SISWA {
        string nis PK "10"
        unsigned_bigint user_id FK
        string kelas "10"
        timestamp created_at
    }

    ADMINS {
        unsigned_bigint id PK
        unsigned_bigint user_id FK
        string username "50" UK
        string password
        timestamp created_at
    }

    KATEGORI {
        unsigned_int id_kategori PK
        string ket_kategori "30"
        timestamp created_at
    }

    INPUT_ASPIRASI {
        unsigned_int id_pelaporan PK
        enum tipe "Pengaduan, Aspirasi"
        string nis FK
        unsigned_int id_kategori FK
        string lokasi "50, Nullable"
        string ket "50"
        timestamp created_at
    }

    ASPIRASI {
        unsigned_int id_aspirasi PK, FK
        enum status "Menunggu, Proses, Selesai"
        unsigned_int id_kategori FK
        string feedback "255, Nullable"
        timestamp archived_at "Nullable"
        timestamp updated_at
    }
```

---

## 2. Kamus Data (Data Dictionary)

### A. Tabel: `users`
| Field | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | BigInt (PK) | Auto-increment primary key |
| `name` | String | Nama lengkap pengguna |
| `email` | String (Unique) | Alamat email untuk login |
| `role` | Enum | Hak akses: 'admin' atau 'siswa' |
| `password` | String | Hash password pengguna |
| `created_at` | Timestamp | Waktu pembuatan data |

### B. Tabel: `siswa`
| Field | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `nis` | String 10 (PK) | Nomor Induk Siswa (Primary Key) |
| `user_id` | BigInt (FK) | Relasi ke tabel `users` |
| `kelas` | String 10 | Kelas siswa (Contoh: XII RPL 1) |
| `created_at` | Timestamp | Waktu pembuatan data |

### C. Tabel: `admins`
| Field | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | BigInt (PK) | Primary key admin |
| `user_id` | BigInt (FK) | Relasi ke tabel `users` |
| `username` | String 50 | Nama unik admin |
| `password` | String | Hash password (cadangan/opsional) |
| `created_at` | Timestamp | Waktu pembuatan data |

### D. Tabel: `kategori`
| Field | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id_kategori` | Int (PK) | Primary key kategori |
| `ket_kategori` | String 30 | Nama kategori (Contoh: Sarana, Layanan) |
| `created_at` | Timestamp | Waktu pembuatan data |

### E. Tabel: `input_aspirasi`
| Field | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id_pelaporan` | Int (PK) | Primary key laporan |
| `tipe` | Enum | Jenis laporan: 'Pengaduan' atau 'Aspirasi' |
| `nis` | String 10 (FK) | Relasi ke tabel `siswa` (Pelapor) |
| `id_kategori` | Int (FK) | Relasi ke tabel `kategori` |
| `lokasi` | String 50 | Lokasi kejadian (Nullable untuk Aspirasi) |
| `ket` | String 50 | Deskripsi detail masalah/saran |
| `created_at` | Timestamp | Waktu pengajuan laporan |

### F. Tabel: `aspirasi`
| Field | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id_aspirasi` | Int (PK, FK) | PK dan FK yang merujuk ke `id_pelaporan` |
| `status` | Enum | Status: 'Menunggu', 'Proses', 'Selesai' |
| `id_kategori` | Int (FK) | Relasi ke tabel `kategori` (untuk filter) |
| `feedback` | String 255 | Tanggapan tertulis dari admin |
| `archived_at` | Timestamp | Waktu pengarsipan data (Nullable) |
| `updated_at` | Timestamp | Waktu pembaruan status terakhir |
