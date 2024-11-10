<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Customer; 
use App\Models\Rdn;
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
            
            'mop' => 'required|string|max:255',
            'ref_number' => 'required|string|max:20',
            'customer_id' => 'nullable|exists:customer,customer_id', // Added validation for customer_id
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Use a transaction to ensure atomicity
        DB::transaction(function () use ($request) {
            // Create subscription record
            

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
                
                'profile_picture' => $request->hasFile('profile_picture') ? 
                    $request->file('profile_picture')->store('profile_pictures', 'public') : null,
            ]);

            // Create payment record
            
        });

        session()->flash('message', 'Registration successful! You can now log in.');

        // Redirect to login page after registration
        return redirect()->route('login');
    }
*/
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
        
        'mop' => 'required|string|max:255',
        'ref_number' => 'required|string|max:20',
        'subscription_type_id' => 'required|exists:subscription_type,subscription_type_id',
        
        // Add validation for food preferences
        'prefer_pork' => 'nullable|boolean',
        'prefer_beef' => 'nullable|boolean',
        'prefer_fish' => 'nullable|boolean',
        'prefer_chicken' => 'nullable|boolean',
        'prefer_veggie' => 'nullable|boolean',
    ]);

    // Return validation errors if any
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Use a transaction to ensure atomicity
    DB::transaction(function () use ($request) {
        

        // Create customer record with food preferences
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
            'profile_picture' => $request->hasFile('profile_picture') ? 
                $request->file('profile_picture')->store('profile_pictures', 'public') : null,

            // Store food preferences (defaults to false if unchecked)
            'prefer_pork' => $request->input('prefer_pork', false),
            'prefer_beef' => $request->input('prefer_beef', false),
            'prefer_fish' => $request->input('prefer_fish', false),
            'prefer_chicken' => $request->input('prefer_chicken', false),
            'prefer_veggie' => $request->input('prefer_veggie', false),
        ]);

        // Create subscription record
        $subscription = Subscriptions::create([
            'start_date' => now(),
            'end_date' => null,
            'mop' => $request->input('mop'),
            'ref_number' => $request->input('ref_number'),
            'subscription_type_id' => $request->input('subscription_type_id'),
            'subscription_type_id' => $request->input('subscription_type_id'),
            'customer_id' => $customer->customer_id, // Associate the customer
        ]);
        // Associate the customer with the subscription using the many-to-many relationship
        //$customer->subscriptions()->save($subscription);
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
    /*
   */
    public function loginUser(Request $request)
{
    // Validate the input
    $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    // Check if the user is a Customer
    $user = Customer::where('username', '=', $request->username)->first();

    // If not found as Customer, check if the user is an Rdn
    if (!$user) {
        $user = Rdn::where('username', '=', $request->username)->first();
    }

    // If the user exists (either Customer or Rdn)
    if ($user) {
        // Verify the password
        if (Hash::check($request->password, $user->password)) {
            // Flash a success message and track the user session
            session()->flash('message', 'Log In successful!');

            // Store the user session with their ID based on the model (Customer or Rdn)
            if ($user instanceof Customer) {
                $request->session()->put('loginId', $user->customer_id); // For Customer
                $request->session()->put('userType', 'customer');
                
                // Redirect to the customer-specific welcome page
                return redirect()->route('welcome');
            } elseif ($user instanceof Rdn) {
                $request->session()->put('loginId', $user->id); // For Rdn
                $request->session()->put('userType', 'rdn');
                
                // Redirect to the Rdn-specific welcome page
                return redirect()->route('rdnDashboard');
            }
        } else {
            // If the password is incorrect, send an error
            return back()->with('fail', 'Invalid username or password!');
        }
    } else {
        // If no user is found in either model, send an error
        return back()->with('fail', 'Account does not exist!');
    }
}

}
