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
	<link rel="stylesheet" href="{{asset('assets')}}/vendor/swiper/swiper-bundle.min.css">
    
	<!-- Stylesheets -->
    <link rel="stylesheet" class="main-css" type="text/css" href="{{asset('assets')}}/css/style.css">
	
    <!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<meta name="csrf-token" content="{{ csrf_token() }}">
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
	<div class="page-content space-top p-b60">
		<div class="container py-0">

			 {{-- Alert Error --}}
			 @if(session('error'))
			 <div class="alert alert-danger solid alert-dismissible fade show">
				 <strong>Error!</strong> {{ session('error') }}
				 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
					 <span><i class="icon feather icon-x"></i></span>
				 </button>
			 </div>
			 @endif

			<div class="row">
				@forelse ($pakets as $row)
				<div class="col-md-6 col-12 mb-2">
					<div class="dz-media-card style-3">
						<div>
							<img src="{{ asset($row->gambar) }}" alt="">
						</div>
						<div class="dz-content">
							<button type="button"  {{-- penting agar tidak submit form (GET) --}}
									class="btn btn-sm btn-dark rounded-xl pay-btn"
									data-url="{{ route('paket.pay', ['paket' => $row->id]) }}"
									data-name="{{ $row->nama_paket }}">
								JOIN NOW
							</button>
						</div>
						
					</div>
				</div>
				@empty 
                <div class="col-md-6 col-12 mb-2">
					<div class="dz-media-card style-3">
						<div>
							<h3>NO DATA</h3>
						</div>
						
					</div>
				</div>
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
<script src="{{asset('assets')}}/js/dz.carousel.js"></script><!-- Swiper -->
<script src="{{asset('assets')}}/js/settings.js"></script>
<script src="{{asset('assets')}}/js/custom.js"></script>

<script>
document.querySelectorAll('.pay-btn').forEach(button => {
    button.addEventListener('click', function() {
        const url = this.getAttribute('data-url');
        
        console.log('URL yang dikirim:', url); // Pastikan URL yang digunakan benar

        // Melakukan request ke server untuk mendapatkan snapToken
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                paket_id: this.getAttribute('data-name')  // Mengirim nama paket atau paket_id
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Data diterima:', data);  // Log data untuk debugging
            if (data.snapToken) {
                console.log('SnapToken diterima:', data.snapToken);  // Log untuk melihat nilai snapToken
                window.location.href = '/checkout/' + data.orderId;  // Redirect ke halaman checkout
            } else {
                alert('Gagal mendapatkan token pembayaran.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error terjadi: ' + error.message);
        });
    });
});

 	document.addEventListener("DOMContentLoaded", function() {
        // Ambil semua alert yang bisa ditutup
        const alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            // Setelah 5 detik (5000 ms), alert akan menghilang
            setTimeout(function() {
                alert.classList.remove('show'); // animasi fade
                alert.classList.add('hide');
                alert.style.display = 'none';
            }, 5000);
        });
    });
</script>
	  
</body>
</html>