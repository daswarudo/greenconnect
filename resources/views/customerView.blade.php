
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/customerSubscription.css') }}">
</head>
<body>
        @include('customerSidebar')

<div class="content">
   <h1>
   WELCOME, 
        @if($userType == 'customer')
            <p>Customer {{ $customer->first_name }} {{ $customer->last_name }}!</p>
        
    </h1>

    @endif
    <form action="{{route('custedit', $customer->customer_id) }}" method="POST"  enctype="multipart/form-data">
@csrf
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

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
   </h1>
   <div class="subscription-info">
   
   <div class="details">
        <div class="info">
            <div class="form-container">
                    
                </div>
                <p>
                    <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">
                    <b>Name:</b> 
                       <input id="first_name" name="first_name" type="text" min="0" step="1" value="{{ old('first_name', $customer->first_name) }}"/>
                       <input id="last_name" name="last_name" type="text" min="0" step="1" value="{{ old('last_name', $customer->last_name) }}"/>
                </p>
                
                
                <p>
                    <b>Birthdate:</b>   <input id="age" name="age" type="date" min="0" step="1" value="{{ old('age', $customer->age) }}"/>
                    
                </p>
                <p>
                <b>Sex:</b>
                <select name="sex" id="sex" >
                    <option value="" {{ !$customer->sex ? 'selected' : '' }}>-- Select Sex --</option>
                    <option value="M" {{ $customer->sex == 'M' ? 'selected' : '' }}>Male</option>
                    <option value="F" {{ $customer->sex == 'F' ? 'selected' : '' }}>Female</option>
                </select>

                </p>
                <p>
                    <b>Address:</b> 
                    <input id="address" name="address" type="text" value="{{ old('address', $customer->address) }}"  />
                </p>
                <p>
                    <b>Contact Number:</b> 
                    <input id="contact_num" name="contact_num" type="text" minlength="11" maxlength="11" 
                            oninput="if(this.value.length > 11) this.value = this.value.slice(0, 11);"  value="{{ old('age', $customer->contact_num) }}"  />
                </p>
                
                <p>
                    <b>Diet Recommended:</b> 
                    <input id="diet_reco" name="diet_reco" type="text" value="{{ $customer->diet_recom  ?? 'No diet recommended' }}"  />
                </p>
                <p>
                    <b>Health Condition:</b> 
                    <input id="health_condition" name="health_condition" type="text" value="{{ $customer->health_condition }}"  />
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
                
                
                <p>
                    <b>Activity Level:</b> 
                    <select name="activity_level" id="activity_level">
                        <option value="" {{ !$customer->activity_level ? 'selected' : '' }}>-- Level --</option>
                        <option value="Sedentary" {{ $customer->activity_level == 'Sedentary' ? 'selected' : '' }}>Sedentary</option>
                        <option value="Low Active" {{ $customer->activity_level == 'Low Active' ? 'selected' : '' }}>Low Active</option>
                        <option value="Active" {{ $customer->activity_level == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Very Active" {{ $customer->activity_level == 'Very Active' ? 'selected' : '' }}>Very Active</option>
                    </select>
                </p>
                <b>Food Preference:</b><br>
                <label>
                    <input type="checkbox" name="prefer_pork" value="1" 
                    {{ old('prefer_pork', $customer->prefer_pork) ? 'checked' : '' }}>
                Pork
                </label><br>
              
                <label>
                    <input type="checkbox" name="prefer_beef" value="1" 
                        {{ old('prefer_beef', $customer->prefer_beef) ? 'checked' : '' }}>
                    Beef
                </label><br>

                <label>
                    <input type="checkbox" name="prefer_beef" value="1" 
                        {{ old('prefer_beef', $customer->prefer_beef) ? 'checked' : '' }}>
                    Beef
                </label><br>

                <label>
                    <input type="checkbox" name="prefer_fish" value="1" 
                        {{ old('prefer_fish', $customer->prefer_fish) ? 'checked' : '' }}>
                    Fish
                </label><br>
                <label>
                    <input type="checkbox" name="prefer_chicken" value="1" 
                        {{ old('prefer_chicken', $customer->prefer_chicken) ? 'checked' : '' }}>
                        Chicken
                </label><br>
                <label>
                    <input type="checkbox" name="prefer_veggie" value="1" 
                        {{ old('prefer_veggie', $customer->prefer_veggie) ? 'checked' : '' }}>
                        Veggie
                </label><br>
                <br>
                <b>Is Allegic To:</b><br>
                <label>
                    <input type="checkbox" name="allergy_wheat" value="1" 
                    {{ old('allergy_wheat', $customer->allergy_wheat) ? 'checked' : '' }}>
                Wheat
                </label><br>
              
                <label>
                    <input type="checkbox" name="allergy_milk" value="1" 
                        {{ old('allergy_milk', $customer->allergy_milk) ? 'checked' : '' }}>
                    Milk
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_egg" value="1" 
                        {{ old('allergy_egg', $customer->allergy_egg) ? 'checked' : '' }}>
                    Egg
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_peanut" value="1" 
                        {{ old('allergy_peanut', $customer->allergy_peanut) ? 'checked' : '' }}>
                    Peanut
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_fish" value="1" 
                        {{ old('allergy_fish', $customer->allergy_fish) ? 'checked' : '' }}>
                    Fish
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_soy" value="1" 
                        {{ old('allergy_soy', $customer->allergy_soy) ? 'checked' : '' }}>
                    Soy
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_shellfish" value="1" 
                        {{ old('allergy_shellfish', $customer->allergy_shellfish) ? 'checked' : '' }}>
                    Shellfish
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_treenut" value="1" 
                        {{ old('allergy_treenut', $customer->allergy_treenut) ? 'checked' : '' }}>
                    Tree Nut
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_sesame" value="1" 
                        {{ old('allergy_sesame', $customer->allergy_sesame) ? 'checked' : '' }}>
                    Sesame
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_corn" value="1" 
                        {{ old('allergy_corn', $customer->allergy_corn) ? 'checked' : '' }}>
                    Corn
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_chicken" value="1" 
                        {{ old('allergy_chicken', $customer->allergy_chicken) ? 'checked' : '' }}>
                    Chicken
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_beef" value="1" 
                        {{ old('allergy_beef', $customer->allergy_beef) ? 'checked' : '' }}>
                    Beef
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_pork" value="1" 
                        {{ old('allergy_pork', $customer->allergy_pork) ? 'checked' : '' }}>
                    Pork
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_lamb" value="1" 
                        {{ old('allergy_lamb', $customer->allergy_lamb) ? 'checked' : '' }}>
                    Lamb
                </label><br>

                <label>
                    <input type="checkbox" name="allergy_gluten" value="1" 
                        {{ old('allergy_gluten', $customer->allergy_gluten) ? 'checked' : '' }}>
                    Gluten
                </label>
            </div>
            
            <div class="photo">
                <!--<img alt="Customer ID" height="100" src="{{ asset($customer->profile_picture) }}" width="100" style="border-radius:50%;"/>
                <p>
                 Customer ID
                </p>-->
                
                <img 
                    alt="Customer's Profile Picture" 
                    height="100" 
                    src="{{ asset($customer->profile_picture) }}" 
                    width="100" 
                    style="border-radius:50%; margin-top:5vh" 
                /><br>

                <input 
                    type="file" 
                    name="profile_picture" 
                    accept="image/*"
                    style="margin-bottom:5vh"
                >
                
            </div>
   
             <div class="save">
                
                <!--<button class = "saveButton" type="submit" onclick="return confirm('Are you sure about that')">
                    APPLY CHANGES
                </button>-->
                <a href ="#">
                  <button type="submit"  onclick="return confirm('Are you sure about that')">
                      EDIT DETAILS
                  </button>
                </a>
                <br>
                <!--<button type="submit">
                    CHANGE PASSWORD
                </button>-->
                       
                
            </div>
  
</div>
    
   </div>
</form>
  </div>
</body>
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
</html>