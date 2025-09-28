@extends('layouts.app')
@section('content_title','Penjualan Area')

@section('content')
<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">Isi Form</h3>
    </div>
    <form method="POST" action="{{ route('admin.member_pakets.update', $member_paket->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Member</label>
                        <select class="form-control" name="member_id" style="width: 100%;">
                            <option value="">Pilih Member</option>
                            @foreach ($members as $m)
                            <option value="{{ $m->id }}" {{ old('member_id', $member_paket->member_id) == $m->id ? 'selected' : '' }}>
                                {{ $m->user->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('paket_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <select class="form-control" name="paket_id" style="width: 100%;">
                            <option value="">Pilih Paket</option>
                            @foreach ($pakets as $p)
                            <option value="{{ $p->id }}" {{ old('paket_id', $member_paket->paket_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->nama_paket }}
                            </option>
                            @endforeach
                        </select>
                        @error('paket_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>status</label>
                        <select name="status" class="form-control" style="width:100%">
                            <option value="pending" {{ old('status', $member_paket->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ old('status', $member_paket->status) == 'paid' ? 'selected' : '' }}>Paid</option>
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

