@extends('layouts.app')
@section('css')
    <!-- Tambahkan CSS khusus untuk halaman ini -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@stop

@section('content_title','Member Area')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Member</h3>
                <div class="card-tools">
                <a href="{{route('admin.members.create')}}" class="btn btn-info"><i class="fas fa-plus-circle"></i> Tambah
                </a>
              </div>
            </div>
        <div class="card-body">
            <table id="paketTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Member</th>
                        <th>Tempat Lahir</th>
                        <th>Tgl Lahir</th>
                        <th>Kelamin</th>
                        <th>No. HP</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($members as $row)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->user->name}} </td>
                        <td>{{$row->tempat_lahir}} </td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td>{{$row->kelamin}} </td>
                        <td>{{$row->no_hp}} </td>
                        <td class="d-flex align-items-center" style="gap: 5px;">
                            <a href="{{route('admin.members.edit',$row->id)}}" class="btn btn-sm btn-info"><i class="far fa-edit"></i></a>
                            <form action="{{ route('admin.members.destroy', $row->id ) }}" method="POST" class="d-inline" id="deleteForm{{ $row->id }}">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        // Menampilkan SweetAlert2 jika ada session 'success'
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>
@endsection