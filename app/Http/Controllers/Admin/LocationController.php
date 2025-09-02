<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $data = Location::all();
        return view('admin.window.location.index', compact('data'));
    }

    public function create()
    {
        return view('admin.window.location.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:locations',
        ]);


        Location::create([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        $notification = array(
            'message'    => 'Create Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.location.index')->with($notification);
    }

    public function show($id)
    {
        $data = Location::findOrFail($id);
        return view('admin.window.location.view', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Location::findOrFail($id);
        return view('admin.window.location.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = Location::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:locations,name,'.$data->id,
        ]);

        $input = $request->all();
        $data->update($input);

        $notification = array(
            'message'    => 'Updated Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.location.index')->with($notification);
    }

    public function destroy(string $id)
    {
        $data = Location::findOrFail($id);
        $data->delete();
        $notification = array(
            'message'    => 'Delete Successfully !!!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
