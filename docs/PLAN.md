# Objective

Deliver a production-oriented implementation plan for a **multi-tenant restaurant/cafe Smart Table SaaS** built on Laravel 12, Livewire 3, Alpine.js, Tailwind CSS v4, and Supabase Postgres/Realtime/Storage, aligned to the requirements in `C:\Karim\projects\Saas\smart-table\docs\PLANNING_BRIEF.md` and the current minimal Laravel application scaffold.

## Recommended Architecture Summary

- **Application architecture:** Laravel monolith with Blade + Livewire full-page components, Alpine.js for light client interactivity, Vite for assets.
- **Tenancy model:** Single database, row-level tenant partitioning using `tenant_id` on all tenant-owned tables, enforced in Laravel with a global scope and middleware; Supabase RLS added as defense-in-depth.
- **Authentication:** Laravel-native auth for staff only. Owners and waiters authenticate; customers remain anonymous.
- **Realtime:** Supabase Realtime in the browser for dashboard/request updates, with Livewire polling fallback.
- **Customer interaction model:** QR token identifies table; session token identifies active table session.
- **Deployment model:** Laravel app hosted on Hostinger VPS, connected to Supabase-managed Postgres, Realtime, and Storage.

## Key Design Decisions

### 1) Tenancy Strategy
**Chosen:** Single database with `tenant_id` on tenant-bound tables.

**Why:**
- Best fit for SaaS MVP complexity and hosting constraints.
- Matches current Laravel scaffold and avoids per-tenant connection orchestration.
- Works cleanly with Supabase Postgres and Laravel Eloquent scopes.

**Rejected alternatives:**
- Database-per-tenant: too much operational overhead for MVP.
- Schema-per-tenant: more complex migrations and deployment story than required.

### 2) Authentication Boundary
**Chosen:** Laravel handles all authenticated staff access; Supabase Auth is not used.

**Why:**
- Keeps roles, middleware, policies, and session management centralized in Laravel.
- Avoids dual-auth complexity across Laravel and Supabase.

**Rejected alternatives:**
- Supabase Auth for staff: duplicates auth concerns and increases coordination complexity.

### 3) Customer Session Model
**Chosen:** QR token for table discovery + server-issued table session token for active anonymous sessions.

**Why:**
- Cleanly distinguishes stable table identity from ephemeral customer occupancy.
- Supports “resume current session on same device” behavior.

**Risk and mitigation:**
- In-app browser cookie persistence can be unreliable. Add a fallback path to resume via signed URL/session token when cookies are missing.

### 4) Realtime Strategy
**Chosen:** Supabase JS client subscribes directly from the browser to request/session updates; Livewire polling remains the fallback.

**Why:**
- Avoids PHP websocket hosting complexity.
- Fits Hostinger constraints while still delivering live UX.

### 5) Product Image Strategy
**Chosen:** Start with Supabase Storage for all uploaded product images; defer any built-in image library until after core flows are stable.

**Why:**
- Lowest-complexity path to deliver core catalog management.
- Keeps storage concerns consistent across environments.

**Rejected for initial phase:**
- Shipping a curated built-in image library and extra image-processing workflow in the MVP foundation.

---

# Current Repository Baseline

## Verified Current State
- Laravel 12 app scaffold exists.
- PostgreSQL connection support is already present.
- Frontend uses Vite + Tailwind CSS v4.
- Routing is still at the default minimal state.
- `User` model is still the stock Laravel model.
- No tenant model, tenant middleware, dashboard structure, or QR/customer flow exists yet.
- No auth starter kit is currently present in dependencies.

## Existing Files That Anchor This Plan
- `C:\Karim\projects\Saas\smart-table\docs\PLANNING_BRIEF.md`
- `C:\Karim\projects\Saas\smart-table\composer.json`
- `C:\Karim\projects\Saas\smart-table\package.json`
- `C:\Karim\projects\Saas\smart-table\routes\web.php`
- `C:\Karim\projects\Saas\smart-table\bootstrap\app.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\User.php`
- `C:\Karim\projects\Saas\smart-table\config\database.php`

---

# Target Architecture

