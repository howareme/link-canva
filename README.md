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
├── dashboard.php           # Daftar link
├── logout.php              # Proses logout
├── includes/
│   └── functions.php       # Helper functions
└── data/
    ├── links.json          # Data link
    └── config.json         # Konfigurasi & kredensial
```

