<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            // One-to-many relationship with Tenant model
            $table->foreignId('tenant_id');

            // Cashier internal subscription name (e.g. 'default')
            $table->string('type');

            // Stripe identifiers
            $table->string('stripe_id')->unique();
            $table->string('stripe_status');
            $table->string('stripe_price')->nullable();

            // Multi-price support quantity
            $table->integer('quantity')->nullable();

            // Lifecycle timestamps
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

            // Index used by Cashier's billable scope queries
            $table->index(['tenant_id', 'stripe_status']);
        });

        Schema::create('subscription_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscription_id');
            $table->string('stripe_id')->unique();
            $table->string('stripe_product')->nullable();
            $table->string('stripe_price');
            $table->integer('quantity')->nullable();
            $table->timestamps();

            $table->index('subscription_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_items');
        Schema::dropIfExists('subscriptions');
    }
};
