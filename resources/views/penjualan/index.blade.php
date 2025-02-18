@extends('layout.main')

@section('title', 'Penjualan')
@section('breadcrumb', 'Penjualan')
@section('page_title', 'Penjualan')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
                <div>
                    <!-- Form Pencarian -->
                    <form action="{{ route('penjualan.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control form-control-sm me-2"
                            placeholder="Cari Nama Pelanggan atau Tanggal..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                    </form>
                </div>
            <div class="card-header pb-0 d-flex justify-content-between">
                <div class="docs-info">
                    <a href="{{ route('penjualan-pdf') }}" class="btn btn-secondary btn-sm w-100 mb-0">Penjualan PDF</a>
                </div>
                <h6>Daftar Penjualan</h6>
                <a href="{{ route('penjualan.create') }}" class="btn btn-primary btn-sm">Tambah Penjualan</a>
            </div>
            

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID Penjualan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pelanggan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Harga</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penjualans as $penjualan)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $loop->iteration + ($penjualans->currentPage() - 1) * $penjualans->perPage() }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $penjualan->pelanggan->namapelanggan }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">{{ $penjualan->tanggalpenjualan }}</p>
                                </td>
                                <td>
                                    <p class="text-xs text-secondary mb-0">Rp {{ number_format($penjualan->totalharga, 2) }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('penjualan.edit', $penjualan->penjualanid) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit penjualan">
                                        Edit
                                    </a> |
                                    <form action="{{ route('penjualan.destroy', $penjualan->penjualanid) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger border-0 bg-transparent font-weight-bold text-xs" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            Hapus
                                        </button>
                                        |<a href="{{ route('idpenjualan-pdf', $penjualan->penjualanid) }} "class="text-secondary font-weight-bold text-xs">Cetak PDF</a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($penjualans->isEmpty())
                <div class="text-center text-muted my-3">
                    <p>Belum ada data penjualan.</p>
                </div>
                @endif
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination">
                            <!-- Tombol "Sebelumnya" -->
                            @if ($penjualans->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $penjualans->previousPageUrl() . '&search=' . request('search') }}"><</a>
                                </li>
                            @endif

                            <!-- Nomor Halaman -->
                            @for ($i = 1; $i <= $penjualans->lastPage(); $i++)
                                <li class="page-item {{ ($penjualans->currentPage() == $i) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $penjualans->url($i) . '&search=' . request('search') }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <!-- Tombol "Selanjutnya" -->
                            @if ($penjualans->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $penjualans->nextPageUrl() . '&search=' . request('search') }}">></a>
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
