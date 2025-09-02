<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpTitle;
use Illuminate\Http\Request;

class HelpTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = HelpTitle::latest()->get();
        return view('admin.help.title.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.help.title.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:help_titles',
        ]);

       
        HelpTitle::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);


        $notification = array(
            'message' => 'Store Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.help-title.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = HelpTitle::findOrFail($id);
        return view('admin.help.title.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = HelpTitle::findOrFail($id);
        return view('admin.help.title.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = HelpTitle::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:help_titles,name,' . $data->id,
        ]);

        $data->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);


        $notification = array(
            'message' => 'Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.help-title.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = HelpTitle::findOrFail($id);
        $data->delete();
        $notification = array(
            'message' => 'Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
