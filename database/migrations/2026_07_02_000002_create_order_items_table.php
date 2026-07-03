<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('product_name');
            $table->integer('unit_price_cents');
            $table->unsignedInteger('quantity');
            $table->timestamps();

            $table->index('order_id', 'order_items_order_id_idx');

            $table->foreign('order_id', 'order_items_order_id_foreign')
                ->references('id')->on('orders')->cascadeOnDelete();
            $table->foreign('product_id', 'order_items_product_id_foreign')
                ->references('id')->on('products')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};