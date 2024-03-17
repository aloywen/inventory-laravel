<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Illuminate\Support\Str;

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
            'kode_barang' => Str::upper($request->kode_barang),
            'nama_barang' => Str::upper($request->nama_barang),
            'stok' => 0
        ];
        
        $data = Barang::create($data);
        
        return redirect()->back()->with('barangStore', 'Barang Berhasil Ditambah!');
    }

    public function update(Request $request)
    {
        $data = Barang::find($request->id); 
        
        if($data->kode_barang === $request->kode_barang){
            $data->nama_barang = Str::upper($request->nama_barang);
            
            $data->save();

            return redirect()->back()->with('barangUpdate', 'Barang Berhasil Diupdate!');
        }else {

            $credentials = $request->validate([
                'kode_barang' => 'required|unique:App\Models\Barang,kode_barang',
                'nama_barang' => 'required'
            ]);
    
            $data->kode_barang = Str::upper($request->kode_barang);
            $data->nama_barang = Str::upper($request->nama_barang);
            
            $data->save();
            
            return redirect()->back()->with('barangUpdate', 'Barang Berhasil Diupdate!');

        }
    }

    public function delete(Request $request)
    {
        $data = Barang::find($request->id);
        
        $data->delete();
        
        return redirect()->back()->with('barangDelete', 'Barang Berhasil Dihapus!');
    }

    public function autocompleteKode(Request $request)
    {
        $name=$_GET['search'];
        $datas = Barang::where('nama_barang', 'LIKE', '%'. $name. '%')->get();


        return response()->json($datas);

    }

}