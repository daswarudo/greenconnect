<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
    use HasFactory;

    // Define the table if it differs from the pluralized model name
    protected $table = 'meals'; 

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'meal_id';

    // If the 'meal_id' is not auto-incrementing (which is rare), set this property to false
    public $incrementing = true;

    // Define which attributes should be mass-assignable
    protected $fillable = [
        'meal_name', 'calories', 'description', 'meal_type', 'time', 'date', 'subscription_type_id',
        'allergy_wheat', 'allergy_milk', 'allergy_egg', 'allergy_peanut', 'allergy_fish', 
        'allergy_soy', 'allergy_shellfish', 'allergy_treenut', 'allergy_sesame', 'allergy_corn', 
        'allergy_chicken', 'allergy_beef', 'allergy_pork', 'allergy_lamb', 'allergy_gluten'
    ];

    protected $casts = [
        'date' => 'date',
    ];


    

    // Optionally, you can define the relationship with the SubscriptionType model
    public function subscriptionType()
    {
        return $this->belongsTo(SubscriptionType::class, 'subscription_type_id');
    }

     /**
     * Relationship: A meal can belong to many customers through a meal plan.
     */
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_meals', 'meal_id', 'customer_id');
    }


    public function customerMeals()
{
    return $this->hasMany(CustomerMeal::class, 'meal_id');
}

}

