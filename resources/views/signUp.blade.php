
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
      <img alt="Green Chef Logo" height="100" src="https://storage.googleapis.com/a1aa/image/5ZVSiXJk97ooLNVVlietIe85bAyorQ641AarmzfLZ1jPFJHnA.jpg" width="100" />
      <h1>WELCOME TO GREEN CONNECT</h1>
      <p>GREEN CHEF'S PORTAL TO NUTRITION</p>
      <p>Already have an account?</p>
      <button>Sign In</button>
    </div>

    <!-- Step 1: Basic Information Form -->
    <div class="right-panel" id="step1">
      <h2>Diet Program</h2>
      <form>
        <div class="form-group full-width">
          <select>
            <option>Diet Program</option>
          </select>
        </div>
        <div class="form-group">
          <label>First Name*</label>
          <input type="text" />
        </div>
        <div class="form-group">
          <label>Last Name*</label>
          <input type="text" />
        </div>
        <div class="form-group">
          <label>Sex :</label>
          <input name="sex" type="radio" /> Male
          <input name="sex" type="radio" /> Female
        </div>
        <div class="form-group">
          <label>Age:</label>
          <input type="text" />
        </div>
        <div class="form-group">
          <label>Height:</label>
          <input placeholder="cm" type="text" />
        </div>
        <div class="form-group">
          <label>Weight:</label>
          <input placeholder="kg" type="text" />
        </div>
        <div class="form-group full-width">
          <label>Delivery Address*</label>
          <input type="text" />
        </div>
        <div class="form-group full-width">
          <label>Contact Number*</label>
          <input type="text" />
        </div>
        <div class="form-group full-width">
          <label>Doctor's Diet Recommendation</label>
          <input type="text" />
        </div>
        <div class="form-group full-width">
          <button type="button" onclick="showNextStep(2)">Next Page</button>
        </div>
      </form>
    </div>

    <!-- Step 2: Allergies Form -->
    <div class="right-panel hidden" id="step2">
      <h2>Allergies</h2>
      <form>
        <div class="form-group full-width">
          <label>Allergies:</label>
          <div class="allergies-grid">
            <div class="checkbox-group">
              <input type="checkbox" />
              <label>Legume</label>
              <select><option>Source</option></select>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" />
              <label>Poultry</label>
              <select><option>Source</option></select>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" />
              <label>Tree nut</label>
              <select><option>Source</option></select>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" />
              <label>Seed</label>
              <select><option>Source</option></select>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" />
              <label>Crustacean</label>
              <select><option>Source</option></select>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" />
              <label>Fruit</label>
              <select><option>Source</option></select>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" />
              <label>Cereal Grain</label>
              <select><option>Source</option></select>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" />
              <label>Fish</label>
              <select><option>Source</option></select>
            </div>
            <div class="checkbox-group">
              <input type="checkbox" />
              <label>Mollusk</label>
              <select><option>Source</option></select>
            </div>
          </div>
        </div>
        <div class="form-group full-width">
          <button type="button" onclick="showNextStep(3)">Next Page</button>
        </div>
      </form>
    </div>

    <!-- Step 3: Username, Password, Payment -->
    <div class="right-panel hidden" id="step3">
      <h2>Account and Payment</h2>
      <form>
        <div class="form-group">
          <label>Username*</label>
          <input type="text" />
        </div>
        <div class="form-group">
          <label>Password*</label>
          <input type="password" />
        </div>
        <div class="form-group">
          <label>Payment Option*</label>
          <select>
            <option>Select Payment Method</option>
            <option>Credit Card</option>
            <option>PayPal</option>
            <option>Bank Transfer</option>
          </select>
        </div>
        <div class="form-group">
          <label>Ref Number*</label>
          <input type="text" />
        </div>
        <div class="form-group full-width">
          <button type="submit">Proceed</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Function to move to the next step of the form
    function showNextStep(stepNumber) {
      // Hide all steps
      document.getElementById('step1').classList.add('hidden');
      document.getElementById('step2').classList.add('hidden');
      document.getElementById('step3').classList.add('hidden');

      // Show the selected step
      document.getElementById('step' + stepNumber).classList.remove('hidden');
    }
  </script>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
