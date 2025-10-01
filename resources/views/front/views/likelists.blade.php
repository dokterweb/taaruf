
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- Title -->
	<title>Profile Member</title>

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
	<link href="{{asset('assets')}}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
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
		<header class="header header-fixed bg-white border-0 style-2">
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
						{{-- <a href="javascript:void(0);" class="font-22">
							<i class="flaticon flaticon-computer-security-shield"></i>
							
						</a>	 --}}
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
	<div class="page-content p-t100 p-b50">
		<div class="container">
			<div class="dz-chat-search input-group input-group-icon input-mini">
				<div class="input-group-text">
					<div class="input-icon">
						<i class="icon feather icon-search"></i>
					</div>
				</div>
				<input type="text" class="form-control" placeholder="Search here...">								
			</div>
			<h6 class="tiltle mb-3">New Matches</h6>
			<div class="swiper chat-swiper">
				<div class="swiper-wrapper">
					@forelse($matches as $match)
                    <div class="swiper-slide">
                        <a href="{{ route('front.likedetail', $match->memberTwo->id) }}" class="recent">
                            <div class="media media-60 rounded-circle">
                                <img src="{{ asset($match->memberTwo->user->avatar) }}" alt="avatar">
                            </div>
                            <span>{{ $match->memberTwo->user->name }}</span>
                        </a>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <h3>No Matches</h3>
                    </div>
                @endforelse
				</div>
				
			</div>
			<div class="title-bar">
				<h6 class="title">Like</h6>
			</div>
			<ul class="message-list">
				@foreach($likes as $like)
					<li>
						{{-- <a href="{{ route('front.likedetail', $like->liker->user->id) }}"> --}}
						<a href="{{ route('front.likedetail', ['id' => $like->liker->user->id]) }}">
							<div class="media media-60">
								<img src="{{ asset($like->liker->user->avatar) }}" alt="image">
							</div>
							<div class="media-content">
								<div>
									<h6 class="name">{{ $like->liker->user->name }}</h6>
									<p class="last-msg">{{ $like->liker->user->member->no_hp }}</p>
								</div>
								<div class="right-content">
									<span class="date">{{ \Carbon\Carbon::parse($like->created_at)->diffForHumans(null, true) }}</span>
									<div class="seen-btn active dz-flex-box">
										<i class="icon feather icon-check"></i>
									</div>
								</div>
							</div>
						</a>
					</li>
				@endforeach
			</ul>
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
			<a href="chat-list.html" class="nav-link">
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
<script>
    // hilangkan notif setelah 5 detik
    setTimeout(() => {
        let el = document.getElementById('flash-message');
        if(el){
            el.classList.remove('show');
            el.classList.add('fade');
        }
    }, 5000);
</script>
</body>
</html>