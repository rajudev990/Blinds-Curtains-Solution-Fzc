<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Page::latest()->get();
        return view('admin.page.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'files' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|unique:pages|',
            'content' => 'nullable',
            'status' => 'required',
          
        ]);

        $banner = $request->hasFile('files') ? ImageHelper::uploadImage($request->file('files')) : null;
        $meta_image = $request->hasFile('meta_image') ? ImageHelper::uploadImage($request->file('meta_image')) : null;
        
        $contact = Page::create([
            'files' => $banner,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'status' => $request->status,

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'meta_image' => $meta_image,

        ]);


        $notification = array(
            'message' => 'Page Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pages.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Page::findOrFail($id);
       return view('admin.page.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Page::findOrFail($id);
       return view('admin.page.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Page::findOrFail($id);

        $request->validate([
            'files' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'title' => 'required|string|max:255|unique:pages,title,' . $data->id,
            
        ]);
       
        $image = $request->hasFile('files') ? ImageHelper::uploadImage($request->file('files')) : null;
        $meta_image = $request->hasFile('meta_image') ? ImageHelper::uploadImage($request->file('meta_image')) : $data->meta_image;

        if ($request->hasFile('meta_image') && $data->meta_image) {
            Storage::disk('public')->delete($data->meta_image);
        }

        
        if ($request->hasFile('files') && $data->files) {
            Storage::disk('public')->delete($data->files);
        }

        $input = $request->all();


        if($image){
            $input['files'] = $image;
        }

        if($meta_image){
            $input['meta_image'] = $meta_image;
        }


        $input['slug'] = Str::slug($request->title);
        $data->update($input);


        $notification = array(
            'message' => 'Page Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pages.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Page::findOrFail($id);
        if($data->files) {
            Storage::disk('public')->delete($data->files);
        }
        $data->delete();
        $notification = array(
            'message' => 'Page Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
