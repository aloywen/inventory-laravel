<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barangmasuk;

class BarangmasukController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Barang Masuk',
            'data' => Barangmasuk::all()
        ];

        return view('admin.barangmasuk.index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Barang Masuk Baru'
        ];

        return view('admin.barangmasuk.add', $data);
    }

    public function show(Request $request)
    {
        $data = [
            'title' => 'Edit Barang Masuk'
        ];

        return view('admin.barangmasuk.edit', $data);
    }

    public function store(Request $request)
    {
        $data = Barangmasuk::create([
            'no_transaksi' => $request->no_transaksi,
            'tgl_transaksi' => $request->tgl_transaksi,
        ]);

        return redirect()->back()->with('loketStore', 'Loket berhasil ditambah!');
    }
    
    public function update(Request $request)
    {
        $data = Barangmasuk::find($request->id);
        
        $data->nomor_loket = $request->nomor_loket;
        $data->nama_loket = $request->nama_loket;
        
        $data->save();
        return redirect()->back()->with('loketUpdate', 'Loket berhasil diubah!');
    }

    public function delete(Request $request)
    {
        $loket = Barangmasuk::find($request->id);

        $loket->delete();

        return redirect()->back()->with('loketDelete', 'Loket dihapus!');
    }
}
