<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MealPlanService;
use App\Models\CustomerMeal;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class MealPlanController extends Controller
{
    protected $mealPlanService;

    public function __construct(MealPlanService $mealPlanService)
    {
        $this->mealPlanService = $mealPlanService;
    }

    /**
     * Generate a meal plan for a specific customer.
     */
    public function generate($customerId)
    {
        $mealPlan = $this->mealPlanService->generateMealPlan($customerId);

        return response()->json([
            'success' => true,
            'meal_plan' => $mealPlan,
           'message' => "Meal plan generated for customer $customerId"
        ]);
    }

    /**
     * Fetch today's meal plan for a customer.
     */
    public function getTodayMealPlan($customerId)
    {
        $today = Carbon::now()->toDateString();

        $mealPlan = CustomerMeal::with('meal')
            ->where('customer_id', $customerId)
            ->whereDate('assigned_date', $today)
            ->get();

        return response()->json([
            'success' => true,
            'date' => $today,
            'meal_plan' => $mealPlan
        ]);
    }

    /**
     * Fetch the weekly meal plan for a customer.
     */
    public function getWeeklyMealPlan($customerId)
    {
        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek()->toDateString();

        $mealPlan = CustomerMeal::with('meal')
            ->where('customer_id', $customerId)
            ->whereBetween('assigned_date', [$startOfWeek, $endOfWeek])
            ->get();

        return response()->json([
            'success' => true,
            'week_start' => $startOfWeek,
            'week_end' => $endOfWeek,
            'meal_plan' => $mealPlan
        ]);
    }

    public static function resetWeeklyMeals() {
        // ✅ Log the reset process
        Log::info("🔄 Resetting customer meals for the new week...");

        // ✅ Delete old meals from the past week
        DB::table('customer_meals')->where('created_at', '<', Carbon::now()->startOfWeek())->delete();

        // ✅ Retrieve all customers to generate new meal plans
        $customers = Customer::all();

        foreach ($customers as $customer) {
            // ✅ Generate a new meal plan
            self::generateNewMealPlan($customer, $customer->daily_calorie);
        }

        Log::info("✅ Customer meals have been successfully reset for the new week!");
    }

    private static function generateNewMealPlan($customer, $dailyCalorie) {
        CustomerMeal::create([
            'customer_id' => $customer->id,
            'meal_name' => "Custom Meal for " . $customer->first_name,
            'calories' => $dailyCalorie / 3, // Divide into 3 meals
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Log::info("✅ New meal plan created for Customer ID: " . $customer->id);
    }
}
