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
use App\Models\ConsultationSched;
use App\Models\Meals;


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
        'contact_num' => 'nullable|string|max:20',
        'mop' => 'required|string|max:255',
        'ref_number' => 'required|string|max:20',
        'subscription_type_id' => 'required|exists:subscription_type,subscription_type_id',
        'prefer_pork' => 'nullable|boolean',
        'prefer_beef' => 'nullable|boolean',
        'prefer_fish' => 'nullable|boolean',
        'prefer_chicken' => 'nullable|boolean',
        'prefer_veggie' => 'nullable|boolean',

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
    ]);

    /* use this as basis
            $table->boolean('allergy_wheat')->default(false);
            $table->boolean('allergy_milk')->default(false);
            $table->boolean('allergy_egg')->default(false);
            $table->boolean('allergy_peanut')->default(false);
            $table->boolean('allergy_fish')->default(false);
            $table->boolean('allergy_soy')->default(false);
            $table->boolean('allergy_shellfish')->default(false);
            $table->boolean('allergy_treenut')->default(false);
            $table->boolean('allergy_sesame')->default(false);
            $table->boolean('allergy_corn')->default(false);
    */
    // Return validation errors if any
    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
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
                $request->file('profile_picture')->store('images', 'public') : 'images/freepik1-min.jpg',
            'contact_num' => $request->input('contact_num'),

            'prefer_pork' => $request->boolean('prefer_pork'),
            'prefer_beef' => $request->boolean('prefer_beef'),
            'prefer_fish' => $request->boolean('prefer_fish'),
            'prefer_chicken' => $request->boolean('prefer_chicken'),
            'prefer_veggie' => $request->boolean('prefer_veggie'),
            /* use this as basis
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
            */
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

        // Create subscription record
        Subscriptions::create([
            'start_date' => now(),
            'end_date' => null,
            'mop' => $request->input('mop'),
            'ref_number' => $request->input('ref_number'),
            'subscription_type_id' => $request->input('subscription_type_id'),
            'customer_id' => $customer->customer_id,
            'sub_status' => 'pending',
        ]);
    });

    session()->flash('message', 'Registration successful! You can now log in.');
    return redirect()->route('login');
}


    public function viewSubs()
    {
        $subscriptionTypes = SubscriptionType::all(); // Fetch all subscription types
        return view('signUp', compact('subscriptionTypes'));
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
  
      // Attempt to find the user as a Customer
      $user = Customer::where('username', '=', $request->username)->first();
  
      // If not found as Customer, check if the user is an Rdn
      if (!$user) {
          $user = Rdn::where('username', '=', $request->username)->first();
      }
  
      // If the user exists (either Customer or Rdn)
      if ($user) {
          // Verify the password
          if (Hash::check($request->password, $user->password)) {
              // Flash a success message
              session()->flash('message', 'Log In successful!');
  
              // Store the user ID and type in the session based on the model (Customer or Rdn)
              if ($user instanceof Customer) {
                  $request->session()->put('loginId', $user->customer_id); // Store customer ID
                  $request->session()->put('userType', 'customer');       // Store user type as 'customer'
                  
                  // Redirect to the customer-specific dashboard or welcome page
                  //return redirect()->route('custTest'); 
                  return redirect('/custTest');
              } elseif ($user instanceof Rdn) {
                  $request->session()->put('loginId', $user->rdn_id); // Store RDN ID
                  $request->session()->put('userType', 'rdn');        // Store user type as 'rdn'
                  
                  // Redirect to the Rdn-specific dashboard
                  return redirect()->route('rdnDashboard'); 
              }
          } else {
              // If the password is incorrect, return with an error
              return back()->withInput()->with('fail', 'Invalid username or password!');
          }
      } else {
          // If no user is found in either model, send an error
          return back()->with('fail', 'Account does not exist!');
      }
  }
  public function showCustomerDashboard()
    {
        $loginId = session()->get('loginId'); // Retrieve loginId
        $userType = session()->get('userType'); // Retrieve userType

        // Fetch the customer data based on the loginId
        $customer = Customer::where('customer_id', $loginId)->first();  

        // Check if values are set
        if ($loginId && $userType) {
            // Pass the data to the view
            return view('custTest', compact('userType', 'loginId', 'customer'));
        } else {
            // Redirect to login page if not authenticated
            return redirect()->route('login')->with('fail', 'Please log in first');
        }
    }

    /*
    public function showSubscriptions()
    {
        $subscriptions = Subscriptions::with(['customer', 'subscriptionType'])
            ->get();

        return view('rdnDashboard', compact('subscriptions'));
    }*/
    public function showSubscriptions()
    {
        $subscriptions = Subscriptions::with(['customer', 'subscriptionType'])->get();

        // Determine which view to return based on the route name
        $viewName = request()->routeIs('subscribers') ? 'subscribers' : 'rdnDashboard';

        return view($viewName, compact('subscriptions'));
    }

    public function editStatus($id)
    {
        // Find the subscription by its ID
        $subscription = Subscriptions::findOrFail($id);

        // Return the edit view with the subscription data
        return view('subscriptions.edit', compact('subscription'));
    }


    public function updateStatus(Request $request)
    {
       // Validate the customer_id
       $request->validate([
        'customer_id' => 'required|exists:subscriptions,customer_id', // Check if customer_id exists in subscriptions
        ]);

        // Update the sub_status of all subscriptions for the specific customer
        Subscriptions::where('customer_id', $request->customer_id)
                    ->update(['sub_status' => 'active']);

        // Redirect back to the rdnDashboard with a success message
        return redirect()->route('rdnDashboard')->with('status', 'All subscriptions for this customer are now active!');
    }

    
    public function viewDetails($id)
    {
        $customer = Customer::findOrFail($id);
        $subscription = Subscriptions::where('customer_id', $id)->first(); // Assuming a customer has one subscription

        //return view('customer.view', compact('customer', 'subscription'));
        return view('viewSubscriber', compact('customer', 'subscription'));

    }

    public function custEditRnd(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'customer_id' => 'nullable|exists:subscriptions,customer_id',// Ensure customer_id exists in subscriptions
            'daily_calorie' => 'nullable|numeric',
            'weight' => 'nullable|numeric|between:0,999.99',
            'bmi' => 'nullable|numeric|between:0,999.99',
        ]);

        // Start a transaction to ensure atomicity
        DB::transaction(function () use ($request, $id) {
            try {
                // Find the customer record by ID
                $customer = Customer::findOrFail($id);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                // If customer not found, return error message
                return redirect()->route('errorPage')->with('error', 'Customer not found!');
            }

            // Prepare the data to be updated
            $updateData = [
                'daily_calorie' => $request->input('daily_calorie', $customer->daily_calorie),
                'weight' => $request->input('weight', $customer->weight),
                'bmi' => $request->input('bmi', $customer->bmi),
            ];

            // If customer_id is provided in the request, update related subscription (optional)
            if ($request->has('customer_id')) {
                $updateData['customer_id'] = $request->customer_id;
            }

            // Perform the update
            $customer->update($updateData);
            //dd('Redirecting to subscribers');
            
            

            //return redirect()->route('subscribers')->with('status', 'Customer details updated successfully!');
            
        });
        return redirect()->route('subscribers')->with('status', 'Customer details updated successfully!')->setStatusCode(302);
    }

    public function showAppointTable()//ADD LATERS PROBS AFTER 50 PERCENT DEF
    {
        /*$subscriptions = Subscriptions::with(['customer', 'subscriptionType'])->get();

        // Determine which view to return based on the route name
        $viewName = request()->routeIs('subscribers') ? 'subscribers' : 'rdnDashboard';

        return view($viewName, compact('subscriptions'));*/
    }
    
}
