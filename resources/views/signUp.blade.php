
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
            <div class="form-container">
                <div class="form-section diet-program">
                    <h2>Diet Program</h2>
                    <label for="diet-program">Diet Program</label>

                    <select id="subscription_type_id" name="subscription_type_id" required><!-- query subs type-->
                        <option value="">Select Diet Program</option>
                        @foreach ($subscriptionTypes as $subscriptionType)
                            <option value="{{ $subscriptionType->subscription_type_id }}">
                                {{ $subscriptionType->plan_name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        <label for="first-name">First Name <span> * </span></label>
                        <input id="first_name" name="first_name" type="text" required />
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name <span> * </span> </label>
                        <input id="last_name" name="last_name" type="text" required />
                    </div>
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
                        <label for="age">Age</label>
                        <input id="age" name="age" type="number" min="0" step="1" required />
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
                        <label for="bmi">BMI <span> * </span></label>
                        <input type="text" name="bmi" id="bmi" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="delivery-address">Delivery Address</label>
                        <input id="address" name="address" type="text" required />
                    </div>
                    <div class="form-group">
                        <label for="contact-number">Contact Number</label>
                        <input id="contact_num" name="contact_num" type="text" minlength="11" maxlength="11" oninput="if(this.value.length > 11) this.value = this.value.slice(0, 11);" />
                    </div>
                    <div class="form-group">
                        <label for="doctor-recommendation">Doctor's Diet Recommendation</label>
                        <input id="diet_reco" name="diet_reco" type="text" placeholder="Ex. Less red meat"/>
                    </div>
                    <div class="form-group">
                        <label for="health_condition">Health Condition</label>
                        <input id="health_condition" name="health_condition" type="text" placeholder="Ex. High Cholesterol"/>
                    </div>
                    <div class="form-group">
                         <label for="diet_reco">Food Preference</label>
                          <select id="diet_reco" name="diet_reco" class="form-control" >
                           <option value="">Select Food Preference</option>
                           <option value="Pork">Pork</option>
                           <option value="Fish">Fish</option>
                           <option value="Beef">Beef</option>
                           <option value="Vegetable">Chicken</option>
                           <option value="Fruit">Fruit</option>
                           <option value="Vegetable">Vegetable</option>
                          </select>
                    </div>
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
                    <h2>Account and Payment</h2>
                    <div class="form-group">
                        <label for="username">Username <span> * </span></label>
                        <input id="username" name="username" type="text"/ placholder="username" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span> * </span></label>
                        <input id="password" name="password" type="password" placholder="password" required />
                    </div>
                    <div class="form-group">
                        <label for="payment-option">Payment Option <span> * </span> </label>
                        <select id="mode_of_payment" name="mode_of_payment" required >
                            <option value="">Select Payment Option</option>
                            <option value="GCash">GCash</option>
                            <option value="Maya">Maya</option>
                            <option value="BPI">BPI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ref-number">Ref Number <span> * </span> </label>
                        <input id="reference_number" name="reference_number" type="text" placeholder="" required />
                    </div>
 <!--SUBMIT FORM --><button type ="submit" class="submit-button">Proceed</button>  <!--SUBMIT FORM -->



                </div>
                <div class="form-section allergies">
                    <h2>Allergies</h2>
                    <div class="checkbox-group">
                        <input id="wheat" name="allergies" type="checkbox" value="wheat"/>
                        <label for="wheat">Wheat</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="milk" name="allergies" type="checkbox" value="milk"/>
                        <label for="milk">Milk</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="egg" name="allergies" type="checkbox" value="egg"/>
                        <label for="egg">Egg</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="peanut" name="allergies" type="checkbox" value="peanut"/>
                        <label for="peanut">Peanut</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="soy" name="allergies" type="checkbox" value="soy"/>
                        <label for="soy">Soy</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="fish" name="allergies" type="checkbox" value="fish"/>
                        <label for="fish">Fish</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="shellfish" name="allergies" type="checkbox" value="shellfish"/>
                        <label for="shellfish">Shellfish</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="tree-nuts" name="allergies" type="checkbox" value="tree-nuts"/>
                        <label for="tree-nuts">Tree Nuts</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="sesame" name="allergies" type="checkbox" value="sesame"/>
                        <label for="sesame">Sesame</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="corn" name="allergies" type="checkbox" value="corn"/>
                        <label for="corn">Corn</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="chicken" name="allergies" type="checkbox" value="chicken"/>
                        <label for="chicken">Chicken</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="beef" name="allergies" type="checkbox" value="beef"/>
                        <label for="beef">Beef</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="pork" name="allergies" type="checkbox" value="pork"/>
                        <label for="pork">Pork</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="lamb" name="allergies" type="checkbox" value="lamb"/>
                        <label for="lamb">Lamb</label>
                    </div>
                    <div class="checkbox-group">
                        <input id="gluten" name="allergies" type="checkbox" value="gluten"/>
                        <label for="gluten">Gluten</label>
                    </div>
                </div>
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
