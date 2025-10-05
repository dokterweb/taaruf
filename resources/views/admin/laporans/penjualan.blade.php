@extends('layouts.app')

@section('css')
    <!-- Tambahkan CSS khusus untuk halaman ini -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@stop

@section('content_title','Laporan Penjualan')

@section('content')
    <div class="card">
       <div class="card-body table-responsive p-3">
            <form method="GET" action="{{ route('laporan.penjualan') }}" class="row mb-4">
                <div class="col-md-3">
                    <label>Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $start }}">
                </div>
                <div class="col-md-3">
                    <label>End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $end }}">
                </div>
                <div class="col-md-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="">Semua</option>
                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $status == 'paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label><br>
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Nama Paket</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($results as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->member->user->name ?? '-' }}</td>
                            <td>{{ $row->paket->nama_paket ?? '-' }}</td>
                            <td>{{ $row->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ ucfirst($row->status) }}</td>
                            <td>{{ number_format($row->paket->biaya ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
                @if ($results->count() > 0)
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end"><strong>Total Biaya:</strong></td>
                            <td><strong>{{ number_format($total_biaya, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

  
@endsection