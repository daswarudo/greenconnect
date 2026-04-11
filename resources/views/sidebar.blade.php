
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
    <link rel="stylesheet" href="{{ asset('css/rdnDash.css') }}">
<!-- naa sa public/css folder ang css, ignore css sa resources sdfasfda-->
    
</head>
<style>
    /* More specific selector to override the sidebar link styles */
    .sidebar .logo-link {
        text-decoration: none !important;
        display: block !important;
        color: inherit !important;  /* Inherit the color to prevent other styles */
        margin: 0 !important;  /* Remove any margin */
        background-color: transparent !important;  /* Remove background color */
        border-radius: 0 !important;  /* Remove border radius */
        padding: 0 !important;  /* Remove padding */
        box-shadow: none !important;  /* Remove box-shadow */
    }

    .sidebar .logo-link:hover {
        color: inherit !important;  /* Remove hover color change */
        background-color: transparent !important;  /* Remove hover background color */
        border: none !important;  /* Remove hover border */
    }
    .confirmation-popup {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #f8f9fa;
    padding: 20px;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    text-align: center;
    z-index: 1000;
}
.confirmation-popup button {
    margin: 5px;
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}
.confirmation-popup button:nth-child(1) {
    background: #dc3545;
    color: white;
}
.confirmation-popup button:nth-child(2) {
    background: #6c757d;
    color: white;
}
</style>
<body>

<div class="sidebar">
    <a href="/rdnDashboard" class="logo-link">
        <img alt="Green Chef Logo" height="200" src="{{ asset('images/logo.png') }}"  />
    </a>

    <a href="/rdnDashboard">
        <i class="fas fa-home">
        </i>
    Home
    </a>
    <a href="{{ route('subscribers') }}">
    <i class="fas fa-users">
    </i>
    Subscribers
   </a>
   <a href="{{route('appointments')}}">
    <i class="fas fa-calendar-alt">
    </i>
    Appointments
   </a>
   <a href="{{ route('mealplans') }}">
    <i class="fas fa-utensils">
    </i>
    Meal Plans
   </a>

   <!--
   <a href="{{ route('logout') }}"  onclick="return confirm('Logout?')">
        <i class="fas fa-sign-out-alt">
        </i>
            Log Out
   </a>
    -->
    <a href="javascript:void(0);" onclick="confirmLogout()" class="logout-link">
        <i class="fas fa-sign-out-alt"></i> Log Out
    </a>

    <!-- Confirmation Pop-Up -->
    <div id="logout-confirmation" class="confirmation-popup">
        <p>Are you sure you want to log out?</p>
        <button onclick="proceedLogout()">Yes</button>
        <button onclick="closePopup()">Cancel</button>
    </div>
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
function confirmLogout() {
    document.getElementById('logout-confirmation').style.display = 'block';
}

function closePopup() {
    document.getElementById('logout-confirmation').style.display = 'none';
}

function proceedLogout() {
    window.location.href = "{{ route('logout') }}";
}

</script>
</body>
</html>
