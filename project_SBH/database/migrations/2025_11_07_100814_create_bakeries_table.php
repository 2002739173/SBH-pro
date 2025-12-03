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
        Schema::create('bakeries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); 
            $table->string('city'); 
            $table->decimal('latitude', 10, 8)->nullable(); 
            $table->decimal('longitude', 11, 8)->nullable(); 
            $table->text('description')->nullable(); 
            $table->string('image_url')->nullable(); 
            $table->decimal('rating_average', 2, 1)->default(0.0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bakeries');
    }
};
