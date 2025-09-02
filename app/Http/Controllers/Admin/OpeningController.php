<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Opening;
use Illuminate\Http\Request;

class OpeningController extends Controller
{
    public function index()
    {
        $data = Opening::all();
        return view('admin.window.opening.index', compact('data'));
    }

    public function create()
    {
        return view('admin.window.opening.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:openings',
        ]);


        Opening::create([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        $notification = array(
            'message'    => 'Create Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.opening.index')->with($notification);
    }

    public function show($id)
    {
        $data = Opening::findOrFail($id);
        return view('admin.window.opening.view', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Opening::findOrFail($id);
        return view('admin.window.opening.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = Opening::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:openings,name,'.$data->id,
        ]);

        $input = $request->all();
        $data->update($input);

        $notification = array(
            'message'    => 'Updated Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.opening.index')->with($notification);
    }

    public function destroy(string $id)
    {
        $data = Opening::findOrFail($id);
        $data->delete();
        $notification = array(
            'message'    => 'Delete Successfully !!!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
