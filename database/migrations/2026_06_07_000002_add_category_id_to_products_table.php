<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            $table->unsignedBigInteger('category_id')->nullable()->after('tenant_id');

            $table->index('category_id', 'products_category_id_idx');
            $table->foreign('category_id', 'products_category_id_foreign')
                ->references('id')
                ->on('product_categories')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            $table->dropForeign('products_category_id_foreign');
            $table->dropIndex('products_category_id_idx');
            $table->dropColumn('category_id');
        });
    }
};
