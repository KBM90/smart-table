<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            // Waiter profile fields
            $table->string('photo')->nullable()->after('name');
            $table->timestamp('joined_at')->nullable()->after('photo');
            $table->boolean('is_active')->default(true)->after('joined_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn(['photo', 'joined_at', 'is_active']);
        });
    }
};
