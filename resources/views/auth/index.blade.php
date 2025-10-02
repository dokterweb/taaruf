<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Title -->
	<title>TaarufLand Login</title>
	<!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets')}}/images/favicon.png">
    <!-- Stylesheets -->
    <link rel="stylesheet" class="main-css" type="text/css" href="{{asset('assets')}}/css/style.css">
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	
</head>   
<body class="primary-gradient" data-theme-color="color-primary-2">
<div class="page-wrapper">
	<!-- Preloader -->
	<div id="preloader">
		<div class="loader">
			<div class="load-circle"><div></div><div></div></div>
		</div>
	</div>
	<!-- Preloader end-->	
    <!-- Welcome Start -->
	<div class="content-body">
		<div class="welcome-area">
			<div class="welcome-inner flex-column">
				<div class="logo-area">
					<img class="logo" src="{{asset('assets')}}/images/logowhitenew.png" alt="">
					<p class="para-title">Media Platform Ta'aruf Exlusive para Profesional dan Akademisi<br>
						Ikhtiar menemukan Jodoh Sekufu untuk menuju Pernikahan</p>
				</div>
				
				<div class="social-area">
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form action="{{route('login')}}" method="post">
						@csrf
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Sign In</h5>
							</div>
							<div class="card-body">
								<div class="mb-2 input-group input-group-icon">
									<span class="input-group-text">
										<div class="input-icon">
											<i class="icon feather icon-mail"></i>
										</div>
									</span>
									<input type="email" name="email" class="form-control" placeholder="Enter Email">
								</div>
								<div class="mb-2 input-group input-group-icon">
									<span class="input-group-text">
										<div class="input-icon">
											<i class="icon feather icon-lock"></i>
										</div>
									</span>
									<input type="password" name="password" id="password" class="form-control dz-password" placeholder="Type Password Here">
									<span class="input-group-text show-pass"> 
										<i class="icon feather icon-eye-off eye-close"></i>
										<i class="icon feather icon-eye eye-open"></i>
									</span>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-icon-outline btn-white w-100">Sign In</button>
					</form>
					
					<h5 class="text-light"><a href="{{route('register')}}">Create New Account</a></h5>
				</div>
			</div>
		</div>
	</div>
    <!-- Welcome End -->
    
</div>
<!--**********************************
    Scripts
***********************************-->
<script src="{{asset('assets')}}/js/jquery.js"></script>
<script src="{{asset('assets')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets')}}/js/settings.js"></script>
<script src="{{asset('assets')}}/js/custom.js"></script>
</body>
</html>