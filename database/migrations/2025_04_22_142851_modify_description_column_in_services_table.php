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
    Schema::table('services', function (Blueprint $table) {
        $table->text('description')->change(); // Change column type to TEXT
    });
}

public function down()
{
    Schema::table('services', function (Blueprint $table) {
        $table->string('description')->change(); // Revert back if necessary
    });
}

};
