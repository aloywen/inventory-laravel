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

        $data = [
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier,
            'alamat' => $request->alamat_supplier,
        ];

        $data = Supplier::create($data);

        return redirect()->back()->with('supplierStore', 'Supplier berhasil ditambah!');
    }
}
