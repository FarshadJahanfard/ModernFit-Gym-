<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDietAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::table('diet_assignments', function (Blueprint $table) {
            $table->boolean('active')->default(false)->after('note');
        });
    }

    public function down()
    {
        Schema::table('diet_assignments', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
}
