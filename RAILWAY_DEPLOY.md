# Deployment Guide untuk Railway

## Cara Deploy ke Railway

### 1. Persiapan

Pastikan Anda memiliki akun Railway di [railway.app](https://railway.app)

**Persyaratan:**
- PHP 8.3 (otomatis dikonfigurasi oleh Railway)
- Composer
- Node.js & NPM

### 2. Deploy dari GitHub

1. Login ke Railway Dashboard
2. Klik "New Project"
3. Pilih "Deploy from GitHub repo"
4. Pilih repository `system-antrian-kua-`
5. Railway akan otomatis mendeteksi `Dockerfile` dan menggunakan Docker untuk build

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

- `Dockerfile`: Docker configuration untuk build dengan PHP 8.3
- `railway.json`: Konfigurasi spesifik Railway
- `deploy.sh`: Script deployment untuk setup awal
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

## Fitur yang Didukung

✅ SQLite Database (default)
✅ File-based Sessions
✅ Queue System (database driver)
✅ Excel Export/Import (maatwebsite/excel)
✅ Vite untuk Asset Pipeline
✅ Auto-migrations pada deployment
✅ Laravel Cache dan Route Optimization

## Tips Optimasi

1. **Storage**: Railway menyediakan persistent storage. Data SQLite akan tersimpan antar deployment.
2. **Logs**: Gunakan `php artisan pail` atau Railway logs untuk monitoring.
3. **Queue Workers**: Untuk production, pertimbangkan menambahkan worker process terpisah di Railway.
4. **Cache**: Aplikasi sudah dikonfigurasi untuk caching database untuk performa optimal.

## Langkah Selanjutnya

Setelah deployment berhasil:

1. ✅ Akses aplikasi melalui URL Railway
2. ✅ Test fitur login/register
3. ✅ Test sistem antrian
4. ✅ Test export Excel
5. ✅ Setup custom domain (opsional)
6. ✅ Setup monitoring dan alerts di Railway

## Support

Untuk pertanyaan atau masalah, buat issue di repository GitHub.
