<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Fitur;
use App\Models\Loket;

class AdminController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Dashboard'
        ];

        return view('admin.dashboard', $data);
    }

    public function users() {
        $data = [
            'title' => 'Users',
            'users' => User::all()
        ];

        return view('admin.users', $data);
    }

    public function role() {
        $data = [
            'title' => 'Role',
            'data' => Role::all()
        ];

        return view('admin.role', $data);
    }

}
