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
        Schema::create('allergies', function (Blueprint $table) {
            $table->id('allergy_id'); // Primary Key
            $table->string('allergy_type'); // Type of allergy, e.g., "Peanut", "Dairy"
            $table->string('allergy_source')->nullable(); // Source or specific substance, e.g., "Peanut butter"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergies');
    }
};
