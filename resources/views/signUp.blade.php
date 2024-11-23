
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/SignUp.css') }}">
<!-- naa sa public/css folder ang css, ignore css sa resources sdfasfda-->
    
</head>
<body>
    
    <div class="container">
        <div class="left-panel">
            <img alt="Green Chef Logo" height="100" src="{{ asset('images/logo.png') }}" width="100"/>
            <h1>WELCOME TO GREEN CONNECT</h1>
            <p>GREEN CHEF'S PORTAL TO NUTRITION</p>
            <p>Already have an account?</p>
            <a id="login" href="{{ route('login') }}">SIGN IN</a>
        </div>
        <form class="right-panel" action="{{ route('register.customer') }}" method="POST"> <!--will find a cleaner way hahah -->
        <!--<form class="right-panel" action="{{ route('view.subscriptions') }}" method="GET">-->
                     @csrf
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
            <div class="form-container">
                <div class="form-section diet-program">

                    <h2>Diet Program</h2>
                
                    <select id="subscription_type_id" name="subscription_type_id" required><!-- query subs type-->
                        <option value="">Select Diet Program</option>
                        @foreach ($subscriptionTypes as $subscriptionType)
                            <option value="{{ $subscriptionType->subscription_type_id }}">
                                {{ $subscriptionType->plan_name }}
                            </option>
                        @endforeach
                    </select>
                    <h2>Personal Information</h2>
                    <div class="form-group">
                        <label for="first-name">First Name <span> * </span></label>
                        <input id="first_name" name="first_name" type="text" required />
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name <span> * </span> </label>
                        <input id="last_name" name="last_name" type="text" required />
                    </div>
                    <div class="form-group">
                        <label for="username">Username <span> * </span></label>
                        <input id="username" name="username" type="text"/ placholder="username" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span> * </span></label>
                        <input id="password" name="password" type="password" placholder="password" required />
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <div class="radio-group">
                            <input id="male" name="sex" type="radio" value="M" required />
                            <label for="male">Male</label>
                            <input id="female" name="sex" type="radio" value="F" required />
                            <label for="female">Female</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="age">Date of Birth</label>
                       
                        <input type="date" name="age" id="age" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="height">Height (cm) <span> * </span></label>
                        <input id="height" name="height" type="number"  step="0.01" value="{{ old('height') }}" oninput="calculateBMI()" required />
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight (kg) <span> * </span></label>
                        <input id="weight" name="weight" type="number"  step="0.01" value="{{ old('weight') }}" oninput="calculateBMI()" required />
                    </div>

                    <div class="form-group">
                        <label for="bmi">BMI </label>
                        <input type="text" name="bmi" id="bmi" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label for="delivery-address">Delivery Address</label>
                        <input id="address" name="address" type="text" required />
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input id="contact_num" name="contact_num" type="text" minlength="11" maxlength="11" 
                        oninput="if(this.value.length > 11) this.value = this.value.slice(0, 11);" />
                    </div>
                    <h2>Health Concerns</h2>
                    <div class="form-group">
                        <label for="doctor-recommendation">Doctor's Diet Recommendation</label>
                        <input id="diet_recom" name="diet_recom" type="text" placeholder="Ex. Less red meat"/>
                    </div>
                    <div class="form-group">
                        <label for="health_condition">Health Condition</label>
                        <input id="health_condition" name="health_condition" type="text" placeholder="Ex. High Cholesterol"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="food_preferences"><h2>Food Preferences</h2></label>
                        
                        <br><input type="checkbox" name="prefer_pork" value="1" {{ old('prefer_pork') ? 'checked' : '' }}>
                            Pork
                        </label><br>
                        
                        <label>
                            <input type="checkbox" name="prefer_beef" value="1" {{ old('prefer_beef') ? 'checked' : '' }}>
                            Beef
                        </label><br>
                        
                        <label>
                            <input type="checkbox" name="prefer_fish" value="1" {{ old('prefer_fish') ? 'checked' : '' }}>
                            Fish
                        </label><br>
                        
                        <label>
                            <input type="checkbox" name="prefer_chicken" value="1" {{ old('prefer_chicken') ? 'checked' : '' }}>
                            Chicken
                        </label><br>
                        <label>
                            <input type="checkbox" name="prefer_veggie" value="1" {{ old('prefer_veggie') ? 'checked' : '' }}>
                            Veggie
                        </label><br>
                    </div>
                    <h2>Lifestyle</h2>
                    <div class="form-group">
                         <label for="activity_level">Select Activity Level</label>
                          <select id="activity_level" name="activity_level" class="form-control"  required>
                           <option value="">Activity Level</option>
                           <option value="Sedentary">Sedentary</option>
                           <option value="Low Active">Low Active</option>
                           <option value="Active">Active</option>
                           <option value="Very Active">Very Active</option>
                          </select>
                    </div>
                    <h2>Payment</h2>
                    <div class="form-group">
                        <label for="payment-option">Payment Option <span> * </span> </label>
                        <select id="mop" name="mop" required >
                            <option value="">Select Payment Option</option>
                            <option value="GCash">GCash</option>
                            <option value="Maya">Maya</option>
                            <option value="BPI">BPI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ref-number">Ref Number <span> * </span> </label>
                        <input id="ref_number" name="ref_number" type="text" placeholder="" required />
                    </div>
 



                </div>
                <div class="form-section allergies">
                    
                    <h2>Allergies</h2>
                    <label>
        <input type="checkbox" name="allergy_wheat" value="1" {{ old('allergy_wheat') ? 'checked' : '' }}>
        Wheat
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_milk" value="1" {{ old('allergy_milk') ? 'checked' : '' }}>
        Milk
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_egg" value="1" {{ old('allergy_egg') ? 'checked' : '' }}>
        Egg
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_peanut" value="1" {{ old('allergy_peanut') ? 'checked' : '' }}>
        Peanut
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_fish" value="1" {{ old('allergy_fish') ? 'checked' : '' }}>
        Fish
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_soy" value="1" {{ old('allergy_soy') ? 'checked' : '' }}>
        Soy
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_shellfish" value="1" {{ old('allergy_shellfish') ? 'checked' : '' }}>
        Shellfish
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_treenut" value="1" {{ old('allergy_treenut') ? 'checked' : '' }}>
        Tree Nut
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_sesame" value="1" {{ old('allergy_sesame') ? 'checked' : '' }}>
        Sesame
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_corn" value="1" {{ old('allergy_corn') ? 'checked' : '' }}>
        Corn
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_chicken" value="1" {{ old('allergy_chicken') ? 'checked' : '' }}>
        Chicken
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_beef" value="1" {{ old('allergy_beef') ? 'checked' : '' }}>
        Beef
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_pork" value="1" {{ old('allergy_pork') ? 'checked' : '' }}>
        Pork
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_lamb" value="1" {{ old('allergy_lamb') ? 'checked' : '' }}>
        Lamb
    </label><br>
    
    <label>
        <input type="checkbox" name="allergy_gluten" value="1" {{ old('allergy_gluten') ? 'checked' : '' }}>
        Gluten
    </label>
    
                </div>-->
                <!--SUBMIT FORM --><button type ="submit" id="submit-button" class="submit-button">Submit</button>  <!--SUBMIT FORM -->
            </div>
        <!--</form>-->
        </form>
    </div>
</body>
  <script>
    // Function to move to the next step of the form
    function showStep(stepNumber) {
        // Hide all steps
        document.getElementById('step1').classList.add('hidden');
        document.getElementById('step2').classList.add('hidden');
        document.getElementById('step3').classList.add('hidden');

        // Show the selected step
        document.getElementById('step' + stepNumber).classList.remove('hidden');
    }
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


</html>
