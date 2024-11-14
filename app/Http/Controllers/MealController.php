<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Customer; 
use App\Models\Rdn;
use App\Models\SubscriptionType;
use App\Models\Subscriptions;
use App\Models\Payments;
use App\Models\Meals;
use Illuminate\Support\Facades\Hash;
use App\Models\ConsultationSched;


class MealController extends Controller
{
    public function index()
    {
        // Fetch all meals
        $meals = Meals::all();

        // Pass the meals to the view
        return view('mealplans', compact('meals'));
    }

    public function show($meal_id)
    {
        // Retrieve the meal by its ID
        $meal = Meals::findOrFail($meal_id);

        // Return a view and pass the meal data to it
        //return view('mealplans', compact('meal'));
    }

    public function viewSubs()
    {
        $subscriptionTypes = SubscriptionType::all(); // Fetch all subscription types
        return view('mealplansAdd', compact('subscriptionTypes'));
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'meal_name' => 'nullable|string|max:50',
            'calories' => 'required|numeric|between:0,999999.99', // Use 'calorie' without the 's'
            'description' => 'nullable|string|max:250',
            'meal_type' => 'nullable|string|max:50',
            'time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'subscription_type_id' => 'nullable|exists:subscription_type,subscription_type_id',

            'allergy_wheat' => 'nullable|boolean',
            'allergy_milk' => 'nullable|boolean',
            'allergy_egg' => 'nullable|boolean',
            'allergy_peanut' => 'nullable|boolean',
            'allergy_fish' => 'nullable|boolean',
            'allergy_soy' => 'nullable|boolean',
            'allergy_shellfish' => 'nullable|boolean',
            'allergy_treenut' => 'nullable|boolean',
            'allergy_sesame' => 'nullable|boolean',
            'allergy_corn' => 'nullable|boolean',

            'allergy_chicken' => 'nullable|boolean',
            'allergy_beef' => 'nullable|boolean',
            'allergy_pork' => 'nullable|boolean',
            'allergy_lamb' => 'nullable|boolean',
            'allergy_gluten' => 'nullable|boolean',
        ]);

        DB::transaction(function () use ($request) {
            // Create meal record with validated data
            Meals::create([
                'meal_name' => $request->input('meal_name'),
                'calories' => $request->input('calories'), // Correct field name here
                'description' => $request->input('description'),
                'meal_type' => $request->input('meal_type'),
                'time' => $request->input('time'),
                'date' => $request->input('date'),
                'subscription_type_id' => $request->input('subscription_type_id'),

                'allergy_wheat' => $request->boolean('allergy_wheat'),
                'allergy_milk' => $request->boolean('allergy_milk'),
                'allergy_egg' => $request->boolean('allergy_egg'),
                'allergy_peanut' => $request->boolean('allergy_peanut'),
                'allergy_fish' => $request->boolean('allergy_fish'),
                'allergy_soy' => $request->boolean('allergy_soy'),
                'allergy_shellfish' => $request->boolean('allergy_shellfish'),
                'allergy_treenut' => $request->boolean('allergy_treenut'),
                'allergy_sesame' => $request->boolean('allergy_sesame'),
                'allergy_corn' => $request->boolean('allergy_corn'),
                'allergy_chicken' => $request->boolean('allergy_chicken'),
                'allergy_beef' => $request->boolean('allergy_beef'),
                'allergy_pork' => $request->boolean('allergy_pork'),
                'allergy_lamb' => $request->boolean('allergy_lamb'),
                'allergy_gluten' => $request->boolean('allergy_gluten'),
            ]);
        });

        //return redirect()->back()->with('success', 'Meal added successfully.');
        session()->flash('message', 'Registration successful! You can now log in.');
        return redirect()->route('mealplansAdd');
    }


}
