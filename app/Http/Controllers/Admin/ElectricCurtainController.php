<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ElectricCurtain;
use Illuminate\Http\Request;

class ElectricCurtainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ElectricCurtain::latest()->get();
        return view('admin.smart-curtains.electric.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.smart-curtains.electric.create');
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


        ElectricCurtain::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);


        $notification = array(
            'message' => 'Electric Curtains Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.electric-curtains.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = ElectricCurtain::findOrFail($id);
       return view('admin.smart-curtains.electric.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ElectricCurtain::findOrFail($id);
       return view('admin.smart-curtains.electric.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = ElectricCurtain::findOrFail($id);
        $data->update($request->all());
        $notification = array(
            'message' => 'Electric Curtains Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.electric-curtains.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ElectricCurtain::findOrFail($id);
        $data->delete();
        $notification = array(
            'message' => 'Electric Curtains Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

       
    }
}
