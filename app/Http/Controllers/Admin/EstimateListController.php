<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\EstimateList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EstimateListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = EstimateList::latest()->get();
        return view('admin.estimate-list.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.estimate-list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
          
        ]);

        $banner = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;
       
        
        $contact = EstimateList::create([
            'image' => $banner,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);


        $notification = array(
            'message' => 'Estimate Media Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.estimate-list.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = EstimateList::findOrFail($id);
       return view('admin.estimate-list.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = EstimateList::findOrFail($id);
       return view('admin.estimate-list.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = EstimateList::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            
        ]);
       
        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;
        
        if ($request->hasFile('image') && $data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $input = $request->all();
        if($image){
            $input['image'] = $image;
        }

        $data->update($input);


        $notification = array(
            'message' => 'Estimate Media Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.estimate-list.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = EstimateList::findOrFail($id);
        if($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();
        $notification = array(
            'message' => 'Estimate Media Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

       
    }
}