```mermaid
flowchart TD
    A[Customer scans QR] --> B[Customer route /t/{qr_token}]
    B --> C[Resolve table]
    C --> D[Create or resume table session]
    D --> E[Livewire customer page]
    E --> F[Create request: call waiter]
    F --> G[(Supabase Postgres)]
    G --> H[Supabase Realtime]
    H --> I[Owner dashboard]
    H --> J[Waiter dashboard]
    I --> K[Accept request]
    J --> K
    K --> G
    G --> H
    H --> E

    L[Owner auth] --> M[Laravel auth/session]
    N[Waiter auth] --> M
    M --> O[Role middleware]
    O --> I
    O --> J
```

## Bounded Contexts

### Tenant & Identity
- Tenant creation during owner onboarding.
- Staff users belong to exactly one tenant.
- Role model: `owner`, `waiter`.

### Venue Operations
- Tables belong to a tenant.
- Each table has a stable QR token.
- Table occupancy is represented by active `table_sessions`.

### Catalog
- Products belong to a tenant.
- Products have image, name, price, and active state.

### Service Requests
- Customer raises waiter requests from a live table session.
- Staff accepts and resolves requests.
- Dashboard views show current pending/accepted activity.

---

# Domain Model

## Core Tables

### `tenants`
Suggested fields:
- `id`
- `name`
- `slug` (unique, optional but recommended)
- timestamps

### `users` (extend existing)
Add:
- `tenant_id` nullable initially for migration safety, then required for tenant staff records
- `role` enum/string: `owner`, `waiter`
- timestamps as existing

Relationships:
- belongs to `tenant`

### `tables`
Fields:
- `id`
- `tenant_id`
- `name` or `label`
- `qr_token` unique
- `status` enum/string: `free`, `occupied`
- timestamps

### `table_sessions`
Fields:
- `id`
- `tenant_id`
- `table_id`
- `session_token` unique
- `status` enum/string: `active`, `closed`
- `started_at`
- `ended_at` nullable
- timestamps

### `products`
Fields:
- `id`
- `tenant_id`
- `name`
- `description` nullable
- `price`
- `image_path` nullable
- `is_active` boolean
- `sort_order` integer default 0
- timestamps

### `requests`
Fields:
- `id`
- `tenant_id`
- `table_session_id`
- `type` enum/string, start with `call_waiter`
- `status` enum/string: `pending`, `accepted`, `resolved`
- `accepted_by` nullable FK to `users`
- `accepted_at` nullable timestamp
- `resolved_at` nullable timestamp
- timestamps

## Eloquent Model Plan
Create or extend:
- `C:\Karim\projects\Saas\smart-table\app\Models\Tenant.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\User.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Table.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\TableSession.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Product.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Request.php`

## Shared Tenant Enforcement Layer
Create:
- `C:\Karim\projects\Saas\smart-table\app\Models\Scopes\TenantScope.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Concerns\BelongsToTenant.php`

Behavior:
- Automatically add `where tenant_id = currentTenantId()` to tenant-bound model queries.
- Automatically assign `tenant_id` on create when authenticated tenant context exists.

---

# Routing and Access Model

## Route Groups

### Public customer routes
- `GET /t/{qr_token}` → customer table page
- Optional resume/fallback route for session recovery if cookie is absent

### Authenticated owner routes
Prefix: `/owner`
- `/owner/dashboard`
- `/owner/tables`
- `/owner/products`
- `/owner/staff`
- `/owner/requests`

### Authenticated waiter routes
Prefix: `/waiter`
- `/waiter/dashboard`
- `/waiter/requests`

## Middleware / Bootstrapping Updates
Update:
- `C:\Karim\projects\Saas\smart-table\bootstrap\app.php`
- `C:\Karim\projects\Saas\smart-table\routes\web.php`

Add middleware aliases:
- `tenant`
- `role`

Middleware responsibilities:
- `IdentifyTenant`: resolve current tenant from authenticated user
- `EnsureRole`: verify required role for route group

---

# UI / Livewire Architecture

## Recommended Livewire Structure

```text
C:\Karim\projects\Saas\smart-table\app\Livewire\
├── Customer\
│   ├── TablePage.php
│   └── RequestStatus.php
├── Owner\
│   ├── Dashboard.php
│   ├── Tables\
│   │   ├── Index.php
│   │   ├── Form.php
│   │   └── QrPreview.php
│   ├── Products\
│   │   ├── Index.php
│   │   └── Form.php
│   ├── Staff\
│   │   ├── Index.php
│   │   └── Form.php
│   └── Requests\
│       └── Index.php
└── Waiter\
    ├── Dashboard.php
    └── Requests\
        └── Index.php
```

