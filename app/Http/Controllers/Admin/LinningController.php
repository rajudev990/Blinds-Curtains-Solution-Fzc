<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Linning;
use Illuminate\Http\Request;

class LinningController extends Controller
{
    public function index()
    {
        $data = Linning::all();
        return view('admin.window.linning.index', compact('data'));
    }

    public function create()
    {
        return view('admin.window.linning.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:linnings',
        ]);


        Linning::create([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        $notification = array(
            'message'    => 'Create Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.linning.index')->with($notification);
    }

    public function show($id)
    {
        $data = Linning::findOrFail($id);
        return view('admin.window.linning.view', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Linning::findOrFail($id);
        return view('admin.window.linning.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = Linning::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:linnings,name,'.$data->id,
        ]);

        $input = $request->all();
        $data->update($input);

        $notification = array(
            'message'    => 'Updated Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.linning.index')->with($notification);
    }

    public function destroy(string $id)
    {
        $data = Linning::findOrFail($id);
        $data->delete();
        $notification = array(
            'message'    => 'Delete Successfully !!!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
