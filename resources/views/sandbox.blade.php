<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS, different ni nga directory if laravel-->
    <link rel="stylesheet" href="{{ asset('css/landstyle.css') }}">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand logo" href="#"><img class="logo" src="{{ asset('images/logo.png') }}" alt="logo"></a>
        <a class="navbar-brand" href="#">GreenConnect</a>

        <!-- Toggler/collapsible Button for Mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
<div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
              <!-- Links -->
              <li class="nav-item">
                    <a class="nav-link"  href="/welcome">HOME</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/sandbox">TESTIMONIALS</a>
              </li>

              @if(session()->has('loginId') && session()->has('userType'))
                  @if(session('userType') === 'customer')
                      <li class="nav-item">
                          <a class="nav-link" href="/customerSubscription">DASHBOARD</a>
                      </li>
                  @elseif(session('userType') === 'rdn')
                      <li class="nav-item">
                          <a class="nav-link" href="/rdnDashboard">DASHBOARD</a>
                      </li>
                  @endif
                  <li class="nav-item">
                      <a class="nav-link ghost" id="logout" href="/logout">LOGOUT</a>
                  </li>
              @else
                  <li class="nav-item">
                      <a class="nav-link ghost" id="signUp" href="/signUp">SIGN UP</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link ghost" id="login" href="/login">LOGIN</a>
                  </li>
              @endif
          </ul>
      </div>
</div>
</nav>

<div style = "height: 5vh;"></div>

<div class="container"><!--hide-->
    <h1 class ="title4"><b>Testimonials</b></h1>
</div>

<div class="div-2"> <!--hide-->
    <div class="flex-container2">
            
        @foreach($testimonials as $testimonial)⠀⠀
            <div class="flex-item2">

              <div style="height: auto;overflow: hidden;position: relative;">
                  
              <p><em>"{{ $testimonial->feedback }}"</em></p>


                  <p style = "font-size:12px; margin-bottom:0px;">{{ $testimonial->customer->first_name ?? 'N/A' }} {{ $testimonial->customer->last_name ?? '' }}</p>
                  
              </div>
          </div>⠀⠀
        @endforeach
        
    </div>
</div>
            ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀

<script>

    //redirect to Subscription Cards
    document.getElementById('subscription-link').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default anchor behavior

        document.getElementById('flex-container').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
