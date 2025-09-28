@extends('layouts.app')
@section('content_title','Paket Area')

@section('content')
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">Isi Form</h3>
    </div>
    <form method="POST" action="{{route('pakets.update',$paket->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}">
                        @error('nama_paket')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Biaya</label>
                        <input type="text" name="biaya" class="form-control" value="{{ $paket->biaya }}">
                        @error('biaya')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Durasi</label>
                        <input type="text" name="durasi" class="form-control" value="{{ $paket->durasi }}">
                        @error('durasi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    @if ($paket->gambar)
                    <img src="{{ asset($paket->gambar) }}" width="100px" alt="Gambar Paket">
                    @endif
                    <div class="form-group">
                        <label for="exampleInputFile">Gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="gambar" class="custom-file-input">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                        @error('gambar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label >Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control">{{ $paket->keterangan }}</textarea>
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

