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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bakery_id')->constrained()->onDelete('cascade'); // المنتج يتبع مخبز معين
            $table->string('name'); // Spanish Bread
            $table->decimal('price', 8, 2); // 12 $ a piece
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();

            // يمكن إضافة متوسط تقييم للمنتج هنا إذا لزم الأمر
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
