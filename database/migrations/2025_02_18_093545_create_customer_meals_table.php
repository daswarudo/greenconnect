<?php

use App\Models\Meals;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerMealsTable extends Migration
{
    public function up()
    {
        Schema::create('customer_meals', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('customer_id')->constrained('customer', 'customer_id')->onDelete('cascade');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customer')->onDelete('cascade');

            $table->unsignedInteger('meal_id');
            $table->foreign('meal_id')->references('meal_id')->on('meals')->onDelete('cascade');

          //  $table->foreignId('meal_id')->constrained('meals', 'meal_id')->onDelete('cascade');
            $table->enum('meal_type', ['breakfast', 'snack', 'lunch', 'dinner']);
            $table->date('assigned_date');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('customer_meals');
    }
}


