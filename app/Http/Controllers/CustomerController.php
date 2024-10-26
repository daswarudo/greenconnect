<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'subscription_type_id' => 'required|exists:subscription_types,subscription_type_id',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'sex' => 'required|in:M,F',
            'age' => 'required|integer',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'address' => 'required|string',
            'contact_num' => 'required|string|min:11|max:11',
            'username' => 'required|string|unique:customers,username',
            'password' => 'required|string',
            'mode_of_payment' => 'required|exists:payment_methods,mode_of_payment',
            'reference_number' => 'required|string|unique:customers,reference_number',
            'activity_level' => 'required|in:Sedentary,Low Active,Active,Very Active',
            'allergies' => 'nullable|array',
            'allergies.*' => 'exists:allergies,allergy_id'
        ]);
    
        try {
            // Create a new Customer and hash the password
            $customer = Customer::create([
                'subscription_type_id' => $validatedData['subscription_type_id'],
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'sex' => $validatedData['sex'],
                'age' => $validatedData['age'],
                'height' => $validatedData['height'],
                'weight' => $validatedData['weight'],
                'address' => $validatedData['address'],
                'contact_num' => $validatedData['contact_num'],
                'diet_reco' => $request->input('diet_reco', null),
                'health_condition' => $request->input('health_condition', null),
                'activity_level' => $validatedData['activity_level'],
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
                'reference_number' => $validatedData['reference_number']
                ]);
    
            // Create Subscription for Customer
            $subscription = Subscription::create([
                'customer_id' => $customer->customer_id,
                'subscription_type_id' => $validatedData['subscription_type_id'],
                'start_date' => now(),
                'end_date' => now()->addDays(14)
            ]);
    
            // Attach selected allergies to the Customer
            if (isset($validatedData['allergies'])) {
                $customer->allergies()->attach($validatedData['allergies']);
            }
    
            return response()->json(['message' => 'Customer registered successfully!'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Registration failed: ' . $e->getMessage()], 500);
        }
        
    }
}
