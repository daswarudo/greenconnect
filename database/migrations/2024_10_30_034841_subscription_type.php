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
        Schema::create('subscription_type', function (Blueprint $table) {//subscription_plan
            $table->id('subscription_type_id'); // Primary Key
            $table->string('plan_name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->boolean('isAvailable_consult'); // true or false
            $table->timestamps(); // Adds created_at and updated_at columns
        });
        DB::table('subscription_type')->insert([
            [
                'plan_name' => 'Weight-Loss Plan',
                'description' => 'Low-calorie meals curated for weight loss.',
                'price' => 3000.00,
                'isAvailable_consult' => true, // available for consultation
            ],
            [
                'plan_name' => 'Weight-Gain Plan',
                'description' => 'High-calorie meals designed for healthy weight gain.',
                'price' => 3300.00,
                'isAvailable_consult' => true, // available for consultation
            ],
            [
                'plan_name' => 'Therapeutic Diet',
                'description' => 'Customized for individuals with specific health needs.',
                'price' => 3500.00,
                'isAvailable_consult' => false, // not available for consultation
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_type');
    }
};
