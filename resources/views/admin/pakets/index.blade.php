@extends('layouts.app')
@section('content_title','Paket Area')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List Paket</h3>
            <div class="card-tools">
                <a href="{{route('pakets.create')}}" class="btn btn-info"><i class="fas fa-plus-circle"></i> Tambah</a>
            </div>
        </div>
        <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <th>Gambar</th>
                        <th>Biaya</th>
                        <th>Durasi</th>
                        <th>Act</th>
                        
                    </tr>
                </thead>
                <tbody>
                @forelse ($pakets as $row)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img src="{{ asset($row->gambar) }}" width="80px" alt="Gambar Paket"></td>
                        <td>{{$row->nama_paket}} </td>
                        <td>{{$row->biaya}} </td>
                        <td>{{$row->durasi}} </td>
                        <td class="d-flex align-items-center" style="gap: 5px;">
                            <a href="{{route('pakets.show',$row->id)}}" class="btn btn-sm btn-success">Show</a>
                            <a href="{{route('pakets.edit',$row->id)}}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('pakets.destroy', $row->id ) }}" method="POST" class="d-inline" id="deleteForm{{ $row->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-btn" data-id="{{ $row->id }}">Delete</button>
                            </form>
                        </td> 
                    </tr>
                @empty
                <tr>
                    <td colspan="5">No Data</td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
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