<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('table_waiter', function (Blueprint $table): void {
            $table->foreignId('table_id')
                ->constrained('tables')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->primary(['table_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('table_waiter');
    }
};