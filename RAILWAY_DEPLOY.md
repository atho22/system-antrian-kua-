# Deployment Guide untuk Railway

## Cara Deploy ke Railway

### 1. Persiapan

Pastikan Anda memiliki akun Railway di [railway.app](https://railway.app)

### 2. Deploy dari GitHub

1. Login ke Railway Dashboard
2. Klik "New Project"
3. Pilih "Deploy from GitHub repo"
4. Pilih repository `system-antrian-kua-`
5. Railway akan otomatis mendeteksi konfigurasi dari file `nixpacks.toml` dan `railway.json`

### 3. Set Environment Variables

Di Railway Dashboard, buka tab "Variables" dan tambahkan:

```
APP_NAME="Sistem Antrian KUA"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:XXXXX (akan di-generate otomatis atau manual dengan: php artisan key:generate --show)
APP_URL=https://your-app-name.railway.app

DB_CONNECTION=sqlite
SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

### 4. Deploy

Railway akan otomatis build dan deploy aplikasi Anda. Proses ini meliputi:

- Install dependencies PHP (composer)
- Install dependencies Node.js (npm)
- Build assets dengan Vite
- Run migrations
- Cache konfigurasi Laravel
- Start aplikasi

### 5. Custom Domain (Opsional)

1. Buka tab "Settings" di Railway
2. Scroll ke "Domains"
3. Tambahkan custom domain atau gunakan domain Railway yang disediakan

## File Konfigurasi

- `Procfile`: Mendefinisikan command untuk menjalankan web server
- `nixpacks.toml`: Konfigurasi build untuk Nixpacks
- `railway.json`: Konfigurasi spesifik Railway
- `deploy.sh`: Script deployment untuk setup awal
- `.env.example`: Template environment variables

## Database

Aplikasi ini menggunakan SQLite secara default, yang cocok untuk Railway karena:
- Tidak perlu setup database terpisah
- File-based, data tersimpan di volume Railway
- Cukup untuk aplikasi skala kecil hingga menengah

Jika Anda ingin menggunakan PostgreSQL atau MySQL, Anda bisa:
1. Tambahkan service database di Railway
2. Update environment variables (DB_CONNECTION, DB_HOST, DB_PORT, dll)

## Troubleshooting

### App Key Error
Jika muncul error "No application encryption key has been specified":
- Tambahkan variable `APP_KEY` di Railway
- Generate key dengan: `php artisan key:generate --show`

### Permission Error
Jika ada error permission di folder storage:
- Railway sudah menghandle permission secara otomatis
- Pastikan folder `storage` dan `bootstrap/cache` ada di repository

### Migration Error
Jika migration gagal:
- Cek logs di Railway Dashboard
- Pastikan database file bisa dibuat dan diakses
- Script `deploy.sh` akan otomatis membuat database.sqlite jika belum ada

## Support

Untuk pertanyaan atau masalah, buat issue di repository GitHub.
