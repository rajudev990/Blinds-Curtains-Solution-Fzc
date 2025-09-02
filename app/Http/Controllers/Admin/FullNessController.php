<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FullNess;
use Illuminate\Http\Request;

class FullNessController extends Controller
{
    public function index()
    {
        $data = FullNess::all();
        return view('admin.window.fullness.index', compact('data'));
    }

    public function create()
    {
        return view('admin.window.fullness.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:full_nesses',
        ]);


        FullNess::create([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        $notification = array(
            'message'    => 'Create Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.fullness.index')->with($notification);
    }

    public function show($id)
    {
        $data = FullNess::findOrFail($id);
        return view('admin.window.fullness.view', compact('data'));
    }

    public function edit(string $id)
    {
        $data = FullNess::findOrFail($id);
        return view('admin.window.fullness.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = FullNess::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:full_nesses,name,'.$data->id,
        ]);

        $input = $request->all();
        $data->update($input);

        $notification = array(
            'message'    => 'Updated Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.fullness.index')->with($notification);
    }

    public function destroy(string $id)
    {
        $data = FullNess::findOrFail($id);
        $data->delete();
        $notification = array(
            'message'    => 'Delete Successfully !!!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
