<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran Paket</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <h1>Checkout untuk Paket: {{ $paket->nama_paket }}</h1>

<form id="pay-form">
    <input type="number" name="amount" value="{{ $paket->biaya }}" min="1000" readonly />
    <button type="submit" id="pay-button">Bayar Sekarang</button>
</form>

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
