<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rdn extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'rdn';

    // The primary key associated with the table.
    protected $primaryKey = 'rdn_id';

    // The attributes that are mass assignable.
    protected $fillable = [
        'username',
        'password',
    ];

    // The attributes that should be hidden for arrays.
    protected $hidden = [
        'password', // Hide the password attribute when the model is converted to an array or JSON
    ];

    // Optionally, if you're not using timestamps, disable them
    public $timestamps = true; // If you want to use timestamps

    public function consultations()
    {
        return $this->hasMany(ConsultationSched::class, 'rdn_id');
    }
}
