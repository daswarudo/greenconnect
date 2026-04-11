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
    <style>
    .social-media-post {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 40px;
        max-width: 143vh;
        margin: 0px auto;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .post-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .profile-pic {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
        /*margin-left: 15px;*/
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .username {
        font-size: 24px;
        font-weight: bold;
        margin: 0;
    }

    .timestamp {
        font-size: 12px;
        color: #888;
        margin: 0;
    }

    .post-content {
        margin-bottom: 15px;
    }

    .testimonial-text {
        font-size: 24px;
        line-height: 1.5;
        color: #333;
    }


    </style>
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
                    <a class="nav-link"  href="{{ url('/') }}">HOME</a>
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

⠀
<div class="social-media-post">
    
    @foreach($testimonials as $testimonial)⠀
    <div class="post-header">
        <img src="{{ asset('images/freepik1-min.jpg') }}" alt="Profile Picture" class="profile-pic">
        <div class="user-info">
            <p class="username">{{ $testimonial->customer->first_name ?? 'N/A' }} {{ $testimonial->customer->last_name ?? '' }}</p>
            
        </div>
    </div>

    <div class="post-content">
        <p class="testimonial-text"><em>"{{ $testimonial->feedback }}"</em></p>
    </div>

    @if (!$loop->last) 
        <hr> <!-- Adds line between testimonials but not after the last one -->
    @endif
    @endforeach
</div>            ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀

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
