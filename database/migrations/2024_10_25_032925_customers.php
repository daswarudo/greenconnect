<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class customers extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id'); // Primary Key
            $table->unsignedBigInteger('subscription_type_id'); // FK for SUBSCRIPTION_TYPE table
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('sex', ['M', 'F']);
            $table->integer('age');
            $table->decimal('height', 5, 2); // Height in cm
            $table->decimal('weight', 5, 2); // Weight in kg
            $table->string('address');
            $table->string('contact_num', 11); // Changed to string for 11-digit numbers
            $table->string('diet_reco')->nullable();
            $table->string('health_condition')->nullable();
            $table->enum('food_preference', ['Pork', 'Fish', 'Beef', 'Chicken', 'Fruit', 'Vegetable'])->nullable();
            $table->enum('activity_level', ['Sedentary', 'Low Active', 'Active', 'Very Active']);
            $table->decimal('bmi', 5, 2)->nullable(); // BMI, nullable
            $table->integer('daily_calorie')->nullable(); // Daily Calorie, nullable
            $table->string('username')->unique();
            $table->string('password');
            $table->unsignedBigInteger('payment_method_id'); // FK for PAYMENT_METHOD table
            $table->string('reference_number')->unique(); // Unique for payment table reference
            $table->binary('profile_pic')->nullable();
            $table->timestamps();
        
            // Foreign Key Constraints
            $table->foreign('subscription_type_id')->references('subscription_type_id')->on('subscription_type')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('payment_method_id')->on('payment_methods');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
}
