<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMeal extends Model
{
    use HasFactory;

    protected $table = 'customer_meals'; // Define the correct table name

    protected $fillable = [
        'customer_id',
        'meal_id',
        'meal_type',
        'assigned_date',
    ];

    protected $casts = [
        'assigned_date' => 'date',
    ];

    /**
     * Relationship: A meal assignment belongs to a customer.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Relationship: A meal assignment belongs to a meal.
     */
    public function meal()
    {
        return $this->belongsTo(Meals::class, 'meal_id', 'meal_id');
    }
}
