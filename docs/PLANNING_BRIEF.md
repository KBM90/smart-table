@Multi-model-planner

Produce a comprehensive architecture and phased implementation plan for a multi-tenant SaaS called "smart-table" for cafes/restaurants.

## Tech stack (locked)
- Backend: Laravel (already scaffolded at C:\Karim\projects\Saas\smart-table)
- Frontend: Laravel Blade + Livewire 3 + Alpine.js (mobile-first)
- Database: Supabase (Postgres) - use Supabase Postgres directly via Laravel's pgsql connection. Use Supabase Realtime for live updates from customer pages and waiter dashboards.
- Storage: Supabase Storage for product/catalog images + a built-in image library shipped with the app
- Auth: Laravel's own auth (Breeze or Fortify) for owners and waiters. Customers are anonymous (no login).
- Local first, deploy target: Hostinger (shared/VPS - keep deploy assumptions realistic)

## Product scope
1. Customer flow (no login)
   - Scans QR on table -> opens a public URL bound to that table.
   - Sees: a "Call Waiter" button + link to catalog (browse only, no ordering checkout in v1).
   - On click: a session/request is created, button becomes a live timer/status ("Waiting...", "Accepted by waiter X").
   - QR is "locked" to the active session: re-scans during an open session resume the same session. New customer can't open a new session on a busy table until owner/waiter marks the table free.
2. Business owner
   - Register/login. Each owner = a tenant. Strict tenant isolation.
   - Dashboard: live list of incoming customer requests (Realtime). Click a request to mark "responded/accepted" -> customer page updates instantly.
   - Tables CRUD. Each table auto-generates a printable QR (PNG/PDF download).
   - Catalog CRUD (name, price, image). Image: upload from device (Supabase Storage) OR pick from a built-in image library.
   - Waiter user management: create/remove waiters (name, email, password). Waiters belong to the owner's tenant.
   - Mark table as "free" (closes active session, unlocks QR).
3. Waiter
   - Login. Sees ONLY the customer requests for their tenant. Can accept/respond. Cannot access catalog/tables/users management.

## Deliverables I need from the plan
1. Database schema - full ER: tenants/owners, users (with role: owner/waiter), tables, table_sessions (the "lock"), requests, products, product_images, image_library. Include Supabase RLS policies (defense-in-depth) and indexes.
2. Auth & roles - how Laravel auth + middleware enforces tenant scoping and owner-vs-waiter permissions. Global scopes for tenancy.
3. Real-time strategy - exactly how customer page subscribes to its session (Supabase Realtime channel design) and how owner/waiter dashboards subscribe to incoming requests. Fallback (polling) if Realtime fails.
4. QR / table session lifecycle - URL design (signed? token?), how a session locks the QR, how re-scan resumes, how owner unlocks.
5. Livewire component map - list every Livewire component, its responsibilities, and which page it lives on. Customer page, owner dashboard, waiter dashboard, catalog editor, tables manager, users manager, login/register.
6. Routes & controllers - full route list (web + any internal API), grouped by guard.
7. File/folder structure inside the existing Laravel project.
8. Image handling - upload pipeline to Supabase Storage, image library seeding, how to swap, max sizes/formats.
9. Phased build roadmap - concrete phases (e.g. Phase 1: tenancy + auth; Phase 2: tables + QR; Phase 3: customer page + call waiter; Phase 4: realtime requests; Phase 5: catalog; Phase 6: waiter role; Phase 7: polish + deploy). Each phase = explicit acceptance criteria so we can verify before moving on.
10. Local dev setup - exact env vars, Supabase project setup steps, how to run locally (php artisan serve + npm run dev), seed data.
11. Risks & open questions - anything ambiguous, anything Hostinger might break (websockets? long polling?), and recommended decisions.

Output a single plan document saved to the project at `docs/PLAN.md` inside C:\Karim\projects\Saas\smart-table and return the path. Do not start coding - planning only.
