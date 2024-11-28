<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::when($request->search, function($query) use($request){
            $query->where('name', 'like', '%'.$request->search.'%');
        })->paginate(20)->appends(['search' => $request->search]);

        $roles = Role::all();
        $edit = false;
        $permissionRoles = [];
        if($request->edit)
        {
            $edit = Permission::find($request->edit);
            $permissionRoles = $edit->roles->pluck('name')->toArray();
        }

        return view('admin.authorize.permissions.indexPermissions', compact('permissions', 'roles', 'edit', 'permissionRoles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'permission' => 'required|min:3'
        ]);

        $permission = Permission::create([
            'name' => $request->permission,
            'guard_name' => 'web'
        ]);

        $permission->syncRoles($request->roles);

        return redirect()->route('permissions.index')->with('success', 'Привилегия создана успешно');
    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update([
            'name' => $request->permission
        ]);

        $permission->syncRoles($request->roles);

        return redirect()->route('permissions.index')->with('success', 'Привилегия изменена');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('danger', 'Привилегия удалена');
    }
}
