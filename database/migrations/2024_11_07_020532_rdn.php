<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('rdn', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('username')->unique(); // Unique username column
            $table->string('password'); // Password column
            $table->timestamps(); // Created_at and updated_at columns
        });
        DB::table('rdn')->insert([
            'username' => 'rdn',
            'password' => Hash::make('pass123'),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('rdn');
    }
};
