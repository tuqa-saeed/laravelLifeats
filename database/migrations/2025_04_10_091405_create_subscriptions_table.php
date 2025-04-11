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
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->string('stripe_id')->nullable()->unique();
            $table->string('stripe_product')->nullable();
            $table->string('stripe_price')->nullable();
            $table->integer('quantity')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropColumn(['stripe_id', 'stripe_product', 'stripe_price', 'quantity']);
        });
    }
};
