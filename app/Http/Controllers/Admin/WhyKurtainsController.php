<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\WhyKurtains;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WhyKurtainsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = WhyKurtains::latest()->get();
        return view('admin.why-kurtains.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.why-kurtains.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'why_kurtains' => 'required',
            'description' => 'required',
            'status' => 'required',
          
        ]);

        $banner = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;
       
        
        $contact = WhyKurtains::create([
            'image' => $banner,
            'title' => $request->title,
            'why_kurtains' => $request->why_kurtains,
            'description' => $request->description,
            'status' => $request->status
        ]);


        $notification = array(
            'message' => 'Why  B & C Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.why-kurtains.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = WhyKurtains::findOrFail($id);
       return view('admin.why-kurtains.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = WhyKurtains::findOrFail($id);
       return view('admin.why-kurtains.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = WhyKurtains::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
             'title' => 'required',
            'why_kurtains' => 'required',
            'description' => 'required',
            
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
            'message' => 'Why  B & C Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.why-kurtains.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = WhyKurtains::findOrFail($id);
        if($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();
        $notification = array(
            'message' => 'Why  B & C Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
