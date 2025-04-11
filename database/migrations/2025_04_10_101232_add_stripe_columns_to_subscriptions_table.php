<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->string('stripe_product')->nullable()->after('price'); // Stripe product ID
            $table->string('stripe_price')->nullable()->after('stripe_product'); // Stripe price ID
            $table->string('stripe_id')->nullable()->after('stripe_price'); // Optional: local subscription mapping to Stripe sub
            $table->string('stripe_status')->nullable()->after('stripe_id'); // Optional: to track Stripe's sub status
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn([
                'stripe_product',
                'stripe_price',
                'stripe_id',
                'stripe_status',
            ]);
        });
    }
};
