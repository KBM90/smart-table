# Phase 5 Notes

- Product prices are stored in integer cents to avoid float precision issues.
- Product uploads use the `supabase_storage` S3-compatible disk when all Supabase Storage env vars are present; otherwise they fall back to the local `public` disk.
- Built-in image library assets are generated placeholders stored under `public/img/library/`.
- Local environments should run `php artisan storage:link` so uploaded product images resolve from the `public` disk fallback.