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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
<<<<<<< HEAD
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('cascade'); 
            $table->integer('rating')->unsigned(); 
            $table->text('notes')->nullable(); 
=======
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('cascade'); // يمكن ربط التقييم بطلب معين
            $table->integer('rating')->unsigned(); // 1 to 5 stars
            $table->text('notes')->nullable(); // ملاحظات التقييم
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
