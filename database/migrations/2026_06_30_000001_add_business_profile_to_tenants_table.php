<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('contact_email')->nullable()->after('slug');
            $table->string('phone', 30)->nullable()->after('contact_email');
            $table->string('address')->nullable()->after('phone');
            $table->string('city', 120)->nullable()->after('address');
            $table->string('country', 120)->nullable()->after('city');
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn([
                'contact_email',
                'phone',
                'address',
                'city',
                'country',
            ]);
        });
    }
};
