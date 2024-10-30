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
            $table->id('subscription_type_id'); // Primary Key
            $table->string('plan_name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->boolean('isAvailable_consult'); // true or false
            $table->timestamps(); // Adds created_at and updated_at columns
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