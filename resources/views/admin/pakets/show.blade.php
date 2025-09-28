@extends('layouts.app')
@section('content_title','Dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>Nama Paket</td>
                                <td>{{ $paket->nama_paket }}</td>
                            </tr>
                            <tr>
                                <td>Biaya</td>
                                <td>{{ number_format($paket->biaya, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Durasi</td>
                                <td>{{ $paket->durasi }} hari</td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>{{ $paket->keterangan }}</td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>
                                    @if($paket->gambar)
                                        <a href="{{ asset($paket->gambar) }}" target="_blank">
                                            <img src="{{ asset($paket->gambar) }}" width="150px">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-footer">
                        <a href="{{ route('pakets.index') }}" class="btn btn-primary">Kembali ke Daftar Paket</a>
                    </div>
           
                </div>
            </div>
        </div>
    </div>
@endsection