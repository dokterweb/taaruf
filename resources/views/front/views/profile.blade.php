
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- Title -->
	<title>Profile Member</title>

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
	<div class="page-content space-top p-b60">
		<div class="container pt-0"> 
			<div class="profile-area">
				<div class="main-profile">
					<div class="about-profile">
						{{-- <a href="setting.html" class="setting dz-icon">
							<i class="flaticon flaticon-setting"></i>
						</a> --}}
						<div class="media rounded-circle">
							<img src="{{asset('assets')}}/images/user/pria.jpg" alt="profile-image">
							<svg class="radial-progress m-b20" data-percentage="{{ $percentage }}" viewBox="0 0 80 80">
								<circle class="incomplete" cx="40" cy="40" r="35"></circle>
								<circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
							</svg>
							<div class="data-fill style-2"><span>{{ $percentage }}% Complete</span></div>
						</div>
						{{-- <a href="edit-profile.html" class="edit-profile dz-icon">
							<i class="flaticon flaticon-pencil-2"></i>
						</a> --}}
					</div>
					<div class="profile-detail">
						<h4 class="name">{{ $user->name }}{{ $age ? ', ' . $age : '' }}</h4>
						<p class="mb-0"><i class="icon feather icon-map-pin me-1"></i>  {{$member->tempat_tinggal ?? 'Tidak ada data'}}</p>
					</div>
				</div>
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul class="mb-0">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
					</ul>
				</div>
				@endif

				@if (session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-message">
					{{ session('success') }}
				</div>
				@endif
				@if (session('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert" id="flash-message">
					{{ session('error') }}
				</div>
				@endif
				<div class="row g-2 mb-5">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title">Edit Profile</h5>
							</div>
							<div class="card-body">
								<form method="POST" action="{{ route('front.profile.update') }}">
									@csrf
									@method('PUT')
									<div class="mb-2">
										<input type="text" name="name" class="form-control"
											   value="{{ old('name', $member->user->name) }}" placeholder="Nama Lengkap">
									</div>
									<div class="mb-2">
										<input type="text" name="tempat_lahir" class="form-control"
										value="{{ old('tempat_lahir', $member->tempat_lahir ?? '') }}">
									</div>
									<div class="mb-2">
										<input type="date" name="tanggal_lahir" class="form-control"
										value="{{ old('tanggal_lahir', $member->tanggal_lahir ?? '') }}">
									</div>
									<div class="mb-2">
										<select name="kelamin" class="form-select" required>
											@php $kel = old('kelamin', $member->kelamin ?? 'pria'); @endphp
											<option value="pria"   {{ $kel === 'pria' ? 'selected' : '' }}>Pria</option>
											<option value="wanita" {{ $kel === 'wanita' ? 'selected' : '' }}>Wanita</option>
										</select>
									</div>
									<div class="mb-2">
										<input type="text" name="no_hp" class="form-control"
										value="{{ old('no_hp', $member->no_hp ?? '') }}">
									</div>
									<div class="mb-2">
										<input type="text" name="tempat_tinggal" class="form-control"
										value="{{ old('tempat_tinggal', $member->tempat_tinggal ?? '') }}" placeholder="Tempat Tinggal">
									</div>
									<div class="mb-2">
										<input type="text" name="pendidikan" class="form-control"
										value="{{ old('pendidikan', $member->pendidikan ?? '') }}" placeholder="pendidikan">
									</div>
									<div class="mb-2">
										<input type="text" name="hafalan_surat" class="form-control"
										value="{{ old('hafalan_surat', $member->hafalan_surat ?? '') }}"  placeholder="hafalan_surat">
									</div>
									<div class="mb-2">
										<input type="text" name="karakter" class="form-control"
										value="{{ old('karakter', $member->karakter ?? '') }}" placeholder="karakter">
									</div>
									<div class="mb-2">
										<input type="text" name="karakter_pasangan" class="form-control"
										value="{{ old('karakter_pasangan', $member->karakter_pasangan ?? '') }}" placeholder="karakter_pasangan">
									</div>
									<div class="mb-2">
										<input type="email" name="email" class="form-control" value="{{ $member->user->email }}">
									</div>
									<div class="mb-2 input-group input-group-icon">
										<input type="password" name="password" class="form-control dz-password">
										<span class="input-group-text show-pass"> 
											<i class="icon feather icon-eye-off eye-close"></i>
											<i class="icon feather icon-eye eye-open"></i>
										</span>
									</div>
									<div class="mb-2">
										<input type="password" name="password_confirmation" class="form-control"
										placeholder="Konfirmasi password baru (opsional)">
									</div>
									<button type="submit" class="btn btn-gradient mb-3 btn-block rounded-xl">Update</button>
								</form>
							</div>
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