<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Customer; 
use App\Models\SubscriptionType;
use App\Models\Subscriptions;
use App\Models\Payments;
use Illuminate\Support\Facades\Hash;



class LoginRegisterController extends Controller
{
    public function showSignUpPage()
    {
        return view('signUp'); // Make sure signUp.blade.php is located in the resources/views folder
    }
/*
    public function register(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'age' => 'nullable|integer',
            'sex' => 'nullable|string|max:50',
            'weight' => 'nullable|numeric|between:0,999.99',
            'height' => 'nullable|numeric|between:0,999.99',
            'diet_recom' => 'nullable|string|max:255',
            'health_condition' => 'nullable|string|max:255',
            'bmi' => 'nullable|numeric|between:0,999.99',
            'daily_calorie' => 'nullable|integer',
            'activity_level' => 'nullable|string|max:255',
            'username' => 'required|string|max:255|unique:customer,username',
            'password' => 'required|min:7|max:15',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subscription_type_id' => 'required|exists:subscription_type,subscription_type_id', // Expecting subscription type ID
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create subscription record
        $subscription = new Subscriptions();
        $subscription->start_date = now(); // Set start date to now
        $subscription->subscription_type_id = $request->input('subscription_type_id');
        $subscription->save(); // Save the subscription record

        // Create customer record
        $customer = new Customer();
        $customer->first_name = $request->input('first_name');
        $customer->last_name = $request->input('last_name');
        $customer->address = $request->input('address');
        $customer->age = $request->input('age');
        $customer->sex = $request->input('sex');
        $customer->weight = $request->input('weight');
        $customer->height = $request->input('height');
        $customer->diet_recom = $request->input('diet_recom');
        $customer->health_condition = $request->input('health_condition');
        $customer->bmi = $request->input('bmi');
        $customer->daily_calorie = $request->input('daily_calorie');
        $customer->activity_level = $request->input('activity_level');
        $customer->username = $request->input('username');
        $customer->password = Hash::make($request->input('password'));

        // Assign the subscription_id from the newly created subscription
        $customer->subscription_id = $subscription->subscription_id;

        // Handle profile picture upload if present
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $customer->profile_picture = $path;
        }

        // Save the customer record
        $customer->save();
        session()->flash('message', 'Registration successful! You can now log in.');

        // Redirect to login page after registration
        return redirect()->route('login');
    }*/
    public function register(Request $request)
{
    // Validation rules
    $validator = Validator::make($request->all(), [
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'age' => 'nullable|integer',
        'sex' => 'nullable|string|max:50',
        'weight' => 'nullable|numeric|between:0,999.99',
        'height' => 'nullable|numeric|between:0,999.99',
        'diet_recom' => 'nullable|string|max:255',
        'health_condition' => 'nullable|string|max:255',
        'bmi' => 'nullable|numeric|between:0,999.99',
        'daily_calorie' => 'nullable|integer',
        'activity_level' => 'nullable|string|max:255',
        'username' => 'required|string|max:255|unique:customer,username',
        'password' => 'required|min:7|max:15',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'subscription_type_id' => 'required|exists:subscription_type,subscription_type_id',
        'mode_of_payment' => 'required|string|max:255',
        'reference_number' => 'required|string|max:20|unique:payments,reference_number',
        'customer_id' => 'nullable|exists:customer,customer_id', // Added validation for customer_id
    ]);

    // Return validation errors if any
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Use a transaction to ensure atomicity
    DB::transaction(function () use ($request) {
        // Create subscription record
        $subscription = Subscriptions::create([
            'start_date' => now(),
            'subscription_type_id' => $request->input('subscription_type_id'),
        ]);

        // Create customer record
        $customer = Customer::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address' => $request->input('address'),
            'age' => $request->input('age'),
            'sex' => $request->input('sex'),
            'weight' => $request->input('weight'),
            'height' => $request->input('height'),
            'diet_recom' => $request->input('diet_recom'),
            'health_condition' => $request->input('health_condition'),
            'bmi' => $request->input('bmi'),
            'daily_calorie' => $request->input('daily_calorie'),
            'activity_level' => $request->input('activity_level'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'subscription_id' => $subscription->subscription_id,
            'profile_picture' => $request->hasFile('profile_picture') ? 
                $request->file('profile_picture')->store('profile_pictures', 'public') : null,
        ]);

        // Create payment record
        Payments::create([
            'customer_id' => $customer->customer_id, // error here!!!!!!
            'subscription_type_id' => $subscription->subscription_type_id,
            'mode_of_payment' => $request->input('mode_of_payment'),
            'reference_number' => $request->input('reference_number'),
        ]);
    });

    session()->flash('message', 'Registration successful! You can now log in.');

    // Redirect to login page after registration
    return redirect()->route('login');
}


    public function viewSubs()
    {
        $subscriptionTypes = SubscriptionType::all(); // Fetch all subscription types
        return view('SignUp', compact('subscriptionTypes'));
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = Customer::where('username','=',$request->username)->first();

        if($user)
        {
                if(Hash::check($request->password,$user->password))
                {
                    session()->flash('message', 'Log In successful!');
                    $request->session()->put('loginId',$user->customer_id);
                    return redirect()->route('welcome');
                }
                else
                    return back()->with('fail','Invalid email or password!');
        }
            
        else
            return back()->with('fail','Account does not exist!');
    }
}
