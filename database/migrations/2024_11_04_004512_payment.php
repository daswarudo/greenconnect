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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id'); // Primary key with auto-increment
            $table->string('reference_number', 20)->unique(); // Unique reference number as string
            $table->string('mode_of_payment'); // Mode of payment as string

            // Foreign key for customer
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                  ->references('customer_id')
                  ->on('customer')
                  ->onDelete('cascade');

            // Foreign key for subscription type
            $table->unsignedBigInteger('subscription_type_id')->nullable();
            $table->foreign('subscription_type_id')
                  ->references('subscription_type_id')
                  ->on('subscription_type')
                  ->onDelete('cascade');
                    
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
