<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans'; // Nama tabel di database
    protected $primaryKey = 'pelangganid'; // Primary key

    protected $fillable = [
        'namapelanggan',
        'alamat',
        'nomor',
    ];
}
