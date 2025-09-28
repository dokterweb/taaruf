
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- Title -->
	<title>Home List</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#FF50A2">
	<meta name="author" content="DexignZone">
	<meta name="robots" content="index, follow"> 
	<meta name="keywords" content="android, ios, mobile, application template, progressive web app, ui kit, multiple color, dark layout, match, partner, perfect match, dating app, dating, couples, dating kit, mobile app">
	<meta name="description" content="Transform your dating app vision into reality with our 'Dating Kit' - a powerful Bootstrap template for mobile dating applications. Seamlessly integrate captivating features, stylish UI components, and user-friendly functionality. Launch your dating app efficiently and elegantly using the Dating Kit template.">
	<meta property="og:title" content="Dating Kit - Dating Mobile App Template ( Bootstrap + PWA )">
	<meta property="og:description" content="Transform your dating app vision into reality with our 'Dating Kit' - a powerful Bootstrap template for mobile dating applications. Seamlessly integrate captivating features, stylish UI components, and user-friendly functionality. Launch your dating app efficiently and elegantly using the Dating Kit template.">
	<meta property="og:image" content="https://datingkit.dexignzone.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">

	<!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets')}}/images/favicon.png">
    
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
							<img src="{{asset('assets')}}/images/logonew.png" alt="">
						</a>
					</div>
					<div class="mid-content">
                    </div>
                    <div class="right-content">
                        <a href="{{ route('logout') }}" class="font-22"
							onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="fa-solid fa-right-from-bracket"></i>
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
							@csrf
						</form>
                    </div>
				</div>
			</div>
		</header>
	<!-- Header -->
	
	
	<!-- Page Content Start -->
	<div class="page-content space-top p-b65">
		<div class="container fixed-full-area">
			<div class="dzSwipe_card-cont dz-gallery-slider">
				<div class="dzSwipe_card">
					<div class="dz-media">
						<img src="{{asset('assets')}}/images/slider/listwomen.jpg" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<span class="badge badge-primary d-inline-flex gap-1 mb-2"><i class="icon feather icon-map-pin"></i>Nearby</span>
							<h4 class="title"><a href="profile-detail.html">Harleen , 24</a></h4>
							<p class="mb-0"><i class="icon feather icon-map-pin"></i> 3 miles away</p>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="dzSwipe_card__option dzReject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="dzSwipe_card__option dzLike">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="dzSwipe_card__option dzSuperlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="dzSwipe_card__drag"></div>
				</div>
				
				<div class="dzSwipe_card">
					<div class="dz-media">
						<img src="{{asset('assets')}}/images/slider/listman.jpg" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<span class="badge badge-primary d-inline-flex gap-1 mb-2"><i class="icon feather icon-map-pin"></i>Nearby</span>
							<h4 class="title"><a href="profile-detail.html">Richard , 21</a></h4>
							<p class="mb-0"><i class="icon feather icon-map-pin"></i> 5 miles away</p>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="dzSwipe_card__option dzReject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="dzSwipe_card__option dzLike">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="dzSwipe_card__option dzSuperlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="dzSwipe_card__drag"></div>
				</div>
				
				<div class="dzSwipe_card">
					<div class="dz-media">
						<img src="{{asset('assets')}}/images/slider/listwomen.jpg" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<h4 class="title"><a href="profile-detail.html">Natasha , 22</a></h4>
							<p class="mb-0"><i class="icon feather icon-map-pin"></i> 2 miles away</p>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="dzSwipe_card__option dzReject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="dzSwipe_card__option dzLike">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="dzSwipe_card__option dzSuperlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="dzSwipe_card__drag"></div>
				</div>
				
				<div class="dzSwipe_card">
					<div class="dz-media">
						<img src="{{asset('assets')}}/images/slider/listman.jpg" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<h4 class="title"><a href="profile-detail.html">Lisa Ray , 25</a></h4>
							<ul class="intrest">
								<li><span class="badge">Photography</span></li>
								<li><span class="badge">Street Food</span></li>
								<li><span class="badge">Foodie Tour</span></li>
							</ul>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="dzSwipe_card__option dzReject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="dzSwipe_card__option dzLike">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="dzSwipe_card__option dzSuperlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="dzSwipe_card__drag"></div>
				</div>
				
				<div class="dzSwipe_card">
					<div class="dz-media">
						<img src="{{asset('assets')}}/images/slider/listwomen.jpg" alt="">
					</div>
					<div class="dz-content">
						<div class="left-content">
							<span class="badge badge-primary mb-2">New here</span>
							<h4 class="title"><a href="profile-detail.html">Richard , 22</a></h4>
							<ul class="intrest">
								<li><span class="badge intrest">Climbing</span></li>
								<li><span class="badge intrest">Skincare</span></li>
								<li><span class="badge intrest">Dancing</span></li>
								<li><span class="badge intrest">Gymnastics</span></li>
							</ul>							
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
					</div>
					<div class="dzSwipe_card__option dzReject">
						<i class="fa-solid fa-xmark"></i>
					</div>
					<div class="dzSwipe_card__option dzLike">
						<i class="fa-solid fa-check"></i>
					</div>
					<div class="dzSwipe_card__option dzSuperlike">
						<h5 class="title mb-0">Super Like</h5>
					</div>
					<div class="dzSwipe_card__drag"></div>
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
			<a href="{{route('front.home')}}" class="nav-link active">
				<i class="flaticon flaticon-magnifying-glass"></i>
			</a>
			<a href="wishlist.html" class="nav-link">
				<i class="flaticon flaticon-sparkle"></i>
			</a>
			<a href="chat-list.html" class="nav-link">
				<i class="flaticon flaticon-chat-2"></i>
			</a>
			<a href="{{route('front.profile')}}" class="nav-link">
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
<script src="{{asset('assets')}}/js/tinderSwiper.min.js"></script>
<script src="{{asset('assets')}}/vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="{{asset('assets')}}/vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="{{asset('assets')}}/js/noui-slider.init.js"></script><!-- NOUSLIDER MIN JS-->
<script src="{{asset('assets')}}/js/dz.carousel.js"></script><!-- Swiper -->
<script src="{{asset('assets')}}/js/settings.js"></script>
<script src="{{asset('assets')}}/js/custom.js"></script>
</body>
</html>