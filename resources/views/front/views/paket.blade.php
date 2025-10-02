<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- Title -->
	<title>Dating Kit - Dating Mobile App Template ( Bootstrap + PWA )</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#FF50A2">

	<!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets')}}/images/favicon.png">
	
    <!-- Global CSS -->
	<link rel="stylesheet" href="{{asset('assets')}}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="{{asset('assets')}}/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
	<link rel="stylesheet" href="{{asset('assets')}}/vendor/swiper/swiper-bundle.min.css">
    
	<!-- Stylesheets -->
    <link rel="stylesheet" class="main-css" type="text/css" href="{{asset('assets')}}/css/style.css">
	
    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>   
<body class="header-large" data-theme-color="color-primary-2">
<div class="page-wrapper">
    
	<!-- Preloader -->
	<div id="preloader">
		<div class="loader">
			<div class="load-circle"><div></div><div></div></div>
		</div>
	</div>
    <!-- Preloader end-->
	
	<!-- Header -->
	<header class="header header-fixed border-0 style-2">
		<div class="container">
			<div class="header-content">
				<div class="left-content header-logo logo-lg">
					<a href="home.html">
						<img src="{{asset('assets')}}/images/logotaaruf.png" alt="">
					</a>
				</div>
				<div class="mid-content">
				</div>
				<div class="right-content">
				</div>
			</div>
		</div>
	</header>
<!-- Header -->
	
	<!-- Page Content Start -->
	<div class="page-content space-top p-b60">
		<div class="container py-0">
			<div class="row">
				<div class="col-md-6 col-12 mb-2">
					<div class="dz-media-card style-3">
						<div class="dz-media">
							<img src="{{asset('assets')}}/images/explore/program1.jpg" alt="">
						</div>
						<div class="dz-content">
							<h3 class="title">Niyyah</h3>
							<a href="javascript:void(0);" class="btn btn-sm btn-light rounded-xl">JOIN NOW</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-12 mb-2">
					<div class="dz-media-card style-3">
						<div class="dz-media">
							<img src="{{asset('assets')}}/images/explore/program2.jpg" alt="">
						</div>
						<div class="dz-content">
							<h3 class="title">Talab</h3>
							<a href="javascript:void(0);" class="btn btn-sm btn-light rounded-xl">JOIN NOW</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-12 mb-2">
					<div class="dz-media-card style-3">
						<div class="dz-media">
							<img src="{{asset('assets')}}/images/explore/program3.jpg" alt="">
						</div>
						<div class="dz-content">
							<h3 class="title">Jiddiyah</h3>
							<a href="javascript:void(0);" class="btn btn-sm btn-light rounded-xl">JOIN NOW</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-12 mb-2">
					<div class="dz-media-card style-3">
						<div class="dz-media">
							<img src="{{asset('assets')}}/images/explore/program4.jpg" alt="">
						</div>
						<div class="dz-content">
							<h3 class="title">Istitha'ah</h3>
							<a href="javascript:void(0);" class="btn btn-sm btn-light rounded-xl">JOIN NOW</a>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-12 mb-2">
					<div class="dz-media-card style-3">
						<div class="dz-media">
							<img src="{{asset('assets')}}/images/explore/program5.jpg" alt="">
						</div>
						<div class="dz-content">
							<h3 class="title">Al Husyiyyin</h3>
							<a href="javascript:void(0);" class="btn btn-sm btn-light rounded-xl">JOIN NOW</a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- Page Content End -->
	<!-- Menubar -->
	<div class="menubar-area style-3 footer-fixed">
		<div class="toolbar-inner menubar-nav">
			<a href="{{route('front.homelist')}}" class="nav-link">
				<i class="fa-solid fa-house"></i>
			</a>
			<a href="{{route('front.home')}}" class="nav-link">
				<i class="flaticon flaticon-magnifying-glass"></i>
			</a>
			<a href="wishlist.html" class="nav-link">
				<i class="flaticon flaticon-sparkle"></i>
			</a>
			<a href="{{route('front.likelist')}}" class="nav-link">
				<i class="flaticon flaticon-chat-2"></i>
			</a>
			<a href="{{route('front.profile')}}" class="nav-link active">
				<i class="fa-solid fa-user"></i>
			</a>
		</div>
	</div>
	<!-- Menubar -->
</div>  
<!--**********************************
    Scripts
***********************************-->
<script src="{{asset('assets')}}/js/jquery.js"></script>
<script src="{{asset('assets')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets')}}/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
<script src="{{asset('assets')}}/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script><!-- Swiper -->
<script src="{{asset('assets')}}/js/dz.carousel.js"></script><!-- Swiper -->
<script src="{{asset('assets')}}/js/settings.js"></script>
<script src="{{asset('assets')}}/js/custom.js"></script>
</body>
</html>