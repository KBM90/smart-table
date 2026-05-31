PHASE 2 IMPLEMENTATION — Tables + QR Lifecycle + Livewire 3 install

Read docs/PLAN.md (Phase 2 section) before starting. Project root: C:\Karim\projects\Saas\smart-table. Phase 1 is already complete (tenancy, auth, owner/waiter dashboards). Build on top of it.

## Work items

### A. Install Livewire 3 (was deferred from Phase 1)
- `composer require livewire/livewire:^3.0`
- `php artisan livewire:publish --config` (optional)
- Confirm @livewireStyles / @livewireScripts directives are added to base layouts (layouts/owner.blade.php, layouts/waiter.blade.php, layouts/app.blade.php — wherever needed).
- Smoke: create a tiny Livewire component (e.g. `Owner\HelloLivewire`) on the owner dashboard, confirm it renders + a wire:click counter works locally; then remove or keep as a debug component. Document.

### B. QR code package
- Install `simplesoftwareio/simple-qrcode` (works on PHP 8.2, no GD-only dependency issues) OR `bacon/bacon-qr-code` if Imagick is available. Pick one and justify.

### C. Migration: tables
File: `database/migrations/2026_..._create_tables_table.php`
Columns:
- id
- tenant_id (FK -> tenants, cascade delete, indexed)
- name (string, required) — e.g. "Table 5", "T-12"
- qr_token (string 32, unique, indexed)
- status (string, default 'free') — values: 'free' | 'occupied'
- timestamps
- soft deletes (so owners can "remove" without losing historical data)

Constraints: unique(tenant_id, name) so two tables in same tenant can't have same label.

### D. Model: app/Models/Table.php
- `use HasFactory, SoftDeletes, BelongsToTenant;`
- Apply TenantScope global scope.
- Fillable: name, status. tenant_id auto-set by trait.
- `qr_token` auto-generated on create (32-char URL-safe, e.g. `Str::random(32)`) if not provided. Ensure uniqueness with retry on collision.
- Constants for status: STATUS_FREE, STATUS_OCCUPIED.
- Relations: `belongsTo(Tenant::class)`.
- `getPublicUrl()` -> route('customer.table', ['qr_token' => $this->qr_token]).

### E. Factory: database/factories/TableFactory.php
- Default: tenant via Tenant::factory(), name "Table {n}", status free.

### F. Service: app/Services/QrCodeService.php
- `pngFor(Table $table): string` returns PNG bytes (base64 not needed — return raw).
- `dataUrlFor(Table $table): string` for inline preview.
- Size + margin configurable; default 512px, margin 2.

### G. Livewire components (Owner)
File-based or class. Use Livewire 3 conventions.
- `app/Livewire/Owner/Tables/Index.php` — paginated list, search by name, status filter, "Create table" button (opens form modal or route), per-row "Edit", "Delete" (soft), "Mark Free", "Download QR (PNG)".
- `app/Livewire/Owner/Tables/Form.php` — create/edit a single table (just `name` is editable; `qr_token` auto, `status` read-only here — managed by sessions in later phases, plus manual "Mark Free" action).
- `app/Livewire/Owner/Tables/QrPreview.php` — shows QR + name + public URL + Download button.

Views under `resources/views/livewire/owner/tables/`.

### H. Routes (routes/web.php)
Inside the existing owner group `[auth, tenant, role:owner]`:
- GET `/owner/tables` -> Owner\Tables\Index (Livewire full-page)
- GET `/owner/tables/{table}/qr.png` -> controller action returning the PNG (signed not required, but enforce tenant scope via route model binding + middleware)

Public (no auth):
- GET `/t/{qr_token}` named `customer.table` -> stub view "Welcome to {{ table.tenant.name }} — Table {{ table.name }}". Real customer flow lands in Phase 3.
- 404 if qr_token doesn't match any non-deleted table.

### I. Owner dashboard nav
Update `layouts/owner.blade.php` (or partial) to include a "Tables" link to `/owner/tables`.

### J. Authorization
- Tenant scope already auto-filters Table queries.
- Add a Policy `app/Policies/TablePolicy.php` (only `update`, `delete`, `view` — all simply check $user->tenant_id === $table->tenant_id and $user->isOwner()).
- Register policy in AuthServiceProvider (or auto-discovery).

### K. Tests
`tests/Feature/Owner/TablesTest.php`:
- owner can create a table with a name; qr_token is generated and unique.
- duplicate name in same tenant fails validation.
- duplicate name across tenants is allowed.
- owner can soft-delete a table; deleted table is not in index.
- owner cannot see another tenant's tables (create tenants A,B; assert).
- owner cannot edit/delete another tenant's table (assert 403/404).
- waiter cannot access /owner/tables (403).

`tests/Feature/Customer/TableScanStubTest.php`:
- GET /t/{valid-qr-token} -> 200, contains tenant name + table name.
- GET /t/{nonexistent-token} -> 404.
- GET /t/{soft-deleted-table-token} -> 404.

`tests/Feature/Owner/TableQrDownloadTest.php`:
- GET /owner/tables/{table}/qr.png authenticated owner -> 200, content-type image/png, body length > 100 bytes.
- Cross-tenant: owner of A requesting B's table QR -> 403/404.

### L. Acceptance criteria
- `php artisan test` -> all green (existing 33 + new tests).
- `php artisan migrate:fresh` runs cleanly.
- Manual smoke (record output):
  - Login as owner.
  - Create 3 tables.
  - Open one's QR preview, download PNG (verify file > 0 bytes).
  - Visit /t/{that_qr_token} in incognito -> stub welcome page shows tenant + table name.
  - Visit /t/garbage -> 404.
  - Login as a manually-seeded waiter -> /owner/tables -> 403.
  - Cross-tenant: seed second tenant + owner; ensure first owner's tables list doesn't include second tenant's tables.

## Constraints
- Do NOT implement table_sessions, requests, customer call-waiter flow, or realtime — Phase 3+.
- Do NOT touch product catalog — Phase 5.
- Keep Livewire 3 install changes minimal; goal is to wire it in cleanly so subsequent phases can use it.
- All identifiers in English. UI strings English for now.
- Use the TenantScope + BelongsToTenant patterns established in Phase 1 — do NOT reinvent.

## Reporting
Return:
- Decisions (QR package choice + why, Livewire layout integration approach).
- File diff list (added/modified/deleted).
- `php artisan test` raw output.
- Manual smoke transcript (curl or Invoke-WebRequest with cookie jar).
- Any deviation from this brief or PLAN.md with justification.
- Open questions only if a real ambiguity exists.
