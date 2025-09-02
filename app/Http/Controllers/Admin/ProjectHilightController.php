<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\ProjectHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectHilightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProjectHighlight::latest()->get();
        return view('admin.project.highlight.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.project.highlight.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'status' => 'required',
            'video' => 'required',
          
        ]);
        
        ProjectHighlight::create([
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'video' => $request->video,
            'status' => $request->status,
        ]);


        $notification = array(
            'message' => 'Project Highlight Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.project-hilights.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = ProjectHighlight::findOrFail($id);
       return view('admin.project.highlight.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ProjectHighlight::findOrFail($id);
       return view('admin.project.highlight.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = ProjectHighlight::findOrFail($id);

        $request->validate([
            'status' => 'required',
            'title' => 'required',
            'type' => 'required',
            'description' => 'required',
            'video' => 'required',
            
        ]);
        $input = $request->all();
        $data->update($input);

        $notification = array(
            'message' => 'Project Hilight Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.project-hilights.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ProjectHighlight::findOrFail($id);
        $data->delete();
        $notification = array(
            'message' => 'Project Hilight Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
