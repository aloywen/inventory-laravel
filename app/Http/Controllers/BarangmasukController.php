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

        return view('admin.loket', $data);
    }

    public function store(Request $request)
    {
        $data = Barangmasuk::create([
            'nomor_loket' => $request->nomor_loket,
            'nama_loket' => $request->nama_loket,
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
