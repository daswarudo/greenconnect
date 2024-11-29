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
            /*
             SELECT 
                a.first_name, 
                a.last_name, 
                b.subscription_id, 
                d.meal_id, 
                d.meal_name 
            FROM 
                customer a 
            INNER JOIN subscription b ON a.customer_id = b.customer_id 
            INNER JOIN subscription_type c ON b.subscription_type_id = c.subscription_type_id 
            INNER JOIN meal d ON c.subscription_type_id = d.subscription_type_id;

            alt may use this or not: 
            SELECT 
                a.first_name, 
                a.last_name, 
                b.subscription_id, 
                d.meal_id, 
                d.meal_name 
            FROM 
                customer a 
            INNER JOIN subscription b ON a.customer_id = b.customer_id 
            INNER JOIN subscription_type c ON b.subscription_type_id = c.subscription_type_id 
            INNER JOIN meal_subscription_type mst ON c.subscription_type_id = mst.subscription_type_id
            INNER JOIN meal d ON mst.meal_id = d.meal_id;



            anotha:
            
            select a. first_name, a.last_name, b.subscription_id, d. meal_id, d.meal_name
            from customer a
            inner join
            subscription b
            on a.customer_id = b.customer_id
            inner join
            subscription_type c
            on b.subscription_type_id = c.subscription_type_id
            inner join
            meal d
            on c.subscription_type_id = d.subscription_type_id
            where meal_type = 'snack'


            select a. first_name, a.last_name, b.subscription_id, d. meal_id, d.meal_name
from customer a
inner join
subscription b
on a.customer_id = b.customer_id
inner join
subscription_plan c
on b.subscription_plan_id = c.subscription_plan_id
inner join
meal d
on c.subscription_plan_id = d.subscription_plan_id
where d.meal_type = 'home'


SELECT 
    a.first_name, 
    a.last_name, 
    b.subscription_id, 
    c.plan_name, 
    d.meal_id, 
    d.meal_name 
FROM 
    customer a
INNER JOIN 
    subscription b ON a.customer_id = b.customer_id
INNER JOIN 
    subscription_type c ON b.subscription_type_id = c.subscription_type_id
INNER JOIN 
    meal d ON c.subscription_type_id = d.subscription_type_id
WHERE 
    a.customer_id = 1;

            */
            //viewable ra ni sa customer dili add edit delete 
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
