<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- Title -->
	<title>Wishlist</title>

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
	<link rel="stylesheet" href="{{asset('assets')}}/vendor/swiper/swiper-bundle.min.css">
    
	<!-- Stylesheets -->
    <link rel="stylesheet" class="main-css" type="text/css" href="{{asset('assets')}}/css/style.css">
	
    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

{{-- 	<style>
		.dz-media-card.style-4 .dz-media{
		position: relative;
		height: auto !important;     /* override kalau ada tinggi bawaan theme */
		overflow: hidden;
		border-radius: 18px;
		}
		.dz-media-card.style-4 .dz-media::before{
		content: "";
		display: block;
		padding-top: 150%;           /* 2:3 */
		}
		.dz-media-card.style-4 .dz-media > img{
		position: absolute;
		inset: 0;
		width: 100%;
		height: 100%;
		object-fit: cover;
		object-position: center;
		}
	  </style> --}}

</head>   
<body class="header-large bg-white" data-theme-color="color-primary-2">
<div class="page-wrapper">
    
	<!-- Preloader -->
	<div id="preloader">
		<div class="loader">
			<div class="load-circle"><div></div><div></div></div>
		</div>
	</div>
    <!-- Preloader end-->
	
	<!-- Header -->
		<header class="header header-fixed bg-white style-2 border-0">
			<div class="container">
				<div class="header-content">
					<div class="left-content header-logo logo-lg">
						<a href="home.html">
							<img src="{{asset('assets')}}/images/w3tinder/tinder.png" alt="">
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
	<div class="page-content p-t100 p-b50">
		<div class="container">
			<!-- Nav tabs -->
			
			@php use Carbon\Carbon; @endphp

			<div class="swiper-btn-center-lr">
				@forelse($pakets as $paket)
					<div class="title-bar mt-3 mb-2">
						<h6 class="title">{{ $paket->nama_paket }}</h6>
					</div>
			
				
					{{-- kasih id unik per paket agar mudah di-init --}}
					<div class="swiper spot-swiper mb-3" id="spot-swiper-{{ $paket->id }}">
						<div class="swiper-wrapper">
			
							@forelse($paket->random_members as $m)
								@php
								$name = $m->user->name ?? 'Member';
								$age  = $m->tanggal_lahir ? Carbon::parse($m->tanggal_lahir)->age : null;
								$city = $m->tempat_tinggal ?? '';
								// avatar: sesuaikan path milikmu
								$avatar = $m->user->member->kelamin=="pria" ? asset('avatars/male400.png') : asset('avatars/female400.png');
								@endphp
				
								<div class="swiper-slide">
									<div class="dz-media-card style-4">
										<a href="{{ route('front.home', ['from_wishlist' => true]) }}">
											<div class="dz-media">
												<img src="{{ $avatar }}" alt="{{ $name }}">
											</div>
											<div class="dz-content">
												<div class="left-content">
													<h6 class="title">
													{{ $name }}@if($age), {{ $age }}@endif
													</h6>
													<span class="active-status">{{ $city ?: 'Recommended' }}</span>
												</div>
												<div class="dz-icon ms-auto me-0">
													<i class="flaticon flaticon-star-1"></i>
												</div>
											</div>
										</a>
									</div>
								</div>
							@empty
							<div class="swiper-slide">
								<div class="dz-media-card style-4">
									<div class="dz-content p-3">
										<small class="text-muted">Belum ada member aktif di paket ini.</small>
									</div>
								</div>
							</div>
							@endforelse
			
						</div>
					</div>
				@empty
				<p class="text-muted">Tidak ada paket untuk ditampilkan.</p>
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
			<a href="{{route('front.wishlist')}}" class="nav-link">
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
<script src="{{asset('assets')}}/vendor/swiper/swiper-bundle.min.js"></script>
<script src="{{asset('assets')}}/js/settings.js"></script>
<script src="{{asset('assets')}}/js/dz.carousel.js"></script>
<script src="{{asset('assets')}}/js/custom.js"></script>

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.swiper.spot-swiper').forEach(function (el) {
      // Jika tema kamu sudah memuat Swiper, ini cukup.
      new Swiper('#' + el.id, {
        slidesPerView: 2.2,
        spaceBetween: 12,
        freeMode: true,
        // Sesuaikan breakpoint sesuai desainmu
        breakpoints: {
          576: { slidesPerView: 3, spaceBetween: 16 },
          768: { slidesPerView: 4, spaceBetween: 18 },
          1200:{ slidesPerView: 5, spaceBetween: 20 },
        },
      });
    });
  });
</script>

</body>
</html>