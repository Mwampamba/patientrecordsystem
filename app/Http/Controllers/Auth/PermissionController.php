<?php

namespace App\Http\Controllers\Auth; 
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Auth\PermissionRequestForm;


class PermissionController extends Controller
{
    public function index(){
        $title = [
            'title' => 'Permissions'
        ];

        $permissions = Permission::all();
        return view('admin.permissions.index', $title, compact('permissions'));
    } 

    public function createNewPermission()
    {
        $title = [
            'title' => 'New permissions'
        ];
        return view('admin.permissions.create', $title);
    }

    public function saveNewPermission(PermissionRequestForm $request)
    {
        $validatedData = $request->validated();

        $permission = new Permission();
        $permission->name = strtolower($validatedData['name']); 
        $permission->save();
        return redirect()->route('permissions')->with('success', 'Permission has been saved successfully!');
    }

    public function permissionDetails($permission_id)
    {
        $title = [
            'title' => 'Permissions'
        ];
        $roles = Role::all();
        $permission = Permission::findOrFail($permission_id);

        return view('admin.permissions.details', $title, compact('permission', 'roles'));
    }
}
