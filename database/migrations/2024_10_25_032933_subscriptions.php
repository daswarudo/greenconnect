<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id('subscription_id'); // Auto-incremented primary key
            $table->unsignedBigInteger('customer_id'); // Foreign key for the customer
            $table->unsignedBigInteger('subscription_type_id'); // Foreign key for subscription type
            $table->date('start_date'); // Subscription start date
            $table->date('end_date'); // Subscription end date
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreign('subscription_type_id')->references('subscription_type_id')->on('subscription_type')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};
