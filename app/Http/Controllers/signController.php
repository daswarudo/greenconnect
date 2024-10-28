<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Allergy; // Import your Allergy model if you have one

class signController extends Controller
{
    // Display the first form
    public function index()
    {
        return view('sign1');
    }

    // Store data from the first page
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'address' => 'required|max:255',
            'sex' => 'required|in:M,F',
            'age' => 'required|integer',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'contact_num' => 'required|max:15',
            'diet_recom' => 'nullable|max:255',
            'health_condition' => 'nullable|max:255',
            'bmi' => 'nullable|numeric',
            'daily_calorie' => 'nullable|integer',
            'activity_level' => 'nullable|max:50',
        ]);

        // Store validated data in the session
        $request->session()->put($validated);
        
        return redirect()->route('sign2'); // Redirect to the second page
    }

    // Store data from the second page
    public function store2(Request $request)
    {
        // Validate data from the second page
        $validated = $request->validate([
            'username' => 'required|max:50|unique:customers',
            'password' => 'required|min:6',
            'profile_pic' => 'nullable|image|max:2048',
            'subscription_id' => 'required|integer',
            'allergies' => 'nullable|max:255',
        ]);

        // Get session data and merge with new data
        $customerData = $request->session()->all();
        $customerData = array_merge($customerData, $validated);

        // Handle file upload for profile picture if present
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename); // Save the file in the 'uploads' directory
            $customerData['profile_pic'] = $filename; // Add filename to customer data
        }

        // Create the customer record
        $customer = Customer::create($customerData);

        // Create an entry in the allergies table if applicable
        /*if (!empty($validated['allergies'])) {
            $allergy = new Allergy();
            $allergy->customer_id = $customer->id; // Assuming there is a customer_id foreign key in the allergies table
            $allergy->allergy = $validated['allergies'];
            $allergy->save();
        }*/

        // Clear session data
        $request->session()->forget(array_keys($customerData));

        return redirect()->route('some.success.route')->with('success', 'Customer data saved successfully.'); // Adjust to your success route
    }

    public function index2()
    {
        return view('sign2'); // Show the second form
    }
}
