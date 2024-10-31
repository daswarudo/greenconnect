
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
<!-- naa sa public/css folder ang css, ignore css sa resources sdfasfda-->
    
</head>
<body>

<script src="login.js"></script>
<div class="container" id="container">
	
	<div class="form-container sign-in-container">
		
		<form action="#">
		<img alt="Green Chef Logo" height="100" src="{{ asset('images/logo.png') }}" width="100" />				<!-- LOGIN FORM -->
			<h1>Sign In</h1>
			
			<h3><i class="fa fa-user"></i> Username</h3>
			<input type="text" placeholder="Username" />
            <h3><i class='fas fa-lock'></i> Password </h3>
			<input type="password" placeholder="Password" />
			
			<button> Sign In</i></button>
		</form>
	</div>
	<div class="overlay-container mobile-row">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>WELCOME TO GREEN CONNECT </h1>
				<p>GREEN CHEF'S PORTAL TO NUTRITION </p>
                <p>Don't have an account? </p>
				<a class="ghost" id="signUp" href="/signUp">Sign Up</a><!-- add later-->
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
