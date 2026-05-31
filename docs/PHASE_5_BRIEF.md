PHASE 5 IMPLEMENTATION — Product Catalog + Image Upload + Built-in Image Library

Read docs/PLAN.md (Phase 5) before starting. Project root: C:\Karim\projects\Saas\smart-table.
Phases 1-4 complete and verified. 64 tests passing. Build on top.

## Goal
Owners can manage a product catalog (CRUD: name, price, image, description, active flag, sort order). Images come from one of two sources:
1. Upload from device -> stored in Supabase Storage (production) or local `storage/app/public/products/` (local dev fallback when Supabase Storage env not set).
2. Pick from a built-in image library shipped with the app (`/public/img/library/*.jpg` or similar) — pre-seeded with ~12-20 generic café/restaurant stock images.

Customer page consumes the catalog at `/t/{qr_token}/catalog` (was a "coming soon" stub in Phase 3 — replace with the real list now). Browse-only, no ordering checkout.

## A. Migration: products
File: `database/migrations/2026_..._create_products_table.php`
Columns:
- id
- tenant_id (FK -> tenants, cascade, indexed)
- name (string, required)
- description (text, nullable)
- price_cents (integer, required) — store cents to avoid float issues. Currency assumed single-currency-per-tenant for v1; add `tenant.currency_code` later (Phase 7 polish).
- image_source (string, default 'none') — 'none' | 'upload' | 'library'
- image_path (string, nullable) — for 'upload': storage path; for 'library': library key like `library/coffee-1.jpg`
- is_active (boolean, default true)
- sort_order (integer, default 0)
- timestamps
- soft deletes
- index (tenant_id, is_active, sort_order)
- unique (tenant_id, name) — same-name product not allowed within a tenant

## B. Model: app/Models/Product.php
- BelongsToTenant + TenantScope.
- Constants for IMAGE_SOURCE_NONE/UPLOAD/LIBRARY.
- `priceFormatted()` accessor -> "12.50" from price_cents.
- `imageUrl()` accessor -> resolves source:
  - 'upload' -> Storage::disk(config('filesystems.product_disk'))->url($image_path)
  - 'library' -> asset('img/library/'.basename($image_path))
  - 'none' -> placeholder asset (e.g., asset('img/library/_placeholder.png'))
- Scope: active() -> where is_active=true.
- Default order: sort_order asc, name asc.

## C. Image Library
- Place 12+ stock-style images under `public/img/library/` named `food-1.jpg .. food-6.jpg`, `drink-1.jpg .. drink-6.jpg`. Use existing royalty-free or generated/SVG fallback images. If real photos aren't available, use simple labeled placeholders (1080x1080, plain colored backgrounds with category text rendered, generated programmatically via GD if needed). Document approach.
- Add a `_placeholder.png` for products with no image.
- Create `config/image_library.php` listing the keys + display labels (used by the picker UI).

## D. Storage configuration
- `config/filesystems.php`: add a disk `supabase_storage` (use `s3` driver since Supabase Storage is S3-compatible; pull endpoint/bucket from `services.supabase`). If Supabase env not set, map `product_disk` to `public` disk (local fallback).
- `config/services.php`: extend supabase config with `bucket`, `s3_endpoint` (e.g., `https://{project}.supabase.co/storage/v1/s3`), `region` (default `us-east-1`).
- `.env.example`: SUPABASE_BUCKET, SUPABASE_S3_ENDPOINT, SUPABASE_S3_KEY, SUPABASE_S3_SECRET (Supabase exposes S3 credentials in dashboard).
- `config('filesystems.product_disk')` -> dynamic: `'supabase_storage'` if env set, else `'public'`.
- Add `php artisan storage:link` reminder in deploy docs.

## E. Service: app/Services/ProductImageService.php
Methods:
- `validateUpload(UploadedFile $file): void` — only image/jpeg, image/png, image/webp; max 4MB; min dimensions 256x256.
- `storeUpload(Tenant $tenant, UploadedFile $file): string` — saves to `products/{tenant_id}/{uuid}.{ext}` on the configured disk; returns the storage path.
- `deleteUpload(string $path): void` — removes from disk; safe if missing.
- `applyToProduct(Product $product, string $source, ?string $key, ?UploadedFile $upload): void` — orchestrates: if 'upload' use storeUpload (and delete previous if any), if 'library' validate key against config('image_library'), if 'none' clear.
- All file operations isolated to this service — Livewire components don't touch Storage directly.

## F. Livewire components (Owner)

