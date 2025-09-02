<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Baner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Baner::latest()->get();
        return view('admin.banner.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'status' => 'required',
            'banner_link' => 'nullable',
        ]);

        $banner = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;
       
        
        $contact = Baner::create([
            'image' => $banner,
            'banner_link' => $request->banner_link,
            'status' => $request->status
        ]);


        $notification = array(
            'message' => 'Banner Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.banner.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Baner::findOrFail($id);
        return view('admin.banner.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Baner::findOrFail($id);
        return view('admin.banner.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $data = Baner::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|max:2048',
            'status' => 'required',
            'banner_link' => 'nullable',
        ]);

        $banner = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;

        if ($request->hasFile('image') && $data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $input = $request->all();
        
        if($banner){
            $input['image'] = $banner;
        }


        $data->update($input);


        $notification = array(
            'message' => 'Banner Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.banner.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Baner::findOrFail($id);
        if($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();
        $notification = array(
            'message' => 'Banner Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
