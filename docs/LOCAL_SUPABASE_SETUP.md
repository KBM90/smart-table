# Local Supabase setup

## Working local configuration

- Back up `C:\Karim\projects\Saas\smart-table\.env` to `C:\Karim\projects\Saas\smart-table\.env.sqlite-backup`.
- Use the Supabase session pooler host on port `5432` for Laravel migrations and app traffic:
  - host: `aws-0-eu-central-1.pooler.supabase.com`
  - port: `5432`
  - database: `postgres`
  - username: `postgres.eishomgozxkyefnwdnna`
  - sslmode: `require`
- Use the Supabase S3-compatible storage endpoint:
  - endpoint: `https://eishomgozxkyefnwdnna.supabase.co/storage/v1/s3`
  - region: `us-east-1`
  - bucket: `product-images`

## Notes

- `config/database.php` already honors `DB_SSLMODE`, so no code change was required there.
- The direct host `db.eishomgozxkyefnwdnna.supabase.co` did not resolve from this machine, so the pooler was used.
- `psql` was not installed locally. RLS was applied through Laravel using the SQL file contents.
- The original RLS file attempts to create a `bypass_rls` role. On Supabase this can fail because managed Postgres does not allow custom `BYPASSRLS` role creation. The safe workaround is to skip that block and apply the table RLS/policies only.
- Laravel connects as the Supabase `postgres` role for this setup, so owner-level direct DB access is sufficient for app traffic while the policies still protect tenant-scoped access patterns.