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
use App\Models\CustomerMeal;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Auth;


class MealController extends Controller
{
    /*public function index()
    {
        // Fetch all meals
        $meals = Meals::all();

        // Pass the meals to the view
        return view('mealplans', compact('meals'));
    }*/
    public function index()
    {
        // Fetch all meals with the related subscription type
        $meals = Meals::with('subscriptionType')->get();


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
            'description' => 'nullable|string|max:500',
            'meal_type' => 'nullable|string|max:50',
            'time' => 'nullable|date_format:H:i',
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

    // Generate the sequential date (no need for user input)
    $startOfWeek = Carbon::now()->startOfWeek();
    $totalMeals = Meals::count();

    // Assign a sequential day in the current week
    $assignedDate = $startOfWeek->copy()->addDays($totalMeals % 7)->format('Y-m-d');

    // Proceed with database insertion
    try {
        DB::transaction(function () use ($request, $assignedDate) {
            Meals::create([
                'meal_name' => $request->input('meal_name'),
                'calories' => $request->input('calories'),
                'description' => $request->input('description'),
                'meal_type' => $request->input('meal_type'),
                'time' => $request->input('time'),
                'date' => $assignedDate,  // Assign the generated sequential date
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








    /*public function addMeals(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'meal_name' => 'nullable|string|max:500',
                'calories' => 'required|numeric|between:0,999999.99',
                'description' => 'nullable|string|max:500',
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

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = $startOfWeek->copy()->endOfWeek();
    
        // Get the count of existing meals
        $totalMeals = Meals::count();
    
        // Assign a sequential day in the current week
        $assignedDate = $startOfWeek->copy()->addDays($totalMeals % 7)->format('Y-m-d');

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
    /*
    public function addMeals(Request $request)//temp
    {
        try {
            $validatedData = $request->validate([
                'meal_name' => 'nullable|string|max:500',
                'calories' => 'required|numeric|between:0,999999.99',
                'description' => 'nullable|string|max:500',
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

        // Generate a random date if not provided
        $randomDate = now()->addDays(rand(0, 35)); // Random date between today and 5 weeks
        $date = $request->input('date', $randomDate); // Use the input date or the generated random date

        // Proceed with database insertion
        try {
            DB::transaction(function () use ($request, $date) {
                Meals::create([
                    'meal_name' => $request->input('meal_name'),
                    'calories' => $request->input('calories'),
                    'description' => $request->input('description'),
                    'meal_type' => $request->input('meal_type'),
                    'time' => $request->input('time'),
                    'date' => $date, // Use the determined date here
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
*/
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
    $meal->date = $request->date; // Directly updating the date from request
    $meal->time = $request->time;

    // Update allergy fields
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



  
   /* public function viewAllMealPlans()
{
    // Fetch all customers with their assigned meals
    $customers = Customer::with(['customerMeals.meal'])->get();

    // Initialize meal plan storage
    $mealPlans = CustomerMeal::with('meal')
        ->get()
        ->groupBy([
            'customer_id',
            function ($item) {
                return Carbon::parse($item->assigned_date)->format('l'); // Group by day name
            }
        ]);

    foreach ($customers as $customer) {
        foreach ($customer->customerMeals as $customerMeal) {
            $dayOfWeek = \Carbon\Carbon::parse($customerMeal->assigned_date)->format('l');

            // Ensure initialization
            if (!isset($mealPlans[$customer->customer_id][$dayOfWeek])) {
                $mealPlans[$customer->customer_id][$dayOfWeek] = collect();
            }

            // Store meal data
            $mealPlans[$customer->customer_id][$dayOfWeek]->push($customerMeal);
        }
    }

    // 🔴 Debugging: Show what $mealPlans contains before rendering Blade
    dd($mealPlans[1]["Monday"]->toArray());

    return view('mealplansAllCust', compact('customers', 'mealPlans'));
}*/




//WITHOUT CALORIES

/*public function viewAllMealPlans()
{
    // Fetch customers with assigned meals
    $customers = Customer::with(['customerMeals.meal'])
        ->join('subscriptions', 'subscriptions.customer_id', '=', 'customer.customer_id')
        ->where('subscriptions.sub_status', 'active')
        ->select('customer.*', 'subscriptions.subscription_type_id')
        ->get();

    // Organize meals by customer and day
    $mealPlans = [];

    foreach ($customers as $customer) {
        foreach ($customer->customerMeals as $customerMeal) {
            $dayOfWeek = Carbon::parse($customerMeal->assigned_date)->format('l');

            // Ensure structure exists
            if (!isset($mealPlans[$customer->customer_id][$dayOfWeek])) {
                $mealPlans[$customer->customer_id][$dayOfWeek] = collect();
            }

            // Push meal entry
            $mealPlans[$customer->customer_id][$dayOfWeek]->push([
                'meal_name' => $customerMeal->meal->meal_name ?? 'No Meal',
                'meal_type' => $customerMeal->meal_type ?? 'Unknown',
                'calories' => $customerMeal->meal->calories ?? 'N/A',
                'description' => $customerMeal->meal->description ?? 'No description available',
            ]);
        }
    }

    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    
    return view('mealsplansAllCust', compact('mealPlans', 'customers', 'daysOfWeek'));
}*/





public function viewAllMealPlans()
{
    // Fetch customers with active subscriptions and meal plans
    $customers = Customer::with(['customerMeals.meal'])
        ->join('subscriptions', 'subscriptions.customer_id', '=', 'customer.customer_id')
        ->where('subscriptions.sub_status', 'active')
        ->select('customer.*', 'subscriptions.subscription_type_id', 'customer.activity_level')
        ->get();

    // Organize meals by customer and day
    $mealPlans = [];

    foreach ($customers as $customer) {
        // Convert birthday (date format) to age
        $customer->age = Carbon::parse($customer->age)->age;

        // Calculate TDEE based on age, gender, weight, height, and activity level
        $customer->tdee = $this->calculateTDEE(
            $customer->age,
            $customer->sex,
            $customer->weight,
            $customer->height,
            $customer->activity_level
        );

        foreach ($customer->customerMeals as $customerMeal) {
            $dayOfWeek = Carbon::parse($customerMeal->assigned_date)->format('l');

            if (!isset($mealPlans[$customer->customer_id][$dayOfWeek])) {
                $mealPlans[$customer->customer_id][$dayOfWeek] = collect();
            }

            $mealPlans[$customer->customer_id][$dayOfWeek]->push([
                'meal_name' => $customerMeal->meal->meal_name ?? 'No Meal',
                'meal_type' => $customerMeal->meal_type ?? 'Unknown',
                'calories' => $customerMeal->meal->calories ?? 'N/A',
                'description' => $customerMeal->meal->description ?? 'No description available',
            ]);
        }
    }

    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    return view('mealsplansAllCust', compact('mealPlans', 'customers', 'daysOfWeek'));
}




  
/*public function assignMealsToCustomers()     //without calorie count
{
    Log::info("🔥 assignMealsToCustomers() function started!");

    // Fetch customers with active subscriptions who **don't have assigned meals** yet
    $customers = Customer::with('activeSubscription')
        ->whereHas('activeSubscription') // Only get customers with an active subscription
        ->whereDoesntHave('customerMeals', function ($query) {
            $query->whereBetween('assigned_date', [now()->startOfWeek(), now()->endOfWeek()]);
        })
        ->get();

    if ($customers->isEmpty()) {
        Log::warning("❌ No new customers found who need meal assignments!");
        return response()->json(['success' => false, 'message' => 'No customers need meals assigned.'], 400);
    }

    // Define week days
    $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    foreach ($customers as $customer) {
        $subscriptionType = $customer->activeSubscription->subscription_type_id ?? null;

        if (!$subscriptionType) {
            Log::warning("⚠️ No active subscription found for Customer ID: {$customer->customer_id}");
            continue;
        }

        Log::info("🔹 Assigning meals for Customer ID: {$customer->customer_id} (Subscription Type: {$subscriptionType})");

        // Fetch meals based on the customer's subscription type, grouped by meal type (breakfast, lunch, etc.)
        $mealsByType = Meals::where('subscription_type_id', $subscriptionType)
            ->get()
            ->groupBy('meal_type');

        if ($mealsByType->isEmpty()) {
            Log::warning("⚠️ No meals found for Subscription Type: {$subscriptionType}");
            continue;
        }

        // Loop through each day of the week and assign meals
        foreach ($weekDays as $index => $day) {
            $date = now()->startOfWeek()->addDays($index)->format('Y-m-d'); // Get correct date for the day

            foreach ($mealsByType as $mealType => $meals) {
                if ($meals->isEmpty()) {
                    Log::warning("⚠️ No meals found for meal type '{$mealType}'");
                    continue;
                }

                // Pick a **random** meal for each meal type (breakfast, lunch, etc.)
                $selectedMeal = $meals->random();

                // Check if a meal is **already assigned** for this day and meal type (to prevent duplicates)
                $existingMeal = CustomerMeal::where([
                    'customer_id' => $customer->customer_id,
                    'meal_type' => $selectedMeal->meal_type,
                    'assigned_date' => $date,
                ])->exists();

                if (!$existingMeal) {
                    // Assign meal to the customer for the specific day
                    CustomerMeal::create([
                        'customer_id' => $customer->customer_id,
                        'meal_id' => $selectedMeal->meal_id,
                        'meal_type' => $selectedMeal->meal_type,
                        'assigned_date' => $date, // Assigning meals for each day
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    Log::info("⚠️ Meal already assigned for Customer ID: {$customer->customer_id} on {$day}");
                }
            }
        }
    }

    Log::info("✅ Meal assignments completed successfully!");
    return response()->json(['success' => true, 'message' => 'Meals assigned successfully!']);
}*/


public function assignMealsToCustomers()    // with unrestricted meal assignment for weight gain and allergen filtering
{
    Log::info("🔥 assignMealsToCustomers() function started!");

    // Fetch customers with active subscriptions who haven't been assigned meals yet
    $customers = Customer::with('activeSubscription')
        ->whereHas('activeSubscription') 
        ->whereDoesntHave('customerMeals', function ($query) {
            $query->whereBetween('assigned_date', [now()->startOfWeek(), now()->endOfWeek()]);
        })
        ->get();

    if ($customers->isEmpty()) {
        Log::warning("❌ No customers found who need meal assignments!");
        return response()->json(['success' => false, 'message' => 'No customers need meals assigned.'], 400);
    }

    // Define week days
    $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    foreach ($customers as $customer) {
        $subscriptionType = $customer->activeSubscription->subscription_type_id ?? null;

        if (!$subscriptionType) {
            Log::warning("⚠️ No active subscription found for Customer ID: {$customer->customer_id}");
            continue;
        }

        Log::info("🔹 Assigning meals for Customer ID: {$customer->customer_id} (Subscription Type: {$subscriptionType})");

        // **Convert Date to Age**
        $customerAge = Carbon::parse($customer->age)->age;
        $customerGender = $customer->gender ?? 'female'; 
        $customerWeight = $customer->weight ?? 70; 
        $customerHeight = $customer->height ?? 170; 
        $customerActivity = $customer->activity_level ?? 'active';

        // **🔥 Calculate the customer's TDEE**
        $dailyCalorieLimit = $this->calculateTDEE($customerAge, $customerGender, $customerWeight, $customerHeight, $customerActivity);

        // **🔥 Apply caloric surplus for weight gain**
        if ($subscriptionType == 'weight_gain') {
            $caloricSurplus = rand(500, 1000); // Randomly select surplus between 500-1000 kcal
            $dailyCalorieLimit += $caloricSurplus;
            Log::info("🍽 Weight Gain: Adding a surplus of {$caloricSurplus} kcal for Customer ID: {$customer->customer_id}, New Daily Limit: {$dailyCalorieLimit}");
        }

        Log::info("🧮 TDEE for Customer ID {$customer->customer_id}: {$dailyCalorieLimit} kcal/day");

        // **🔹 STEP 2: Save daily calorie limit to customer record**
        $customer->daily_calorie = $dailyCalorieLimit;  
        $customer->save();  // Save updated calorie info

        // **Fetch meals for the subscription type and filter out allergenic meals**
        $mealsQuery = Meals::where('subscription_type_id', $subscriptionType);

        // **Dynamically exclude meals that contain allergens the customer is allergic to**
        $allergenColumns = [
            'allergy_wheat', 'allergy_milk', 'allergy_egg', 'allergy_peanut', 'allergy_fish', 'allergy_soy', 
            'allergy_shellfish', 'allergy_treenut', 'allergy_sesame', 'allergy_corn', 'allergy_chicken', 
            'allergy_beef', 'allergy_pork', 'allergy_lamb', 'allergy_gluten'
        ];

        foreach ($allergenColumns as $allergen) {
            if ($customer->$allergen) { // If the customer is allergic to this, exclude meals that have it
                $mealsQuery->where($allergen, 0);
            }
        }

        $mealsByType = $mealsQuery->get()->groupBy('meal_type');

        if ($mealsByType->isEmpty()) {
            Log::warning("⚠️ No meals found for Subscription Type: {$subscriptionType} after allergen filtering.");
            continue;
        }

        // Assign meals **without calorie restrictions for weight gain**
        foreach ($weekDays as $index => $day) {
            $date = now()->startOfWeek()->addDays($index)->format('Y-m-d'); 
            $mealsAssigned = 0;

            foreach ($mealsByType as $mealType => $meals) {
                if ($meals->isEmpty()) continue;

                // **🔥 Weight Gain: Assign meals without checking calorie limit**
                if ($subscriptionType == 'weight_gain') {
                    $selectedMeal = $meals->sortByDesc('calories')->first(); // Highest calorie meal first
                } else {
                    // **Regular meal selection with daily calorie restriction**
                    $selectedMeal = $meals->random();
                }

                if ($selectedMeal) {
                    $mealsAssigned++;

                    CustomerMeal::create([
                        'customer_id' => $customer->customer_id,
                        'meal_id' => $selectedMeal->meal_id,
                        'meal_type' => $selectedMeal->meal_type,
                        'assigned_date' => $date, 
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // **🔥 Ensure all meal types (breakfast, lunch, dinner, snacks) are assigned**
            $mealTypesNeeded = ['breakfast', 'lunch', 'dinner', 'snacks'];
            $assignedMealTypes = CustomerMeal::where('customer_id', $customer->customer_id)
                ->where('assigned_date', $date)
                ->pluck('meal_type')
                ->toArray();

            foreach ($mealTypesNeeded as $neededMealType) {
                if (!in_array($neededMealType, $assignedMealTypes) && isset($mealsByType[$neededMealType])) {
                    Log::warning("⚠️ Missing $neededMealType for Customer ID {$customer->customer_id}. Assigning a fallback meal.");
                    $fallbackMeal = $mealsByType[$neededMealType]->random();
                    CustomerMeal::create([
                        'customer_id' => $customer->customer_id,
                        'meal_id' => $fallbackMeal->meal_id,
                        'meal_type' => $neededMealType,
                        'assigned_date' => $date,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    Log::info("✅ Meal assignments completed successfully!");
    return response()->json(['success' => true, 'message' => 'Meals assigned successfully!']);
}














public function viewCustomerMeals()
{
    // 🔥 Use the correct auth guard (adjust based on your setup)
    $customer = Auth::guard('customer')->user();

    if (!$customer) {
        abort(403, 'Unauthorized'); // Prevent unauthorized access
    }

    // Get customer ID
    $customerId = $customer->customer_id;

    // Fetch meals assigned to this customer
    $meals = CustomerMeal::with('meal')
        ->where('customer_id', $customerId)
        ->orderBy('assigned_date', 'asc')
        ->get()
        ->groupBy(function ($meal) {
            return Carbon::parse($meal->assigned_date)->format('l'); // Group by day of the week
        });

    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    return view('customerMeals', compact('meals', 'daysOfWeek'));
}

private function getGoalFromSubscription($subscriptionTypeId)
{
    $subscriptionGoals = [
        1 => 'weight loss',
        2 => 'weight gain',
        3 => 'maintenance',
        // Add more if you have other subscription types
    ];

    return $subscriptionGoals[$subscriptionTypeId] ?? 'maintenance';
}


private function calculateTDEE($age, $gender, $weight, $height, $activity_level)
{
    // BMR calculation (Mifflin-St Jeor Equation)
    if ($gender == 'male') {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
    } else {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
    }

    // TDEE based on activity level
    switch (strtolower($activity_level)) {
        case 'sedentary':
            return $bmr * 1.2;
        case 'low active':
            return $bmr * 1.375;
        case 'active':
            return $bmr * 1.55;
        case 'very active':
            return $bmr * 1.725;
        default:
            return $bmr * 1.2; // Default to sedentary
    }
}











}