<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GetEstimateTitle;
use Illuminate\Http\Request;

class GetEstimateTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = GetEstimateTitle::latest()->get();
        return view('admin.project.estimate.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.project.estimate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:get_estimate_titles',
        ]);

       
        GetEstimateTitle::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);


        $notification = array(
            'message' => 'Store Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.get-estimate-title.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = GetEstimateTitle::findOrFail($id);
        return view('admin.project.estimate.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = GetEstimateTitle::findOrFail($id);
        return view('admin.project.estimate.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = GetEstimateTitle::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:get_estimate_titles,name,' . $data->id,
        ]);

        $data->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);


        $notification = array(
            'message' => 'Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.get-estimate-title.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = GetEstimateTitle::findOrFail($id);
        $data->delete();
        $notification = array(
            'message' => 'Deleted Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
