<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role= Role::latest()->get();
        return view('admin.setting.role.index',['roles'=>$role]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('admin.setting.role.new',['permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id', // Ensures all permission IDs exist in the permissions table
        ]);
        
        // Create the role with the admin guard
        $role = Role::create(['name' => $request->name, 'guard_name' => 'admin']);
        
        // Fetch permissions associated with the admin guard
        $permissions = Permission::whereIn('id', $request->permissions)->where('guard_name', 'admin')->get();
        
        // Sync permissions
        $role->syncPermissions($permissions);
        


        $notification = array(
            'message' => 'Role created !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.roles.index')->with( $notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::findOrFail($id);
        $permission = Permission::get();
        return view('admin.setting.role.edit',['role'=>$role,'permissions' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

       // Validate the request data
        $request->validate([
            'name' => 'required',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id', // Ensures all permission IDs exist in the permissions table
        ]);

        // Find the role by ID
        $role = Role::findOrFail($id);

        // Update the role's name
        $role->update(['name' => $request->name]);

        // Fetch the permissions associated with the admin guard
        $permissions = Permission::whereIn('id', $request->permissions)
                                ->where('guard_name', 'admin')
                                ->get();

        // Sync the permissions with the role
        $role->syncPermissions($permissions);


        $notification = array(
            'message' => 'Role updated !!!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.roles.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        $notification = array(
            'message' => 'Role deleted !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
