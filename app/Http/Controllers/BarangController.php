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

public function store(Request $request)
{
    // dd($request);
    $credentials = $request->validate([
        'kode_barang' => 'required|unique:App\Models\Barang,kode_barang',
        'nama_barang' => 'required|unique:App\Models\Barang,nama_barang'
    ]);

    $data = [
        'kode_barang' => $request->kode_barang,
        'nama_barang' => $request->nama_barang,
        'stok' => 0
    ];
    
    $data = Barang::create($data);
    
    return redirect()->back()->with('barangStore', 'Barang Berhasil Ditambah!');
}

public function update(Request $request)
{
    $data = Barang::find($request->id); 
    
    $credentials = $request->validate([
        'kode_barang' => 'required|unique:App\Models\Barang,kode_barang',
        'nama_barang' => 'required'
    ]);

    $data->kode_barang = $request->kode_barang;
    $data->nama_barang = $request->nama_barang;
    
    $data->save();
    
    return redirect()->back()->with('barangUpdate', 'Barang Berhasil Diupdate!');
    // dd($data);
}

public function delete(Request $request)
{
    $data = Barang::find($request->id);
    
    $data->delete();
    
    return redirect()->back()->with('barangDelete', 'Barang Berhasil Dihapus!');
}
}
