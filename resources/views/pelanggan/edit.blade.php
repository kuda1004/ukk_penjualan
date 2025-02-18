@extends('layout.main')

@section('title', 'Edit Pelanggan')
@section('breadcrumb', 'Edit Pelanggan')
@section('page_title', 'Edit Pelanggan')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h6>Form Edit Pelanggan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pelanggan.update', $pelanggan->pelangganid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Pelanggan</label>
                        <input type="text" name="namapelanggan" class="form-control @error('namapelanggan') is-invalid @enderror" value="{{ old('namapelanggan', $pelanggan->namapelanggan) }}" required>
                        @error('namapelanggan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="number" name="nomor" class="form-control @error('nomor') is-invalid @enderror" value="{{ old('nomor', $pelanggan->nomor) }}" required>
                        @error('nomor')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
