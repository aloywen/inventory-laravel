<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangmasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    protected $fillable = [
        'nomor_transaksi',
        'tgl_transaksi',
        'kode_supplier',
        'kode_barang',
        'qty',
        'user_buat',
        'user_ubah',
        'keterangan'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
