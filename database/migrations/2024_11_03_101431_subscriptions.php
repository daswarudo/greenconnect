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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id('subscription_id'); // Primary Key
            $table->date('start_date');
            $table->date('end_date')->nullable(); // Optional end date

            //$table->foreignId('subscription_type_id')->constrained('subscription_types'); // Foreign Key
            $table->unsignedBigInteger('subscription_type_id')->nullable();
            $table->foreign('subscription_type_id')
            ->references('subscription_type_id')
            ->on('subscription_type')
            ->onDelete('cascade');

            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
