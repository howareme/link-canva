# Link Canva — Temu Ramah Himate

Situs statis HTML untuk menampilkan kumpulan link Canva. Seluruh tampilan, konfigurasi, dan data link berada di `index.html`, sehingga situs dapat dipublikasikan melalui GitHub Pages tanpa PHP atau database.

## Fitur

- Halaman masuk dan dashboard daftar link
- Link aktif dibuka di tab baru
- Tombol keluar mengakhiri sesi browser saat ini
- Judul, subtitle, kredensial, dan daftar link diatur langsung dalam `index.html`

## Mengubah konfigurasi dan link

Buka `index.html`, lalu ubah objek `CONFIG` dan array `LINKS` di bagian akhir file. Setiap link memiliki `title`, `url`, `icon`, dan `active`. Ubah `active` menjadi `false` untuk menyembunyikan link dari dashboard.

## Deploy ke GitHub Pages

1. Unggah file `index.html` ke repository GitHub.
2. Buka **Settings → Pages**.
3. Pilih branch dan folder yang berisi `index.html`, lalu simpan.
4. Buka URL GitHub Pages yang diberikan.

## Catatan penting tentang login

GitHub Pages hanya menyajikan file statis. Login di halaman ini hanya untuk alur tampilan: username dan password tersimpan di dalam HTML/JavaScript yang dapat dilihat pengunjung, dan daftar link juga dapat diakses dari source. Jangan gunakan ini untuk melindungi data rahasia. Untuk autentikasi dan konten privat yang benar-benar aman, gunakan hosting yang menjalankan backend seperti PHP.
