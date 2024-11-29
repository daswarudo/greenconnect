
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
                    <h2>SIGN UP</h2>
                    <label for="diet-program">Diet Program</label>
                    <select id="subscription_type_id" name="subscription_type_id" required><!-- query subs type-->
                        <option value="">Select Diet Program</option>
                        @foreach ($subscriptionTypes as $subscriptionType)
                            <option value="{{ $subscriptionType->subscription_type_id }}">
                                {{ $subscriptionType->plan_name }}
                            </option>
                        @endforeach
                    </select>

                <div class="form-container2">
                    <div class="form-group">
                        <label for="first-name">First Name <span> * </span></label>
                        <input id="first_name" name="first_name" type="text" required />
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name <span> * </span> </label>
                        <input id="last_name" name="last_name" type="text" required />
                    </div>
                </div>

                <div class="form-container2">
                    <div class="form-group">
                        <label for="username">Username <span> * </span></label>
                        <input id="username" name="username" type="text"/ placholder="username" required />
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span> * </span></label>
                        <input id="password" name="password" type="password" placholder="password" required />
                    </div>
                </div>  

                </div>
                
            </div>
        <!--</form>-->
        <!--SUBMIT FORM --><button type ="submit" class="submit-button" id="button-signUp">SIGN UP</button>  <!--SUBMIT FORM -->
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
