<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::when($request->search, function($query) use($request){
            $query->where('name', 'like', '%'.$request->search.'%');
        })->paginate(20)->appends(['search' => $request->search]);

        return view('admin.authorize.roles.indexRoles', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'roles' => 'required|min:3'
        ]);

        Role::create([
            'name' => $request->roles,
            'guard_name' => 'web'
        ]);

        return redirect()->route('roles.index')->with('success', 'Роль добавлена');
    }

    public function destroy(String $id)
    {
        $role = Role::find($id);

        $role->delete();

        return redirect()->route('roles.index')->with('danger', 'Роль удалена');
    }
}
