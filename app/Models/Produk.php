<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks'; // Nama tabel di database
    protected $primaryKey = 'produkid'; // Primary key

    protected $fillable = [
        'namaproduk',
        'harga',
        'stok',
    ];

    // Relasi ke Penjualan (Contoh, jika produk ada di transaksi penjualan)
    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'produkid', 'produkid');
    }
}
