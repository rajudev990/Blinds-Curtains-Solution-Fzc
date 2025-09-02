<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Polling;
use Illuminate\Http\Request;

class PollingController extends Controller
{
    public function index()
    {
        $data = Polling::all();
        return view('admin.window.polling.index', compact('data'));
    }

    public function create()
    {
        return view('admin.window.polling.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:pollings',
        ]);


        Polling::create([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        $notification = array(
            'message'    => 'Create Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.polling.index')->with($notification);
    }

    public function show($id)
    {
        $data = Polling::findOrFail($id);
        return view('admin.window.polling.view', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Polling::findOrFail($id);
        return view('admin.window.polling.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = Polling::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:pollings,name,'.$data->id,
        ]);

        $input = $request->all();
        $data->update($input);

        $notification = array(
            'message'    => 'Updated Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.polling.index')->with($notification);
    }

    public function destroy(string $id)
    {
        $data = Polling::findOrFail($id);
        $data->delete();
        $notification = array(
            'message'    => 'Delete Successfully !!!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
