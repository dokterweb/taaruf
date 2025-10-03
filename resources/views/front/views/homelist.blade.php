
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- Title -->
	<title>Home List</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#FF50A2">
	<meta name="robots" content="index, follow"> 
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
<style>
	.dz-content {
    position: relative; /* supaya anaknya bisa absolute */
}

.dz-content .dz-icon-box {
    position: absolute;
    left: 50%;
    transform: translateX(-50%); /* ini bikin rata tengah horizontal */
    bottom: 60px; /* geser naik: makin besar nilainya, makin ke atas */
    display: flex;
    gap: 20px; /* jarak antar tombol */
    z-index: 20;
}

.dz-content .dz-icon-box .icon {
    background: #fff;
    border-radius: 50%;
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    font-size: 22px;
    color: #333;
}
</style>
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

			@if(session('matched_name'))
				<div class="alert alert-success solid alert-dismissible fade show">
					<svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
						<circle cx="12" cy="12" r="10"></circle>
						<path d="M16 12l-4-4-4 4"></path>
					</svg>
					<strong>Selamat!</strong> Anda dan <strong>{{ session('matched_name') }}</strong> saling menyukai. Kalian telah <strong>Match!</strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
						<span><i class="icon feather icon-x"></i></span>
					</button>
				</div>
			@endif

			@if(session('success') && session('liked_name'))
				<div class="alert alert-info solid alert-dismissible fade show">
					<svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
						<circle cx="12" cy="12" r="10"></circle>
						<line x1="12" y1="16" x2="12" y2="12"></line>
						<line x1="12" y1="8" x2="12.01" y2="8"></line>
					</svg>
					<strong>Info!</strong> Anda sudah like <strong>{{ session('liked_name') }}</strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
						<span><i class="icon feather icon-x"></i></span>
					</button>
				</div>
			@endif
			
			<div class="dzSwipe_card-cont dz-gallery-slider">

				@forelse($cards as $m)
					@php
					$avatar = asset($m->user->avatar);
					$name   = $m->user?->name ?? 'User';
					$age    = $m->tanggal_lahir ? \Carbon\Carbon::parse($m->tanggal_lahir)->age : null;
					$ttl    = $m->tempat_tinggal ?: '-';
					@endphp

					<div class="dzSwipe_card mb-3">
					<div class="dz-media">
						<img src="{{ $avatar }}" alt="avatar">
					</div>
				
					<div class="dz-content">
						<div class="left-content">
						{{-- contoh badge opsional --}}
						<span class="badge badge-primary d-inline-flex gap-1 mb-2">
							<i class="icon feather icon-map-pin"></i>Same Package
						</span>

						<h4 class="title">
							<a href="{{ route('front.profile') }}"> {{-- ganti ke route detail jika ada --}}
							{{ $name }}{{ $age ? ', '.$age : '' }}
							</a>
						</h4>

						<p class="mb-0">
							<i class="icon feather icon-map-pin"></i>
							{{ $ttl }}
						</p>
						</div>
						<div class="dz-icon-box">
							<form action="{{ route('like.dislike', $m->id) }}" method="POST" class="d-inline">
								@csrf
								<button type="submit" class="icon dz-flex-box dislike">
									<i class="flaticon flaticon-cross font-18"></i>
								</button>
							</form>
							<a href="home.html" class="icon dz-flex-box super-like"><i class="fa-solid fa-star"></i></a>
							{{-- <a href="wishlist.html" class="icon dz-flex-box like"><i class="fa-solid fa-heart"></i></a> --}}
							<form action="{{ route('like.like', $m->id) }}" method="POST" class="d-inline">
								@csrf
								<button type="submit" class="icon dz-flex-box like">
									<i class="fa-solid fa-heart"></i>
								</button>
							</form>
						</div>
						<a href="javascript:void(0);" class="dz-icon dz-sp-like"><i class="flaticon flaticon-star-1"></i></a>
						
					</div>

					<div class="dzSwipe_card__option dzReject"><i class="fa-solid fa-xmark"></i></div>
					<div class="dzSwipe_card__option dzLike"><i class="fa-solid fa-check"></i></div>
					<div class="dzSwipe_card__option dzSuperlike"><h5 class="title mb-0">Super Like</h5></div>
					<div class="dzSwipe_card__drag"></div>
					</div>
				@empty
					<p class="text-muted">Belum ada member lain dengan paket yang sama.</p>
				@endforelse
				
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
<script src="{{asset('assets')}}/js/tinderSwiper.min.js"></script>
<script src="{{asset('assets')}}/vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="{{asset('assets')}}/vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="{{asset('assets')}}/js/noui-slider.init.js"></script><!-- NOUSLIDER MIN JS-->
<script src="{{asset('assets')}}/js/dz.carousel.js"></script><!-- Swiper -->
<script src="{{asset('assets')}}/js/settings.js"></script>
<script src="{{asset('assets')}}/js/custom.js"></script>
<script>
	setTimeout(() => {
		document.querySelectorAll('.alert-dismissible').forEach(el => {
			el.style.transition = 'opacity 0.5s ease';
			el.style.opacity = '0';
			setTimeout(() => el.remove(), 500);
		});
	}, 5000);
</script>


</body>
</html>