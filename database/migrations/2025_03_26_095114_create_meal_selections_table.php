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
        Schema::create('meal_selections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_schedule_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('meal_categories')->onDelete('set null');
            $table->foreignId('meal_id')->nullable()->constrained('meals')->onDelete('set null');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_selections');
    }
};
