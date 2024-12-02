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
use App\Models\Feedback;
use Illuminate\Validation\ValidationException;


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

    public function addMeals(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'meal_name' => 'nullable|string|max:500',
                'calories' => 'required|numeric|between:0,999999.99',
                'description' => 'nullable|string|max:250',
                'meal_type' => 'nullable|string|max:50',
                'time' => 'nullable|date_format:H:i',
                'date' => 'nullable|date',
                'subscription_type_id' => 'nullable|exists:subscription_type,subscription_type_id',

                // Allergy fields as nullable booleans
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
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        // Convert checkbox values to booleans: if checkbox is not checked, set to false
        $allergies = [
            'allergy_wheat', 'allergy_milk', 'allergy_egg', 'allergy_peanut',
            'allergy_fish', 'allergy_soy', 'allergy_shellfish', 'allergy_treenut',
            'allergy_sesame', 'allergy_corn', 'allergy_chicken', 'allergy_beef',
            'allergy_pork', 'allergy_lamb', 'allergy_gluten'
        ];

        foreach ($allergies as $allergy) {
            $request->merge([$allergy => $request->has($allergy)]);
        }

        // Proceed with database insertion
        try {
            DB::transaction(function () use ($request) {
                Meals::create([
                    'meal_name' => $request->input('meal_name'),
                    'calories' => $request->input('calories'),
                    'description' => $request->input('description'),
                    'meal_type' => $request->input('meal_type'),
                    'time' => $request->input('time'),
                    'date' => $request->input('date'),
                    'subscription_type_id' => $request->input('subscription_type_id'),
                    // Convert allergy fields to boolean
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

            session()->flash('message', 'Meal added successfully!');
            return redirect()->route('mealplans');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }
    public function edit($id)
    {
        $meal = Meals::findOrFail($id);
        return view('mealplansEdit', compact('meal'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'meal_name' => 'required|string',
            'meal_type' => 'required|string',
            'description' => 'required|string',
            'calories' => 'required|numeric',
            'time' => 'nullable|date_format:H:i',
            'date' => 'nullable|date',
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

        // Retrieve the meal record
        $meal = Meals::findOrFail($id);

        // Update basic details
        $meal->meal_name = $request->meal_name;
        $meal->meal_type = $request->meal_type;
        $meal->description = $request->description;
        $meal->calories = $request->calories;
        $meal->time = $request->time;
        $meal->date = $request->date;
        
        $meal->allergy_wheat = $request->boolean('allergy_wheat');
        $meal->allergy_milk = $request->boolean('allergy_milk');
        $meal->allergy_egg = $request->boolean('allergy_egg');
        $meal->allergy_peanut = $request->boolean('allergy_peanut');
        $meal->allergy_fish = $request->boolean('allergy_fish');
        $meal->allergy_soy = $request->boolean('allergy_soy');
        $meal->allergy_shellfish = $request->boolean('allergy_shellfish');
        $meal->allergy_treenut = $request->boolean('allergy_treenut');
        $meal->allergy_sesame = $request->boolean('allergy_sesame');
        $meal->allergy_corn = $request->boolean('allergy_corn');
        $meal->allergy_chicken = $request->boolean('allergy_chicken');
        $meal->allergy_beef = $request->boolean('allergy_beef');
        $meal->allergy_pork = $request->boolean('allergy_pork');
        $meal->allergy_lamb = $request->boolean('allergy_lamb');
        $meal->allergy_gluten = $request->boolean('allergy_gluten');

        // Update allergy fields
        

        // Update subscription type if provided
        if ($request->has('subscription_type_id')) {
            $meal->subscription_type_id = $request->subscription_type_id;
        }

        // Save the updated meal
        $meal->save();

        return redirect()->route('mealplans')->with('success', 'Meal updated successfully.');
    }


    public function destroy($id)
    {
        $meal = Meals::findOrFail($id);
        $meal->delete();

        return redirect()->route('mealplans')->with('success', 'Meal deleted successfully.');
    }

    /*public function viewSubs2()
    {
        $subscriptionTypes = SubscriptionType::all(); // Fetch all subscription types
        return view('mealplansEdit', compact('subscriptionTypes'));
    }*/
    public function viewSubs2($id)
    {
        $subscriptionTypes = SubscriptionType::all(); // Fetch all subscription types
        $meal = Meals::where('meal_id', $id)->first(); // Fetch meal by meal_id
        return view('mealplansEdit', compact('subscriptionTypes', 'meal'));
    }



}
