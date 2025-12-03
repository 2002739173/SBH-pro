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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('product_name')->default('Spanish Bread');
<<<<<<< HEAD
            $table->string('bread_type'); 
            $table->string('bread_size'); 
            $table->integer('quantity'); 
=======
            $table->string('bread_type'); // France Bread, etc.
            $table->string('bread_size'); // Big, etc.
            $table->integer('quantity'); // Number of items
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
