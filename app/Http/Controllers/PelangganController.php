<?php

namespace App\Http\Controllers;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        // Jika ada pencarian, filter data berdasarkan nama pelanggan
        $query = Pelanggan::query();
        
        if (!empty($search)) {
            $query->where('namapelanggan', 'LIKE', "%$search%");
        }

        $pelanggans = $query->paginate(5);
        
        return view('pelanggan.index', compact('pelanggans', 'search'));
    }

    // Menampilkan form tambah pelanggan
    public function create()
    {
        return view('pelanggan.create');
    }

    // Menyimpan data pelanggan
    public function store(Request $request)
    {
        $request->validate([
            'namapelanggan' => 'required|string|max:255',
            'alamat' => 'required',
            'nomor' => 'required|integer',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    // Menampilkan form edit pelanggan
    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    // Menyimpan perubahan data pelanggan
    public function update(Request $request, $id)
    {
        $request->validate([
            'namapelanggan' => 'required|string|max:255',
            'alamat' => 'required',
            'nomor' => 'required|integer',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui!');
    }

    // Menghapus pelanggan
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
