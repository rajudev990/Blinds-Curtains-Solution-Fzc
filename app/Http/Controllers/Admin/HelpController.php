<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Help;
use App\Models\HelpTitle;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Help::latest()->get();
        return view('admin.help.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = HelpTitle::where('status',1)->get();
        return view('admin.help.create',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'question' => 'required',
            'description' => 'required',
            'status' => 'required',
          
        ]);

      
        
        $contact = Help::create([
            'title' => $request->title,
            'question' => $request->question,
            'description' => $request->description,
            'status' => $request->status
        ]);


        $notification = array(
            'message' => 'Help Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.help.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Help::findOrFail($id);
        $list = HelpTitle::where('status',1)->get();
       return view('admin.help.view',compact('data','list'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Help::findOrFail($id);
        $list = HelpTitle::where('status',1)->get();
       return view('admin.help.edit',compact('data','list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Help::findOrFail($id);

        $request->validate([
            'status' => 'required',
            'title' => 'required',
            'question' => 'required',
            'description' => 'required',
            
        ]);
        $input = $request->all();
        $data->update($input);


        $notification = array(
            'message' => 'Help Updated Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.help.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Help::findOrFail($id);
        $data->delete();
        $notification = array(
            'message' => 'Help Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
