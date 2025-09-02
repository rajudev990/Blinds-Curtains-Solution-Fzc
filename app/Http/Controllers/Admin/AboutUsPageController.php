<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\AboutUsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AboutUsPage::first();
        return view('admin.setting.about',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = AboutUsPage::findOrFail($id);

        $bgimage = $request->hasFile('bgimage') ? ImageHelper::uploadImage($request->file('bgimage')) : null;

        $cofounder_image = $request->hasFile('cofounder_image') ? ImageHelper::uploadImage($request->file('cofounder_image')) : null;

        $founder_image = $request->hasFile('founder_image') ? ImageHelper::uploadImage($request->file('founder_image')) : null;

        $vision_image = $request->hasFile('vision_image') ? ImageHelper::uploadImage($request->file('vision_image')) : null;
        
        $mission_image = $request->hasFile('mission_image') ? ImageHelper::uploadImage($request->file('mission_image')) : null;
        
        $partnership_image = $request->hasFile('partnership_image') ? ImageHelper::uploadImage($request->file('partnership_image')) : null;

        if ($request->hasFile('bgimage') && $data->bgimage) {
            Storage::disk('public')->delete($data->bgimage);
        }

        if ($request->hasFile('cofounder_image') && $data->cofounder_image) {
            Storage::disk('public')->delete($data->cofounder_image);
        }
        if ($request->hasFile('founder_image') && $data->founder_image) {
            Storage::disk('public')->delete($data->founder_image);
        }
        if ($request->hasFile('vision_image') && $data->vision_image) {
            Storage::disk('public')->delete($data->vision_image);
        }
        if ($request->hasFile('mission_image') && $data->mission_image) {
            Storage::disk('public')->delete($data->mission_image);
        }
        if ($request->hasFile('partnership_image') && $data->partnership_image) {
            Storage::disk('public')->delete($data->partnership_image);
        }


        $input = $request->all();

        if($bgimage){
            $input['bgimage'] = $bgimage;
        }
        if($cofounder_image){
            $input['cofounder_image'] = $cofounder_image;
        }
        if($founder_image){
            $input['founder_image'] = $founder_image;
        }
        if($vision_image){
            $input['vision_image'] = $vision_image;
        }
        if($mission_image){
            $input['mission_image'] = $mission_image;
        }
        if($partnership_image){
            $input['partnership_image'] = $partnership_image;
        }

        $data->update($input);
        $notification = array(
            'message' => 'Update Successfully !!!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
