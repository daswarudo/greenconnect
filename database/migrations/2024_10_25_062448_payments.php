<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id'); // Primary Key
            $table->string('reference_number')->unique(); // Unique reference number
            $table->unsignedBigInteger('payment_method_id'); // Foreign Key for payment method
        
            $table->unsignedBigInteger('customer_id'); // Foreign Key to customers
            $table->unsignedBigInteger('subscription_type_id'); // Foreign Key to subscription_type
        
            // Foreign Key Constraints
            $table->foreign('reference_number')->references('reference_number')->on('customers')->onDelete('cascade');
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreign('subscription_type_id')->references('subscription_type_id')->on('subscription_type')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('payment_method_id')->on('payment_methods')->onDelete('cascade'); // Reference to payment_methods
        
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
