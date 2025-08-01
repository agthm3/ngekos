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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('boarding_house_id')
                ->constrained('boarding_houses')
                ->onDelete('cascade');
            $table->string('photo'); // Path to the testimonial photo
            $table->string('content'); // Content of the testimonial
            $table->integer('rating'); // Rating given in the testimonial
            $table->string('name'); // Name of the person giving the testimonial
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
