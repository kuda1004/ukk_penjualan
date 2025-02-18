<?php

namespace App\Http\Controllers;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
    
        // Query penjualan dengan relasi pelanggan dan produk
        $query = Penjualan::with('pelanggan', 'detailPenjualans.produk');
    
        if (!empty($search)) {
            $query->whereHas('pelanggan', function ($q) use ($search) {
                $q->where('namapelanggan', 'LIKE', "%$search%");
            })->orWhere('tanggalpenjualan', 'LIKE', "%$search%");
        }
    
        $penjualans = $query->paginate(5);
    
        return view('penjualan.index', compact('penjualans', 'search'));
    }
    

    // Tampilkan form tambah penjualan
    public function create()
    {
        $pelanggans = Pelanggan::all(); // Ambil semua pelanggan untuk dropdown
        return view('penjualan.create', compact('pelanggans'));
    }

    // Simpan data penjualan
    public function store(Request $request)
    {
        $request->validate([
            'tanggalpenjualan' => 'required|date',
            'totalharga' => 'required|numeric',
            'pelangganid' => 'required|exists:pelanggans,pelangganid',
        ]);

        Penjualan::create($request->all());

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
    }

    // Tampilkan form edit penjualan
    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $pelanggans = Pelanggan::all(); // Ambil semua pelanggan untuk dropdown
        return view('penjualan.edit', compact('penjualan', 'pelanggans'));
    }

    // Update data penjualan
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggalpenjualan' => 'required|date',
            'totalharga' => 'required|numeric',
            'pelangganid' => 'required|exists:pelanggans,pelangganid',
        ]);

        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update($request->all());

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diperbarui.');
    }

    // Hapus data penjualan
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus.');
    }
}
