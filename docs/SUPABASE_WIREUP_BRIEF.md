SUPABASE LOCAL WIRE-UP — connect local dev to real Supabase project

Project root: C:\Karim\projects\Saas\smart-table.
All 7 phases of the SaaS are complete; 100 tests passing against sqlite. Now wire local dev to the real Supabase backend so the user can verify end-to-end before deploying to smartable.space.

## Credentials (write to .env only — NEVER commit)
- SUPABASE_URL = https://eishomgozxkyefnwdnna.supabase.co
- SUPABASE_PROJECT_REF = eishomgozxkyefnwdnna
- SUPABASE_ANON_KEY = eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVpc2hvbWdvenhreWVmbndkbm5hIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODAyNDUxOTMsImV4cCI6MjA5NTgyMTE5M30.kWG1ybv9iewlQT9fhpf1Rf7PnScF3s39u6ZZGPF9K44
- SUPABASE_SERVICE_ROLE_KEY = eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVpc2hvbWdvenhreWVmbndkbm5hIiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImlhdCI6MTc4MDI0NTE5MywiZXhwIjoyMDk1ODIxMTkzfQ.8J-50nvoDkmrt6x3rraxF2ZL2l4rVsCJjB8Tec5CVmQ
- DB password = Jaja1990@Jaja  (URL-encode the @ to %40 when used in connection strings)
- Storage S3 Access Key ID = e54f91ee47931a612ff4b59dd8f2326d
- Storage S3 Secret = a9e7346edab8af934ca33b3d23be54914b330565620886007a0b40f7a70a4e22

## Postgres connection
Use the direct connection or the IPv4 pooler. Discover via `https://eishomgozxkyefnwdnna.supabase.co/rest/v1/?apikey=...` if needed; otherwise:
- Try direct: host = `db.eishomgozxkyefnwdnna.supabase.co`, port 5432, db `postgres`, user `postgres`, password above, sslmode=require.
- If direct fails (Supabase often blocks IPv4 direct), fall back to Transaction Pooler: host = `aws-0-<region>.pooler.supabase.com`, port 6543, user `postgres.eishomgozxkyefnwdnna`, password above, sslmode=require. Determine region by attempting `psql` to `aws-0-eu-central-1.pooler.supabase.com` first; if connection refused/timeout, try `aws-0-us-east-1`, then `aws-0-eu-west-1`, then `aws-0-ap-southeast-1`. Use whichever connects.
- For migrations specifically prefer Session pooler (port 5432 on the pooler host) since transaction pooler can break Laravel's prepared statements. Set `DB_PORT=5432` on the pooler if available; document choice.

## Storage S3
- Endpoint: https://eishomgozxkyefnwdnna.supabase.co/storage/v1/s3
- Region: us-east-1 (Supabase S3 expects this string; ignore project region for S3 client config)
- Bucket: product-images (must be created — see below). Public bucket so public read works without signed URLs.

## Steps

### 1. Backup current .env
Copy `.env` to `.env.sqlite-backup` before changing it (so user can revert to local sqlite quickly).

### 2. Write new .env values
Set:
- APP_URL=http://127.0.0.1:8000
- DB_CONNECTION=pgsql
- DB_HOST, DB_PORT, DB_DATABASE=postgres, DB_USERNAME, DB_PASSWORD (URL-encode the @ when needed; in .env raw value is fine since Laravel parses)
- DB_SSLMODE=require (add if not present in .env example)
- SUPABASE_URL, SUPABASE_ANON_KEY, SUPABASE_SERVICE_ROLE_KEY
- SUPABASE_BUCKET=product-images
- SUPABASE_S3_ENDPOINT=https://eishomgozxkyefnwdnna.supabase.co/storage/v1/s3
- SUPABASE_S3_KEY, SUPABASE_S3_SECRET
- SUPABASE_REALTIME_ANON_ENABLED=false (keep default)
- FILESYSTEM_DISK can stay; product_disk auto-resolves

Verify config/database.php pgsql block honors DB_SSLMODE (Laravel default supports `sslmode` in `options` or via DSN). If it doesn't, add it to the pgsql array in config/database.php.

### 3. Verify Postgres connectivity
- Run `php artisan db:show` (or `php artisan tinker --execute="DB::select('select version()');"`).
- If fails: try pooler hosts as described, document which works.

