@extends('layouts.app')
@section('content_title','Penjualan Area')

@section('css')
  {{-- CSS Select2 masuk ke head lewat @yield('css') --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
  {{-- (Opsional) Tema Bootstrap 4 untuk nyatu dengan AdminLTE 3 --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">Isi Form</h3>
    </div>
    <form method="POST" action="{{ route('member_pakets.store') }}">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Member</label>
                        {{-- <select class="form-control" name="member_id" style="width: 100%;"> --}}
                        <select class="form-control select2" name="member_id" style="width: 100%;" data-placeholder="Pilih Member">
                            <option value="">Pilih Member</option>
                            @foreach ($members as $m)
                            <option value="{{ $m->id }}" {{ old('member_id') == $m->id ? 'selected' : '' }}>{{ $m->user->name }}</option>
                            @endforeach
                        </select>
                        @error('member_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <select class="form-control" name="paket_id" id="paket_id" style="width: 100%;">
                            <option value="">Pilih Paket</option>
                            @foreach ($pakets as $p)
                            <option value="{{ $p->id }}" data-durasi="{{ $p->durasi }}">
                              {{ $p->nama_paket }} ({{ $p->durasi }} bln)
                            </option>
                          @endforeach
                        </select>
                        @error('paket_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Tanggal Mulai</label>
                        <input type="date" name="tanggalmulai" id="tanggalmulai" class="form-control" value="{{ old('tanggalmulai') }}">
                        @error('tanggalmulai')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Tanggal Akhir</label>
                        <input type="date" name="tanggalakhir" id="tanggalakhir" class="form-control" value="{{ old('tanggalakhir') }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>status</label>
                        <select name="status" class="form-control" style="width:100%">
                            <option value="pending">pending</option>
                            <option value="paid">Paid</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(function () {
    $('.select2').select2({
      placeholder: function(){
        return $(this).data('placeholder') || '';
      },
      allowClear: true,
      width: 'resolve'
    });
  });

  $(function () {
  const $paket  = $('#paket_id');
  const $mulai  = $('#tanggalmulai');
  const $akhir  = $('#tanggalakhir');

  function addMonthsClamped(isoDate, months) {
    const [y, m, d] = isoDate.split('-').map(Number);
    // set ke tanggal 1 dulu biar aman, lalu “clamp” ke akhir bulan jika perlu
    const tmp = new Date(y, m - 1, 1);
    tmp.setMonth(tmp.getMonth() + months);
    const lastDay = new Date(tmp.getFullYear(), tmp.getMonth() + 1, 0).getDate();
    tmp.setDate(Math.min(d, lastDay));

    // Jika kebijakanmu “inklusif” (1 Jan + 1 bln = 31 Jan), buka baris ini:
    // tmp.setDate(tmp.getDate() - 1);

    const yyyy = tmp.getFullYear();
    const mm   = String(tmp.getMonth() + 1).padStart(2, '0');
    const dd   = String(tmp.getDate()).padStart(2, '0');
    return `${yyyy}-${mm}-${dd}`;
  }

  function hitungTanggalAkhir() {
    const start  = $mulai.val();
    const durasi = parseInt($paket.find(':selected').data('durasi'), 10); // durasi = bulan

    if (!start || isNaN(durasi)) {
      $akhir.val('');
      return;
    }
    $akhir.val( addMonthsClamped(start, durasi) );
  }

  $mulai.on('change', hitungTanggalAkhir);
  $paket.on('change', hitungTanggalAkhir);     // Select2 juga memicu event 'change'
  hitungTanggalAkhir();                        // prefll saat halaman load (kalau old() ada)
});
</script>
</script>
@endsection
