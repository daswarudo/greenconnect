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
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Carbon;


class LoginRegisterController extends Controller
{
    public function showSignUpPage()
    {
        return view('signUp'); // Make sure signUp.blade.php is located in the resources/views folder
    }
/*
    
*/
public function register(Request $request)
{
    // Validation rules
    $validator = Validator::make($request->all(), [
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        //'age' => 'nullable|integer',
        'age' => 'nullable|date',
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
        'mop' => 'nullable|string|max:255',
        'ref_number' => 'nullable|string|max:20',
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

    session()->flash('message', 'Registration successful! Please wait for dietician confirmation.');
    return redirect()->route('login');
}


    public function viewSubs()
    {
        $subscriptionTypes = SubscriptionType::all(); // Fetch all subscription types
        return view('signUp', compact('subscriptionTypes'));
    }
    /*
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
      if ($user) {
        // Check if the customer has an active subscription
        $subscription = $user->subscriptions()->where('sub_status', 'active')->first();
        if (!$subscription) {
            return back()->with('fail', 'Your subscription is not active!');
        }
        } else {
            // If not found as Customer, check if the user is an Rdn
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
                  
                  return redirect('/custTest');
              } elseif ($user instanceof Rdn) {
                  $request->session()->put('loginId', $user->rdn_id); // Store RDN ID
                  $request->session()->put('userType', 'rdn');        // Store user type as 'rdn'
                  
                  // Redirect to the Rdn-specific dashboard
                  
                  return redirect('/rdnDashboard');
              }
          } else {
              // If the password is incorrect, return with an error
              return back()->withInput()->with('fail', 'Invalid username or password!');
          }
      } else {
          // If no user is found in either model, send an error
          return back()->with('fail', 'Account does not exist!');
      }
  }*/
  public function loginUser(Request $request)
    {
        // Validate the input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt to find the user as a Customer
        $user = Customer::where('username', '=', $request->username)->first();

        if (!$user) {
            // If not found as Customer, check if the user is an Rdn
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

                    // Authenticate the user
                    Auth::guard('customer')->login($user);

                    // Redirect to the customer-specific dashboard
                    return redirect('/customerSubscription');
                    //return redirect('/custTest');
                } elseif ($user instanceof Rdn) {
                    $request->session()->put('loginId', $user->rdn_id); // Store RDN ID
                    $request->session()->put('userType', 'rdn');        // Store user type as 'rdn'

                    // Authenticate the user
                    Auth::guard('rdn')->login($user);

                    // Redirect to the Rdn-specific dashboard
                    return redirect('/rdnDashboard');
                }
            } else {
                return back()->withInput()->with('fail', 'Invalid username or password!');
            }
        } else {
            return back()->with('fail', 'Account does not exist!');
        }
    }

    public function logout(Request $request)
    {
        // Clear the session data
        $request->session()->flush();

        // Flash a success message
        session()->flash('message', 'You have been logged out successfully.');

        // Redirect to the login page
        return redirect()->route('login');
    }
    /*
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
    */
    public function showCustomerDashboard()
    {
        // Retrieve the loginId and userType from the session
        $loginId = session()->get('loginId');
        $userType = session()->get('userType');

        // Ensure that userType is 'customer' and loginId is valid
        if ($loginId && $userType === 'customer') {
            // Fetch the customer data based on the loginId
            $customer = Customer::where('customer_id', $loginId)->first();

            if ($customer) {
                $appointments = DB::table('consultation_sched')
            ->join('customer', 'consultation_sched.customer_id', '=', 'customer.customer_id') // Join with customer table
            ->where('consultation_sched.customer_id', $loginId) // Filter by logged-in customer's ID
            ->select(
                'consultation_sched.consultation_sched_id',
                'consultation_sched.customer_id',
                'consultation_sched.date',
                'consultation_sched.time',
                'consultation_sched.notes',
                'customer.first_name',
                'customer.last_name'
            )
            ->get()
            ->map(function ($appointment) {
                // Format the date and time separately, then combine them into a full datetime for FullCalendar
                $appointment->formatted_date = Carbon::parse($appointment->date)->format('Y-m-d');
                $appointment->formatted_time = Carbon::parse($appointment->time)->format('H:i');

                // Combine date and time into a full datetime for FullCalendar (ISO 8601 format)
                $appointment->start = Carbon::parse($appointment->date . ' ' . $appointment->time)->toIso8601String();

                return $appointment;
            });

                // Pass the data to the view if customer exists
                return view('custTest', compact('userType', 'loginId', 'customer','appointments'));//
            } else {
                // Redirect if customer not found
                return redirect()->route('login')->with('fail', 'Customer not found');
            }
        } else {
            // Redirect to login page if not authenticated as a customer
            return redirect()->route('login')->with('fail', 'Please log in first as customer');
        }
    }

