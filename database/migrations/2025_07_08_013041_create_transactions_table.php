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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Unique code for the transaction
            $table->foreignId('boarding_house_id')
                ->constrained('boarding_houses')
                ->onDelete('cascade'); // Foreign key to the boarding house
            $table->foreignId('room_id')
                ->constrained('rooms')
                ->onDelete('cascade'); // Foreign key to the room
            $table->string('name'); // Name of the person making the transaction
            $table->string('email'); // Email of the person making the transaction
            $table->string('phone_number'); // Phone number of the person making the transaction
            $table->enum('payment_method', ['down_payment', 'full_payment'])->nullable(); // Payment method used
            $table->string('payment_status')->nullable(); // Status of the payment
            $table->date('start_date')->nullable(); // Date of the payment
            $table->integer('duration')->nullable(); // Duration of the transaction in months
            $table->integer('total_amount')->nullable(); // Total amount for the transaction
            $table->date('transaction_date')->nullable(); // Date of the transaction
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
