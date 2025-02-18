@extends('layout.main')

@section('title', 'Tambah Detail Penjualan')
@section('breadcrumb', 'Tambah Detail Penjualan')
@section('page_title', 'Tambah Detail Penjualan')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm border-0">
            <div class="card-header text-white">
                <h6 class="mb-0">Tambah Detail Penjualan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('detailpenjualan.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="penjualanid" class="form-label">Penjualan</label>
                        <select class="form-select" id="penjualanid" name="penjualanid" required>
                            <option value="">Pilih Penjualan</option>
                            @foreach($penjualans as $penjualan)
                                <option value="{{ $penjualan->penjualanid }}">{{ $penjualan->pelanggan->namapelanggan }} | {{ $penjualan->tanggalpenjualan }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Produk List -->
                    <div id="produk-list">
                        <div class="produk-item row mb-3 align-items-center">
                            <div class="col-md-5">
                                <label class="form-label">Produk</label>
                                <select class="form-select produk-select" name="produkid[]" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach($produks as $produk)
                                        @if($produk->stok > 0)
                                            <option value="{{ $produk->produkid }}" data-harga="{{ $produk->harga }}" data-stok="{{ $produk->stok }}">
                                                {{ $produk->namaproduk }} (Stok: {{ $produk->stok }})
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jumlah</label>
                                <input type="number" class="form-control jumlah-produk" name="jumlahproduk[]" min="1" step="1" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Subtotal</label>
                                <input type="text" class="form-control subtotal" name="subtotal[]" readonly>
                            </div>
                            <div class="col-md-1 text-end">
                                <button type="button" class="btn btn-danger btn-sm btn-hapus mt-4">&times;</button>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-success mb-3" id="tambah-produk">+ Tambah Produk</button>

                    <div class="mb-3">
                        <label for="total" class="form-label">Total Keseluruhan</label>
                        <input type="text" class="form-control" id="total" name="total" readonly>
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
    document.addEventListener('DOMContentLoaded', function () {
        let produkList = document.getElementById('produk-list');
        let tambahProdukBtn = document.getElementById('tambah-produk');

        function hitungSubtotal() {
            let total = 0;
            document.querySelectorAll('.produk-item').forEach(function (item) {
                let select = item.querySelector('.produk-select');
                let jumlahInput = item.querySelector('.jumlah-produk');
                let subtotalInput = item.querySelector('.subtotal');

                let harga = select.options[select.selectedIndex].getAttribute('data-harga') || 0;
                let stok = select.options[select.selectedIndex].getAttribute('data-stok') || 0;
                let jumlah = parseInt(jumlahInput.value) || 0;

                if (jumlah > stok) {
                    jumlahInput.value = stok;
                    jumlah = stok;
                }

                let subtotal = jumlah * harga;
                subtotalInput.value = subtotal.toFixed(2);
                total += subtotal;
            });
            document.getElementById('total').value = total.toFixed(2);
        }

        // Menambahkan produk baru ke dalam list
        tambahProdukBtn.addEventListener('click', function () {
            let newProduk = document.createElement('div');
            newProduk.classList.add('produk-item', 'row', 'mb-3', 'align-items-center');
            newProduk.innerHTML = `
                <div class="col-md-5">
                    <label class="form-label">Produk</label>
                    <select class="form-select produk-select" name="produkid[]" required>
                        <option value="">Pilih Produk</option>
                        @foreach($produks as $produk)
                            @if($produk->stok > 0)
                                <option value="{{ $produk->produkid }}" data-harga="{{ $produk->harga }}" data-stok="{{ $produk->stok }}">
                                    {{ $produk->namaproduk }} (Stok: {{ $produk->stok }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" class="form-control jumlah-produk" name="jumlahproduk[]" min="1" step="1" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Subtotal</label>
                    <input type="text" class="form-control subtotal" name="subtotal[]" readonly>
                </div>
                <div class="col-md-1 text-end">
                    <button type="button" class="btn btn-danger btn-sm btn-hapus mt-4">&times;</button>
                </div>
            `;
            produkList.appendChild(newProduk);
        });

        // Update subtotal saat produk atau jumlah berubah
        produkList.addEventListener('input', function (event) {
            if (event.target.classList.contains('jumlah-produk') || event.target.classList.contains('produk-select')) {
                hitungSubtotal();
            }
        });

        // Menghapus produk dari list
        produkList.addEventListener('click', function (event) {
            if (event.target.classList.contains('btn-hapus')) {
                event.target.closest('.produk-item').remove();
                hitungSubtotal();
            }
        });
    });
</script>
@endsection
