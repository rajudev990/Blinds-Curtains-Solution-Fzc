<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user= Admin::all();
        return view('admin.setting.user.index',['users'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.setting.user.new',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:admins',
            'password'=>'required|confirmed'
        ]);
        $user = Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
        ]);

        // Retrieve role names or slugs based on the provided role IDs
        $roles = Role::whereIn('id', $request->roles)->pluck('name')->toArray();

        // Sync roles with the user
        $user->syncRoles($roles);


        // $user->syncRoles($request->roles);

        $notification = array(
            'message' => 'User Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.users.index')->with($notification);

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
       $user = Admin::findOrFail($id);
       $role = Role::get();
       $user->roles;
       return view('admin.setting.user.edit',['user'=>$user,'roles' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Admin::findOrFail($id);
        $validated = $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:admins,email,'.$user->id.',id',
        ]);
        if($request->password != null){
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $validated['password'] = bcrypt($request->password);
        }
        $user->update($validated);

        // Validate and sync roles
        $roles = Role::whereIn('id', $request->roles)->where('guard_name', 'admin')->get();
        $user->syncRoles($roles);


        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.users.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Admin::findOrFail($id);
        $role->delete();
        $notification = array(
            'message' => 'User deleted !!! Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