## Blade Layouts / Views
Recommended additions under:
- `C:\Karim\projects\Saas\smart-table\resources\views\layouts\`
- `C:\Karim\projects\Saas\smart-table\resources\views\livewire\customer\`
- `C:\Karim\projects\Saas\smart-table\resources\views\livewire\owner\`
- `C:\Karim\projects\Saas\smart-table\resources\views\livewire\waiter\`

## UX Principles
- Mobile-first for customer experience.
- Dashboard-first clarity for staff workflows.
- Keep owner and waiter layouts distinct.
- Use Livewire loading states and lightweight Alpine interactions.

---

# Customer Flow Design

## Scan / Session / Occupancy Rules
1. Customer scans QR.
2. Route resolves table by `qr_token`.
3. If table has no active session:
   - create `table_sessions` row
   - mark table as `occupied`
   - set session token in cookie
4. If table has an active session and cookie/session token matches:
   - resume session
5. If table has an active session and no valid session token:
   - show “table currently in use” screen
6. Customer sees catalog and waiter call action.

## Request Lifecycle
Statuses:
- `pending`
- `accepted`
- `resolved`

Flow:
- Customer creates request.
- Owner or waiter accepts request.
- Customer sees accepted status live.
- Staff resolves request after service completion.

## Fallback for QR Session Fragility
Implement a planned fallback path:
- signed resume URL or one-time resume token
- only used when cookie/session persistence fails
- keep this behind a service abstraction so it can be enabled without redesigning the flow

---

# Supabase Integration Plan

## Postgres Connection
Use Laravel `pgsql` connection against Supabase Postgres.

Config impact:
- existing `C:\Karim\projects\Saas\smart-table\config\database.php` already supports `pgsql`
- environment config will supply host, port, db, username, password, ssl mode as required

## Realtime
Use browser-side Supabase client for:
- owner request dashboards
- waiter request dashboards
- customer request status updates

Recommended subscription targets:
- `requests` filtered by `tenant_id` for staff dashboards
- `requests` filtered by current `table_session_id` for customer status
- optionally `table_sessions` for table state refreshes

## Storage
Use Supabase Storage for product images.

Recommended service wrapper:
- `C:\Karim\projects\Saas\smart-table\app\Services\ProductImageService.php`

Responsibilities:
- validate file type/size
- upload/delete image
- return stored path/public URL mapping
- isolate storage vendor details from Livewire components

## Optional RLS Policies
Add after Laravel-based tenancy is working:
- `requests` tenant filter policies
- `products` tenant filter policies
- `tables` tenant filter policies
- `table_sessions` tenant filter policies

This is defense-in-depth, not the primary isolation layer.

---

# Services, Policies, and Supporting Classes

## Services to Introduce
- `C:\Karim\projects\Saas\smart-table\app\Services\TenantRegistrationService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\TableSessionService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\QrCodeService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\ProductImageService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\RequestRealtimePayloadService.php` (optional)

## Middleware / Support
- `C:\Karim\projects\Saas\smart-table\app\Http\Middleware\IdentifyTenant.php`
- `C:\Karim\projects\Saas\smart-table\app\Http\Middleware\EnsureRole.php`
- `C:\Karim\projects\Saas\smart-table\app\Support\CurrentTenant.php`

## Policies
Recommended if authorization complexity grows:
- `TablePolicy`
- `ProductPolicy`
- `UserPolicy`
- `RequestPolicy`

For MVP, route middleware + tenant scope can carry most of the load, but policies should be introduced as owner capabilities expand.

---

# Security Plan

## Core Controls
- Tenant isolation via scope + middleware.
- Authenticated staff-only route groups.
- Anonymous customers constrained to QR/session-based pages.
- Livewire validation for every mutating action.
- CSRF and session security from Laravel defaults.
- Blade escaping for rendered content.
- Rate limiting on public QR and request endpoints.
- Signed/fallback session recovery for in-app browser edge cases.

## Abuse / Edge Cases
- Repeated QR scans on occupied tables.
- Customers attempting to forge session tokens.
- Cross-tenant data leakage through incorrectly scoped queries.
- Unauthorized waiter access to owner-only management features.
- Realtime subscription filters being broader than intended.

---

# Testing and Validation Strategy

## Test Categories

### Feature tests
- owner registration creates tenant + owner user
- waiter cannot access owner routes
- customer scan creates session only when table is free
- customer without valid session cannot hijack occupied table
- request creation is limited to active table session
- request accept/resolve updates statuses correctly

### Tenancy tests
- tenant A cannot see tenant B tables/products/requests
- scoped models auto-filter correctly
- owner-created staff/users stay within tenant

### Integration tests
- QR route resolution
- product image upload service behavior (faked storage in tests)
- fallback polling path when realtime is unavailable

### Manual verification checklist
- QR scan on mobile
- live waiter call updates owner/waiter dashboards
- customer sees accepted state without refresh
- owner CRUD for tables/products/staff works end-to-end

## Definition of Done
- Tenancy enforced across all tenant-owned models and routes.
- Auth and role boundaries implemented for owner/waiter.
- Customer QR flow works with table locking/resume behavior.
- Waiter-call lifecycle works end-to-end.
- Realtime updates function with polling fallback.
- Product images upload successfully to Supabase Storage.
- Core tenant-isolation and access-control tests pass.
- Deployment/config documentation is sufficient for production setup.

---

# Phased Implementation Plan

## Phase 1 — Foundation: Auth, Tenant Core, Roles

### Goals
- Establish tenant-aware architecture and staff authentication.
- Convert the stock user system into owner/waiter tenant staff management.

### Primary targets
- `C:\Karim\projects\Saas\smart-table\composer.json`
- `C:\Karim\projects\Saas\smart-table\app\Models\User.php`
- `C:\Karim\projects\Saas\smart-table\bootstrap\app.php`
- `C:\Karim\projects\Saas\smart-table\routes\web.php`
- new tenant-related migrations/models/middleware/services

### Work items
- Add Laravel auth scaffolding appropriate for Blade/Alpine.
- Create `tenants` table and extend `users` with `tenant_id` and `role`.
- Create tenant scope/trait/current-tenant support.
- Add role middleware and owner/waiter route groups.
- Implement tenant-aware registration flow for owners.

### Verification
- Owner registration creates tenant and owner user.
- Authenticated owner reaches owner dashboard.
- Waiter role guard blocks owner-only routes.

---

## Phase 2 — Tables and QR Lifecycle

### Goals
- Enable owner-managed tables and QR generation.
- Prepare stable table discovery entry point for customers.

### Primary targets
- new `tables` migration/model/factory
- owner table Livewire components
- QR generation service
- customer table route

### Work items
- Create table CRUD.
- Generate unique `qr_token` per table.
- Implement QR rendering/download flow.
- Add table status handling (`free`, `occupied`).

### Verification
- Owner can create/update/archive tables.
- QR resolves to correct public route.
- Duplicate QR tokens are prevented.

---

## Phase 3 — Anonymous Customer Sessions and Waiter Call

### Goals
- Create customer-facing table session flow and v1 waiter-call interaction.

### Primary targets
- new `table_sessions` and `requests` migrations/models
- `TableSessionService`
- customer Livewire components/views
- request lifecycle handlers

### Work items
- Build QR scan entry flow.
- Create/resume active session with session token.
- Lock occupied tables against unauthorized reuse.
- Add “call waiter” action and status display.

### Verification
- Free table opens new session.
- Same device resumes active session.
- Other devices cannot hijack active table.
- Request record is created and visible to staff.

---

## Phase 4 — Staff Dashboards and Realtime

### Goals
- Surface live requests to owner and waiter dashboards.
- Reflect status changes back to customers.

### Primary targets
- owner and waiter dashboard Livewire components
- frontend JS bootstrap for Supabase client
- request list/status UI

### Work items
- Add owner request overview panel.
- Add waiter-focused pending request screen.
- Connect Supabase Realtime subscriptions in frontend.
- Add polling fallback for degraded network/websocket conditions.

### Verification
- New customer request appears on dashboards without page refresh.
- Accepting request updates customer status live.
- Polling fallback preserves correctness when realtime is unavailable.

---

## Phase 5 — Product Catalog and Images

### Goals
- Allow owners to manage menu/catalog content used on customer table pages.

### Primary targets
- `products` migration/model
- owner products Livewire components
- Supabase Storage service adapter
- customer catalog view composition

### Work items
- Add product CRUD with validation.
- Upload/store product images in Supabase Storage.
- Render catalog on customer page.
- Add active/inactive and sort ordering controls.

### Verification
- Owner can create/edit/deactivate products.
- Images upload and display correctly.
- Customer sees only active products for the current tenant.

---

## Phase 6 — Staff Management, Authorization Hardening, and QA

### Goals
- Complete owner-driven waiter management.
- Harden authorization and tenant isolation.

### Primary targets
- staff management UI
- policies/middleware refinements
- feature and tenancy tests

### Work items
- Owner creates, edits, and disables waiter accounts.
- Tighten route, component, and service authorization checks.
- Expand automated tests around isolation and role boundaries.
- Add rate limiting and edge-case handling.

### Verification
- Owner can manage waiters successfully.
- Waiters are isolated to tenant resources only.
- Access-control and tenancy test suite passes.

---

## Phase 7 — Production Readiness and Deployment Documentation

### Goals
- Finalize operational readiness for Hostinger deployment.

### Primary targets
- env/deployment documentation
- queue/session/cache config choices
- production bootstrap notes

### Work items
- Document Supabase/Postgres/Storage config.
- Define production queue/session/cache drivers.
- Document migration/build/deploy flow.
- Add recovery notes for realtime degradation and storage failures.

### Verification
- Deployment checklist is executable end-to-end.
- Production environment variables are fully enumerated.
- Smoke test plan covers login, dashboard, QR scan, and waiter-call flow.

---

# Step → Targets → Verification Traceability

| Step | Targets | Verification |
|---|---|---|
| Phase 1 | `User`, tenant models, middleware, auth routes | owner onboarding, role guard, tenant creation |
| Phase 2 | tables model/components/routes/services | QR uniqueness, owner CRUD, public route resolution |
| Phase 3 | table sessions, requests, customer UI | occupied-table protection, session resume, request creation |
| Phase 4 | owner/waiter dashboards, JS realtime integration | live updates, accept flow, polling fallback |
| Phase 5 | products model/components/storage service | product CRUD, image upload, tenant-scoped catalog rendering |
| Phase 6 | staff management, auth hardening, tests | cross-tenant isolation, owner/waiter permissions |
| Phase 7 | deployment docs/config | production smoke checklist and environment completeness |

---

# Dependencies and Sequencing Constraints

- Tenant foundation must land before any tenant-owned CRUD.
- Table model and QR flow must exist before customer sessions.
- Customer request lifecycle must exist before realtime dashboard work.
- Product catalog can be parallelized somewhat after tenant foundation, but should integrate after customer page structure exists.
- RLS should be added after Laravel tenancy is already validated, not before.

---

# Risks and Mitigations

## Risk: Incorrect tenant scoping causes data leakage
**Mitigation:** centralize scope/trait pattern, add explicit tenancy tests early.

## Risk: In-app browsers drop cookies for anonymous customers
**Mitigation:** design a signed resume fallback path in the customer session service.

## Risk: Realtime subscriptions drift from authorization intent
**Mitigation:** keep channel filters narrow and derive filter values from server-rendered tenant/session context.

## Risk: Storage/vendor logic leaks into UI components
**Mitigation:** use a dedicated image service layer.

## Risk: Overbuilding before the core waiter-call flow works
**Mitigation:** prioritize phases strictly around the MVP journey: auth → tables → customer session → request flow → realtime → catalog.

---

# Recommended Initial File Creation/Modification Set

## Likely first-wave modifications
- `C:\Karim\projects\Saas\smart-table\composer.json`
- `C:\Karim\projects\Saas\smart-table\package.json`
- `C:\Karim\projects\Saas\smart-table\bootstrap\app.php`
- `C:\Karim\projects\Saas\smart-table\routes\web.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\User.php`
- `C:\Karim\projects\Saas\smart-table\config\database.php`

## Likely first-wave additions
- `C:\Karim\projects\Saas\smart-table\app\Models\Tenant.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Table.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\TableSession.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Product.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Request.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Scopes\TenantScope.php`
- `C:\Karim\projects\Saas\smart-table\app\Models\Concerns\BelongsToTenant.php`
- `C:\Karim\projects\Saas\smart-table\app\Http\Middleware\IdentifyTenant.php`
- `C:\Karim\projects\Saas\smart-table\app\Http\Middleware\EnsureRole.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\TenantRegistrationService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\TableSessionService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\QrCodeService.php`
- `C:\Karim\projects\Saas\smart-table\app\Services\ProductImageService.php`
- tenant/table/session/request/product migrations
- Livewire components and matching Blade views for customer/owner/waiter flows
- docs for deployment/setup

---

# Approval Request

The implementation plan has been prepared and is ready for approval. Once approved, execution can proceed phase-by-phase starting with tenancy, auth, and role foundations.