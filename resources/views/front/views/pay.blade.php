@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h3>Pembayaran Paket {{ $paket->nama_paket }}</h3>
    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
  document.getElementById('pay-button').onclick = function(){
    window.snap.pay('{{ $snapToken }}', {
      onSuccess: function(result){ console.log(result); },
      onPending: function(result){ console.log(result); },
      onError: function(result){ console.log(result); },
      onClose: function(){ alert('Kamu menutup popup tanpa menyelesaikan pembayaran'); }
    });
  };
</script>
@endsection
