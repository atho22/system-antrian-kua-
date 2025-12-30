# ✅ Checklist Deploy Railway

Gunakan checklist ini untuk memastikan deployment berhasil.

## Persiapan (Sebelum Deploy)

- [ ] Punya akun Railway ([Daftar di sini](https://railway.app))
- [ ] Repository sudah ter-push ke GitHub
- [ ] Baca dokumentasi [RAILWAY_DEPLOY.md](RAILWAY_DEPLOY.md)
- [ ] Siapkan environment variables (lihat [RAILWAY_ENV_VARS.md](RAILWAY_ENV_VARS.md))

## Step-by-Step Deploy

### 1. Create New Project di Railway

- [ ] Login ke [Railway Dashboard](https://railway.app/dashboard)
- [ ] Klik tombol **"New Project"**
- [ ] Pilih **"Deploy from GitHub repo"**
- [ ] Authorize Railway untuk akses GitHub (jika belum)
- [ ] Pilih repository: `atho22/system-antrian-kua-`
- [ ] Railway akan otomatis mulai build

### 2. Set Environment Variables

- [ ] Buka project di Railway Dashboard
- [ ] Klik tab **"Variables"**
- [ ] Tambahkan variable berikut (minimum):

```
APP_NAME=Sistem Antrian KUA
APP_ENV=production
APP_DEBUG=false
APP_URL=https://[your-app-name].up.railway.app
DB_CONNECTION=sqlite
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

- [ ] Klik **"Deploy"** atau tunggu auto-redeploy

### 3. Monitor Build Process

- [ ] Buka tab **"Deployments"**
- [ ] Klik deployment yang sedang berjalan
- [ ] Monitor logs untuk memastikan:
  - [ ] ✅ Composer install berhasil
  - [ ] ✅ NPM install berhasil
  - [ ] ✅ Vite build berhasil
  - [ ] ✅ Deploy script berhasil (migrations, cache, etc)
  - [ ] ✅ Server start berhasil

### 4. Verifikasi Deployment

- [ ] Tunggu status deployment menjadi **"Success"** (hijau)
- [ ] Copy URL aplikasi dari Railway
- [ ] Buka URL di browser
- [ ] Test fitur dasar:
  - [ ] Homepage load dengan benar
  - [ ] Assets (CSS/JS) load
  - [ ] Login/Register berfungsi (jika ada)
  - [ ] Database berfungsi (cek antrian/tamu)

### 5. Setup Domain (Opsional)

- [ ] Buka tab **"Settings"**
- [ ] Scroll ke section **"Domains"**
- [ ] Klik **"Generate Domain"** untuk Railway domain
- [ ] Atau klik **"Custom Domain"** untuk domain sendiri
- [ ] Update `APP_URL` di environment variables dengan domain baru
- [ ] Redeploy aplikasi

## Troubleshooting

### ❌ Build Failed

**Cek logs untuk error messages:**

- [ ] Composer dependencies error → Periksa `composer.json`
- [ ] NPM install error → Periksa `package.json`
- [ ] PHP extension missing → Sudah ada di `nixpacks.toml`
- [ ] Memory limit → Contact Railway support

### ❌ Deployment Success tapi App Error

**Cek Runtime Logs:**

- [ ] APP_KEY not set → Generate dengan `php artisan key:generate --show`
- [ ] Database error → Cek `deploy.sh` logs, pastikan migrations jalan
- [ ] Permission error → Railway harusnya handle otomatis
- [ ] 500 Error → Set `APP_DEBUG=true` sementara untuk lihat error

### ❌ Assets Tidak Load

- [ ] Cek build logs: `npm run build` harus sukses
- [ ] Periksa `APP_URL` di environment variables
- [ ] Cek folder `public/build` ada setelah build

## Post-Deployment

- [ ] Set `APP_DEBUG=false` untuk production
- [ ] Monitor aplikasi di Railway metrics
- [ ] Setup alerts (opsional)
- [ ] Backup database secara berkala
- [ ] Test semua fitur penting
- [ ] Share URL dengan tim/user

## Maintenance

### Update Code

1. Push code baru ke GitHub
2. Railway akan auto-deploy
3. Monitor deployment logs
4. Test aplikasi setelah deployment

### Database Backup

Railway menyimpan data di persistent volume, tapi disarankan:
- Export database secara berkala
- Gunakan Railway backup feature (jika available)
- Download SQLite file via Railway CLI (opsional)

### Monitoring

- [ ] Setup Sentry atau error tracking (opsional)
- [ ] Monitor Railway metrics
- [ ] Check logs secara berkala
- [ ] Setup uptime monitoring (opsional)

## Need Help?

- 📖 Baca [RAILWAY_DEPLOY.md](RAILWAY_DEPLOY.md) untuk panduan lengkap
- 📋 Lihat [RAILWAY_ENV_VARS.md](RAILWAY_ENV_VARS.md) untuk env vars
- 🆘 Buat issue di GitHub jika ada masalah
- 💬 Contact Railway support untuk masalah platform

---

**Happy Deploying! 🚀**
