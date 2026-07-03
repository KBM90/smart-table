<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('table_session_id');
            $table->unsignedBigInteger('request_id')->nullable();
            $table->integer('total_cents')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index('tenant_id', 'orders_tenant_id_idx');
            $table->index('table_session_id', 'orders_table_session_id_idx');
            $table->index('request_id', 'orders_request_id_idx');

            $table->foreign('tenant_id', 'orders_tenant_id_foreign')
                ->references('id')->on('tenants')->cascadeOnDelete();
            $table->foreign('table_session_id', 'orders_table_session_id_foreign')
                ->references('id')->on('table_sessions')->cascadeOnDelete();
            $table->foreign('request_id', 'orders_request_id_foreign')
                ->references('id')->on('requests')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};