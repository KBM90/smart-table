# Smart Table SaaS

Smart Table SaaS is a multi-tenant restaurant and cafe workflow app built with Laravel 12, Livewire 3, Alpine.js, Tailwind CSS, and Supabase. It supports owner onboarding, waiter accounts, QR-driven customer table sessions, waiter-call handling, tenant-scoped dashboards, and product catalogs with Supabase-backed or local-public image storage.

The source project root for this workspace is `C:\Karim\projects\Saas\smart-table`.

## Stack

- PHP 8.2+
- Composer
- Node.js 20+
- Laravel 12
- Livewire 3
- Tailwind CSS + Vite
- SQLite for local tests/dev convenience
- Supabase Postgres + Storage for production

## Requirements

- PHP extensions: `pdo_sqlite`, `pdo_pgsql`, `mbstring`, `openssl`, `curl`, `fileinfo`, `gd`, `zip`
- Composer 2
- Node.js + npm

## Local setup

1. From `C:\Karim\projects\Saas\smart-table`, install dependencies:
   - `composer install`
   - `npm install`
2. Create your local env file:
   - `Copy-Item .env.example .env`
3. Configure local development values in `.env`:
   - `APP_ENV=local`
   - `APP_DEBUG=true`
   - `DB_CONNECTION=sqlite`
   - `DB_DATABASE=database/database.sqlite`
4. Create the sqlite file if needed:
   - `New-Item -ItemType File database/database.sqlite -Force`
5. Generate the app key and migrate:
   - `php artisan key:generate`
   - `php artisan migrate --seed`
6. Link public storage for local product-image fallback:
   - `php artisan storage:link`
7. Run the app:
   - `php artisan serve`
   - `npm run dev`

## Quality checks

- `php artisan test`
- `npm run build`

## Production deployment

Use `.env.production.example` as the production template. The primary deployment runbook is in `docs/DEPLOY_HOSTINGER.md`.

Recommended production flow:

1. `composer install --no-dev --optimize-autoloader`
2. `npm ci`
3. `npm run build`
4. `php artisan migrate --force`
5. `php artisan config:cache`
6. `php artisan route:cache`
7. `php artisan view:cache`
8. `php artisan event:cache`

For VPS deployments, use `deploy.sh`.

## Documentation

- Architecture and phase plan: `docs/PLAN.md`
- Hostinger deployment runbook: `docs/DEPLOY_HOSTINGER.md`
- Supabase RLS notes: `docs/SUPABASE_RLS.md`
- Production smoke checklist: `docs/SMOKE_CHECKLIST.md`
- Phase brief used for this deploy work: `docs/PHASE_7_BRIEF.md`

## Notes

- Production keeps `SUPABASE_REALTIME_ANON_ENABLED=false` and relies on Livewire polling fallback.
- Product uploads use the `public` disk locally and switch to Supabase S3-compatible storage when the Supabase storage env keys are present.
- Hostinger shared hosting is supported as a fallback, but VPS is the recommended target because queue workers and symlinks are more reliable.
