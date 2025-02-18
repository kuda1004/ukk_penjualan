@extends('layout.main')

@section('title', 'Pelanggan')
@section('breadcrumb', 'Pelanggan')
@section('page_title', 'Pelanggan')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div>
                    <!-- Form Pencarian -->
                    <form action="{{ route('pelanggan.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control form-control-sm me-2"
                            placeholder="Cari Pelanggan..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                    </form>
                </div>
            <div class="card-header pb-0 d-flex justify-content-between">
                <h6>Daftar Pelanggan</h6>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm">Tambah Pelanggan</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr><th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Alamat</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelanggans as $pelanggan)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $loop->iteration + ($pelanggans->currentPage() - 1) * $pelanggans->perPage() }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $pelanggan->namapelanggan }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 text-sm">{{ $pelanggan->alamat }}</p>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="mb-0 text-sm">{{ $pelanggan->nomor }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('pelanggan.edit', $pelanggan->pelangganid) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit pelanggan">
                                        Edit
                                    </a> |
                                    <form action="{{ route('pelanggan.destroy', $pelanggan->pelangganid) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-danger border-0 bg-transparent font-weight-bold text-xs" onclick="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if ($pelanggans->isEmpty())
                <div class="text-center text-muted my-3">
                    <p>Data pelanggan belum tersedia.</p>
                </div>
                @endif
                <div class="d-flex justify-content-center mt-4">
                    <nav>
                        <ul class="pagination">
                            <!-- Tombol "Sebelumnya" -->
                            @if ($pelanggans->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $pelanggans->previousPageUrl(). '&search=' . request('search') }}"><</a>
                                </li>
                            @endif

                            <!-- Nomor Halaman -->
                            @for ($i = 1; $i <= $pelanggans->lastPage(); $i++)
                                <li class="page-item {{ ($pelanggans->currentPage() == $i) ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $pelanggans->url($i). '&search=' . request('search') }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <!-- Tombol "Selanjutnya" -->
                            @if ($pelanggans->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $pelanggans->nextPageUrl(). '&search=' . request('search')  }}">></a>
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
