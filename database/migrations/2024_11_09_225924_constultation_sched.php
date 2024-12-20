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
        Schema::create('consultation_sched', function (Blueprint $table) {
            $table->increments('consultation_sched_id'); // Primary key
        
            // Define other columns
            $table->time('time');
            $table->date('date');
            
            // Foreign key to customer table
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')
                ->references('customer_id')
                ->on('customer')
                ->onDelete('cascade');
            
            // Foreign key to rdn table (assuming rdn_id is unsignedBigInteger in rdn table)
            $table->unsignedBigInteger('rdn_id')->default(1); // Default RDN id (if there is only one RDN)
            $table->foreign('rdn_id')
                ->references('rdn_id')
                ->on('rdn')
                ->onDelete('cascade');


            $table->string('notes');
            
            // Add timestamps
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_sched');
    }
};
