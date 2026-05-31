BEGIN;

DO $$
BEGIN
    IF NOT EXISTS (SELECT 1 FROM pg_roles WHERE rolname = 'bypass_rls') THEN
        CREATE ROLE bypass_rls NOLOGIN BYPASSRLS;
    END IF;
END
$$;

COMMENT ON ROLE bypass_rls IS 'Grant this role to the Laravel database user before enabling RLS so server-side queries bypass Supabase defense-in-depth policies.';

ALTER TABLE public.tenants ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.users ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.tables ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.table_sessions ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.requests ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.products ENABLE ROW LEVEL SECURITY;

DROP POLICY IF EXISTS tenants_tenant_isolation_select ON public.tenants;
DROP POLICY IF EXISTS tenants_tenant_isolation_insert ON public.tenants;
DROP POLICY IF EXISTS tenants_tenant_isolation_update ON public.tenants;
DROP POLICY IF EXISTS tenants_tenant_isolation_delete ON public.tenants;
CREATE POLICY tenants_tenant_isolation_select ON public.tenants FOR SELECT
    USING (id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tenants_tenant_isolation_insert ON public.tenants FOR INSERT
    WITH CHECK (id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tenants_tenant_isolation_update ON public.tenants FOR UPDATE
    USING (id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tenants_tenant_isolation_delete ON public.tenants FOR DELETE
    USING (id::text = current_setting('app.current_tenant_id', true));

DROP POLICY IF EXISTS users_tenant_isolation_select ON public.users;
DROP POLICY IF EXISTS users_tenant_isolation_insert ON public.users;
DROP POLICY IF EXISTS users_tenant_isolation_update ON public.users;
DROP POLICY IF EXISTS users_tenant_isolation_delete ON public.users;
CREATE POLICY users_tenant_isolation_select ON public.users FOR SELECT
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY users_tenant_isolation_insert ON public.users FOR INSERT
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY users_tenant_isolation_update ON public.users FOR UPDATE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY users_tenant_isolation_delete ON public.users FOR DELETE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));

DROP POLICY IF EXISTS tables_tenant_isolation_select ON public.tables;
DROP POLICY IF EXISTS tables_tenant_isolation_insert ON public.tables;
DROP POLICY IF EXISTS tables_tenant_isolation_update ON public.tables;
DROP POLICY IF EXISTS tables_tenant_isolation_delete ON public.tables;
CREATE POLICY tables_tenant_isolation_select ON public.tables FOR SELECT
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tables_tenant_isolation_insert ON public.tables FOR INSERT
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tables_tenant_isolation_update ON public.tables FOR UPDATE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY tables_tenant_isolation_delete ON public.tables FOR DELETE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));

DROP POLICY IF EXISTS table_sessions_tenant_isolation_select ON public.table_sessions;
DROP POLICY IF EXISTS table_sessions_tenant_isolation_insert ON public.table_sessions;
DROP POLICY IF EXISTS table_sessions_tenant_isolation_update ON public.table_sessions;
DROP POLICY IF EXISTS table_sessions_tenant_isolation_delete ON public.table_sessions;
CREATE POLICY table_sessions_tenant_isolation_select ON public.table_sessions FOR SELECT
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY table_sessions_tenant_isolation_insert ON public.table_sessions FOR INSERT
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY table_sessions_tenant_isolation_update ON public.table_sessions FOR UPDATE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY table_sessions_tenant_isolation_delete ON public.table_sessions FOR DELETE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));

DROP POLICY IF EXISTS requests_tenant_isolation_select ON public.requests;
DROP POLICY IF EXISTS requests_tenant_isolation_insert ON public.requests;
DROP POLICY IF EXISTS requests_tenant_isolation_update ON public.requests;
DROP POLICY IF EXISTS requests_tenant_isolation_delete ON public.requests;
CREATE POLICY requests_tenant_isolation_select ON public.requests FOR SELECT
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY requests_tenant_isolation_insert ON public.requests FOR INSERT
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY requests_tenant_isolation_update ON public.requests FOR UPDATE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY requests_tenant_isolation_delete ON public.requests FOR DELETE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));

DROP POLICY IF EXISTS products_tenant_isolation_select ON public.products;
DROP POLICY IF EXISTS products_tenant_isolation_insert ON public.products;
DROP POLICY IF EXISTS products_tenant_isolation_update ON public.products;
DROP POLICY IF EXISTS products_tenant_isolation_delete ON public.products;
CREATE POLICY products_tenant_isolation_select ON public.products FOR SELECT
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY products_tenant_isolation_insert ON public.products FOR INSERT
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY products_tenant_isolation_update ON public.products FOR UPDATE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true))
    WITH CHECK (tenant_id::text = current_setting('app.current_tenant_id', true));
CREATE POLICY products_tenant_isolation_delete ON public.products FOR DELETE
    USING (tenant_id::text = current_setting('app.current_tenant_id', true));

COMMENT ON POLICY requests_tenant_isolation_select ON public.requests IS 'Anon Supabase realtime remains effectively disabled because browser clients do not set app.current_tenant_id in v1.';
COMMENT ON POLICY table_sessions_tenant_isolation_select ON public.table_sessions IS 'Anon Supabase realtime remains effectively disabled because browser clients do not set app.current_tenant_id in v1.';

COMMIT;