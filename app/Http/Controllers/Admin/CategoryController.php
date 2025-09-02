<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::latest()->get();
        return view('admin.product.category.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $meta_image = $request->hasFile('meta_image') ? ImageHelper::uploadImage($request->file('meta_image')) : null;

        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : null;


        $contact = Category::create([
            'name' => $request->name,
            'status' => $request->status,
            'slug' => Str::slug($request->name),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'meta_image' => $meta_image,
            'image' => $image,
        ]);


        $notification = array(
            'message' => 'Categories Store Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.categories.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Category::findOrFail($id);
        return view('admin.product.category.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Category::findOrFail($id);
        return view('admin.product.category.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $data = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $data->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $meta_image = $request->hasFile('meta_image') ? ImageHelper::uploadImage($request->file('meta_image')) : $data->meta_image;
        
        $image = $request->hasFile('image') ? ImageHelper::uploadImage($request->file('image')) : $data->image;


        if ($request->hasFile('meta_image') && $data->meta_image) {
            Storage::disk('public')->delete($data->meta_image);
        }
        if ($request->hasFile('image') && $data->image) {
            Storage::disk('public')->delete($data->image);
        }

        $data->update([
            'name' => $request->name,
            'status' => $request->status,
            'slug' => Str::slug($request->name),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'meta_image' => $meta_image,
            'image' => $image,
        ]);


        $notification = array(
            'message' => 'Categories Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.categories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Category::findOrFail($id);
        if($data->meta_image) {
            Storage::disk('public')->delete($data->meta_image);
        }
        if($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();
        $notification = array(
            'message' => 'Categories Deleted Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
