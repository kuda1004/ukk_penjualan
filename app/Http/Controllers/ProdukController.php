<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        // Query produk dengan pencarian nama
        $query = Produk::query();
    
        if (!empty($search)) {
            $query->where('namaproduk', 'LIKE', "%$search%");
        }
    
        $produks = $query->paginate(5);
    
        return view('produk.index', compact('produks', 'search'));
    }
    

    // Menampilkan form tambah produk
    public function create()
    {
        return view('produk.create');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'namaproduk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        Produk::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    // Menyimpan perubahan produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'namaproduk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
