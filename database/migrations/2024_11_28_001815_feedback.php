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
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('feedback_id'); // Using increments to create a primary key
            
            // Define other columns
            $table->string('feedback', 510)->nullable();
            
            // Foreign key to customer table (matching the int type in customer table)
            $table->unsignedInteger('customer_id')->nullable();
            $table->foreign('customer_id')
                ->references('customer_id')
                ->on('customer')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
