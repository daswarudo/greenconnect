<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer'; // Ensure this matches your database table name

    // Specify the primary key if it's not the default 'id'
    protected $primaryKey = 'customer_id';

    // If the primary key is not an incrementing integer (e.g., UUID), uncomment the next line
    // public $incrementing = false;

    protected $fillable = [
        'first_name', 'last_name', 'address', 'age', 'sex', 'weight', 'height', 
        'diet_recom', 'health_condition', 'bmi', 'daily_calorie', 'activity_level', 
        'username', 'password', 'profile_picture', 'subscription_id'
    ];

    protected $hidden = [
        'password',
    ];
}
