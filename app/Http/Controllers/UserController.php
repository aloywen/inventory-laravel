<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => 123456,
            'status' => 1,
        ]);

        return redirect('/panel/user')->with('userStore', 'Data ditambah!');
    }
    
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        
        $user->delete();

        return redirect('/panel/user')->with('userDelete', 'Data berhasil dihapus!');
    }
    
    public function update(Request $request)
    {
        // dd($request->id);
        $user = User::find($request->id);
        
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'status' => $request->status,
        ];
        
        $user->save();
        return redirect('/panel/user')->with('userUpdate', 'Data berhasil diupdate!');
    }
}
