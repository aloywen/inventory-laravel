<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransaksi extends Model
{
    use HasFactory;

    protected $table = 'item_transaksi';

    protected $fillable = [
        'no_transaksi',
        'kode_barang',
        'qty',
        'tipe'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
