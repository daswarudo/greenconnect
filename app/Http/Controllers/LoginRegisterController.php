<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubscriptionType;

class LoginRegisterController extends Controller
{
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
            'password' => 'required|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subscription_id' => 'nullable|exists:subscription_type,subscription_type_id'
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
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
        $customer->subscription_id = $request->input('subscription_id');

        // Handle profile picture upload if present
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $customer->profile_picture = $path;
        }

        // Save the customer record
        $customer->save();

        // Return success response
        return response()->json(['message' => 'Registration successful', 'customer' => $customer], 201);
    }

    public function viewSubs()
    {
        $subscriptionTypes = SubscriptionType::all(); // Fetch all subscription types
        return view('SignUp', compact('subscriptionTypes'));
    }
}
