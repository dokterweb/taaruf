@extends('layouts.app')

@section('css')
    <!-- Tambahkan CSS khusus untuk halaman ini -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@stop

@section('content_title','Paket Area')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Paket</h3>
            <div class="card-tools">
                <a href="{{route('member_pakets.create')}}" class="btn btn-info"><i class="fas fa-plus-circle"></i> Tambah</a>
            </div>
        </div>
        <div class="card-body table-responsive p-3">
            <table id="paketTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Member</th>
                        <th>Paket</th>
                        <th>Durasi</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Akhir</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($member_pakets as $row)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->member->user->name}} </td>
                        <td>{{$row->paket->nama_paket}} </td>
                        <td>{{$row->paket->durasi}} bulan</td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggalmulai)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggalakhir)->format('d-m-Y') }}</td>
                        <td>{{$row->status}} </td>
                        <td class="d-flex align-items-center" style="gap: 5px;">
                            <a href="{{route('member_pakets.edit',$row->id)}}" class="btn btn-sm btn-info"><i class="far fa-edit"></i></a>
                            
                            <form action="{{ route('member_pakets.destroy', $row->id ) }}" method="POST" class="d-inline" id="deleteForm{{ $row->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-btn" data-id="{{ $row->id }}">Delete</button>
                            </form>
                        </td> 
                    </tr>
                @empty
                <tr>
                    <td colspan="6">No Data</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

    <script>
         $(document).ready(function() {
            // Inisialisasi DataTables pada tabel dengan id 'paketTable'
            $('#paketTable').DataTable({
                "pageLength": 10, // Menentukan jumlah baris per halaman
                "responsive": true // Membuat tabel responsif untuk perangkat kecil
            });
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var rowId = $(this).data('id');
                var formId = '#deleteForm' + rowId;

                // SweetAlert untuk konfirmasi hapus
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form jika user mengkonfirmasi
                        $(formId).submit();
                    }
                });
            });
        });

    </script>
@endsection