@extends('layout.main')

@section('title', 'Create Pelanggan')
@section('breadcrumb', 'Create Pelanggan')
@section('page_title', 'Create Pelanggan')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h6>Form Tambah Pelanggan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pelanggan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Pelanggan</label>
                        <input type="text" name="namapelanggan" class="form-control @error('namapelanggan') is-invalid @enderror" placeholder="Masukkan nama pelanggan" value="{{ old('namapelanggan') }}" required>
                        @error('namapelanggan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat pelanggan" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="number" name="nomor" class="form-control @error('nomor') is-invalid @enderror" placeholder="Masukkan nomor telepon" value="{{ old('nomor') }}" required>
                        @error('nomor')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
