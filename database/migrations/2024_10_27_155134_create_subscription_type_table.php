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
        Schema::create('subscription_type', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name', 50);
            $table->string('description', 255);
            $table->decimal('price',8,2);
            $table->boolean('isAvailable_Consult');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_type');
    }
};
