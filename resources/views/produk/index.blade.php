@extends('layout.main')

@section('title', 'Produk')
@section('breadcrumb', 'Produk')
@section('page_title', 'Produk')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
        <div>
                    <!-- Form Pencarian -->
                    <form action="{{ route('produk.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control form-control-sm me-2"
                            placeholder="Cari Nama Produk..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                    </form>
                </div>
            <div class="card-header pb-0 d-flex justify-content-between">
                <h6>Daftar Produk</h6>
                
                <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">Tambah Produk</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Harga</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stok</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produks as $produk)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $loop->iteration + ($produks->currentPage() - 1) * $produks->perPage() }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $produk->namaproduk }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">Rp {{ number_format($produk->harga, 2) }}</p>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">{{ $produk->stok }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('produk.edit', $produk->produkid) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit produk">
                                        Edit
                                    </a> |
                                    <form action="{{ route('produk.destroy', $produk->produkid) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger border-0 bg-transparent font-weight-bold text-xs" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($produks->isEmpty())
                <div class="text-center text-muted my-3">
                    <p>Belum ada data produk.</p>
                </div>
                @endif
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination">
                            <!-- Tombol "Sebelumnya" -->
                            @if ($produks->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $produks->previousPageUrl(). '&search=' . request('search')}}"><</a>
                                </li>
                            @endif

                            <!-- Nomor Halaman -->
                            @for ($i = 1; $i <= $produks->lastPage(); $i++)
                                <li class="page-item {{ ($produks->currentPage() == $i) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $produks->url($i). '&search=' . request('search') }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <!-- Tombol "Selanjutnya" -->
                            @if ($produks->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $produks->nextPageUrl(). '&search=' . request('search') }}">></a>
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