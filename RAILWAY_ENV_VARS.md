# Railway Environment Variables Setup

Copy and paste these environment variables in your Railway project settings.

## Required Variables

```bash
APP_NAME="Sistem Antrian KUA"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE
APP_URL=https://your-app-name.railway.app
```

## Database Configuration (SQLite - Default)

```bash
DB_CONNECTION=sqlite
```

## Session & Cache Configuration

```bash
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database
QUEUE_CONNECTION=database
```

## Logging

```bash
LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=error
```

## Additional Settings

```bash
BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
```

---

## How to Generate APP_KEY

If you need to generate an APP_KEY manually:

1. Run locally: `php artisan key:generate --show`
2. Copy the output (format: `base64:...`)
3. Add it to Railway environment variables

Or Railway will auto-generate it on first deployment via `deploy.sh` script.

---

## Optional: PostgreSQL Configuration

If you want to use PostgreSQL instead of SQLite:

1. Add PostgreSQL service in Railway
2. Railway will auto-provide these variables:
   - `DATABASE_URL`
   - `PGHOST`
   - `PGPORT`
   - `PGUSER`
   - `PGPASSWORD`
   - `PGDATABASE`

3. Then add these to your environment:

```bash
DB_CONNECTION=pgsql
DB_HOST=${PGHOST}
DB_PORT=${PGPORT}
DB_DATABASE=${PGDATABASE}
DB_USERNAME=${PGUSER}
DB_PASSWORD=${PGPASSWORD}
```

---

## Optional: MySQL Configuration

If you want to use MySQL:

```bash
DB_CONNECTION=mysql
DB_HOST=your-mysql-host
DB_PORT=3306
DB_DATABASE=your-database-name
DB_USERNAME=your-username
DB_PASSWORD=your-password
```

---

## Verification Steps

After setting environment variables:

1. ✅ Redeploy your application in Railway
2. ✅ Check deployment logs for any errors
3. ✅ Verify APP_KEY is set (check logs for "key:generate" output)
4. ✅ Verify migrations ran successfully
5. ✅ Access your application URL
6. ✅ Test basic functionality

---

## Common Issues

### Issue: "No application encryption key has been specified"
**Solution**: Set APP_KEY environment variable or wait for deploy.sh to generate it

### Issue: "Database file not found"
**Solution**: The deploy.sh script creates it automatically. Check deployment logs.

### Issue: "Permission denied on storage"
**Solution**: Railway handles this automatically. If persists, check logs.

### Issue: "Assets not found"
**Solution**: Ensure `npm run build` completed successfully in build logs
