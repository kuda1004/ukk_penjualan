@extends('layout.main')

@section('title', 'Edit Detail Penjualan')
@section('breadcrumb', 'Edit Detail Penjualan')
@section('page_title', 'Edit Detail Penjualan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Edit Detail Penjualan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('detailpenjualan.update', $detailpenjualan->detailid) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="penjualanid">Penjualan</label>
                        <select class="form-control" id="penjualanid" name="penjualanid" required>
                            @foreach($penjualans as $penjualan)
                                <option value="{{ $penjualan->penjualanid }}" 
                                    {{ $penjualan->penjualanid == $detailpenjualan->penjualanid ? 'selected' : '' }}>
                                    {{ $penjualan->pelanggan->namapelanggan }} | {{ $penjualan->tanggalpenjualan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="produkid">Produk</label>
                        <select class="form-control" id="produkid" name="produkid" required>
                            @foreach($produks as $produk)
                                @if($produk->stok > 0 || $produk->produkid == $detailpenjualan->produkid)
                                    <option value="{{ $produk->produkid }}" 
                                        data-harga="{{ $produk->harga }}" 
                                        data-stok="{{ $produk->stok }}"
                                        {{ $produk->produkid == $detailpenjualan->produkid ? 'selected' : '' }}>
                                        {{ $produk->namaproduk }} (Stok: {{ $produk->stok }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="jumlahproduk">Jumlah Produk</label>
                        <input type="number" class="form-control" id="jumlahproduk" name="jumlahproduk" 
                            value="{{ $detailpenjualan->jumlahproduk }}" required min="1" max="{{ $detailpenjualan->produk->stok }}">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="subtotal">Subtotal</label>
                        <input type="number" class="form-control" id="subtotal" name="subtotal" 
                            value="{{ $detailpenjualan->subtotal }}" required readonly>
                    </div>
                    
                    <div class="text-end">
                        <a href="{{ route('detailpenjualan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function updateSubtotal() {
        let jumlahProduk = document.getElementById('jumlahproduk').value;
        let produkSelect = document.getElementById('produkid');
        let hargaProduk = produkSelect.options[produkSelect.selectedIndex].getAttribute('data-harga');

        if (jumlahProduk && hargaProduk) {
            let subtotal = jumlahProduk * hargaProduk;
            document.getElementById('subtotal').value = subtotal.toFixed(2);
        } else {
            document.getElementById('subtotal').value = '0';
        }
    }

    document.getElementById('jumlahproduk').addEventListener('input', updateSubtotal);
    document.getElementById('produkid').addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        let stok = selectedOption.getAttribute('data-stok') || 0;
        let jumlahInput = document.getElementById('jumlahproduk');

        jumlahInput.max = stok;
        if (jumlahInput.value > stok) {
            jumlahInput.value = stok;
        }

        updateSubtotal();
    });

    window.onload = function() {
        updateSubtotal();
    };
</script>
@endsection
