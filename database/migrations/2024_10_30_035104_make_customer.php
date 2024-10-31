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
        Schema::create('customer', function (Blueprint $table) {
            $table->integer('customer_id')->autoIncrement()->primary();

            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->integer('age')->nullable();
            $table->string('sex', 50)->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('height', 5, 2)->nullable();
            $table->string('diet_recom', 255)->nullable();
            $table->string('health_condition', 255)->nullable();
            $table->decimal('bmi', 5, 2)->nullable();
            $table->integer('daily_calorie')->nullable();
            $table->string('activity_level')->nullable();
            $table->string('username', 255)->unique();
            $table->string('password');
            $table->string('profile_picture')->nullable(); // For storing profile picture path
            
            // Foreign key to subscription_type table
            $table->unsignedBigInteger('subscription_type_id')->nullable();
            $table->foreign('subscription_type_id')->references('subscription_type_id')->on('subscription_type')->onDelete('cascade');

            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
