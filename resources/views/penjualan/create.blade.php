@extends('layout.main')

@section('title', 'Tambah Penjualan')
@section('breadcrumb', 'Tambah Penjualan')
@section('page_title', 'Tambah Penjualan')

@section('content')
<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">Form Tambah Penjualan</div>
            <div class="card-body">
                <form action="{{ route('penjualan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tanggal Penjualan</label>
                        <input type="date" name="tanggalpenjualan" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Harga</label>
                        <input type="number" name="totalharga" value="0" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pelanggan</label>
                        <select name="pelangganid" class="form-control" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach ($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->pelangganid }}">{{ $pelanggan->namapelanggan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