### `app/Livewire/Owner/Products/Index.php` (full-page)
- Paginated list: image thumb, name, price (formatted), is_active toggle, sort_order, edit, delete.
- Search by name. Filter by active/inactive.
- "Create product" button -> opens Form panel/modal.
- Sort: drag-and-drop is a polish item — for v1, edit sort_order numerically. (Document.)

### `app/Livewire/Owner/Products/Form.php`
- Fields: name, description, price (decimal input, converted to price_cents on save), is_active, sort_order.
- Image picker section:
  - Tabs/radio: "No image" | "Upload" | "Pick from library"
  - Upload tab: Livewire `WithFileUploads` + temporary preview.
  - Library tab: grid of library thumbnails from `config('image_library')` — click to select.
  - Current image preview always visible.
- Validation rules per tab.
- On submit: ProductImageService.applyToProduct -> save Product.

### `app/Livewire/Owner/Products/LibraryPicker.php` (optional sub-component)
- Encapsulates the library grid + selection emit. Use if it cleans up Form.php; otherwise inline.

## G. Customer catalog
Replace the placeholder `resources/views/customer/catalog.blade.php` with a real Livewire component:
- `app/Livewire/Customer/Catalog.php`
- Mounts with $qrToken; resolves table -> tenant; lists active products ordered by sort_order then name.
- Image, name, description, price.
- Mobile-first card grid (Tailwind).
- Header shows tenant name + table name.
- "Back to table" link -> `/t/{qr_token}`.
- No add-to-cart in v1 (browse only).

Routes:
- GET `/t/{qr_token}/catalog` -> Customer\Catalog (replace existing static view route).
- 404 if invalid qr_token.

## H. Owner navigation
Add "Products" link in `layouts/owner.blade.php` -> `/owner/products`.

## I. Authorization
- ProductPolicy: view/update/delete checked against tenant_id (same pattern as TablePolicy).
- Customer catalog: no auth, but only shows products of the QR's tenant + only `is_active=true`.
- Waiter cannot access /owner/products (already enforced by role middleware).

## J. Tests

### `tests/Feature/Owner/ProductsTest.php`
- Owner creates a product with price entered as "12.50" -> stored as 1250 cents.
- Duplicate name in same tenant fails validation.
- Cross-tenant: owner of A can't see/edit/delete tenant B's products.
- Soft delete works; deleted not in index.
- is_active toggle works.
- Sort order respected in index list.
- Waiter cannot access /owner/products (403).

### `tests/Feature/Owner/ProductImageTest.php` (uses `Storage::fake`)
- Upload image: file stored, image_source='upload', image_path matches `products/{tenant_id}/...`.
- Replace image with library pick: previous upload deleted; image_source='library'; image_path matches a library key.
- Replace with 'none': previous deleted; image_path null.
- Reject upload > 4MB or unsupported mime.
- Library key must exist in config or validation fails.

### `tests/Feature/Customer/CatalogTest.php`
- GET /t/{token}/catalog -> 200, lists active products only, ordered by sort_order.
- Inactive products hidden.
- Cross-tenant: products from another tenant never appear.
- Invalid token -> 404.

### Update existing
- Make sure 64 prior tests still green.

## K. Acceptance criteria
- `php artisan test` -> all green (64 + ~12 new tests).
- `php artisan migrate:fresh` clean.
- `npm run build` clean.
- Manual smoke (record):
  - Login as owner, /owner/products: empty list initially.
  - Create product "Cappuccino" 3.50 with library image -> appears in list with thumb.
  - Create product "Croissant" 2.00 with uploaded image (use a small test PNG) -> appears with uploaded image rendered (200 OK on the image URL).
  - Toggle "Cappuccino" inactive.
  - Visit /t/{seeded-qr-token}/catalog: only "Croissant" visible.
  - Reactivate "Cappuccino", refresh customer catalog: both visible, in sort_order.
  - Cross-tenant isolation: second tenant's owner can't see these products.

## L. Constraints
- Do NOT touch Phase 4 realtime code unless strictly necessary (e.g., Product changes generally don't need realtime in v1; do not subscribe customer catalog to realtime).
- Do NOT build waiter management UI (Phase 6).
- Do NOT add ordering/checkout — browse-only.
- Local dev MUST work without Supabase env vars set (fallback to public disk + library).
- TenantScope + BelongsToTenant patterns required on Product.

## M. Reporting
Return:
- Decisions (S3 disk vs custom driver, library image generation approach, price storage).
- File diff list.
- Full `php artisan test` output.
- `npm run build` output.
- Manual smoke transcript.
- Deviations from PLAN.md / brief.
- Any open questions.
