
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
    <h1>
     WELCOME, RDN
        
   </div>
   <div class="tabs">
    <button>
     Weight Loss
    </button>
    <button>
     Weight Gain
    </button>
    <button>
     Therapeutic
    </button>
    <button>
     Gluten Free
    </button>
   </div>
   
   <div class="details">
        <div class="info">
        <div class="form-container">
                <div class="form-section diet-program">
                    <h2>Diet Program</h2>
                    

                </div>
            </div>
             <p>
              <b>First Name:</b>  <input type="text" name="first_name" value="{{ old('first_name', $customer->first_name) }}" />
             </p>
             
             <p>
             <b>Last Name:</b> <input type="text" name="last_name" value="{{ old('first_name', $customer->last_name) }}" />
             </p>
             <p>
             <b>Age:</b> {{ $customer->age }}
             </p>
             <p>
             <b>Sex:</b> {{ $customer->sex }}
             </p>
             <p>
             <b>Address:</b> {{ $customer->address  }}
             </p>
             <p>
             <b>Contact Number:</b> {{ $customer->contact_num  ?? 'No phone given' }}
             </p>
             <p>
             <b>Weight (kg):</b> {{ $customer->weight }}
             </p>
             <p>
             <b>Height (cm):</b> {{ $customer->height }}
             </p>
             <p>
             <b>Diet Recommended:</b> {{ $customer->diet_recom  ?? 'No activity level' }}
             </p>
             <p>
             <b>Health Condition:</b> {{ $customer->health_condition }}
             </p>
             <p>
             <b>BMI:</b> {{ $customer->bmi }}
             </p>
             <p>
             <b>Daily Calorie:</b> {{ $customer->daily_calorie  ?? 'No daily calorie given' }}
             </p>
             <p>
             <b>Activity Level:</b> {{ $customer->activity_level  ?? 'No activity level given' }}
             </p>


             <p>
                <b>Plan name:</b> {{ $subscription->subscriptionType->plan_name ?? 'N/A' }}
            </p>

             <p>
                <b>Start:</b> {{ $subscription->start_date ?? 'N/A' }}
             </p>
             <p>
                <b>End:</b> {{ $subscription->end_date ?? 'No end given' }}
             </p>
             <p>
                <b>Payment Info:</b> {{ $subscription->mop  ?? 'No activity level given' }}
             </p>
             <p>
                <b>Reference Number:</b> {{ $subscription->ref_number  ?? 'No activity level given' }}
             </p>
            </div>
            <div class="photo">
                <img alt="Customer ID" height="100" src="{{ asset($customer->profile_picture) }}" width="100" style="border-radius:50%;"/>
                <p>
                 Customer ID
                </p>
            </div>
                <!-- <div class="close">
                    <a href="{{ url()->previous() }}" style="text-decoration: none;">&#10006</a>
               </div>-->
            <!-- save button-->
             <div class="save">
                <a href="#" style="text-decoration: none;">
                    <button class = "saveButton">
                        EDIT
                    </button>
                </a>
            </div>
  </div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
