<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('table_sessions', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('table_id');
            $table->string('session_token', 40)->unique();
            $table->string('status')->default('active');
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();

            $table->index('tenant_id', 'table_sessions_tenant_id_idx');
            $table->index('table_id', 'table_sessions_table_id_idx');
            $table->index(['table_id', 'status']);
            $table->foreign('tenant_id', 'table_sessions_tenant_id_foreign')
                ->references('id')
                ->on('tenants')
                ->cascadeOnDelete();
            $table->foreign('table_id', 'table_sessions_table_id_foreign')
                ->references('id')
                ->on('tables')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_sessions');
    }
};
