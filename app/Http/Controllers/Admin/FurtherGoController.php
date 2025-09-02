<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FurtherGo;
use Illuminate\Http\Request;

class FurtherGoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FurtherGo::latest()->get();
        return view('admin.smart-curtains.go.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.smart-curtains.go.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
          
        ]);

        FurtherGo::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);


        $notification = array(
            'message' => 'Go Further Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.go-furthers.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = FurtherGo::findOrFail($id);
       return view('admin.smart-curtains.go.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = FurtherGo::findOrFail($id);
       return view('admin.smart-curtains.go.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = FurtherGo::findOrFail($id);
        $data->update($request->all());

        $notification = array(
            'message' => 'Go Further Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.go-furthers.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = FurtherGo::findOrFail($id);
        $data->delete();
        $notification = array(
            'message' => 'Go Further Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

       
    }
}
