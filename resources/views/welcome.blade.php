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
                    <a class="nav-link active" aria-current="page" href="#">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">SUBSCRIPTION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>

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
<div class="div-2 cta">
    <div class="flex-container">
        <div class="flex-item cta">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                 ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
                 esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,</p>
                 <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Inquire Now</button>

        </div>
        <div class="flex-item cta">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                 ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
                 esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,</p>
                 <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Inquire Now</button>

        </div>
    </div>
</div>
<div class="div-2 cta">
    <div class="flex-container">
        <div class="flex-item">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                 ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
                 esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,</p>
                 <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Inquire Now</button>

        </div>
        <div class="flex-item">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                 ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit 
                 esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,</p>
                 <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Inquire Now</button>

        </div>
    </div>
</div>

<!--testimonial-->
<div style = "height: 7vh;"></div>
<div class="container">
    <h1 class ="title4"><b>Centered Heading</b></h1>
</div>

<div class="div-2">
    <div class="flex-container">
        <div class="flex-item2">
            
            <p>I've tried countless diets, but this subscription has been a game-changer! The meals are not only delicious but perfectly portioned and balanced. I’ve lost 8 pounds in 6 weeks, and I feel more energized than ever. The best part? No more meal prep stress!
                Kenny
                Weight Loss Meal Plan Subscriber</p>
        </div>
        <div class="flex-item2">
            <p>I've tried countless diets, but this subscription has been a game-changer! The meals are not only delicious but perfectly portioned and balanced. I’ve lost 8 pounds in 6 weeks, and I feel more energized than ever. The best part? No more meal prep stress!
                Kenny
                Weight Loss Meal Plan Subscriber</p>
        </div>
        <div class="flex-item2">
            <p>I've tried countless diets, but this subscription has been a game-changer! The meals are not only delicious but perfectly portioned and balanced. I’ve lost 8 pounds in 6 weeks, and I feel more energized than ever. The best part? No more meal prep stress!
                Kenny
                Weight Loss Meal Plan Subscriber</p>
        </div>
    </div>
</div>

<div class="footer">
    <div class="footer-left">
        <div><p class = "f-text">Establishment Name</p></div>
        <div><p class = "f-text">Street Address</p></div>
        <div><p class = "f-text">Email: example@example.com</p></div>
        <div><p class = "f-text">Phone: +123 456 7890</p></div>
    
    </div>
    <div class="footer-right">
        <img src="{{ asset('images/panda.jpg') }}" alt="Image 1">
        <img src="{{ asset('images/grab.jpg') }}" alt="Image 2">
    </div>
</div>
<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
