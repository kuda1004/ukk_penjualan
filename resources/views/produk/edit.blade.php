@extends('layout.main')

@section('title', 'Edit Produk')
@section('breadcrumb', 'Edit Produk')
@section('page_title', 'Edit Produk')

@section('content')
<div class="row">
<div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">Edit Produk</div>
            <div class="card-body">
                <form action="{{ route('produk.update', $produk->produkid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="namaproduk">Nama Produk</label>
                        <input type="text" class="form-control" id="namaproduk" name="namaproduk" value="{{ old('namaproduk', $produk->namaproduk) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok', $produk->stok) }}" required>
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
