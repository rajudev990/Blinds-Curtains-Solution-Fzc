<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\HowItWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HowItWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = HowItWork::latest()->get();
        return view('admin.website.work.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.website.work.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:5',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;

        $contact = HowItWork::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $image,
        ]);


        $notification = array(
            'message' => 'How It Works Store Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.how-it-works.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = HowItWork::findOrFail($id);
        return view('admin.website.work.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = HowItWork::findOrFail($id);
        return view('admin.website.work.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = HowItWork::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:5',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : $data->image;

        if ($request->hasFile('image') && $data->image) {
            Storage::disk('public')->delete($data->image);
        }

        $data->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $image,
        ]);


        $notification = array(
            'message' => 'How It Works Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.how-it-works.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = HowItWork::findOrFail($id);
        if($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();
        $notification = array(
            'message' => 'How It Works Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
