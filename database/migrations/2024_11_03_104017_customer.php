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
            $table->increments('customer_id'); // Using increments to create a primary key
            
            // Define other columns
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
            $table->string('profile_picture')->nullable();

            $table->boolean('prefer_pork')->default(false);
            $table->boolean('prefer_beef')->default(false);
            $table->boolean('prefer_fish')->default(false);
            $table->boolean('prefer_chicken')->default(false);
            $table->boolean('prefer_veggie')->default(false);

            //$table->string('status')->default('pending')->nullable();//moves to subs
        
            $table->timestamps();
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
