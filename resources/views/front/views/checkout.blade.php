<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Title -->
	<title>Pembayaran Paket</title>
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
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>   
<body data-theme-color="color-primary-2">
<div class="page-wrapper">
    
	<!-- Preloader -->
	<div id="preloader">
		<div class="loader">
			<div class="load-circle"><div></div><div></div></div>
		</div>
	</div>
    <!-- Preloader end-->
	
	<!-- Page Content Start -->
	<div class="page-content space-top">
		<div class="container"> 
			<div class="row gy-3 mb-4">
				<div class="col-12">
					<div class="dz-box gold">
						<div class="logo-img">
							<img class="logo" src="{{asset('assets')}}/images/logonew.png" alt="">
						</div>
						<p>Media Platform Ta'aruf Exclusive para Profesional dan Akademisi<br>
							Ikhtiar menemukan jodoh sekufu dan menuju pernikahan</p>
					</div>
				</div>
			</div>
			
			<div class="card style-4">
				<div class="card-header">
					<h6 class="title mb-0 font-14">Pesan</h6>
				</div>
				<div class="card-body">
					<div class="dz-box gold">
                        <h6>Checkout untuk Paket: {{ $paket->nama_paket }}</h6>
                        
                        <form id="pay-form">
                            <input type="number" name="amount" value="{{ $paket->biaya }}" min="1000" readonly />
                            <button type="submit" class="btn btn-sm btn-dark rounded-xl" id="pay-button">
                                    BAYAR SEKARANG
                            </button>
                        </form>
                    </div>
				</div>
			</div>
		</div> 
	</div>
	<!-- Page Content End -->
	
</div>  
<!--**********************************
    Scripts
***********************************-->
<script src="{{asset('assets')}}/js/jquery.js"></script>
<script src="{{asset('assets')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets')}}/js/settings.js"></script>
<script src="{{asset('assets')}}/js/custom.js"></script>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    // Trigger pembayaran saat tombol "Bayar Sekarang" ditekan
    const snapToken = "{{ $snapToken }}";

    document.getElementById('pay-button').onclick = function(event) {
        event.preventDefault();

        const orderId = "{{ $order->order_id }}";
        
        console.log('SnapToken yang diterima:', snapToken);
        
        snap.pay(snapToken, {
            onSuccess: function(result) {
                fetch('{{ route('paket.updateStatus', ['orderId' => ':orderId']) }}'.replace(':orderId', orderId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        status: 'paid',  // Status pembayaran yang berhasil
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Pembayaran berhasil dan status diperbarui.');
                        window.location.href = '{{ route('front.home') }}';
                    } else {
                        alert('Gagal memperbarui status pembayaran.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui status.');
                });
            },
            onPending: function(result) {
                alert('Pembayaran tertunda');
                console.log(result);
                // Update status ke pending jika pembayaran tertunda
            },
            onError: function(result) {
                alert('Pembayaran gagal');
                console.log(result);
            }
        });

    };
</script>

</body>
</html>