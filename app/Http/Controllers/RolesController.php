<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            'role_or_permission:Admin|Edit User',
            //new Middleware('role:author', only: ['index']),
            //new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('manager'), except: ['show']),
            //new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete records,api'), only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $roles = Role::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%'.$request->search.'%');
        })->paginate(20)->appends(['search' => $request->search]);

        return view('admin.authorize.roles.indexRoles', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'roles' => 'required|min:3',
        ]);

        Role::create([
            'name' => $request->roles,
            'guard_name' => 'web',
        ]);

        return redirect()->route('roles.index')->with('success', 'Роль добавлена');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.authorize.roles.editRoles', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $role->update([
            'name' => $request->role,
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name');

        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Роль изменена');
    }

    public function destroy(string $id)
    {
        $role = Role::find($id);

        $role->delete();

        return redirect()->route('roles.index')->with('danger', 'Роль удалена');
    }
}
