
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
              Joe
             </p>
             <p>
              Amistoso
             </p>
             <p>
              35
             </p>
             <p>
              M
             </p>
             <p>
              Larena Drive, 123, Taclob, Dumaguete City
             </p>
             <p>
              Contact Number: 09391102031
             </p>
             <p>
              Weight (kg): 85
             </p>
             <p>
              Height (cm): 170
             </p>
             <p>
              Diet Recommended: Weight Loss
             </p>
             <p>
              Health Condition: High Cholesterol
             </p>
             <p>
              BMI:
             </p>
             <p>
              Daily Calorie:
             </p>
             <p>
              Activity Level: Moderate
             </p>
            </div>
            <div class="photo">
                <img alt="Customer ID" height="100" src="" width="100"/>
                <p>
                 Customer ID
                </p>
            </div>
               <div class="close">
                X
               </div>
   
  </div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
