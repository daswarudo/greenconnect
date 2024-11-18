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
        Schema::create('meals', function (Blueprint $table) {
            $table->increments('meal_id'); // Using increments to create a primary key
            
            $table->string('meal_name', 50)->nullable();
            $table->decimal('calories', 8, 2);
            $table->string('description', 250)->nullable();

            $table->string('meal_type', 50)->nullable();
            $table->time('time')->nullable();
            $table->date('date')->nullable();

            //$table->string('status')->default('pending')->nullable();//moves to subs
            $table->boolean('allergy_wheat')->default(false);
            $table->boolean('allergy_milk')->default(false);
            $table->boolean('allergy_egg')->default(false);
            $table->boolean('allergy_peanut')->default(false);
            $table->boolean('allergy_fish')->default(false);
            $table->boolean('allergy_soy')->default(false);
            $table->boolean('allergy_shellfish')->default(false);
            $table->boolean('allergy_treenut')->default(false);
            $table->boolean('allergy_sesame')->default(false);
            $table->boolean('allergy_corn')->default(false);
            $table->boolean('allergy_chicken')->default(false);//
            $table->boolean('allergy_beef')->default(false);
            $table->boolean('allergy_pork')->default(false);
            $table->boolean('allergy_lamb')->default(false);
            $table->boolean('allergy_gluten')->default(false);

            $table->unsignedBigInteger('subscription_type_id')->nullable();
            $table->foreign('subscription_type_id')
            ->references('subscription_type_id')
            ->on('subscription_type')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
