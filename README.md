# Link Canva — Temu Ramah Himate

Halaman kumpulan link berbasis PHP sederhana dengan autentikasi login. Tidak memerlukan database.

## Fitur

- Halaman login dengan validasi
- Dashboard daftar link yang bisa diklik
- Data link & konfigurasi disimpan di file JSON

## Struktur

```
link-canva/
├── login.php               # Halaman login
├── dashboard.php           # Daftar link (butuh login)
├── logout.php              # Proses logout
├── .htaccess               # Keamanan akses direktori
├── includes/
│   └── functions.php       # Helper functions
└── data/
    ├── links.json          # Data link
    ├── config.json         # Konfigurasi & kredensial (tidak di-commit)
    └── config.example.json # Contoh config
```

## Setup

1. Clone repo ini
2. Salin file konfigurasi:
   ```bash
   cp data/config.example.json data/config.json
   ```
3. Edit `data/config.json` — isi `username` dan `password` sesuai kebutuhan
4. Jalankan dengan PHP built-in server:
   ```bash
   php -S localhost:8000
   ```
5. Buka `http://localhost:8000`

## Persyaratan

- PHP 8.0 atau lebih baru
- Web server dengan dukungan `.htaccess` (Apache) untuk production

## Keamanan

- File `data/config.json` sudah di-exclude dari git via `.gitignore`
- Akses langsung ke folder `data/` dan `includes/` diblokir via `.htaccess`
