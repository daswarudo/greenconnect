<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Meals;
use App\Models\CustomerMeal;
use Carbon\Carbon;

class MealPlanService
{
    protected $mealDistribution = [
        'breakfast' => 0.25,
        'snack' => 0.15,
        'lunch' => 0.30,
        'dinner' => 0.30,
    ];

    /**
     * Generate meal plan for a given customer.
     */
    public function generateMealPlan($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $dailyCalorie = $customer->daily_calorie;
        $subscriptionType = $customer->subscriptions()->latest()->first()->subscription_type_id;

        $mealPlan = [];

        foreach ($this->mealDistribution as $mealType => $ratio) {
            $targetCalories = $dailyCalorie * $ratio;

            // Query meals that fit the subscription and dietary restrictions
            $meal = Meals::where('subscription_type_id', $subscriptionType)
                ->where('meal_type', $mealType)
                ->where('allergy_milk', '<=', $customer->allergy_milk)
                ->where('allergy_gluten', '<=', $customer->allergy_gluten)
                ->orderByRaw("ABS(calories - $targetCalories) ASC") // Closest match to calorie target
                ->first();

            if ($meal) {
                // Save meal to customer_meals table
                CustomerMeal::create([
                    'customer_id' => $customer->customer_id,
                    'meal_id' => $meal->meal_id,
                    'meal_type' => $mealType,
                    'assigned_date' => Carbon::now(),
                ]);
                
                $mealPlan[] = [
                    'meal_type' => $mealType,
                    'meal_name' => $meal->meal_name,
                    'calories' => $meal->calories
                ];
            }
        }
        
        return $mealPlan;
    }
}
