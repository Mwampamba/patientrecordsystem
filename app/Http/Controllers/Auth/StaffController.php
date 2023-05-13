<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str; 
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\RoleRequest;
use Illuminate\Database\QueryException;
use App\Http\Requests\Auth\StaffRequest;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Auth\RolePermissionRequest;

class StaffController extends Controller
{
    public function index()
    {
        $title = [
            'title' => 'Staffs'
        ];
        $staffs = User::all();
        return view('admin.staffs.index', $title, compact('staffs'));
    }

    public function addNewStaff()
    {
        $title = [
            'title' => 'New staff'
        ];
        return view('admin.staffs.create', $title);
    }

    public function saveNewStaff(StaffRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $staff = new User();
            $staff->name = $validatedData['name'];
            $staff->email = strtolower($validatedData['email']);
            $staff->status = true;
            $password = Str::random(8);
            $hashed_password = Hash::make($password);
            $staff->password = $hashed_password;

            $staff->save();

            $body = "Use this password as your default password. Don't forget to change it";

            Mail::send(
                'authentication.default-password',
                ['password' => $password, 'body' => $body],
                function ($message) use ($request) {
                    $message->from('info@hms.com', 'Hospital Information System');
                    $message->to($request->email, $request->name)
                        ->subject('Default Password');
                }
            );
            return redirect()->route('staffs')->with('success', 'Staff has been registered successfully!');
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1062) {
                return redirect()->back()->with('error', 'Sorry, the email has used already.');
            }
        }
    }

    public function editStaff($staff_id)
    {
        $title = [
            'title' => 'Update staff'
        ];

        $staff = User::findOrFail($staff_id); 
        return view('admin.staffs.update', $title, compact('staff'));
    }

    public function updateStaff(StaffRequest $request, $staff_id)
    {
        $staff = User::findOrFail($staff_id);
        $validatedData = $request->validated();
        $staff->name = $validatedData['name']; 
        $staff->email = $validatedData['email']; 

        $staff->update();
        return redirect()->route('staffs')->with('success', 'Staff has been updated successfully!');
    }

    public function deleteStaff($staff_id)
    {
        $staff = User::findOrFail($staff_id);
        $staff->delete();
        return redirect()->route('staffs')->with('error', 'Staff has been deleted successfully!');
    }

    public function roleAndPermissions($staff_id)
    {
        $title = [
            'title' => 'Role and Permissions'
        ];
        $staff = User::findOrFail($staff_id); 
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.staffs.details', $title, compact('staff', 'roles', 'permissions'));
    }

    public function attachRole(RoleRequest $request, $staff_id)
    {
        $validatedData = $request->validated();
        $role = $validatedData['role'];

        $staff = User::findOrFail($staff_id);

        $staff->assignRole($role);  

        return redirect()->back()->with('success', 'Role has been added successfully!');
    }

    public function removeRole($role_id, $staff_id)
    {
        $role = Role::findOrFail($role_id);
        $staff = User::findOrFail($staff_id);
        
        if ($staff->hasRole($role))
            $staff->removeRole($role);

        return redirect()->back()->with('success', 'Role has been removed successfully!');
    }

    public function givePermission(RolePermissionRequest $request, $staff_id)
    {
        $validatedData = $request->validated();
        $permissions = $validatedData['permissions'];

        $staff = User::findOrFail($staff_id);

        $staff->givePermissionTo($permissions);

        return redirect()->back()->with('success', 'Permission(s) has been added successfully!');
    }

    public function removePermisssion($staff_id, $permission_id)
    {
        $staff = User::findOrFail($staff_id);
        $permission = Permission::findOrFail($permission_id);
        
        if ($staff->hasPermissionTo($permission))
            $staff->revokePermissionTo($permission);

        return redirect()->back()->with('success', 'Permission has been removed successfully!');
    }
    
}
