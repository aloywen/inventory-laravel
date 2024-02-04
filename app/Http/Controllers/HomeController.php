<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loket;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'loket' => Loket::get()
        ];

        return view('home', $data);
    }
}
