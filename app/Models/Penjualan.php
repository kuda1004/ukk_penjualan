<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';
    protected $primaryKey = 'penjualanid';

    protected $fillable = [
        'tanggalpenjualan',
        'totalharga',
        'pelangganid',
    ];

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelangganid', 'pelangganid');
    }

        public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualanid');
    }
    }
