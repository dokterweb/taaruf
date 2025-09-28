@extends('layouts.app')
@section('content_title','Member Area')

@section('content')
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">Isi Form</h3>
    </div>
    <form method="POST" action="{{route('admin.members.update',$member->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label >Nama Member</label>
                        <input type="text" name="name" class="form-control" value="{{ $member->user->name }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ $member->tempat_lahir }}">
                        @error('tempat_lahir')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $member->tanggal_lahir }}">
                        @error('tanggal_lahir')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Kelamin</label>
                        <select name="kelamin" class="form-control" style="width:100%">
                            <option value="pria" {{ $member->kelamin == 'pria' ? 'selected' : '' }}>Pria</option>
                            <option value="wanita" {{ $member->kelamin == 'wanita' ? 'selected' : '' }}>Wanita</option>
                        </select>
                        @error('kelamin')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >No HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ $member->no_hp }}">
                        @error('no_hp')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" class="form-control" style="width:100%">
                            <option value="0" {{ $member->is_active == 0 ? 'selected' : '' }}>Non Aktif</option>
                            <option value="1" {{ $member->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                        </select>
                        @error('is_active')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $member->user->email }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label >Password</label>
                        <input type="password" name="password" class="form-control" autocomplete="new-password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    @if ($member->user->avatar)
                    <img src="{{public_path('storage/' . $member->user->avatar)}}" alt="avatar" width="200">
                    @endif
                    <div class="form-group">
                        <label for="exampleInputFile">Gambar</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="avatar" class="custom-file-input">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                        @error('avatar')
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