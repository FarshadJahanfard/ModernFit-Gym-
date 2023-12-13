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
        Schema::create('diet_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained('users');
            $table->integer('calories');
            $table->integer('protein');
            $table->integer('fats');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('diet_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('plan_id')->constrained('diet_plans');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_plans');
        Schema::dropIfExists('diet_assignments');
    }
};
