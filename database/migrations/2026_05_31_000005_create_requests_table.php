<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requests', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('table_session_id');
            $table->string('type')->default('call_waiter');
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('accepted_by')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();

            $table->index('tenant_id', 'requests_tenant_id_idx');
            $table->index('table_session_id', 'requests_table_session_id_idx');
            $table->index(['tenant_id', 'status']);
            $table->foreign('tenant_id', 'requests_tenant_id_foreign')
                ->references('id')
                ->on('tenants')
                ->cascadeOnDelete();
            $table->foreign('table_session_id', 'requests_table_session_id_foreign')
                ->references('id')
                ->on('table_sessions')
                ->cascadeOnDelete();
            $table->foreign('accepted_by', 'requests_accepted_by_foreign')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
