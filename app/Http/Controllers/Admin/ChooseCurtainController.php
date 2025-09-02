<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChooseCurtain;
use Illuminate\Http\Request;

class ChooseCurtainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ChooseCurtain::latest()->get();
        return view('admin.choose-curtain.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.choose-curtain.create');
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

      
        
        $contact = ChooseCurtain::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);


        $notification = array(
            'message' => 'choose curtains Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.choose-curtain.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = ChooseCurtain::findOrFail($id);
       return view('admin.choose-curtain.view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ChooseCurtain::findOrFail($id);
       return view('admin.choose-curtain.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = ChooseCurtain::findOrFail($id);

        $request->validate([
            'status' => 'required',
            
        ]);
        $input = $request->all();
        $data->update($input);


        $notification = array(
            'message' => 'Choose Curtain Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.choose-curtain.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = ChooseCurtain::findOrFail($id);
        $data->delete();
        $notification = array(
            'message' => 'OChoose Curtain Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
