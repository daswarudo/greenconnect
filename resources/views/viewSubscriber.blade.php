
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
             <p>
              <b>First Name:</b> Joe
             </p>
             <p>
             <b>Last Name:</b> Amistoso
             </p>
             <p>
             <b>Age:</b> 35
             </p>
             <p>
             <b>Sex:</b> M
             </p>
             <p>
             <b>Address:</b> Larena Drive, 123, Taclobo, Dumaguete City
             </p>
             <p>
             <b>Contact Number:</b> 09391102031
             </p>
             <p>
             <b>Weight (kg):</b> 85
             </p>
             <p>
             <b>Height (cm):</b> 170
             </p>
             <p>
             <b>Diet Recommended:</b> Weight Loss
             </p>
             <p>
             <b>Health Condition:</b> High Cholesterol
             </p>
             <p>
             <b>BMI:</b>
             </p>
             <p>
             <b>Daily Calorie:</b>
             </p>
             <p>
             <b>Activity Level:</b> Moderate
             </p>
            </div>
            <div class="photo">
                <img alt="Customer ID" height="100" src="{{ asset('images/freepik3.jpg') }}" width="100" style="border-radius:50%;"/>
                <p>
                 Customer ID
                </p>
            </div>
               <div class="close">
               &#10006
               </div>
            <!-- save button-->
             <div class="save">
                <button class = "saveButton">
                    SAVE
                </button>
            </div>
  </div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
