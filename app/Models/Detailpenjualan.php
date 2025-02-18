<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpenjualan extends Model
{
    use HasFactory;

    protected $table = 'detailpenjualans';  // Nama tabel
    protected $primaryKey = 'detailid';  // Primary key tabel
    public $timestamps = true;  // Menambahkan created_at dan updated_at

    // Kolom yang bisa diisi
    protected $fillable = [
        'penjualanid',
        'produkid',
        'jumlahproduk',
        'subtotal',
    ];

    // Relasi ke tabel penjualans
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualanid');
    }
    

    // Relasi ke tabel produks
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produkid');
    }
}
