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
        $table->foreignId('submission_id')->nullable()->constrained('service_submissions')->onDelete('cascade')->change();
    });
}

public function down()
{
    Schema::table('services', function (Blueprint $table) {
        $table->foreignId('submission_id')->constrained('service_submissions')->onDelete('cascade')->change();
    });
}

};
