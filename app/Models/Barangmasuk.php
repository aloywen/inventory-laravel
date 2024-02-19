<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barangmasuk extends Model
{
    public function itemTransaksi()
    {
        return DB::table('item_transaksi')->join('barang', 'item_transaksi.kode_barang', '=', 'barang.kode_barang')->select('item_transaksi.*', 'barang.nama_barang')->get();
    }
    use HasFactory;

    protected $table = 'barang_masuk';

    protected $fillable = [
        'no_transaksi',
        'tgl_transaksi',
        'kode_supplier',
        'kode_barang',
        'user_buat',
        'user_ubah',
        'keterangan'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
