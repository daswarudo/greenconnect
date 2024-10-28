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
    <body>
        <div class="container">
            <div class="left-panel">
                <img alt="Green Chef Logo" height="100" src="{{ asset('images/logo.png') }}" width="100"/>
                <h1>WELCOME TO GREEN CONNECT</h1>
                <p>GREEN CHEF'S PORTAL TO NUTRITION</p>
                <p>Already have an account?</p>
                <a id="login" href="{{ route('login') }}">SIGN IN</a>
            </div>
            <form class="right-panel">
                <div class="form-container">
                    <div class="form-section diet-program">
                        <h2>Diet Program</h2>
                        <label for="diet-program">Diet Program</label>
                        <select id="subscription_type_id" name="subscription_type_id" required >
                            <option value="">Select Diet Program</option>
                            <option value="1">Weight Loss</option>
                            <option value="2">Weight Gain</option>
                            <option value="3">Gluten-Free</option>
                            <option value="4">Therapeutic</option>
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
                            <input id="height" name="height" type="number" required />
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight (kg) <span> * </span></label>
                            <input id="weight" name="weight" type="number" required />
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
                              <select id="activity_leve" name="activity_level" class="form-control"  required>
                               <option value="">Activity Level</option>
                               <option value="Sedentary">Sedentary</option>
                               <option value="Low Active">Low Active</option>
                               <option value="Active">Active</option>
                               <option value="Very Active">Very Active</option>
                              </select>
                        </div>
                        <button type="submit">Next Page</button>

</body>
</html>