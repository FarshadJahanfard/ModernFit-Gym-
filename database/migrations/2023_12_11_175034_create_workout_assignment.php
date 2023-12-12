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
        Schema::create('workout_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('workout_plan_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('users');
            $table->foreign('workout_plan_id')->references('id')->on('workout_plans');
        });

        Schema::create('workout_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignment_id');
            $table->unsignedBigInteger('exercise_id');
            $table->integer('sets');
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('assignment_id')->references('id')->on('workout_assignments');
            $table->foreign('exercise_id')->references('id')->on('workout_exercises');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_assignments');
        Schema::dropIfExists('workout_logs');
    }
};
