<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permission= Permission::all();
        return view('admin.setting.permission.index',['permissions'=>$permission]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setting.permission.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name'=>'required',
        ]);
        $permission = Permission::create(['name'=>$request->name]);
        $notification = array(
            'message' => 'Permission created !!!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.permissions.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.setting.permission.edit',['permission' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.setting.permission.edit',['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::findOrFail($id);

        $permission->update(['name'=>$request->name]);
        $notification = array(
            'message' => 'Permission updated !!!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.permissions.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        $notification = array(
            'message' => 'Permission Deleted !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
