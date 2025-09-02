<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\ProjectVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProjectVideo::latest()->get();
        return view('admin.project.video.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.project.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
          
        ]);

        $video = $request->hasFile('video') ? ImageHelper::uploadImage($request->file('video')) : null;
       
        
        $contact = ProjectVideo::create([
            'video' => $video,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);


        $notification = array(
            'message' => 'Project Videos Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.project-videos.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = ProjectVideo::findOrFail($id);
       return view('admin.project.video.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ProjectVideo::findOrFail($id);
       return view('admin.project.video.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = ProjectVideo::findOrFail($id);

        $request->validate([
            'status' => 'required',
            'title' => 'required',
            'description' => 'required',
            
        ]);
       
        $video = $request->hasFile('video') ? ImageHelper::uploadImage($request->file('video')) : null;
        
        if ($request->hasFile('video') && $data->video) {
            Storage::disk('public')->delete($data->video);
        }
        $input = $request->all();
        if($video){
            $input['video'] = $video;
        }

        $data->update($input);


        $notification = array(
            'message' => 'Project Videos Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.project-videos.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ProjectVideo::findOrFail($id);
        if($data->video) {
            Storage::disk('public')->delete($data->video);
        }
        $data->delete();
        $notification = array(
            'message' => 'Project Videos Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
