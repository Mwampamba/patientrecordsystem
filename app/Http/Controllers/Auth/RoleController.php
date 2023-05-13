<?php

namespace App\Http\Controllers\Auth;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Auth\RoleRequestForm;
use App\Http\Requests\Auth\RolePermissionRequest;

class RoleController extends Controller
{
    public function index()
    {
        $title = [
            'title' => 'Roles'
        ];
        $roles = Role::all();
        return view('admin.roles.index', $title, compact('roles'));
    }

    public function createNewRole()
    {
        $title = [
            'title' => 'New roles'
        ];
        return view('admin.roles.create', $title);
    }

    public function saveNewRole(RoleRequestForm $request)
    {
        $validatedData = $request->validated();

        $role = new Role();
        $role->name = strtolower($validatedData['name']);
        $role->save();
        return redirect()->route('roles')->with('success', 'Role has been saved successfully!');
    }

    public function roleDetails($role_id)
    {
        $title = [
            'title' => 'Role permissions'
        ];
        $permissions = Permission::all();
        $role = Role::findOrFail($role_id);

        return view('admin.roles.details', $title, compact('role', 'permissions'));
    }

    public function attachPermissionsToRole(RolePermissionRequest $request, $role_id)
    {
        $validatedData = $request->validated();
        $permissions = $validatedData['permissions'];

        $role = Role::findOrFail($role_id);

        $role->givePermissionTo($permissions);

        return redirect()->back()->with('success', 'Permission(s) has been added successfully!');
    }

    public function removePermissionsToRole($role_id, $permission_id)
    {
        $role = Role::findOrFail($role_id);
        $permission = Permission::findOrFail($permission_id);
        
        if ($role->hasPermissionTo($permission))
            $role->revokePermissionTo($permission);

        return redirect()->back()->with('success', 'Permission has been removed successfully!');
    }
}
