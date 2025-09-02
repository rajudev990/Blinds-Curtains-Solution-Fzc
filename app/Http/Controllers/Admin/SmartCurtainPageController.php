<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\SmartCurtainsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SmartCurtainPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SmartCurtainsPage::first();
        return view('admin.smart-curtains.page.index', compact('data'));
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
        $data = SmartCurtainsPage::findOrFail($id);

        $banner_image = $request->hasFile('banner_image') ? ImageHelper::uploadImage($request->file('banner_image')) : null;
        $step_two_image = $request->hasFile('step_two_image') ? ImageHelper::uploadImage($request->file('step_two_image')) : null;

        if ($request->hasFile('banner_image') && $data->banner_image) {
            Storage::disk('public')->delete($data->banner_image);
        }

        if ($request->hasFile('step_two_image') && $data->step_two_image) {
            Storage::disk('public')->delete($data->step_two_image);
        }

        $input = $request->all();

        if ($banner_image) {
            $input['banner_image'] = $banner_image;
        }
        if ($step_two_image) {
            $input['step_two_image'] = $step_two_image;
        }

        $data->update($input);
        $notification = array(
            'message' => 'Setting Update Successfully !!!',
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
