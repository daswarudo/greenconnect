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
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('address', 255);
            $table->integer('age');
            $table->enum('sex', ['M', 'F']);
            $table->decimal('weight', 5,2);
            $table->decimal('height', 5,2);
            $table->string('contact_num', 15);
            $table->string('diet_recom',255);
            $table->string('health_condition', 255);
            $table->decimal('bmi', 5,2);
            $table->integer('daily_calorie');
            $table->string('activity_level',50);
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('profile_pic');
            $table->foreignId('subscription_id');
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
