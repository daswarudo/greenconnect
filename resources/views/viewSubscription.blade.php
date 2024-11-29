
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
	<script> 
        
    </script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/viewsubscriber.css') }}">
<!-- naa sa public/css folder ang css, ignore css sa resources sdfasfda-->
    
</head>
<body>
    @include('sidebar')

    <div class="content">
   <div class="header">
    
        
   </div>
   
   <form action="{{ route('updateSubscription', $subscription->subscription_id) }}" method="POST">
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
            <b>Subscription Plan Selected:</b>
            <select id="subscription_type_id" name="subscription_type_id" required>
                <option value="">Select Diet Program</option>
                @foreach ($subscriptionTypes as $subscriptionType)
                    <option value="{{ $subscriptionType->subscription_type_id }}" 
                        {{ $subscriptionType->subscription_type_id == $subscription->subscriptionType->subscription_type_id ? 'selected' : '' }}>
                        {{ $subscriptionType->plan_name }}
                    </option>
                @endforeach
            </select>
            </p>

                
                <p>
                    <b>Subscription Status:</b> 
                    <select name="sub_status" id="sub_status">
                    <option value="active" {{ old('sub_status', $subscription->sub_status) == 'active' ? 'selected' : '' }}>active</option>
                    <option value="pending" {{ old('sub_status', $subscription->sub_status) == 'pending' ? 'selected' : '' }}>pending</option>
                    <option value="disabled" {{ old('sub_status', $subscription->sub_status) == 'disabled' ? 'selected' : '' }}>disabled</option>
                </select>

                </p>
                <p>
                    <b>Start Date</b>
                    <input type="date" name="start_date" id="start_date" class="form-control" 
                        value="{{ old('start_date', $subscription->start_date) }}" style="width: 50vh;" onchange="setEndDateMin()">
                </p>
                <p>
                    <b>End Date</b>
                    <input type="date" name="end_date" id="end_date" class="form-control" 
                        value="{{ old('end_date', $subscription->end_date) }}" style="width: 50vh;">
                </p>
                <p>
                    <b>Payment Method</b>
                    <select id="mop" name="mop">
                        <option value="" {{ is_null($subscription->mop) ? 'selected' : '' }}>Select Payment Method</option>
                        <option value="Gcash" {{ $subscription->mop == 'Gcash' ? 'selected' : '' }}>Gcash</option>
                        <option value="Maya" {{ $subscription->mop == 'Maya' ? 'selected' : '' }}>Maya</option>
                        <option value="BPI" {{ $subscription->mop == 'BPI' ? 'selected' : '' }}>BPI</option>
                    </select>

                </p>
                
                <p>
                    <b>Reference Number</b>
                    <input id="ref_number" name="ref_number" type="text" value="{{ $subscription->ref_number   }}"/>
                </p>
            </div>
            
            
   
            <div class="save">
                
                <button class = "saveButton" type="submit" onclick="return confirm('Are you sure about that')">
                    APPLY CHANGES
                </button>
                       
                
            </div>
  </div>
</form>
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

        function setEndDateMin() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');

        if (startDateInput.value) {
            const startDate = new Date(startDateInput.value);
            const minEndDate = new Date(startDate);
            minEndDate.setDate(minEndDate.getDate() + 14); // Add 14 days

            // Format the date to YYYY-MM-DD
            const formattedDate = minEndDate.toISOString().split('T')[0];
            endDateInput.min = formattedDate;
        }
    }

    // Set the minimum end date on page load if start date is already set
    window.onload = setEndDateMin;
</script>
<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>