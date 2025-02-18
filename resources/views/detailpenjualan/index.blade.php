@extends('layout.main')

@section('title', 'DetailPenjualan')
@section('breadcrumb', 'DetailPenjualan')
@section('page_title', 'DetailPenjualan')

@section('content')
<div class="row">
    <div class="col-12">    
        <div class="card mb-4">
        <div>
                    <!-- Form Pencarian -->
                    <form action="{{ route('detailpenjualan.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control form-control-sm me-2"
                            placeholder="Cari Nama Produk atau Tanggal Penjualan..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                    </form>
                </div>
            <div class="card-header pb-0 d-flex justify-content-between">
                <div class="docs-info">
                        <a href="{{ route('generate-pdf') }}" class="btn btn-secondary btn-sm w-100 mb-0">Detail Penjualan PDF</a>
                </div>
                <h6>Daftar Detail Penjualan</h6>
                <a href="{{ route('detailpenjualan.create') }}" class="btn btn-primary btn-sm">Tambah Detail Penjualan</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pelanggan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Produk</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jumlah Produk</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subtotal</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailpenjualans as $detailpenjualan)
                            <tr>
                                 <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $loop->iteration + ($detailpenjualans->currentPage() - 1) * $detailpenjualans->perPage() }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $detailpenjualan->penjualan->pelanggan->namapelanggan }}</h6>
                                            <p class="mb-0 text-sm">|{{ $detailpenjualan->penjualan->tanggalpenjualan }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 text-sm">{{ $detailpenjualan->produk->namaproduk }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 text-sm">{{ $detailpenjualan->jumlahproduk }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 text-sm">Rp {{ number_format($detailpenjualan->subtotal, 2) }}</p>
                                 </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('detailpenjualan.edit', $detailpenjualan->detailid) }}" class="text-secondary font-weight-bold text-xs">
                                        Edit
                                    </a> |
                                    <form action="{{ route('detailpenjualan.destroy', $detailpenjualan->detailid) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger border-0 bg-transparent font-weight-bold text-xs" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($detailpenjualans->isEmpty())
                <div class="text-center text-muted my-3">
                    <p>Belum ada detail penjualan.</p>
                </div>
                @endif
                                                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination">
                            <!-- Tombol "Sebelumnya" -->
                            @if ($detailpenjualans->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $detailpenjualans->previousPageUrl(). '&search=' . request('search')  }}"><</a>
                                </li>
                            @endif

                            <!-- Nomor Halaman -->
                            @for ($i = 1; $i <= $detailpenjualans->lastPage(); $i++)
                                <li class="page-item {{ ($detailpenjualans->currentPage() == $i) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $detailpenjualans->url($i). '&search=' . request('search')  }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <!-- Tombol "Selanjutnya" -->
                            @if ($detailpenjualans->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $detailpenjualans->nextPageUrl(). '&search=' . request('search')  }}">></a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">></span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
