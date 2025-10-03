<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Title -->
	<title>TaarufLand Register</title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#FF50A2">
	<meta name="robots" content="index, follow"> 
	<meta name="format-detection" content="telephone=no">

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
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<div class="social-area">
					<form action="{{route('front.createMember')}}" method="post">
						@csrf
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Register</h5>
							</div>
							<div class="card-body">
								<div class="mb-2">
									<input type="text" name="name" class="form-control" placeholder="Full Name">
								</div>
								<div class="mb-2">
									<select name="kelamin" class="form-control">
										<option selected>Gender</option>
										<option value="pria">Male</option>
										<option value="wanita">Female</option>
									</select>
								</div>
								<div class="mb-2">
									<input type="number" name="no_hp" class="form-control" placeholder="Handphone No">
								</div>
								<div class="mb-2">
									<input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
								</div>
								<div class="mb-2">
									<input type="date" name="tanggal_lahir" class="form-control">
								</div>
								<div class="mb-2">
									<input type="email" name="email" class="form-control" placeholder="Enter Email">
								</div>
								<div class="mb-2 input-group input-group-icon">
									<input type="password" name="password" id="password" class="form-control dz-password" placeholder="Type Password Here">
									<span class="input-group-text show-pass"> 
										<i class="icon feather icon-eye-off eye-close"></i>
										<i class="icon feather icon-eye eye-open"></i>
									</span>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-icon-outline btn-white w-100">Create</button>
					</form>
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