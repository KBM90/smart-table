PHASE 7 IMPLEMENTATION — Production Readiness + Hostinger Deploy Docs

Read docs/PLAN.md (Phase 7) before starting. Project root: C:\Karim\projects\Saas\smart-table.
Phases 1-6 complete and verified. 97 tests passing. Build on top.

## Goal
Make the app production-deployable to Hostinger (VPS preferred, but document shared-hosting limitations) with Supabase Postgres + Storage + (disabled) Realtime. Deliver runbook + smoke checklist + .env.production template + Hostinger-specific gotchas. NO new features — operational work only.

## A. Production config

### `.env.production.example` (new, in project root)
Comprehensive template:
- APP_KEY (generate)
- APP_ENV=production
- APP_DEBUG=false
- APP_URL=https://your-domain.tld
- LOG_CHANNEL=stack, LOG_LEVEL=warning
- DB_CONNECTION=pgsql
- DB_HOST/PORT/DATABASE/USERNAME/PASSWORD (Supabase pooler — port 6543 for transaction mode)
- DB_SSLMODE=require
- SESSION_DRIVER=database (so single-server -> multi-server upgrade is painless)
- CACHE_STORE=database (Hostinger shared has no Redis; VPS can swap to redis)
- QUEUE_CONNECTION=database
- BROADCAST_CONNECTION=null (we don't broadcast from PHP)
- FILESYSTEM_DISK=public (assets) — products use product_disk
- SUPABASE_URL, SUPABASE_ANON_KEY (browser-side; safe)
- SUPABASE_SERVICE_ROLE_KEY (server-only; NEVER expose)
- SUPABASE_S3_ENDPOINT, SUPABASE_BUCKET, SUPABASE_S3_KEY, SUPABASE_S3_SECRET
- SUPABASE_REALTIME_ANON_ENABLED=false (per Phase 6 decision)
- TRUSTED_PROXIES=* (Hostinger usually fronts via shared proxy; document)
- MAIL_* (Hostinger SMTP example — leave placeholders)

### `config/session.php`, `config/cache.php`, `config/queue.php`
Confirm sane production defaults; only modify if currently broken for prod (driver should default to env). No code changes expected — verify only.

### Sessions/cache/queue migrations
- Ensure migrations exist for sessions, cache, jobs (Laravel 11+ usually includes them; create if missing).
- Verify `php artisan migrate` includes them in pgsql.

### Storage on Hostinger
- `php artisan storage:link` -> creates `public/storage` symlink. On Hostinger shared: symlinks may be restricted -> document the workaround (point Apache directly to `storage/app/public` or use a `public/storage/.htaccess` proxy). On VPS: works normally.

## B. Build pipeline
- Document: `composer install --no-dev --optimize-autoloader` -> `npm ci && npm run build` -> `php artisan migrate --force` -> `php artisan config:cache route:cache view:cache event:cache`.
- Add `deploy.sh` in repo root for VPS users (idempotent steps + `php artisan optimize:clear` first).

## C. Hostinger-specific notes
Document in `docs/DEPLOY_HOSTINGER.md`:

### VPS (recommended)
- Ubuntu 22.04 example. PHP 8.2 with extensions: pdo_pgsql, gd, mbstring, openssl, curl, fileinfo, zip.
- Nginx vhost example pointing document root to `public/`.
- `supervisord` snippet for `php artisan queue:work` (single worker for now).
- `cron` entry for `php artisan schedule:run` every minute.
- TLS via Hostinger's panel or Certbot.

### Shared hosting (fallback)
- Document limitations: no SSH for queue workers; `schedule:run` via cron control panel; symlink workaround; no long-running processes -> prefer sync queue + sync notifications.
- Note: realtime is anon-disabled, so polling fallback is what users see — works fine on shared.
- Composer install: usually run locally and upload vendor/.

### Supabase setup checklist
Document one-time setup:
1. Create Supabase project, copy URL + anon key + service role key.
2. Get Postgres credentials from project Settings -> Database (use pooler for production: port 6543, transaction mode).
3. Create Storage bucket `product-images` (public). Configure S3 access keys in Storage settings -> S3.
4. Apply `database/supabase/rls.sql` via Supabase SQL editor (after granting BYPASSRLS to the Laravel app DB user).
5. Verify RLS by attempting a SELECT as anon role -> should be blocked.

## D. Production smoke checklist
`docs/SMOKE_CHECKLIST.md` — step-by-step with expected results:
1. Hit `/` -> redirects to /login.
2. Register a new business owner -> lands on /dashboard with tenant name visible.
3. Create a table -> QR PNG downloads (open the PNG, scan with phone).
4. Open the scanned URL on a real phone -> public table page renders mobile-friendly with "Call Waiter".
5. Click Call Waiter -> status view appears, timer counts.
6. In another browser as owner: /owner/requests -> sees pending request within 10s (polling fallback).
7. Owner clicks Accept -> customer page updates within 10s ("Accepted by …").
8. Owner marks table free -> customer can scan again, fresh session.
9. Catalog: create a product with library image + product with uploaded image. Visit catalog from QR -> images load over HTTPS.
10. Create a waiter -> log in as waiter -> only sees /waiter/dashboard with requests; can't reach /owner/*.
11. Run rate-limit probes: 6 bad logins -> 429.
12. Verify HTTPS, security headers (HSTS recommended), no mixed content.

## E. Repo cleanup
- Add/refresh `README.md`: project description, requirements, local setup (one-page), link to docs/PLAN.md, docs/DEPLOY_HOSTINGER.md, docs/SUPABASE_RLS.md, docs/SMOKE_CHECKLIST.md.
- Move existing `smoke-*.html` artifacts produced during dev out of repo root into `storage/app/smoke/` (or delete) so they don't clutter prod deploys. Add `smoke-*.html` to .gitignore.
- `.gitignore` review: ensure .env, .env.production, storage/app/products/*, public/storage are properly handled (public/storage is the symlink — keep gitignored).
- Verify no secrets in committed files (grep for SUPABASE_SERVICE_ROLE_KEY, hardcoded keys).

## F. CI hint (optional but valued)
Add a minimal `.github/workflows/ci.yml` running on push: composer install, npm ci, npm run build, php artisan test against sqlite. Don't enable any deployment in CI.

## G. Tests
- All 97 prior tests must still pass.
- Add `tests/Feature/Production/ConfigSanityTest.php`:
  - When APP_ENV=production and APP_DEBUG=true -> assert this would log a warning (or simply assert that .env.production.example sets APP_DEBUG=false). A pure-text test reading the file is acceptable.
  - assert config('services.supabase.realtime_anon_enabled') === false by default.
  - assert config('app.debug') === false in env=production simulation (use `Config::set` or env switch).

## H. Acceptance criteria
- `php artisan test` -> all green (97 + ~3 new).
- `npm run build` clean.
- `composer install --no-dev --optimize-autoloader` simulated locally OR documented exactly.
- `.env.production.example` exists, has every key needed, no real secrets.
- `docs/DEPLOY_HOSTINGER.md` exists with VPS + shared sections, supabase setup, supervisord/cron snippets.
- `docs/SMOKE_CHECKLIST.md` exists with all 12 steps.
- `README.md` is end-to-end-readable for someone new to the project.
- Repo is clean: no dev smoke HTML files committed; .gitignore correct.

## I. Manual verification (record)
- Run `composer install --no-dev --optimize-autoloader -d "C:\Karim\projects\Saas\smart-table"` against a copy if possible OR on the live tree (then run a `composer install` afterward to restore dev deps). Document.
- Run `php artisan config:cache && php artisan route:cache && php artisan view:cache` -> verify no errors. Then `php artisan optimize:clear` to undo (so dev tests still work).
- Confirm `php artisan migrate:fresh --seed` still succeeds.
- Confirm `php artisan test` still 100/100 (or whatever the new total is) green.

## J. Constraints
- Do NOT change application functionality.
- Do NOT introduce new dependencies unless strictly necessary (e.g., a logger driver). If you do, justify.
- Do NOT modify Phase 6 RLS SQL.
- Documentation must reference real file paths under `C:\Karim\projects\Saas\smart-table\`.

## K. Reporting
Return:
- File diff list (configs, docs, .env templates, README, .gitignore, CI).
- Full `php artisan test` output.
- `npm run build` output.
- `composer install --no-dev --optimize-autoloader` evidence (or full justification if skipped).
- `php artisan config/route/view:cache` outputs.
- Summary of DEPLOY_HOSTINGER.md, SMOKE_CHECKLIST.md, README.md key sections.
- Final overall project status: total tests passing, all phases complete.
- Open issues / known limitations the owner should be aware of before going live.
