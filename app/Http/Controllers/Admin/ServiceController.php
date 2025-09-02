<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Service::latest()->get();
        return view('admin.service.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'status' => 'required',
          
        ]);

        $banner = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;
       
        
        $contact = Service::create([
            'image' => $banner,
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'status' => $request->status
        ]);


        $notification = array(
            'message' => 'Service Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.services.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $data = Service::findOrFail($id);
       return view('admin.service.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Service::findOrFail($id);
        return view('admin.service.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Service::findOrFail($id);

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
            'message' => 'Service Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.services.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Service::findOrFail($id);
        if($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();
        $notification = array(
            'message' => 'Service Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
