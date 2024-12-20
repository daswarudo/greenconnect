
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribers</title>

    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">   ==>login css-->
	<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js'></script>

    <!-- temporary-->
	

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/viewsubscriber.css') }}">
<!-- naa sa public/css folder ang css, ignore css sa resources sdfasfda-->
    
</head>
<style> 
        
    </style>
<body>
    @include('sidebar')

    <div class="content">
   <div class="header">
    
        
   </div>
   
<form action="{{route('viewSubscriber.custEditRnd', $customer->customer_id) }}" method="POST">
@csrf
@method('PUT')

    @if(session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
	@endif
    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                     @endif
   <div class="details">
        <div class="info">
            <div class="form-container">
                    <div class="form-section diet-program">
                        <h2>Diet Program: {{ $subscription->subscriptionType->plan_name}}</h2>
                    </div>
                </div>
                <p>
                    <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">
                    <b>Name:</b>  {{$customer->first_name}} {{$customer->last_name}}
                </p>
                
                
                <p>
                    <b>Birthdate:</b>   <input 
                        id="age" 
                        name="age" 
                        type="date" 
                        min="0" 
                        step="1" 
                        value="{{ old('age', optional($customer->age)->format('Y-m-d')) }}" 
                        disabled
                    />
                    
                </p>
                <p>
                <b>Sex:</b>
                <select name="sex" id="sex" disabled>
                    <option value="" {{ !$customer->sex ? 'selected' : '' }}>-- Select Sex --</option>
                    <option value="M" {{ $customer->sex == 'M' ? 'selected' : '' }}>Male</option>
                    <option value="F" {{ $customer->sex == 'F' ? 'selected' : '' }}>Female</option>
                </select>

                </p>
                <p>
                    <b>Address:</b> 
                    <input id="address" name="address" type="text" value="{{ old('address', $customer->address) }}"  disabled/>
                </p>
                <p>
                    <b>Contact Number:</b> 
                    <input id="contact_num" name="contact_num" type="text" minlength="11" maxlength="11" 
                            oninput="if(this.value.length > 11) this.value = this.value.slice(0, 11);"  value="{{ old('age', $customer->contact_num) }}"  disabled/>
                </p>
                
                <p>
                    <b>Diet Recommended:</b> 
                    <input id="diet_recom" name="diet_recom" type="text" value="{{ $customer->diet_recom  ?? 'No diet recommended' }}"/>
                </p>
                <p>
                    <b>Health Condition:</b> 
                    <input id="health_condition" name="health_condition" type="text" value="{{ $customer->health_condition }}"  disabled/>
                </p>
                <p>
                    <b>Height (cm):</b> 
                    <input id="height" name="height" type="number"  step="0.01" value="{{ $customer->height }}"  oninput="calculateBMI()" required/>
                </p>

                <p>
                    <b>Weight (kg):</b> 
                    <input id="weight" name="weight" type="number"  step="0.01" value="{{ old('weight', $customer->weight) }}"  oninput="calculateBMI()" required />
                </p>
                <p>
                    <b>BMI:</b>
                    <input type="text" name="bmi" id="bmi" class="form-control" value="{{ old('bmi', $customer->bmi) }}">
                </p>
                <p>
                    <b>Daily Calorie:</b> 
                    <input type="number" name="daily_calorie" id="daily_calorie" class="form-control" value="{{ old('daily_calorie', $customer->daily_calorie) }}">
                    
                </p>
                <!--
                <p>
                    <b>Subscription Status:</b> 
                    <select name="sub_status" id="sub_status" disabled>
                    <option value="active" {{ old('sub_status', $subscription->sub_status) == 'active' ? 'selected' : '' }}>active</option>
                    <option value="pending" {{ old('sub_status', $subscription->sub_status) == 'pending' ? 'selected' : '' }}>pending</option>
                    <option value="disabled" {{ old('sub_status', $subscription->sub_status) == 'disabled' ? 'selected' : '' }}>disabled</option>
                </select>

                </p>
   -->
                
                <p>
                    <b>Activity Level:</b> 
                    <select name="activity_level" id="activity_level"  disabled>
                        <option value="" {{ !$customer->activity_level ? 'selected' : '' }}>-- Level --</option>
                        <option value="Sedentary" {{ $customer->activity_level == 'Sedentary' ? 'selected' : '' }}>Sedentary</option>
                        <option value="Low Active" {{ $customer->activity_level == 'Low Active' ? 'selected' : '' }}>Low Active</option>
                        <option value="Active" {{ $customer->activity_level == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Very Active" {{ $customer->activity_level == 'Very Active' ? 'selected' : '' }}>Very Active</option>
                    </select>
                </p>
                <div style="margin: 0; padding: 0; display: inline-block;" class="checked">
                <b>Food Preference:</b><br>
                <label>
                    <input type="checkbox" name="prefer_pork" value="1" 
                    {{ old('prefer_pork', $customer->prefer_pork) ? 'checked' : '' }} disabled>
                Pork
                </label>
              
                <label>
                    <input type="checkbox" name="prefer_beef" value="1" 
                        {{ old('prefer_beef', $customer->prefer_beef) ? 'checked' : '' }} disabled>
                    Beef
                </label>


                <label>
                    <input type="checkbox" name="prefer_fish" value="1" 
                        {{ old('prefer_fish', $customer->prefer_fish) ? 'checked' : '' }} disabled>
                    Fish
                </label>
                <label>
                    <input type="checkbox" name="prefer_chicken" value="1" 
                        {{ old('prefer_chicken', $customer->prefer_chicken) ? 'checked' : '' }} disabled>
                        Chicken
                </label>
                <label>
                    <input type="checkbox" name="prefer_veggie" value="1" 
                        {{ old('prefer_veggie', $customer->prefer_veggie) ? 'checked' : '' }} disabled>
                        Veggie
                </label>
                <br>
                <b>Is Allegic To:</b><br>
                <label>
                    <input type="checkbox" name="allergy_wheat" value="1" 
                    {{ old('allergy_wheat', $customer->allergy_wheat) ? 'checked' : '' }} disabled>
                Wheat
                </label>
              
                <label>
                    <input type="checkbox" name="allergy_milk" value="1" 
                        {{ old('allergy_milk', $customer->allergy_milk) ? 'checked' : '' }} disabled>
                    Milk
                </label>

                <label>
                    <input type="checkbox" name="allergy_egg" value="1" 
                        {{ old('allergy_egg', $customer->allergy_egg) ? 'checked' : '' }} disabled>
                    Egg
                </label>

                <label>
                    <input type="checkbox" name="allergy_peanut" value="1" 
                        {{ old('allergy_peanut', $customer->allergy_peanut) ? 'checked' : '' }} disabled>
                    Peanut
                </label>

                <label>
                    <input type="checkbox" name="allergy_fish" value="1" 
                        {{ old('allergy_fish', $customer->allergy_fish) ? 'checked' : '' }} disabled>
                    Fish
                </label>

                <label>
                    <input type="checkbox" name="allergy_soy" value="1" 
                        {{ old('allergy_soy', $customer->allergy_soy) ? 'checked' : '' }} disabled>
                    Soy
                </label>

                <label>
                    <input type="checkbox" name="allergy_shellfish" value="1" 
                        {{ old('allergy_shellfish', $customer->allergy_shellfish) ? 'checked' : '' }} disabled>
                    Shellfish
                </label>

                <label>
                    <input type="checkbox" name="allergy_treenut" value="1" 
                        {{ old('allergy_treenut', $customer->allergy_treenut) ? 'checked' : '' }} disabled>
                    Tree Nut
                </label>

                <label>
                    <input type="checkbox" name="allergy_sesame" value="1" 
                        {{ old('allergy_sesame', $customer->allergy_sesame) ? 'checked' : '' }} disabled>
                    Sesame
                </label>

                <label>
                    <input type="checkbox" name="allergy_corn" value="1" 
                        {{ old('allergy_corn', $customer->allergy_corn) ? 'checked' : '' }} disabled>
                    Corn
                </label>

                <label>
                    <input type="checkbox" name="allergy_chicken" value="1" 
                        {{ old('allergy_chicken', $customer->allergy_chicken) ? 'checked' : '' }} disabled>
                    Chicken
                </label>

                <label>
                    <input type="checkbox" name="allergy_beef" value="1" 
                        {{ old('allergy_beef', $customer->allergy_beef) ? 'checked' : '' }} disabled>
                    Beef
                </label>

                <label>
                    <input type="checkbox" name="allergy_pork" value="1" 
                        {{ old('allergy_pork', $customer->allergy_pork) ? 'checked' : '' }} disabled>
                    Pork
                </label>

                <label>
                    <input type="checkbox" name="allergy_lamb" value="1" 
                        {{ old('allergy_lamb', $customer->allergy_lamb) ? 'checked' : '' }} disabled>
                    Lamb
                </label>

                <label>
                    <input type="checkbox" name="allergy_gluten" value="1" 
                        {{ old('allergy_gluten', $customer->allergy_gluten) ? 'checked' : '' }} disabled>
                    Gluten
                </label>
                </div>
            </div>
            <!--
             <p>
                <b>Plan name:</b> 
                <select name="activity_level" id="activity_level"  disabled>
                    <option value="Weight-Loss Plan" {{ $subscription->subscriptionType->plan_name == 'Weight-Loss Plan' ? 'selected' : '' }}>Weight-Loss Plan</option>
                    <option value="Weight-Gain Plan" {{ $subscription->subscriptionType->plan_name == 'Weight-Gain Plan' ? 'selected' : '' }}>Weight-Gain Plan</option>
                    <option value="Therapeutic Diet" {{ $subscription->subscriptionType->plan_name == 'Therapeutic Diet' ? 'selected' : '' }}>Therapeutic Diet</option>
                    {{--<option value="BPI" {{ $subscription->subscriptionType->plan_name == 'BPI' ? 'selected' : '' }}>BPI</option>--}}
                </select>
            </p>

             <p>
                <b>Start:</b> 
                    <input type="date" name="start_date" id="start_date" value="{{ $subscription->start_date ?? '' }}"  disabled/>

             </p>
             <p>
                <b>End:</b> 
                <input type="date" name="end_date" id="end_date" value="{{ $subscription->end_date ?? '' }}"  disabled/>
             </p>
             <p>
                <b>Payment Info:</b> 
                <select name="activity_level" id="activity_level"  disabled>
                    <option value="GCash" {{ $subscription->mop == 'GCash' ? 'selected' : '' }}>GCash</option>
                    <option value="Maya" {{ $subscription->mop == 'Maya' ? 'selected' : '' }}>Maya</option>
                    <option value="BPI" {{ $subscription->mop == 'BPI' ? 'selected' : '' }}>BPI</option>
                </select>
             </p>
             <p>
                <b>Reference Number:</b> 
                <input id="ref_number" name="ref_number" type="text" placeholder="" value="{{ $subscription->ref_number  ?? 'No activity level given' }}"  disabled/> 
            </p>
            -->
                <div class="save">
                    
                    <button class = "saveButton" type="submit" onclick="return confirm('Are you sure about that')">
                        APPLY CHANGES
                    </button>
                        
                    
                </div>


            </div>
            
            <div class="photo">
                <!--<img alt="Customer ID" height="100" src="{{ asset($customer->profile_picture) }}" width="100" style="border-radius:50%;"/>
                <p>
                 Customer ID
                </p>-->
            </div>
   
             
  
   </form>
        <div style ="background-color:#e0e0e0;padding:2vh 2vh 2vh 2vh;">
            <form action="{{ route('custpass', $customer->customer_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <div>
                    <label for="new_password_confirmation">Confirm Password</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>
                <div>
                    <button type="submit" style="padding: 10px;
    border: none;
    background-color: #0fbb7c;
    color: white;
    cursor: pointer;
    font-size: 16px;
    ">Change Password</button>
                </div>
            </div>
        </form>
    </div>
<script>
    //bmi calculator
    function calculateBMI() {
            // Get weight and height values
            let weight = parseFloat(document.getElementById('weight').value);
            let height = parseFloat(document.getElementById('height').value);

            // Check if both weight and height are valid numbers
            if (!isNaN(weight) && !isNaN(height) && height > 0) {
                // Convert height to meters if in cm
                if (height > 3) {
                    height = height / 100; // Assuming input in cm, convert to m
                }
                // Calculate BMI
                let bmi = weight / (height * height);
                // Set the calculated BMI to the BMI input field with two decimal places
                document.getElementById('bmi').value = bmi.toFixed(2);
            }
        }
</script>
<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>