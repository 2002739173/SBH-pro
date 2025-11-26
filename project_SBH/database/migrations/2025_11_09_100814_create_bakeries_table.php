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
            $table->string('name')->unique(); // اسم المخبز: ahmad backery
            $table->string('city'); // للمساعدة في الفلترة حسب المدينة
            $table->decimal('latitude', 10, 8)->nullable(); // للموقع الحالي
            $table->decimal('longitude', 11, 8)->nullable(); // للموقع الحالي
            $table->text('description')->nullable(); // الوصف: this is a backery that makes...
            $table->string('image_url')->nullable(); // صورة العرض
            $table->decimal('rating_average', 2, 1)->default(0.0); // متوسط التقييم (4.7)
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
