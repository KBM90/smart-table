<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table): void {
            $table->unsignedBigInteger('tenant_id');

            $table->index('tenant_id', 'reviews_tenant_id_idx');

            $table->foreign('tenant_id', 'reviews_tenant_id_foreign')
                ->references('id')
                ->on('tenants')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table): void {
            $table->dropForeign('reviews_tenant_id_foreign');
            $table->dropIndex('reviews_tenant_id_idx');
            $table->dropColumn('tenant_id');
        });
    }
};