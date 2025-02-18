@extends('layout.main')

@section('title', 'Edit Penjualan')
@section('breadcrumb', 'Edit Penjualan')
@section('page_title', 'Edit Penjualan')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h6>Form Edit Penjualan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('penjualan.update', $penjualan->penjualanid) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Tanggal Penjualan</label>
                        <input type="date" name="tanggalpenjualan" class="form-control @error('tanggalpenjualan') is-invalid @enderror" value="{{ old('tanggalpenjualan', $penjualan->tanggalpenjualan) }}" required>
                        @error('tanggalpenjualan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Harga</label>
                        <input type="number" name="totalharga" class="form-control @error('totalharga') is-invalid @enderror" value="{{ old('totalharga', $penjualan->totalharga) }}" required>
                        @error('totalharga')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pelanggan</label>
                        <select name="pelangganid" class="form-control @error('pelangganid') is-invalid @enderror" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->pelangganid }}" {{ $penjualan->pelangganid == $pelanggan->pelangganid ? 'selected' : '' }}>
                                {{ $pelanggan->namapelanggan }}
                            </option>
                            @endforeach
                        </select>
                        @error('pelangganid')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
