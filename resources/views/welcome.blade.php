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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand logo" href="#"><img class="logo" src="{{ asset('images/logo.png') }}" alt="logo"></a>
        <a class="navbar-brand" href="#">GreenConnect</a>

        <!-- Toggler/collapsible Button for Mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Links -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="signup" style="cursor: pointer;" href="/signUp">SIGN UP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ghost" id="login" href="/login">LOGIN</a>
                    <!--<a class="nav-link" href="{{ route('login') }}">LOGIN</a>-->
                </li>
                
            </ul>
        </div>
    </div>
</nav>
@if(session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
		@endif
<div class="div-1">
    <div class="content">
        <h1 class = "title1"><b>Green Connect</b></h1>
        <h1 class = "title1"><b>Nourish Your Body,</b></h1>
        <h1 class = "title1"><b>Nourished by Earth</b></h1>
        <div style = "height: 3vh;"></div>
        <h4 class = "title2"><b>Discover the taste of plant-based meals at Green Chef, where every meal CONNECTS sustainability and flavor</b></h4>
    </div>
    <div class="image-container">
        <img src="{{ asset('images/PLANT-BASED GOODNESS.png') }}" alt="Earth" class="responsive-image">
    </div>
    
</div>
<!-- 4 boxes-->
<div class="container">
    <div class="card">
      <div class="inner">
        <div class="front">
          <h2>Weight Loss</h2>
          <img src="{{ asset('images/logo.png') }}" alt="logo"  style="height: 30vh">
          <p>Low-calorie meals for weight loss</p>
          <h4>₱3000.00/2 weeks</h4>
        </div>
        <div class="back">
                <p> <span>&#10003;</span>  Free consultation and close monitoring from our Registered Nutritionist Dietitian</p> <!--https://www.toptal.com/designers/htmlarrows/symbols/check-mark/-->
                <p> <span>&#10003;</span>  Calorie-counted plant-based lunch and dinner from Mondays to Fridays</p>
                <p> <span>&#10003;</span>  Meal plan guide for everyday breakfast</p>
                <p> <span>&#10003;</span>  Meal plan guide for weekends</p>
                <p> <span>&#10003;</span>  Free Delivery within Dumaguete City</p>
                <div class="payment">
                  <img src="{{ asset('images/5.png') }}" alt="Maya">
                  <img src="{{ asset('images/6.png') }}" alt="Gcash">
                </div>
                <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Subscribe Now</button>
        </div>
      </div>
    </div>
    
    <div class="card">
      <div class="inner">
        <div class="front">
          <h2>Weight Gain</h2>
          <img src="{{ asset('images/logo.png') }}" alt="logo"  style="height: 30vh">
          <p>High-calorie meals for weight gain</p>
          <h4>₱3300.00/2 weeks</h4>
        </div>
        <div class="back">
                <p> <span>&#10003;</span>  Free consultation and close monitoring from our Registered Nutritionist Dietitian</p> <!--https://www.toptal.com/designers/htmlarrows/symbols/check-mark/-->
                <p> <span>&#10003;</span>  Calorie-counted plant-based lunch and dinner from Mondays to Fridays</p>
                <p> <span>&#10003;</span>  Meal plan guide for everyday breakfast</p>
                <p> <span>&#10003;</span>  Meal plan guide for weekends</p>
                <p> <span>&#10003;</span>  Free Delivery within Dumaguete City</p>
                <div class="payment">
                  <img src="{{ asset('images/5.png') }}" alt="Maya">
                  <img src="{{ asset('images/6.png') }}" alt="Gcash">
                </div>
                <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Subscribe Now</button>
              
        </div>
      </div>
    </div>

    <div class="card">
      <div class="inner">
        <div class="front">
          <h2>Therapeutic Diet</h2>
          <img src="{{ asset('images/logo.png') }}" alt="logo"  style="height: 30vh">
          <p>Customized for specific health needs</p>
          <h4>₱3500.00/2 weeks</h4>
        </div>
        <div class="back">
                <p> <span>&#10003;</span>  Free consultation and close monitoring from our Registered Nutritionist Dietitian</p> <!--https://www.toptal.com/designers/htmlarrows/symbols/check-mark/-->
                <p> <span>&#10003;</span>  Calorie-counted plant-based lunch and dinner from Mondays to Fridays</p>
                <p> <span>&#10003;</span>  Meal plan guide for everyday breakfast</p>
                <p> <span>&#10003;</span>  Meal plan guide for weekends</p>
                <p> <span>&#10003;</span>  Free Delivery within Dumaguete City</p>
                <div class="payment">
                  <img src="{{ asset('images/5.png') }}" alt="Maya">
                  <img src="{{ asset('images/6.png') }}" alt="Gcash">
                </div>
                <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Subscribe Now</button>
              
        </div>
      </div>
    </div>

    <div class="card">
      <div class="inner">
        <div class="front">
          <h2>Gluten-Free Diet</h2>
          <img src="{{ asset('images/logo.png') }}" alt="logo"  style="height: 30vh">
          <p>Specially curated gluten-free meals</p>
          <h4>₱3500.00/2 weeks</h4>
        </div>
        <div class="back">
                <p> <span>&#10003;</span>  Free consultation and close monitoring from our Registered Nutritionist Dietitian</p> <!--https://www.toptal.com/designers/htmlarrows/symbols/check-mark/-->
                <p> <span>&#10003;</span>  Calorie-counted plant-based lunch and dinner from Mondays to Fridays</p>
                <p> <span>&#10003;</span>  Meal plan guide for everyday breakfast</p>
                <p> <span>&#10003;</span>  Meal plan guide for weekends</p>
                <p> <span>&#10003;</span>  Free Delivery within Dumaguete City</p>
                <div class="payment">
                  <img src="{{ asset('images/5.png') }}" alt="Maya">
                  <img src="{{ asset('images/6.png') }}" alt="Gcash">
                </div>
                <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Subscribe Now</button>
              
        </div>
      </div>
    </div>
   
  </div>

<!--testimonial
<div style = "height: 7vh;"></div>
<div class="container">
    <h1 class ="title4"><b>Testimonials</b></h1>
</div>

<div class="div-2">
        <div class="flex-item2">

            <div style="height: 500px;overflow: hidden;position: relative;">
                <div class = "picture">
                    <img alt="Person1" src="{{ asset('images/freepik3.jpg') }}" class = "testi"/>
                </div>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor 
                .
                    
                    
                </p>

                <p style = "font-size:20px; margin-bottom:0px;">John Doe</p>
                <p">Weight Loss Meal Plan Subscriber</p>
            </div>

        </div>
        <div class="flex-item2">


            <div style="height: 500px;overflow: hidden;position: relative;">
                <div class = "picture">
                    <img alt="Person1" src="{{ asset('images/freepik3.jpg') }}" class = "testi"/>
                </div>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor 
                .
                    
                </p>
                <p style = "font-size:20px; margin-bottom:0px;">James Doe</p>
                <p">Weight Gain Meal Plan Subscriber</p>
            </div>

        </div>
        <div class="flex-item2">


            <div style="height: 500px;overflow: hidden;position: relative;">
                <div class = "picture">
                    <img alt="Person1" src="{{ asset('images/freepik3.jpg') }}" class = "testi"/>
                </div>
                <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor 
                .
                    
                </p>
                <p style = "font-size:20px; margin-bottom:0px;">Jane Joe</p>
                <p">Therapeutic Diet Plan Subscriber</p>
            </div>
        </div>
    </div>
</div>
-->
<div class="footer">
    <div class="footer-left">
        <div><p class = "f-text">The Green Chef Dumaguete</p></div>
        <div><p class = "f-text">Sta. Rosa St., Dumaguete, Negros Oriental, Dumaguete City, Philippines</p></div>
        <div><p class = "f-text">thegreenchefdumaguete@gmail.com</p></div>
        <div><p class = "f-text">0991 677 9151</p></div>
    
    </div>
    <div class="footer-right">
        <a href="https://www.foodpanda.ph/restaurant/kxxh/the-green-chef-dumaguete-santa-rosa-street">
        <img src="{{ asset('images/panda.jpg') }}" alt="foodpanda">
        </a>
        <a href="https://food.grab.com/ph/en/restaurant/the-greenchef-mango-avenue-delivery/2-C2LXNJUWVVB2RN?">
        <img src="{{ asset('images/grab.jpg') }}" alt="grab">
        </a>
    </div>
</div>

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
