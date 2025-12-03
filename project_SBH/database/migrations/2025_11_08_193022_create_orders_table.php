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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('bakery_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique(); 
            $table->enum('status', ['Confirmed', 'In Progress', 'Picked Up', 'Delivered', 'Canceled'])->default('Confirmed');
            $table->dateTime('delivery_date')->nullable(); 
            $table->decimal('total_price', 8, 2); 
=======
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // صاحب الطلب
            $table->string('order_number')->unique(); // رقم الطلب #234235
            $table->enum('status', ['Confirmed', 'In Progress', 'Picked Up', 'Delivered', 'Canceled'])->default('Confirmed');
            $table->dateTime('delivery_date')->nullable(); // تاريخ التسليم المطلوب (Write the Date)
            $table->decimal('total_price', 8, 2); // 255 $
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
            $table->string('payment_method')->default('Cash on delivery');
            $table->string('special_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
