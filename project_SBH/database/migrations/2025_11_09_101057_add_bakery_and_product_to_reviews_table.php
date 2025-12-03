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
        Schema::table('reviews', function (Blueprint $table) {
<<<<<<< HEAD
            
            $table->foreignId('bakery_id')->nullable()->after('user_id')->constrained()->onDelete('cascade');
            
=======
            // إضافة حقل اختياري لربط التقييم بمخبز
            $table->foreignId('bakery_id')->nullable()->after('user_id')->constrained()->onDelete('cascade');
            // إضافة حقل اختياري لربط التقييم بمنتج (يمكن استخدامه لاحقًا)
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
            $table->foreignId('product_id')->nullable()->after('bakery_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['bakery_id']);
            $table->dropColumn('bakery_id');
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
        });
    }
};
