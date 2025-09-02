<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Happyclient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HappyclientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Happyclient::latest()->get();
        return view('admin.client.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
          
        ]);

        $banner = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;
       
        
        $contact = Happyclient::create([
            'image' => $banner,
            'status' => $request->status
        ]);


        $notification = array(
            'message' => 'Happy Client Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.happy-client.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Happyclient::findOrFail($id);
        return view('admin.client.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Happyclient::findOrFail($id);
        return view('admin.client.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Happyclient::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            
        ]);
       
        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;
        
        if ($request->hasFile('image') && $data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $input = [];
        $input['status'] = $request->status;
        if($image){
            $input['image'] = $image;
        }

        $data->update($input);


        $notification = array(
            'message' => 'Happy Client Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.happy-client.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Happyclient::findOrFail($id);
        if($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();
        $notification = array(
            'message' => 'Happy Client Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
