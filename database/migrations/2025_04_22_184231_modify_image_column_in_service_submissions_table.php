<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyImageColumnInServiceSubmissionsTable extends Migration
{
    public function up()
    {
        Schema::table('service_submissions', function (Blueprint $table) {
            $table->string('image')->nullable()->change(); // Permettre à la colonne 'image' d'accepter NULL
        });
    }

    public function down()
    {
        Schema::table('service_submissions', function (Blueprint $table) {
            $table->string('image')->nullable(false)->change(); // Revenir à l'état d'origine, non nullable
        });
    }
}