    public function showWelcomeLogged()//welcome if logged in
    {
       // Retrieve the loginId and userType from the session (if available)
        $loginId = session()->get('loginId');
        $userType = session()->get('userType');
        $user = null;

        // Fetch user data based on loginId and userType if available
        if ($loginId && $userType === 'customer') {
            $user = Customer::where('customer_id', $loginId)->first();
        } elseif ($loginId && $userType === 'rdn') {
            $user = Rdn::where('customer_id', $loginId)->first();
        }

        // Return the view regardless of whether the user is logged in
        return view('welcome', compact('userType', 'loginId', 'user'));
        
    }

    /*
    
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
            'height' => 'nullable|numeric|between:0,999.99',
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
                'height' => $request->input('height', $customer->height),
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

    public function showAppointTable()//ADD LATERS PROBS AFTER 50 PERCENT DEF//ASA???
    {
        /*$subscriptions = Subscriptions::with(['customer', 'subscriptionType'])->get();

        // Determine which view to return based on the route name
        $viewName = request()->routeIs('subscribers') ? 'subscribers' : 'rdnDashboard';

        return view($viewName, compact('subscriptions'));*/
    }
    
    public function edit($id)
    {
        // Fetch subscription with its related subscription type and customer
        $subscription = Subscriptions::with(['subscriptionType', 'customer'])->findOrFail($id);

        // Fetch all available subscription types for the dropdown
        $subscriptionTypes = SubscriptionType::all();

        // Return the edit view with the subscription and subscription types data
        return view('viewSubscription', compact('subscription', 'subscriptionTypes'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            
            'sub_status' => 'required|string|in:pending,active,disabled',
            'mop' => 'required|string|max:255',
            'ref_number' => 'required|string|max:20',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'subscription_type_id' => 'nullable|exists:subscription_type,subscription_type_id',
        ]);

        $subscription = Subscriptions::findOrFail($id);

        
        // Update subscription details
        
        $subscription->mop = $request->mop;
        $subscription->ref_number = $request->ref_number;
        $subscription->start_date = $request->start_date;
        $subscription->end_date = $request->end_date;
        $subscription->subscription_type_id = $request->subscription_type_id;

        // Update subscription status
        $subscription->sub_status = $request->sub_status;

        $subscription->save();

        return redirect()->route('subscribers')->with('success', 'Subscription updated successfully!');
    }



    ///EDIT CUSTOMER THEM SIDE
    public function custEdit(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'customer_id' => 'nullable|exists:subscriptions,customer_id',// Ensure customer_id exists in subscriptions
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            
            'age' => 'nullable|date',
            'sex' => 'nullable|string|max:50',
            'weight' => 'nullable|numeric|between:0,999.99',
            'height' => 'nullable|numeric|between:0,999.99',
            'diet_recom' => 'nullable|string|max:255',
            'health_condition' => 'nullable|string|max:255',
            'bmi' => 'nullable|numeric|between:0,999.99',
            'daily_calorie' => 'nullable|integer',
            'activity_level' => 'nullable|string|max:255',
            
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'contact_num' => 'nullable|string|max:20',
            
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

        // Start a transaction to ensure atomicity
        DB::transaction(function () use ($request, $id) {
            try {
                // Find the customer record by ID
                $customer = Customer::findOrFail($id);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                // If customer not found, return error message
                return redirect()->route('errorPage')->with('error', 'Customer not found!');
            }
            //if ($request->hasFile('profile_picture'))
            //$pic = $request->file('profile_picture')->getClientOriginalName();
            //$path = $request->file('profile_picture')->storeAs('public/profile/',$pic);
            //$relativePath = str_replace('public/', '', $path);
            /*
            $imageName = time().'.'.$request->image->extension();
    $request->image->move(public_path('images'), $imageName);
    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->image = 'images/'.$imageName;
            */
            
            // Prepare the data to be updated
            $updateData = [
                'first_name' => $request->input('first_name', $customer->first_name),
                'last_name' => $request->input('last_name', $customer->last_name),
                'address' => $request->input('address', $customer->address),
                'age' => $request->input('age', $customer->age),
                'sex' => $request->input('sex', $customer->sex),
                'weight' => $request->input('weight', $customer->weight),
                'height' => $request->input('height', $customer->height),
                'diet_recom' => $request->input('diet_recom', $customer->diet_recom),
                'health_condition' => $request->input('health_condition', $customer->health_condition),
                'bmi' => $request->input('bmi', $customer->bmi),
                'daily_calorie' => $request->input('daily_calorie', $customer->daily_calorie),
                'activity_level' => $request->input('activity_level', $customer->activity_level),
                'contact_num' => $request->input('contact_num', $customer->contact_num),

                'prefer_pork' => $request->input('prefer_pork', $customer->prefer_pork),
                'prefer_beef' => $request->input('prefer_beef', $customer->prefer_beef),
                'prefer_fish' => $request->input('prefer_fish', $customer->prefer_fish),
                'prefer_chicken' => $request->input('prefer_chicken', $customer->prefer_chicken),
                'prefer_veggie' => $request->input('prefer_veggie', $customer->prefer_veggie),

                'allergy_wheat' => $request->input('allergy_wheat', $customer->allergy_wheat),
                'allergy_milk' => $request->input('allergy_milk', $customer->allergy_milk),
                'allergy_egg' => $request->input('allergy_egg', $customer->allergy_egg),
                'allergy_peanut' => $request->input('allergy_peanut', $customer->allergy_peanut),
                'allergy_fish' => $request->input('allergy_fish', $customer->allergy_fish),
                'allergy_soy' => $request->input('allergy_soy', $customer->allergy_soy),
                'allergy_shellfish' => $request->input('allergy_shellfish', $customer->allergy_shellfish),
                'allergy_treenut' => $request->input('allergy_treenut', $customer->allergy_treenut),
                'allergy_sesame' => $request->input('allergy_sesame', $customer->allergy_sesame),
                'allergy_corn' => $request->input('allergy_corn', $customer->allergy_corn),
                //'profile_picture' => $pic,
                
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
        return redirect()->route('viewCust')->with('status', 'Customer details updated successfully!')->setStatusCode(302);
    }
    public function viewCustEdit()
    {
        // Retrieve the loginId and userType from the session
        $loginId = session()->get('loginId'); // Logged-in user's ID
        $userType = session()->get('userType'); // Logged-in user's type

        // Ensure only customers can create consultations
        if ($userType != 'customer') {
            return redirect()->route('dashboard')->with('fail', 'Only customers can make consultations.');
        }

        // Fetch the customer using the loginId
        $customer = Customer::findOrFail($loginId);

        // Hardcode the RDN ID (assuming only one RDN with ID = 1)
        $rdnId = 1; // or replace with logic to fetch the only RDN

        // Pass the necessary data to the view
        return view('customerEdit', compact('loginId', 'userType', 'customer', 'rdnId'));
    }
    public function viewCustSubs()
    {
        // Retrieve the loginId and userType from the session
        $loginId = session()->get('loginId'); // Logged-in user's ID
        $userType = session()->get('userType'); // Logged-in user's type

        // Ensure only customers can access this page
        if ($userType != 'customer') {
            return redirect()->route('dashboard')->with('fail', 'Only customers can access this page.');
        }

        // Fetch the customer using the loginId
        $customer = Customer::findOrFail($loginId);

        // Fetch subscriptions for the customer, including related subscription types
        $subscriptions = DB::table('subscriptions as s')
            ->join('subscription_type as st', 's.subscription_type_id', '=', 'st.subscription_type_id')
            ->join('customer as c', 's.customer_id', '=', 'c.customer_id')
            ->where('c.customer_id', $loginId)
            ->select('s.subscription_id', 's.start_date', 's.end_date', 's.mop', 's.ref_number', 's.sub_status', 'st.subscription_type_id', 'st.plan_name', 'c.customer_id')
            ->get();

        // Pass the necessary data to the view
        return view('customerSubscription', compact('loginId', 'userType', 'customer', 'subscriptions'));
    }
    public function viewSubsCreate()
    {
        // Retrieve the loginId and userType from the session
        $loginId = session()->get('loginId'); // Logged-in user's ID
        $userType = session()->get('userType'); // Logged-in user's type

        // Ensure only customers can access this page
        if ($userType != 'customer') {
            return redirect()->route('dashboard')->with('fail', 'Only customers can access this page.');
        }

        // Fetch the customer using the loginId
        $customer = Customer::findOrFail($loginId);

        $subscriptionTypes = SubscriptionType::all(); // Fetch all subscription types
        return view('customerSubscriptionAdd', compact('subscriptionTypes','customer'));
    }

    public function addSubscription(Request $request)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customer,customer_id',
            'subscription_type_id' => 'required|exists:subscription_type,subscription_type_id',
            'mop' => 'required|in:GCash,Maya,BPI',
            'ref_number' => 'required|string|max:255',
        ]);

        // Save the subscription data
        $subscription = new Subscriptions();
        $subscription->customer_id = $validatedData['customer_id'];
        $subscription->subscription_type_id = $validatedData['subscription_type_id'];
        $subscription->mop = $validatedData['mop'];
        $subscription->ref_number = $validatedData['ref_number'];
        $subscription->start_date = now(); // Set the current date as the start date
        $subscription->sub_status = 'pending'; // Default status
        $subscription->save();

        // Redirect with a success message
        //return redirect()->route('customerSubscriptionAdd')->with('success', 'Subscription added successfully!');
        return redirect()->back()->with('success', 'Customer details updated successfully!');

    }

    //KAPOY NA HIMO BAG O CONTROLLER JAJAJAJAJAJA
    public function storeFeedback(Request $request)
    {
        // Retrieve the loginId and userType from the session
        $loginId = session()->get('loginId'); // Logged-in user's ID
        $userType = session()->get('userType'); // Logged-in user's type

        // Ensure only customers can submit feedback
        if ($userType !== 'customer') {
            return redirect()->route('dashboard')->with('fail', 'Only customers can submit feedback.');
        }

        $request->validate([
            'feedback' => 'required|string|max:510',
        ]);

        // Use the loginId from the session as the customer_id
        Feedback::create([
            'feedback' => $request->feedback,
            'customer_id' => $loginId, // Assuming loginId corresponds to customer_id
        ]);

        return back()->with('success', 'Thank you for your feedback!');
    }
    public function showMyFeedback()
    {
        // Retrieve the loginId from the session
        $loginId = session()->get('loginId');

        // Fetch all feedback for the logged-in customer
        $feedbacks = Feedback::where('customer_id', $loginId)->latest()->get();

        return view('customerFeedback', compact('feedbacks'));
    }
    public function destroyFeedback($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return back()->with('success', 'Feedback deleted successfully');
    }
    public function getLoggedInCustomerMealDetails()
    {
        // Retrieve the loginId and userType from the session
        $loginId = session()->get('loginId'); // Logged-in user's ID
        $userType = session()->get('userType'); // Logged-in user's type

        // Ensure only customers can access this page
        if ($userType !== 'customer') {
            return redirect()->route('dashboard')->with('fail', 'Only customers can view meal details.');
        }

        // Get the customer based on the loginId
        $customer = Customer::where('customer_id', $loginId)->first();

        /*$customerMealDetails = Customer::with(['subscriptions.subscriptionType.meals'])
        ->join('subscriptions', 'customer.customer_id', '=', 'subscriptions.customer_id')
        ->join('subscription_type', 'subscriptions.subscription_type_id', '=', 'subscription_type.subscription_type_id')
        ->join('meals', 'subscription_type.subscription_type_id', '=', 'meals.subscription_type_id')
        ->select('customer.first_name', 'customer.last_name', 'subscriptions.subscription_id', 'meals.meal_id', 'meals.meal_name', 'subscription_type.plan_name')
        ->get();*/

        $details = DB::table('customer as a')
        ->join('subscriptions as b', 'a.customer_id', '=', 'b.customer_id')
        ->join('subscription_type as c', 'b.subscription_type_id', '=', 'c.subscription_type_id')
        ->join('meals as d', 'c.subscription_type_id', '=', 'd.subscription_type_id')
        ->select(
            'a.first_name',
            'a.last_name',
            'b.subscription_id',
            'c.plan_name',
            'd.meal_id',
            'd.meal_name'
        )
        ->where('a.customer_id', $loginId)
        ->where('b.sub_status', 'active') // Add condition to filter active subscriptions
        ->get();


        return view('customerMeals', compact('details'));
    }
    public function showCustomerMealsDetails()
    {
        // Fetch the required data with Eloquent relationships
        
        $customers = Customer::join('subscriptions', 'customer.customer_id', '=', 'subscriptions.customer_id')
            ->join('subscription_type', 'subscriptions.subscription_type_id', '=', 'subscription_type.subscription_type_id')
            ->join('meals', 'subscription_type.subscription_type_id', '=', 'meals.subscription_type_id')
            ->select(
                'customer.first_name',
                'customer.last_name',
                'subscriptions.subscription_id',
                'subscription_type.plan_name as subscription_type',
                'meals.meal_id',
                'meals.meal_name'
            )
            ->get();
           

        // Return the data to the view
        return view('mealsplansAllCust', compact('customers'));
    }
    
    public function custPass(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'customer_id' => 'nullable|exists:subscriptions,customer_id',// Ensure customer_id exists in subscriptions
            
            'new_password' => 'required|min:7|max:15',
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

            // Prepare the password to be updated
            $updateData = [
                'password' => Hash::make($request->new_password),
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
        return redirect()->route('subscribers')->with('status', 'Customer password updated successfully!')->setStatusCode(302);
    }




}
