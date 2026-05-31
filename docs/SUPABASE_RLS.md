# Supabase RLS rollout for Smart Table

Phase 6 adds `C:\Karim\projects\Saas\smart-table\database\supabase\rls.sql` as defense-in-depth for production Supabase Postgres. Laravel tenancy and policies remain the primary enforcement layer.

## Recommended v1 rollout

1. Confirm the Laravel database user has been granted the `bypass_rls` role or equivalent `BYPASSRLS` capability.
2. Apply `database/supabase/rls.sql` in the Supabase SQL editor or through `psql`.
3. Keep `SUPABASE_REALTIME_ANON_ENABLED=false` in production.
4. Rely on Livewire polling fallback for request/session updates until Laravel starts issuing tenant-scoped Supabase JWTs.

## Apply script

Example with `psql`:

```bash
psql "$SUPABASE_DATABASE_URL" -f database/supabase/rls.sql
```

## What the SQL does

- Enables RLS on `tenants`, `users`, `tables`, `table_sessions`, `requests`, and `products`.
- Recreates idempotent tenant-isolation policies for `SELECT`, `INSERT`, `UPDATE`, and `DELETE`.
- Uses `current_setting('app.current_tenant_id', true)` as the tenant boundary.
- Creates a `bypass_rls` role if missing, for the Laravel database user.

## Important realtime note

Current browser realtime uses the anon key only. Once RLS is enabled, anon clients cannot satisfy the tenant-setting checks in `rls.sql`, so direct anon subscriptions to `requests` and `table_sessions` will not receive rows.

That is intentional for Phase 6. The secure v1 posture is:

- `SUPABASE_REALTIME_ANON_ENABLED=false`
- Livewire polling remains active
- No browser-issued Supabase JWTs yet

## Verification checklist

- Laravel app still works normally after the DB user receives `bypass_rls`.
- Owner pages only show same-tenant rows.
- Browser console logs the anon realtime disabled message in production.
- Dashboard and customer request status still update through polling.

## Deferred improvement

If realtime must be re-enabled later without polling fallback, add a Laravel endpoint that issues short-lived Supabase JWTs with tenant-scoped claims and update the browser client to authenticate with those JWTs instead of the anon key.