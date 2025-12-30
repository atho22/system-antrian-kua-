# Sistem Antrian KUA

Aplikasi sistem antrian untuk Kantor Urusan Agama (KUA) yang dibangun dengan Laravel 12.

## Fitur

- ✅ Manajemen Antrian
- ✅ Registrasi Tamu
- ✅ Layanan Multi-Service
- ✅ Export Data ke Excel
- ✅ Activity Logs
- ✅ Dashboard Admin
- ✅ Sistem Queue untuk Background Jobs

## Teknologi

- **Framework**: Laravel 12
- **Frontend**: Vite + TailwindCSS 4
- **Database**: SQLite (default) / MySQL / PostgreSQL
- **PHP**: ^8.2

## 🚀 Deploy ke Railway

Aplikasi ini sudah dikonfigurasi untuk deployment ke Railway. 

**Quick Deploy:**

[![Deploy on Railway](https://railway.app/button.svg)](https://railway.app/new/template?template=https://github.com/atho22/system-antrian-kua-)

Atau ikuti panduan lengkap di [RAILWAY_DEPLOY.md](RAILWAY_DEPLOY.md)

### Environment Variables

Lihat [RAILWAY_ENV_VARS.md](RAILWAY_ENV_VARS.md) untuk daftar lengkap environment variables yang diperlukan.

## Instalasi Lokal

1. Clone repository
```bash
git clone https://github.com/atho22/system-antrian-kua-.git
cd system-antrian-kua-
```

2. Install dependencies
```bash
composer install
npm install
```

3. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

4. Setup database
```bash
touch database/database.sqlite
php artisan migrate
```

5. Build assets
```bash
npm run build
```

6. Run development server
```bash
php artisan serve
```

## Development

Run dengan hot-reload:
```bash
composer dev
```

Ini akan menjalankan:
- PHP development server
- Queue worker
- Laravel Pail (log viewer)
- Vite dev server

## Testing

```bash
composer test
```

## Linting

```bash
./vendor/bin/pint
```

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
