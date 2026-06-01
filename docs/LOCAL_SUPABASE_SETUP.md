# Local Supabase setup

## Verified local configuration

- Database host: `aws-0-eu-west-1.pooler.supabase.com`
- Database port: `5432`
- Database name: `postgres`
- Database user: `postgres.eishomgozxkyefnwdnna`
- SSL mode: `require`
- Supabase project ref: `eishomgozxkyefnwdnna`
- Storage bucket: `product-images`
- S3 endpoint for Laravel disk config: `https://eishomgozxkyefnwdnna.storage.supabase.co/storage/v1/s3`
- Public object URL host: `eishomgozxkyefnwdnna.supabase.co`
- S3 region: `us-east-1`

## Verified storage smoke

The local S3 adapter issue is resolved.

- Composer install completed successfully with the missing `aws/aws-sdk-php` package installed.
- `League\Flysystem\AwsS3V3\PortableVisibilityConverter` now resolves successfully.
- The local Windows PHP runtime needed a CA bundle for cURL-backed S3 calls. `config/filesystems.php` now auto-detects a common Git for Windows CA bundle path when `SUPABASE_S3_CA_BUNDLE` is not set.
- Supabase S3 writes also required:
  - the storage hostname form `https://{project-ref}.storage.supabase.co/storage/v1/s3`
  - an allowed image MIME type for the `product-images` bucket

Verified result:

- PUT: success
- HEAD/existence check: success
- Public GET: HTTP `200`
- DELETE: success
- Public URL host: `eishomgozxkyefnwdnna.supabase.co`

## RLS verification method

RLS had already been applied before this pass:

- `56` statements applied
- `24` policies present
- `6` tables with RLS enabled

Verification method used for this pass:

- App-level tenant isolation checks remain covered by the passing feature suite, especially:
  - cross-tenant owner/table/product tests
  - waiter/owner route boundary tests
  - tenant scope and authorization policy tests
- Attempted live smoke verification for cross-tenant access used:
  - owner B against owner A QR download route
  - owner B against owner A owner tables Livewire listing

## 12-step local smoke status

### Verified directly

1. Visit `/`
   - Result: pass
   - Evidence: `curl.exe -I http://127.0.0.1:8000/` returned `302` redirect to `/login`

2. Storage-backed public image path
   - Result: pass
   - Evidence: storage smoke PUT + public GET `200` + DELETE succeeded

### Blocked during scripted end-to-end run

The remaining browser-style checklist was not fully completed in this pass because the scripted registration/login flow hit Laravel CSRF/session behavior when driven outside a browser, and the fallback attempt to reuse Laravel's PHPUnit HTTP harness from a standalone PHP script is not supported cleanly by PHPUnit's runtime registry.

Exact failing command:

- `php storage/app/local-supabase-smoke.php`

Observed failing output:

- registration attempt returned HTTP `419 Page Expired`
- fallback harness run ended with:
  - `PHP Fatal error: Uncaught TypeError: PHPUnit\TextUI\Configuration\Registry::get(): Return value must be of type PHPUnit\TextUI\Configuration\Configuration, null returned`

What was tried:

1. Raw cURL flow with cookie jar + `_token`
2. Added `X-XSRF-TOKEN` header from cookie to mimic browser behavior
3. Reworked the script to use Laravel/Livewire-native actions where possible
4. Reworked auth-protected steps toward Laravel's HTTP testing harness
5. Stopped after confirming PHPUnit's standalone harness path is not reliable outside `php artisan test`

Current checklist summary:

- Step 1 redirect: pass
- Step 2 register tenant: blocked by scripted CSRF/session handling
- Steps 3-12: not claimed; require either manual browser execution or a dedicated test-case-based smoke implementation under the test runner

## Test suite

Latest verification:

- `php artisan test`
- Result: `100 passed`

## Notes

- `config/database.php` already honors `DB_SSLMODE`, so no code change was required there.
- The direct database host was not used; the working connection remained the session pooler on port `5432`.
- The Supabase bucket remains public and suitable for uploaded product images.
- `config/app.php` now trims inline `#` comments from `APP_KEY` values so local `.env` files with annotated keys do not break HTTP boot.
- The local repo still needs either:
  - a manual browser walk through the remaining smoke checklist, or
  - a proper PHPUnit/Laravel test-case-backed smoke script executed under the test runner

## Current verdict

Local Supabase database and storage wiring are working, storage public-read is verified, and the automated test suite is green.

Local deployment readiness is blocked only on completing the full browser-style 12-step smoke in a supported execution path.