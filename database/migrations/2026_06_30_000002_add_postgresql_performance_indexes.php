<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public $withinTransaction = false;

    public function up(): void
    {
        if (DB::getDriverName() !== 'pgsql') {
            return;
        }

        DB::statement('CREATE EXTENSION IF NOT EXISTS pg_trgm');

        foreach ($this->indexes() as $statement) {
            DB::statement($statement);
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() !== 'pgsql') {
            return;
        }

        foreach ($this->indexNames() as $indexName) {
            DB::statement("DROP INDEX IF EXISTS public.{$indexName}");
        }
    }

    /**
     * @return list<string>
     */
    private function indexes(): array
    {
        return [
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS requests_active_queue_idx
                ON public.requests (tenant_id, created_at, id)
                INCLUDE (table_session_id, assigned_waiter_id, accepted_by)
                WHERE status IN ('pending', 'accepted')",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS requests_session_active_idx
                ON public.requests (table_session_id, created_at, id)
                WHERE status IN ('pending', 'accepted')",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS requests_resolved_waiter_stats_idx
                ON public.requests (tenant_id, accepted_by)
                INCLUDE (created_at, resolved_at)
                WHERE status = 'resolved'
                    AND accepted_by IS NOT NULL
                    AND resolved_at IS NOT NULL",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS requests_accepted_by_idx
                ON public.requests (accepted_by)
                WHERE accepted_by IS NOT NULL",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS table_sessions_active_tenant_idx
                ON public.table_sessions (tenant_id)
                WHERE status = 'active'",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS table_waiter_user_id_table_id_idx
                ON public.table_waiter (user_id, table_id)",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS products_tenant_active_sort_idx
                ON public.products (tenant_id, sort_order, name, id)
                WHERE deleted_at IS NULL AND is_active = true",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS products_tenant_activity_sort_idx
                ON public.products (tenant_id, is_active, sort_order, name, id)
                WHERE deleted_at IS NULL",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS products_tenant_category_active_sort_idx
                ON public.products (tenant_id, category_id, sort_order, name, id)
                WHERE deleted_at IS NULL AND is_active = true",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS products_category_id_idx
                ON public.products (category_id)
                WHERE category_id IS NOT NULL",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS tables_tenant_status_created_idx
                ON public.tables (tenant_id, status, created_at DESC, id)
                WHERE deleted_at IS NULL",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS tables_tenant_name_trgm_idx
                ON public.tables USING gin (name gin_trgm_ops)
                WHERE deleted_at IS NULL",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS products_tenant_name_trgm_idx
                ON public.products USING gin (name gin_trgm_ops)
                WHERE deleted_at IS NULL",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS users_tenant_role_name_idx
                ON public.users (tenant_id, role, name, id)
                WHERE deleted_at IS NULL",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS users_tenant_name_trgm_idx
                ON public.users USING gin (name gin_trgm_ops)
                WHERE deleted_at IS NULL",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS users_tenant_email_trgm_idx
                ON public.users USING gin (email gin_trgm_ops)
                WHERE deleted_at IS NULL",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS reviews_tenant_waiter_created_idx
                ON public.reviews (tenant_id, waiter_id, created_at DESC)
                INCLUDE (rating)",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS reviews_waiter_created_idx
                ON public.reviews (waiter_id, created_at DESC)",
            "CREATE INDEX CONCURRENTLY IF NOT EXISTS categories_sort_order_name_idx
                ON public.categories (sort_order, name, id)",
        ];
    }

    /**
     * @return list<string>
     */
    private function indexNames(): array
    {
        return [
            'requests_active_queue_idx',
            'requests_session_active_idx',
            'requests_resolved_waiter_stats_idx',
            'requests_accepted_by_idx',
            'table_sessions_active_tenant_idx',
            'table_waiter_user_id_table_id_idx',
            'products_tenant_active_sort_idx',
            'products_tenant_activity_sort_idx',
            'products_tenant_category_active_sort_idx',
            'products_category_id_idx',
            'tables_tenant_status_created_idx',
            'tables_tenant_name_trgm_idx',
            'products_tenant_name_trgm_idx',
            'users_tenant_role_name_idx',
            'users_tenant_name_trgm_idx',
            'users_tenant_email_trgm_idx',
            'reviews_tenant_waiter_created_idx',
            'reviews_waiter_created_idx',
            'categories_sort_order_name_idx',
        ];
    }
};
