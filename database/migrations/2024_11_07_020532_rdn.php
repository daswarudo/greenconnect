<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rdn', function (Blueprint $table) {
            $table->bigIncrements('rdn_id'); // Auto-incrementing primary key renamed to rdn_id
            $table->string('username')->unique(); // Unique username column
            $table->string('password'); // Password column
            $table->timestamps(); // created_at and updated_at columns
        });

        // Insert default user
        DB::table('rdn')->insert([
            'username' => 'rdn',
            'password' => Hash::make('pass123'),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('rdn');
    }
};
