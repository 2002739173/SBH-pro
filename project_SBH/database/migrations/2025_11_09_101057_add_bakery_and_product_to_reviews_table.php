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
            
            $table->foreignId('bakery_id')->nullable()->after('user_id')->constrained()->onDelete('cascade');
            
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
