<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LifeStyleTitle;
use Illuminate\Http\Request;

class LifeStyleTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LifeStyleTitle::latest()->get();
        return view('admin.project.lifestyle.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.project.lifestyle.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:life_style_titles',
        ]);

       
        LifeStyleTitle::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);


        $notification = array(
            'message' => 'Store Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.life-style-title.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = LifeStyleTitle::findOrFail($id);
        return view('admin.project.lifestyle.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = LifeStyleTitle::findOrFail($id);
        return view('admin.project.lifestyle.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = LifeStyleTitle::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:life_style_titles,name,' . $data->id,
        ]);

        $data->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);


        $notification = array(
            'message' => 'Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.life-style-title.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = LifeStyleTitle::findOrFail($id);
        $data->delete();
        $notification = array(
            'message' => 'Deleted Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
