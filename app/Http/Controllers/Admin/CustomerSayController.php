<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\CustomerSay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerSayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CustomerSay::all();
        return view('admin.website.customer-say.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.website.customer-say.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'review_date' => 'required|',
            'review_text' => 'required|string',
            'star' => 'required|',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;

        $contact = CustomerSay::create([
            'name' => $request->name,
            'review_date' => $request->review_date,
            'review_text' => $request->review_text,
            'star' => $request->star,
            'status' => $request->status,
            'image' => $image,
        ]);


        $notification = array(
            'message' => 'Customer Say Store Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.customer-say.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = CustomerSay::findOrFail($id);
        return view('admin.website.customer-say.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = CustomerSay::findOrFail($id);
        return view('admin.website.customer-say.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = CustomerSay::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'review_date' => 'required|',
            'review_text' => 'required|string',
            'star' => 'required|',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : $data->image;

        if ($request->hasFile('image') && $data->image) {
            Storage::disk('public')->delete($data->image);
        }

        $data->update([
            'name' => $request->name,
            'review_date' => $request->review_date,
            'review_text' => $request->review_text,
            'star' => $request->star,
            'status' => $request->status,
            'image' => $image,
        ]);


        $notification = array(
            'message' => 'Customer Say Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.customer-say.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = CustomerSay::findOrFail($id);
        if($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();
        $notification = array(
            'message' => 'Customer Say Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
