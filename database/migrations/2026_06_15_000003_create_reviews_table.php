<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('waiter_id');
            $table->unsignedBigInteger('request_id');
            $table->unsignedTinyInteger('rating');  // 1–5
            $table->text('comment')->nullable();
            $table->timestamps();

            // One review per request
            $table->unique('request_id');

            $table->index('waiter_id', 'reviews_waiter_id_idx');

            $table->foreign('waiter_id', 'reviews_waiter_id_foreign')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('request_id', 'reviews_request_id_foreign')
                ->references('id')
                ->on('requests')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
