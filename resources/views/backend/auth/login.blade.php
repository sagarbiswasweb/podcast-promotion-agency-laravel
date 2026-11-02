
<!doctype html>
<html lang="en" dir="ltr"> <!-- This "custom-app.blade.php" master page is used only for "custom" page content present in "views/livewire" Ex: login, 404 -->
	
<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Noa - Laravel Bootstrap 5 Admin & Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="laravel admin template, bootstrap admin template, admin dashboard template, admin dashboard, admin template, admin, bootstrap 5, laravel admin, laravel admin dashboard template, laravel ui template, laravel admin panel, admin panel, laravel admin dashboard, laravel template, admin ui dashboard">

        <!-- TITLE -->
		<title>Admin Login</title>

        <!-- FAVICON -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/brand/favicon.ico" />

        <!-- BOOTSTRAP CSS -->
        <link id="style" href="{{ asset('') }}backend/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

        <!-- STYLE CSS -->
        <link href="{{ asset('') }}backend/assets/css/style.css" rel="stylesheet" />
        <link href="{{ asset('') }}backend/assets/css/skin-modes.css" rel="stylesheet" />

        
        
        <!--- FONT-ICONS CSS -->
        <link href="{{ asset('') }}backend/assets/plugins/icons/icons.css" rel="stylesheet" />

        <!-- INTERNAL Switcher css -->
        <link href="{{ asset('') }}backend/assets/switcher/css/switcher.css" rel="stylesheet">
        <link href="{{ asset('') }}backend/assets/switcher/demo.css" rel="stylesheet">

    </head>

    
        <body class="ltr login-img">
    
            <!-- GLOBAL-LOADER -->
            <div id="global-loader">
                <img src="{{ asset('') }}backend/assets/images/loader.svg" class="loader-img" alt="Loader">
            </div>

			<!-- PAGE -->
			<div class="page">
				<div class="container-login100">
					<div class="wrap-login100 p-0">
						<div class="card-body">
							<form class="login100-form validate-form" method="POST" action="{{ route('admin.login') }}">
								@csrf
								<span class="login100-form-title">
									Admin Login
								</span>

								{{-- Show all errors in one place --}}
								@if ($errors->any())
									<div class="alert alert-danger text-center" style="font-size: 14px;">
										@foreach ($errors->all() as $error)
											<div>{{ $error }}</div>
										@endforeach
									</div>
								@endif
								{{-- Email --}}
								<div class="wrap-input100 validate-input" data-bs-validate="Valid email is required: ex@abc.xyz">
									<input class="input100" 
										type="text" 
										name="email" 
										value="{{ old('email') }}" 
										placeholder="Email">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="zmdi zmdi-email" aria-hidden="true"></i>
									</span>
								</div>

								{{-- Password --}}
								<div class="wrap-input100 validate-input" data-bs-validate="Password is required" style="position: relative;">
									<input class="input100" 
										type="password" 
										name="password" 
										id="password" 
										placeholder="Password">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="zmdi zmdi-lock" aria-hidden="true"></i>
									</span>
									
									{{-- Eye icon for show/hide password --}}
									<span id="togglePassword" style="position: absolute; right: 15px; top: 12px; cursor: pointer; font-size: 18px;">
										<i class="zmdi zmdi-eye-off"></i>
									</span>
								</div>

								<div class="container-login100-form-btn">
									<button class="login100-form-btn btn-primary" type="submit">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- End PAGE -->

            
        <!-- JQUERY JS -->
        <script src="{{ asset('') }}backend/assets/plugins/jquery/jquery.min.js"></script>

        <!-- BOOTSTRAP JS -->
        <script src="{{ asset('') }}backend/assets/plugins/bootstrap/js/popper.min.js"></script>
        <script src="{{ asset('') }}backend/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

        <!-- Perfect SCROLLBAR JS-->
        <script src="{{ asset('') }}backend/assets/plugins/p-scroll/perfect-scrollbar.js"></script>

        <!-- STICKY JS -->
        <script src="{{ asset('') }}backend/assets/js/sticky.js"></script>

        
        
        <!-- COLOR THEME JS -->
        <script src="{{ asset('') }}backend/assets/js/themeColors.js"></script>

        <!-- CUSTOM JS -->
        <script src="{{ asset('') }}backend/assets/js/custom.js"></script>

        <!-- SWITCHER JS -->
        <script src="{{ asset('') }}backend/assets/switcher/js/switcher.js"></script>


		{{-- Script to toggle password visibility --}}
		<script>
			document.addEventListener("DOMContentLoaded", function () {
				const passwordInput = document.getElementById("password");
				const togglePassword = document.getElementById("togglePassword");
				const eyeIcon = togglePassword.querySelector("i");

				togglePassword.addEventListener("click", function () {
					const isPassword = passwordInput.getAttribute("type") === "password";
					passwordInput.setAttribute("type", isPassword ? "text" : "password");
					eyeIcon.classList.toggle("zmdi-eye");
					eyeIcon.classList.toggle("zmdi-eye-off");
				});
			});
		</script>
    </body>
</html>
