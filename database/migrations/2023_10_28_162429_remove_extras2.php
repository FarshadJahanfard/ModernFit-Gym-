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
        Schema::dropIfExists('laravel2step');
        Schema::dropIfExists('laravel_blocker');
        Schema::dropIfExists('laravel_blocker_types');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laravel2step');
        Schema::dropIfExists('laravel_blocker');
        Schema::dropIfExists('laravel_blocker_types');
    }
};