### 4. Run migrations against Supabase
- `php artisan migrate:fresh --seed --force` — this WILL drop and recreate everything in the Supabase postgres `public` schema. (Acceptable — the project is empty.)
- Confirm all tables created. Use `psql` or `php artisan tinker` to list.

### 5. Create the Storage bucket
Use the Supabase Management API with the service role key:
```
POST https://eishomgozxkyefnwdnna.supabase.co/storage/v1/bucket
Authorization: Bearer <SERVICE_ROLE_KEY>
Content-Type: application/json
{ "id": "product-images", "name": "product-images", "public": true, "file_size_limit": 4194304, "allowed_mime_types": ["image/jpeg","image/png","image/webp"] }
```
Use curl from PowerShell. If bucket already exists (409), continue.

### 6. Apply RLS SQL
- Read `database/supabase/rls.sql`.
- Apply via psql against Supabase. If psql not available locally, use the Supabase REST endpoint? No — use psql. If psql isn't installed, download Postgres client tools or use `php artisan tinker` running each statement. Document approach.
- If `bypass_rls` role creation fails because the postgres user isn't superuser on Supabase, adjust: instead of creating a custom role, grant `BYPASSRLS` is not allowed on Supabase. Workaround: the Supabase `postgres` user is already a superuser-like role and the `service_role` JWT bypasses RLS at the API layer. Since Laravel connects via Postgres directly with the postgres user, RLS won't block Laravel queries (postgres role is owner). DOCUMENT this clearly: Laravel app uses the postgres role which is BYPASSRLS by default on Supabase managed instances; no separate bypass role needed.
- Re-read `database/supabase/rls.sql` and adapt: skip the `CREATE ROLE bypass_rls` if it errors; keep the `ALTER TABLE ... ENABLE ROW LEVEL SECURITY` and policy creates. Document any edits.

### 7. Quick storage smoke
- Use Laravel tinker or a small artisan command: `Storage::disk('supabase_storage')->put('test/hello.txt', 'hello'); Storage::disk('supabase_storage')->url('test/hello.txt');`
- Confirm the file appears in Supabase Storage dashboard (or via API GET) and the public URL returns 200.
- Clean up test file.

### 8. End-to-end smoke against real Supabase
Run `php artisan serve --host=127.0.0.1 --port=8000` and `npm run dev` in parallel. Walk all 12 steps from `docs/SMOKE_CHECKLIST.md` using curl + cookie jar where possible:
- Register an owner.
- Create a table.
- Hit /t/{qr_token} as anonymous; trigger callWaiter (use the seeded approach from Phase 3 smoke).
- Owner sees pending request, accepts it.
- Owner marks free.
- Create a product with library image; create another with uploaded image; verify image hosted on Supabase Storage (URL contains the supabase domain).
- Visit catalog from QR.
- Create a waiter; logout; log in as waiter; sees requests; can't reach /owner.
- Verify cross-tenant isolation by registering a second owner in another tenant.
- Verify rate limiting: 6 bad logins -> 429.
- Confirm in Supabase dashboard: tables populated, storage bucket has uploaded image.

### 9. Test suite
- Tests still run against sqlite (phpunit.xml uses in-memory sqlite). DO NOT change that. Run `php artisan test` once to confirm nothing regressed because of any code changes (e.g., if you tweaked config/database.php).

### 10. Report
Return:
- Final .env diff (REDACT secrets in the report — show keys, redact values).
- Which Postgres host/port worked.
- RLS apply transcript (with any adjustments).
- Storage bucket creation response.
- Storage put/url smoke evidence (URL pattern).
- End-to-end smoke transcript covering all 12 checklist steps.
- `php artisan test` output.
- Any deviations + a clear "ready/not-ready for production deploy" verdict.
- A `docs/LOCAL_SUPABASE_SETUP.md` capturing the working configuration so the user can reproduce.

## Constraints
- DO NOT commit .env.
- DO NOT print full secret values back in the report — redact tokens, show only first/last 4 chars or `***`.
- DO NOT change app behavior. Only config + .env + Storage bucket creation + RLS apply.
- If anything blocks (e.g., Postgres unreachable from this machine, RLS apply fails), STOP and report clearly with the exact blocker — don't fake success.
