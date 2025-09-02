<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\LifeStyle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LifeStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LifeStyle::latest()->get();
        return view('admin.smart-curtains.life-style.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.smart-curtains.life-style.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'title_id' => 'required',
            'description' => 'required',
            'status' => 'required',
          
        ]);

        $banner = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;
       
        
        LifeStyle::create([
            'image' => $banner,
            'title' => $request->title,
            'title_id' => $request->title_id,
            'description' => $request->description,
            'status' => $request->status
        ]);


        $notification = array(
            'message' => 'Life Styles Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.life-styles.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = LifeStyle::findOrFail($id);
       return view('admin.smart-curtains.life-style.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = LifeStyle::findOrFail($id);
       return view('admin.smart-curtains.life-style.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = LifeStyle::findOrFail($id);

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
            'message' => 'Life Styles Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.life-styles.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = LifeStyle::findOrFail($id);
        if($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();
        $notification = array(
            'message' => 'Life Styles Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

       
    }
}
