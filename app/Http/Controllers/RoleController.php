<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;


class RoleController extends Controller
{
    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);

        return redirect('/panel/role')->with('roleStore', 'Data ditambah!');
    }
    
    public function delete(Request $request)
    {
        $role = Role::find($request->id);
        
        $role->delete();

        return redirect('/panel/role')->with('roleDelete', 'Data berhasil dihapus!');
    }
    
    public function update(Request $request)
    {
        // dd($request->id);
        $role = Role::find($request->id);
        
        $role->name = $request->name;
        
        $role->save();
        return redirect('/panel/role')->with('roleUpdate', 'Data berhasil diupdate!');
    }
}
