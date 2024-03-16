<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|unique:App\Models\User,username',
            'name' => 'required',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role_id' => $request->role_id,
            'password' => Hash::make('123456'),
            'status' => 1,
        ]);

        return redirect()->back()->with('userNew', 'Data ditambah!');
    }
    
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        
        $user->delete();

        return redirect()->back()->with('userDelete', 'Data berhasil dihapus!');
    }
    
    public function update(Request $request)
    {
        // dd($request->id);
        $user = User::find($request->id);
        
        if($request->username === $user->username){
            
            $user->name = $request->name;
            $user->role_id = $request->role_id;
            $user->status = $request->status;
            
            $user->save();
            return redirect()->back()->with('userUpdate', 'Data berhasil diupdate!');
            
        } else {
            $credentials = $request->validate([
                'name' => 'required|unique:App\Models\User,username',
                'name' => 'required',
                'role' => 'required'
            ]);
            
            $user->username = $request->username;
            $user->name = $request->name;
            $user->role_id = $request->role_id;
            $user->status = $request->status;
            
            $data->save();
            return redirect()->back()->with('userUpdate', 'Data berhasil diupdate!');
        }

    }
}
