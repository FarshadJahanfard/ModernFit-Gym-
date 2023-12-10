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
        Schema::create('workout_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('workout_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workout_plan_id');
            $table->string('exercise_name');
            $table->integer('amount');
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('workout_plan_id')->references('id')->on('workout_plans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('workout_exercises');
        Schema::dropIfExists('workout_plans');
    }
};
