<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;


class SupplierController extends Controller
{
    public function index()
    { 
        $data = [
            'title' => 'Data Supplier',
            'supplier' => Supplier::all(),
        ];
        return view('admin.supplier.index', $data);
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'kode_supplier' => 'required|unique:App\Models\Supplier,kode_supplier',
            'nama_supplier' => 'required',
            'alamat_supplier' => 'required'
        ]);

        $data = [
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat_supplier,
        ];

        $data = Supplier::create($data);

        return redirect()->back()->with('supplierStore', 'Supplier berhasil ditambah!');
    }
    
    public function update(Request $request)
    {
        $data = Supplier::find($request->id);
        
        // dd($data);
        if($data->kode_supplier == $request->kode_supplier){

            $data->nama_supplier = $request->nama_supplier;
            $data->alamat = $request->alamat_supplier;
            
            $data->save();
            
            
            return redirect()->back()->with('supplierUpdate', 'Supplier berhasil diupdate!');
        } else {
            
            $credentials = $request->validate([
                'kode_supplier' => 'required|unique:App\Models\Supplier,kode_supplier',
                'nama_supplier' => 'required',
                'alamat_suppiler' => 'required'
            ]);

            $data->kode_supplier = $request->kode_supplier;
            $data->nama_supplier = $request->nama_supplier;
            $data->alamat = $request->alamat_supplier;

            $data->save();
    
            return redirect()->back()->with('supplierUpdate', 'Supplier berhasil diupdate!');
        }
        
    }
    
    public function delete(Request $request)
    {
        $data = Supplier::find($request->id);
        
        $data->delete();
        
        return redirect()->back()->with('supplierDelete', 'Supplier berhasil dihapus!');
    }
}
