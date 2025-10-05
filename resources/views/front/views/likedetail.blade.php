
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- Title -->
	<title>Like Detail</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#FF50A2">
	<meta name="robots" content="index, follow"> 
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
<body class="bg-white" data-theme-color="color-primary-2">
<div class="page-wrapper">
    
	<!-- Preloader -->
	<div id="preloader">
		<div class="loader">
			<div class="load-circle"><div></div><div></div></div>
		</div>
	</div>
    <!-- Preloader end-->
	
	<!-- Header -->
		<header class="header header-fixed bg-white">
			<div class="container">
				<div class="header-content">
					<div class="left-content">
						<a href="{{route('front.likelist')}}" class="back-btn">
							<i class="icon feather icon-arrow-left"></i>
						</a>
						<h6 class="title">Back</h6>
					</div>
					<div class="mid-content header-logo">
					</div>
					<div class="right-content dz-meta">
					</div>
				</div>
			</div>
		</header>
	<!-- Header -->
	
	<!-- Page Content Start -->
	<div class="page-content space-top p-b40">
		<div class="container">
			<div class="detail-area">
				<div class="dz-media-card style-2">
					<div class="dz-media">
						<img src="{{ asset($member->user->avatar) }}" alt="avatar">
					</div>
					<div class="dz-content">
						<div class="left-content">
                            <h4 class="title">{{ $member->user->name }}, {{ \Carbon\Carbon::parse($member->tanggal_lahir)->age }}</h4>
							<p class="mb-0"><i class="icon feather icon-map-pin"></i> {{ $member->tempat_tinggal }}</p>
						</div>
						<a href="javascript:void(0);" class="dz-icon"><i class="flaticon flaticon-star-1"></i></a>
					</div>
				</div>
				<div class="detail-bottom-area">
					<div class="about">
						<h6 class="title">Basic information</h6>
						<table class="table">
							<tbody>
								<tr>
								<th scope="row">Tempat Lahir</th>
								<td>:</td>
								<td>{{ $member->tempat_lahir }}</td>
								</tr>
								<tr>
								<th scope="row">Tanggal Lahir</th>
								<td>:</td>
								<td>{{ $member->tanggal_lahir }}</td>
								</tr>
								<tr>
								<th scope="row">No HP</th>
								<td>:</td>
								<td>{{ $member->no_hp }}</td>
								</tr>
								<tr>
								<th scope="row">Tempat Tinggal</th>
								<td>:</td>
								<td>{{ $member->tempat_tinggal }}</td>
								</tr>
								<tr>
								<th scope="row">Pendidikan</th>
								<td>:</td>
								<td>{{ $member->pendidikan }}</td>
								</tr>
								<tr>
								<th scope="row">Karakter</th>
								<td>:</td>
								<td>{{ $member->karakter }}</td>
								</tr>
								<tr>
								<th scope="row">Karakter Pasangan</th>
								<td>:</td>
								<td>{{ $member->karakter_pasangan }}</td>
								</tr>
								<tr>
								<th scope="row">Hafalan Surat</th>
								<td>:</td>
								<td>{{ $member->hafalan_surat}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Content End -->
	<!-- Menubar -->
	<div class="footer fixed">
		<div class="dz-icon-box">
            <form action="{{ route('like.dislike_detail', $member->user->member->id) }}" method="POST" class="d-inline">
				@csrf
				<button type="submit" class="icon dz-flex-box dislike">
					<i class="flaticon flaticon-cross font-18"></i>
				</button>
			</form>
			<a href="home.html" class="icon dz-flex-box super-like"><i class="fa-solid fa-star"></i></a>
			@if (!$alreadyMatched)
            <form action="{{ route('like.like', $member->user->member->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="icon dz-flex-box like">
                    <i class="fa-solid fa-heart"></i>
                </button>
            </form>
			@endif
		</div>
	</div>
	<!-- Menubar -->
</div>  
<!--**********************************
    Scripts
***********************************-->

<script src="{{asset('assets')}}/js/jquery.js"></script>
<script src="{{asset('assets')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets')}}/vendor/wnumb/wNumb.js"></script><!-- WNUMB -->
<script src="{{asset('assets')}}/vendor/nouislider/nouislider.min.js"></script><!-- NOUSLIDER MIN JS-->
<script src="{{asset('assets')}}/js/dz.carousel.js"></script><!-- Swiper -->
<script src="{{asset('assets')}}/js/settings.js"></script>
<script src="{{asset('assets')}}/js/custom.js"></script>
</body>
</html>