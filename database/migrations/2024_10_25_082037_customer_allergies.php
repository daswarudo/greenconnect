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
        Schema::create('customer_allergies', function (Blueprint $table) {
            $table->id('customer_allergy_id'); // Primary Key
            $table->unsignedBigInteger('customer_id'); // Foreign Key referencing customers table
            $table->unsignedBigInteger('allergy_id'); // Foreign Key referencing allergies table
            $table->string('severity')->nullable(); // Severity of the allergy
            $table->string('reaction')->nullable(); // Reaction of the allergy
            $table->timestamps();
        
            // Foreign Key Constraints
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreign('allergy_id')->references('allergy_id')->on('allergies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
