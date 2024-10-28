<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RDN extends Model
{
    protected $table = 'rdn'; // Specify the table name
    protected $fillable = ['username', 'password']; // Specify which attributes can be mass assigned

    // Optionally, define timestamps if you have created_at and updated_at columns
    public $timestamps = true;
}
