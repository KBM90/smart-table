# Hostinger deployment runbook

This runbook applies to the Smart Table SaaS project at `C:\Karim\projects\Saas\smart-table`.

## Deployment position

- Recommended target: Hostinger VPS
- Fallback target: Hostinger shared hosting
- Database: Supabase Postgres via pooler transaction mode on port `6543`
- File storage: Supabase Storage via S3-compatible endpoint
- Browser realtime: disabled for anon clients in production with `SUPABASE_REALTIME_ANON_ENABLED=false`
- Live updates in production: Livewire polling fallback

## Files involved

- Production env template: `C:\Karim\projects\Saas\smart-table\.env.production.example`
- Deploy script: `C:\Karim\projects\Saas\smart-table\deploy.sh`
- RLS SQL: `C:\Karim\projects\Saas\smart-table\database\supabase\rls.sql`
- Smoke checklist: `C:\Karim\projects\Saas\smart-table\docs\SMOKE_CHECKLIST.md`
- Architecture context: `C:\Karim\projects\Saas\smart-table\docs\PLAN.md`

## Supabase one-time setup checklist

1. Create the Supabase project.
2. Copy the project URL, anon key, and service role key.
3. Open Supabase project settings and collect Postgres pooler credentials.
4. Use transaction mode on port `6543` for production.
5. Create the Storage bucket named `product-images` and make it public.
6. In Supabase Storage settings, create S3 credentials and copy:
   - access key
   - secret
   - endpoint
7. Apply `C:\Karim\projects\Saas\smart-table\database\supabase\rls.sql` in the Supabase SQL editor after granting `BYPASSRLS` to the Laravel database user.
8. Verify RLS by attempting a `SELECT` as the anon role and confirming access is denied.

## Environment file

Start from `C:\Karim\projects\Saas\smart-table\.env.production.example`.

Important production values:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://your-domain.tld`
- `DB_CONNECTION=pgsql`
- `DB_PORT=6543`
- `DB_SSLMODE=require`
- `SESSION_DRIVER=database`
- `CACHE_STORE=database`
- `QUEUE_CONNECTION=database`
- `BROADCAST_CONNECTION=null`
- `FILESYSTEM_DISK=public`
- `SUPABASE_REALTIME_ANON_ENABLED=false`
- `TRUSTED_PROXIES=*`

`TRUSTED_PROXIES=*` is supported by the application bootstrap so Hostinger proxy headers are trusted when the env value is set.

## Build and deploy pipeline

Production order:

1. `composer install --no-dev --optimize-autoloader`
2. `npm ci`
3. `npm run build`
4. `php artisan migrate --force`
5. `php artisan storage:link`
6. `php artisan config:cache`
7. `php artisan route:cache`
8. `php artisan view:cache`
9. `php artisan event:cache`

For VPS usage, run `./deploy.sh`.

## Hostinger VPS

### Recommended server shape

- Ubuntu 22.04
- PHP 8.2
- Nginx
- Composer 2
- Node.js 20+
- Supervisor

### PHP extensions

Install these extensions:

- `pdo_pgsql`
- `gd`
- `mbstring`
- `openssl`
- `curl`
- `fileinfo`
- `zip`

### Nginx server block example

```nginx
server {
    listen 80;
    server_name your-domain.tld www.your-domain.tld;
    root /var/www/smart-table/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### Supervisor queue worker

```ini
[program:smart-table-queue]
command=/usr/bin/php /var/www/smart-table/artisan queue:work --sleep=3 --tries=3 --timeout=90
directory=/var/www/smart-table
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/smart-table/storage/logs/queue-worker.log
```

### Cron

Run Laravel scheduler every minute:

```cron
* * * * * cd /var/www/smart-table && /usr/bin/php artisan schedule:run >> /dev/null 2>&1
```

### TLS

Use Hostinger's panel-managed TLS or Certbot.

### Storage link

On VPS, `php artisan storage:link` should work normally and create `public/storage`.

## Hostinger shared hosting

### Supported but limited

Shared hosting is a fallback only.

Limitations:

- no long-running queue workers
- queue processing should prefer `sync` if background work becomes necessary
- scheduler must be configured through Hostinger cron UI
- `public/storage` symlink creation may be blocked
- Composer is often easier to run locally, then upload `vendor/`

### Shared-hosting recommendations

- keep `SUPABASE_REALTIME_ANON_ENABLED=false`
- rely on Livewire polling fallback
- if queue workers are unavailable, use `QUEUE_CONNECTION=sync`
- upload prebuilt assets from `public/build`
- if `composer install` is not available on-host, build locally and upload the generated `vendor/` directory

### Storage workaround when symlinks are blocked

If `php artisan storage:link` fails on shared hosting:

1. point the web server or Hostinger public path so `/storage/*` can resolve to `storage/app/public/*`, or
2. use a lightweight `public/storage/.htaccess` rewrite/proxy strategy handled by the shared Apache environment

The VPS path remains the preferred deployment because it avoids this workaround.

## Session, cache, and queue tables

The repo already includes migrations for:

- `sessions`
- `cache`
- `cache_locks`
- `jobs`
- `job_batches`
- `failed_jobs`

Run:

```bash
php artisan migrate --force
```

## Operational commands

Clear caches before a fresh deploy:

```bash
php artisan optimize:clear
```

Rebuild caches after the deploy:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

## Recovery notes

### Realtime degradation

Production is intentionally configured with anon realtime disabled. If browsers cannot open websocket subscriptions or RLS blocks anon access, the app stays correct because:

- owner request screens poll
- waiter request screens poll
- customer request status polls

### Storage failures

If Supabase Storage S3 credentials are missing or invalid:

- local/public image handling still exists for non-production fallback
- production should be treated as misconfigured until `SUPABASE_BUCKET`, `SUPABASE_S3_ENDPOINT`, `SUPABASE_S3_KEY`, and `SUPABASE_S3_SECRET` are corrected

### Proxy/TLS issues

If HTTPS redirects or secure cookies behave incorrectly behind Hostinger:

- verify `APP_URL`
- verify `SESSION_SECURE_COOKIE=true`
- verify `TRUSTED_PROXIES=*`

## Post-deploy smoke test

Run the checklist in `C:\Karim\projects\Saas\smart-table\docs\SMOKE_CHECKLIST.md`.