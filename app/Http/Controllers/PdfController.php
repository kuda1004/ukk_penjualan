<?php

namespace App\Http\Controllers;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePDF()
    {
        // Fetch data from the 'details' table (replace with your model)
        $details = DetailPenjualan::with('penjualan', 'produk')->get();

        // Load a view with the data
        $pdf = PDF::loadView('detailpenjualan.pdf', compact('details'));

        // Return the PDF file as a response
        return $pdf->download('details_report.pdf');
    }

    public function penjualanPDF()
    {
        // Fetch data from the 'details' table (replace with your model)
        $penjualans = Penjualan::with('pelanggan', 'detailPenjualans.produk')->get();

        // Load a view with the data
        $pdf = PDF::loadView('penjualan.pdf', compact('penjualans'));

        // Return the PDF file as a response
        return $pdf->download('penjualans_report.pdf');
    }

    public function idpenjualanPDF($penjualanid)
    {
        // Get the penjualan data along with its related customer and product details
        $penjualan = Penjualan::with('pelanggan', 'detailPenjualans.produk')->findOrFail($penjualanid);

        // Calculate the total price if needed (or fetch it if already stored)
        $totalHarga = $penjualan->totalharga;

        // Prepare data to pass to the view
        $data = [
            'penjualanid' => $penjualan->penjualanid,
            'pelanggan' => $penjualan->pelanggan->namapelanggan,
            'tanggalpenjualan' => $penjualan->tanggalpenjualan,
            'totalharga' => $totalHarga,
            'detailPenjualans' => $penjualan->detailPenjualans,
        ];

        // Load the PDF view and pass the data
        $pdf = PDF::loadView('penjualan.penjualanid', $data);

        // Return the generated PDF as a download
        return $pdf->download('penjualan_' . $penjualanid . '.pdf');
    }
}
