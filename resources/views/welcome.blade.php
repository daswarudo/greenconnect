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
                    <a class="nav-link" id="subscription-link" style="cursor: pointer;">SUBSCRIPTION</a>
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
<div class = "div-2" id="flex-container">
    <div class = "flex-container" >
        <div class = "flex-item">
            <div>  <!-- temporary because krazy css-->
                <div style = "text-align:center;">
                    <p style = "font-size:35px;"><b>Weight-Loss Plan</b></p>
                    <p>Low-calorie meals curated for weight loss</p>
                    <p style = "font-size:30px;"><b>₱3000.00/2 weeks</b></p>
                </div>

                <p> <span>&#10003;</span>  Free consultation and close monitoring from our Registered Nutritionist Dietitian</p> <!--https://www.toptal.com/designers/htmlarrows/symbols/check-mark/-->
                <p> <span>&#10003;</span>  Calorie-counted plant-based lunch and dinner from Mondays to Fridays</p>
                <p> <span>&#10003;</span>  Meal plan guide for everyday breakfast</p>
                <p> <span>&#10003;</span>  Meal plan guide for weekends</p>
                <p> <span>&#10003;</span>  Free Delivery within Dumaguete City</p>
            </div>
            <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Inquire Now</button>

        </div>
        <div class = "flex-item">
            <div>  <!-- temporary because krazy css-->
                <div style = "text-align:center;">
                    <p style = "font-size:35px;"><b>Weight-Gain Plan</b></p>
                    <p>High-calorie meals designed for healthy weight gain</p>
                    <p style = "font-size:30px;"><b>₱3300.00/2 weeks</b></p>
                </div>

                <p> <span>&#10003;</span>  Free consultation and close monitoring from our Registered Nutritionist Dietitian</p>
                <p> <span>&#10003;</span>  Calorie-counted plant-based lunch and dinner from Mondays to Fridays</p>
                <p> <span>&#10003;</span>  Meal plan guide for everyday breakfast</p>
                <p> <span>&#10003;</span>  Meal plan guide for weekends</p>
                <p> <span>&#10003;</span>  Free Delivery within Dumaguete City</p>
            </div>
            <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Inquire Now</button>

        </div>
    </div>
</div>
<div class="div-2">
    <div class="flex-container">
        <div class = "flex-item">
            <div>  <!-- temporary because krazy css-->
                <div style = "text-align:center;">
                    <p style = "font-size:35px;"><b>Therapeutic Diet</b></p>
                    <p>Customized for individuals with specific health needs</p><!-- fix align later-->
                    <p style = "font-size:30px;"><b>₱3500.00/2 weeks</b></p>
                </div>

                <p> <span>&#10003;</span>  Free consultation and close monitoring from our Registered Nutritionist Dietitian</p>
                <p> <span>&#10003;</span>  Calorie-counted plant-based lunch and dinner from Mondays to Fridays</p>
                <p> <span>&#10003;</span>  Meal plan guide for everyday breakfast</p>
                <p> <span>&#10003;</span>  Meal plan guide for weekends</p>
                <p> <span>&#10003;</span>  Free Delivery within Dumaguete City</p>
            </div>
            <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Inquire Now</button>

        </div>
        <div class = "flex-item">
            <div>  <!-- temporary because krazy css-->
                <div style = "text-align:center;">
                    <p style = "font-size:35px;"><b>Gluten-Free Diet</b></p>
                    <p>Specially curated gluten-free meals for individuals with celiac disease or gluten sensitivity</p>
                    <p style = "font-size:30px;"><b>₱3500.00/2 weeks</b></p>
                </div>

                <p> <span>&#10003;</span>  Free consultation and close monitoring from our Registered Nutritionist Dietitian</p>
                <p> <span>&#10003;</span>  Calorie-counted plant-based lunch and dinner from Mondays to Fridays</p>
                <p> <span>&#10003;</span>  Meal plan guide for everyday breakfast</p>
                <p> <span>&#10003;</span>  Meal plan guide for weekends</p>
                <p> <span>&#10003;</span>  Free Delivery within Dumaguete City</p>
            </div>
            <button type="submit" class="btn btn-success" style="width: 200px; border-radius: 0; background-color: #52634f;">Inquire Now</button>

        </div>
    </div>
</div>

<!--testimonial-->
<div style = "height: 7vh;"></div>
<div class="container">
    <h1 class ="title4"><b>Testimonials</b></h1>
</div>

<div class="div-2"> <!--di ma align if lahi ang text for each testi, may use 'see more' function or change text-->
    <div class="flex-container2">
        <div class="flex-item2">

            <div style="height: 500px;overflow: hidden;position: relative;">
                <div class = "picture">
                    <img alt="Person1" src="{{ asset('images/freepik3.jpg') }}" class = "testi"/>
                </div>
                <p>
                    I've tried countless diets, but this subscription has been a game-changer! 
                    The meals are not only delicious but perfectly portioned and balanced. 
                    I’ve lost 8 pounds in 6 weeks, and I feel more 
                    energized than ever. 
                    The best part? No more meal prep stress!
                    
                    
                </p>

                <p style = "font-size:20px; margin-bottom:0px;">Kenny</p>
                <p">Weight Loss Meal Plan Subscriber</p>
            </div>

        </div>
        <div class="flex-item2">


            <div style="height: 500px;overflow: hidden;position: relative;">
                <div class = "picture">
                    <img alt="Person1" src="{{ asset('images/freepik3.jpg') }}" class = "testi"/>
                </div>
                <p>
                    As a vegan looking to gain weight, I struggled to find the right balance of nutrients. 
                    This subscription has exceeded my expectations! The meals are hearty, creative, and packed 
                    
                    with plant-based protein. I’ve noticed a steady increase in muscle mass, and I love the variety of dishes! 
                    
                </p>
                <p style = "font-size:20px; margin-bottom:0px;">James L.</p>
                <p">Weight Gain Meal Plan Subscriber</p>
            </div>

        </div>
        <div class="flex-item2">


            <div style="height: 500px;overflow: hidden;position: relative;">
                <div class = "picture">
                    <img alt="Person1" src="{{ asset('images/freepik3.jpg') }}" class = "testi"/>
                </div>
                <p>
                    I have specific dietary needs due to health conditions, and finding a convenient meal 
                    service has always been a challenge — until now. The therapeutic meal plan has made managing diet
                    so  
                    
                    easy and enjoyable. The meals I have more free time, and I’ve actually started enjoying cooking again! 
                    
                </p>
                <p style = "font-size:20px; margin-bottom:0px;">Priya S.</p>
                <p">Therapeutic Diet Plan Subscriber</p>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="footer-left">
        <div><p class = "f-text">The Green Chef Dumaguete</p></div>
        <div><p class = "f-text">Sta. Rosa St., Dumaguete, Negros Oriental, Dumaguete City, Philippines</p></div>
        <div><p class = "f-text">thegreenchefdumaguete@gmail.com</p></div>
        <div><p class = "f-text">0991 677 9151</p></div>
    
    </div>
    <div class="footer-right">
        <img src="{{ asset('images/panda.jpg') }}" alt="Image 1">
        <img src="{{ asset('images/grab.jpg') }}" alt="Image 2">
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
