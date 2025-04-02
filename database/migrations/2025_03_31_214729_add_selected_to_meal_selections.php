<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('meal_selections', function (Blueprint $table) {
            $table->boolean('selected')->default(false);
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('meal_selections', function (Blueprint $table) {
            //
        });
    }
};
