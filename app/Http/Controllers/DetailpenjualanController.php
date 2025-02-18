<?php

namespace App\Http\Controllers;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;

use Illuminate\Http\Request;

class DetailpenjualanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        // Query untuk mengambil detail penjualan beserta penjualan dan produk
        $query = DetailPenjualan::with(['penjualan', 'produk']);

        if (!empty($search)) {
            $query->whereHas('penjualan.pelanggan', function ($q) use ($search) {
                $q->where('namapelanggan', 'LIKE', "%$search%");
            })->orwhereHas('produk', function ($q) use ($search) {
                $q->where('namaproduk', 'LIKE', "%$search%");
            })->orWhereHas('penjualan', function ($q) use ($search) {
                $q->where('tanggalpenjualan', 'LIKE', "%$search%");
            });
        }

        $detailpenjualans = $query->paginate(5);

        return view('detailpenjualan.index', compact('detailpenjualans', 'search'));
    }

public function create()
{
    // Mengambil semua penjualan dan produk untuk dipilih
    $penjualans = Penjualan::all();
    $produks = Produk::all();
    return view('detailpenjualan.create', compact('penjualans', 'produks'));
}

public function store(Request $request)
{
    // Validasi form input
    $request->validate([
        'penjualanid' => 'required|exists:penjualans,penjualanid',
        'produkid' => 'required|array', // Pastikan produk yang dipilih adalah array
        'jumlahproduk' => 'required|array', // Jumlah produk harus dalam array
        'subtotal' => 'required|array', // Subtotal juga dalam array
    ]);

    // Looping untuk menyimpan setiap produk yang dipilih
    foreach ($request->produkid as $index => $produkid) {
        DetailPenjualan::create([
            'penjualanid' => $request->penjualanid,
            'produkid' => $produkid,
            'jumlahproduk' => $request->jumlahproduk[$index],
            'subtotal' => $request->subtotal[$index],
        ]);
    }

    return redirect()->route('detailpenjualan.index')->with('success', 'Detail Penjualan berhasil ditambahkan!');
}

public function edit($id)
{
    $detailpenjualan = DetailPenjualan::findOrFail($id);
    $penjualans = Penjualan::all();
    $produks = Produk::all();
    return view('detailpenjualan.edit', compact('detailpenjualan', 'penjualans', 'produks'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'penjualanid' => 'required|exists:penjualans,penjualanid',
        'produkid' => 'required|exists:produks,produkid',
        'jumlahproduk' => 'required|integer',
        'subtotal' => 'required|numeric',
    ]);

    $detailpenjualan = DetailPenjualan::findOrFail($id);
    $detailpenjualan->update($request->all());
    return redirect()->route('detailpenjualan.index')->with('success', 'Detail penjualan berhasil diperbarui.');
}

public function destroy($id)
{
    $detailpenjualan = DetailPenjualan::findOrFail($id);
    $detailpenjualan->delete();
    return redirect()->route('detailpenjualan.index')->with('success', 'Detail penjualan berhasil dihapus.');
}
}
