<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('requests', function (Blueprint $table): void {
            // Explicit assigned waiter (may differ from accepted_by for pre-assignment flows)
            $table->unsignedBigInteger('assigned_waiter_id')->nullable()->after('table_session_id');

            $table->index('assigned_waiter_id', 'requests_assigned_waiter_id_idx');
            $table->foreign('assigned_waiter_id', 'requests_assigned_waiter_id_foreign')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('requests', function (Blueprint $table): void {
            $table->dropForeign('requests_assigned_waiter_id_foreign');
            $table->dropIndex('requests_assigned_waiter_id_idx');
            $table->dropColumn('assigned_waiter_id');
        });
    }
};
