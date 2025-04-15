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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description');
            $table->string('address');
            $table->string('website');

            
            $table->foreignId('submission_id')->constrained('service_submissions')->onDelete('cascade');
            
            
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->on('cities')->references('id')->onDelete('cascade');
            
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->on('categories')->references('id')->onDelete('cascade');
            
            
            $table->string('email');
            $table->string('phone_number');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
