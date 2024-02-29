<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Supplier',
        ];
        return view('admin.supplier.index', $data);
    }
}
