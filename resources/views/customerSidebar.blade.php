
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenConnect Dashboard</title>

    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">   ==>login css-->
	<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js'></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/customerDash.css') }}">
<!-- naa sa public/css folder ang css, ignore css sa resources sdfasfda-->
    
</head>
<body>

<div class="sidebar">
	<img alt="Green Chef Logo" height="100" src="{{ asset('images/logo.png') }}" width="100" />
    
    
    
    
    
   <a href="/custTest">            
    <i class="fas fa-calendar-alt">
    </i>
    Appointments
   </a>

   <a href="#">
        <i class="fas fa-utensils">
        </i>
        Meal Plans
   </a>
   
   <a href="/customerFeedback">
   <i class="fa fa-comment" ></i>
    
    Feedback
   </a>
   
   <a href="/customerSubscription">
   <i class="fa fa-info" ></i>
    
    Subscription
   </a>
   <a href="/customerView">
   <i class="fa fa-user"></i>
    
   Account Info
   </a>
   <a href="{{ route('logout') }}">
    <i class="fas fa-sign-out-alt">
    </i>
    Log Out
   </a>
</div>
  
<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebarLinks = document.querySelectorAll('.sidebar a');
    const currentUrl = window.location.href;

    
    sidebarLinks.forEach(link => {
        
        if (link.href === currentUrl) {
            
            link.classList.add('active');
        }
        
       
        link.addEventListener('click', function() {
            sidebarLinks.forEach(item => item.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>
</body>
</html>
