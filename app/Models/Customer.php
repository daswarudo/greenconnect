<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'first_name', 'last_name', 'address', 'age', 'sex', 'weight', 'height', 
        'diet_recom', 'health_condition', 'bmi', 'daily_calorie', 'activity_level', 
        'username', 'password', 'profile_picture', 'subscription_id'
    ];

    protected $hidden = [
        'password',
    ];
}
