<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- Title -->
	<title>Taaruf Land</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#FF50A2">
    <meta property="og:title" content="Taaruf Land">
	<meta property="og:description" content="Transform your dating app vision into reality with our 'Dating Kit' - a powerful Bootstrap template for mobile dating applications. Seamlessly integrate captivating features, stylish UI components, and user-friendly functionality. Launch your dating app efficiently and elegantly using the Dating Kit template.">
	<meta property="og:image" content="https://datingkit.dexignzone.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">

	<!-- Favicons Icon -->
	{{-- <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets')}}/images/favicon.png"> --}}
    
    <!-- Global CSS -->
	<link rel="stylesheet" href="{{asset('assets')}}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="{{asset('assets')}}/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css">
	<link rel="stylesheet" href="{{asset('assets')}}/vendor/nouislider/nouislider.min.css">
	<link rel="stylesheet" href="{{asset('assets')}}/vendor/swiper/swiper-bundle.min.css">
    
	<!-- Stylesheets -->
    <link rel="stylesheet" class="main-css" type="text/css" href="{{asset('assets')}}/css/style.css">
	
    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>   
<body class="bg-white overflow-hidden header-large" data-theme-color="color-primary-2">
<div class="page-wrapper">
    
	<!-- Preloader -->
	<div id="preloader">
		<div class="loader">
			<div class="load-circle"><div></div><div></div></div>
		</div>
	</div>
    <!-- Preloader end-->
	
	<!-- Header -->	
		<header class="header header-fixed border-0 style-2 bg-white">
			<div class="container">
				<div class="header-content">
					<div class="left-content header-logo logo-lg">
						<a href="home.html">
							<img src="{{asset('assets')}}/images/logotaaruf.png" alt="">
						</a>
					</div>
					<div class="mid-content">
					</div>
					<div class="right-content d-flex gap-2">
						<a href="javascript:void(0);" class="filter-icon" data-bs-toggle="offcanvas" data-bs-target="#settingCanvas" aria-controls="offcanvasBottom">
							<i class="flaticon flaticon-settings-sliders"></i>
						</a>
						<a href="javascript:void(0);" class="menu-toggler">
							<i class="icon feather icon-grid"></i>
						</a>
					</div>
				</div>
			</div>
		</header>
	<!-- Header -->
	
	<!-- Sidebar -->
    <div class="dark-overlay"></div>
	<div class="sidebar">
		<div class="inner-sidebar">
			<a href="profile.html" class="author-box">
				<div class="dz-media">
					<img src="{{asset('assets')}}/images/user/female.png" alt="author-image">
				</div>
				<div class="dz-info">
					<h5 class="name">John Doe</h5>
					<span>example@gmail.com</span>
				</div>
			</a>
			<ul class="nav navbar-nav">	
				<li>
					<a class="nav-link active" href="home.html">
						<span class="dz-icon">
							<i class="icon feather icon-home"></i>
						</span>
						<span>Home</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="../package.html">
						<span class="dz-icon">
							<i class="icon feather icon-heart"></i>
						</span>
						<span>W3Dating Package</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="../package-list.html">
						<span class="dz-icon">
							<i class="icon feather icon-list"></i>
						</span>
						<span>Package List</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="../index.html">
						<span class="dz-icon">
							<i class="icon feather icon-wind"></i>
						</span>
						<span>Welcome</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="../components/components.html">
						<span class="dz-icon">
							<i class="icon feather icon-grid"></i>
						</span>
						<span>Components</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="setting.html">
						<span class="dz-icon">
							<i class="icon feather icon-settings"></i>
						</span>
						<span>Settings</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="profile.html">
						<span class="dz-icon">
							<i class="icon feather icon-user"></i>
						</span>
						<span>Profile</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="welcome.html">
						<span class="dz-icon">
							<i class="icon feather icon-log-out"></i>
						</span>
						<span>Logout</span>
					</a>
				</li>
			</ul>
			<div class="sidebar-bottom">
				<ul class="app-setting">
					<li>
						<div class="mode">
							<span class="dz-icon">                        
								<i class="icon feather icon-moon"></i>
							</span>					
							<span>Dark Mode</span>
							<div class="custom-switch">
								<input type="checkbox" class="switch-input theme-btn" id="toggle-dark-menu">
								<label class="custom-switch-label" for="toggle-dark-menu"></label>
							</div>					
						</div>
					</li>
				</ul>
				<div class="app-info">
					<h6 class="name">W3Dating - Dating App</h6>
					<span class="ver-info">App Version 1.1</span>
				</div>
			</div>
		</div>
	</div>
    <!-- Sidebar End -->
	
	<!-- Page Content Start -->
	@yield('content')
	<!-- Page Content End -->
	
	<!-- Menubar -->
	<div class="menubar-area style-3 footer-fixed">
		<div class="toolbar-inner menubar-nav">
			<a href="home.html" class="nav-link active">
				<i class="fa-solid fa-house"></i>
			</a>
			<a href="explore.html" class="nav-link">
				<i class="flaticon flaticon-magnifying-glass"></i>
			</a>
			<a href="wishlist.html" class="nav-link">
				<i class="flaticon flaticon-sparkle"></i>
			</a>
			<a href="chat-list.html" class="nav-link">
				<i class="flaticon flaticon-chat-2"></i>
			</a>
			<a href="profile.html" class="nav-link">
				<i class="fa-solid fa-user"></i>
			</a>
		</div>
	</div>
	<!-- Menubar -->

	<!--  Setting OffCanvas -->
    <div class="offcanvas offcanvas-bottom container p-0" tabindex="-1" id="settingCanvas">
		<button type="button" class="btn-close drage-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		<div class="offcanvas-header share-style m-0">
			<h5 class="title mb-0">Discovery Setting</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
		</div>
        <div class="offcanvas-body">
			<div class="dz-slider mb-3">
				<div class="slider-head">
					<h6 class="title mb-0">Maximum Distance</h6>
					<div class="title font-w600 font-16">
						<span class="example-val title slider-margin-value-min"></span>
						<span class="example-val title slider-margin-value-max"></span>
					</div>
				</div>
				<div class="slider-body">
					<div class="range-slider style-1 w-100">
						<div id="slider-tooltips3"></div>
					</div>
				</div>
			</div>
			<div class="show-me mb-3">
				<h6 class="title">Show Me</h6>
				<a href="javascript:void(0);" class="btn d-flex align-items-center justify-content-between btn-primary light py-2 px-3 font-14" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom4" aria-controls="offcanvasBottom">
					<span class="text-start d-block">Women</span>
					<i class="font-20 icon feather icon-chevron-right"></i>
				</a>
			</div>
			<div class="dz-slider">
				<div class="slider-head">
					<h6 class="title mb-0">Age Range</h6>
					<div class="title font-w600 font-16">
						<span class="example-val title slider-margin-value-min"></span>
						<span class="example-val title slider-margin-value-max"></span>
					</div>
				</div>
				<div class="slider-body">
					<div class="range-slider style-1 w-100">
						<div id="slider-tooltips4"></div>
					</div>
				</div>
			</div>
        </div>
    </div>
	<!--  Setting OffCanvas -->

	<!--  Show Me OffCanvas -->
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom4">
		<button type="button" class="btn-close drage-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		<div class="offcanvas-header share-style m-0 pb-0">
			<h5 class="title">Show Me</h5>
		</div>
        <div class="offcanvas-body">
			<div class="radio style-3">
				<label class="radio-label">
					<input type="radio" checked="checked" name="radio2">
					<span class="checkmark">						
						<span class="text">Women</span>					
					</span>
				</label>
				<label class="radio-label">
					<input type="radio" name="radio2">
					<span class="checkmark">
						<span class="text">Men</span>				
					</span>
				</label>
				<label class="radio-label">
					<input type="radio" name="radio2">
					<span class="checkmark">
						<span class="text">Everyone</span>						
					</span>
				</label>
			</div>
        </div>
    </div>
	<!--  Show Me OffCanvas -->
</div>  
<!--**********************************
    Scripts
***********************************-->
<script src="{{asset('assets')}}/js/jquery.js"></script>
<script src="{{asset('assets')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets')}}/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
<script src="{{asset('assets')}}/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script><!-- Swiper -->
<script src="{{asset('assets')}}/js/tinderSwiper.min.js"></script>
<script src="{{asset('assets')}}/vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="{{asset('assets')}}/vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="{{asset('assets')}}/js/noui-slider.init.js"></script><!-- NOUSLIDER MIN JS-->
<script src="{{asset('assets')}}/js/dz.carousel.js"></script><!-- Swiper -->
<script src="{{asset('assets')}}/js/settings.js"></script>
<script src="{{asset('assets')}}/js/custom.js"></script>
</body>
</html>