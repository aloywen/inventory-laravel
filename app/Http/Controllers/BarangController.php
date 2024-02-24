<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
      $data = [
        'title' => 'Data Barang',
        'barang' => Barang::all(),
      ];
      
    // dd($data);

      return view('admin.barang.index', $data);
    }
}
