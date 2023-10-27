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
        // Remove the foreign key and column from the profiles table
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['theme_id']); // Make sure to use an array for the column name
            $table->dropColumn('theme_id');
        });

        // Drop the themes table
        Schema::dropIfExists('themes');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // If you want to rollback the changes, you can recreate the themes table
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Add any other columns as needed
            $table->timestamps();
        });

        // Recreate the foreign key and column in the profiles table
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreignId('theme_id')->constrained();
        });
    }
};
