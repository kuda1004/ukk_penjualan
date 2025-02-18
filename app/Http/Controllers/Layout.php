<?php

namespace App\Http\Controllers;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Detailpenjualan;
use Illuminate\Support\Facades\DB;
 

class Layout extends Controller
{
    public function index()
    {
        // Mendapatkan overview penjualan produk
        $salesOverview = DB::table('detailpenjualans')
            ->join('produks', 'detailpenjualans.produkid', '=', 'produks.produkid')
            ->join('penjualans', 'detailpenjualans.penjualanid', '=', 'penjualans.penjualanid')
            ->select('produks.namaproduk', DB::raw('SUM(detailpenjualans.jumlahproduk) as totalbeli'))
            ->groupBy('produks.namaproduk')
            ->get();

        // Data lainnya untuk dashboard
        $totalHargaPenjualan = Penjualan::sum('totalharga'); // Total harga penjualan, misal menggunakan field totalharga
        $totalPelanggan = DB::table('pelanggans')->count(); // Jumlah pelanggan
        $totalProduk = Produk::count(); // Jumlah produk
        $totalDetail = DetailPenjualan::count(); // Jumlah detail penjualan

        // Kirim data ke view
        return view('layout/dashboard', compact(
            'salesOverview',
            'totalHargaPenjualan',
            'totalPelanggan',
            'totalProduk',
            'totalDetail'
        ));
    }
}
