<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingTime;
use Illuminate\Http\Request;

class BookTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BookingTime::get();
        return view('admin.book-time.index',compact('data'));
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
        $validatedData = $request->validate([
            'name' => 'required|unique:booking_times|max:255',
        ]);

        $data = $request->all();
        BookingTime::create($data);
        $notification = array(
            'message'    => 'Successfully Saved',
            'alert-type' => 'success',
        );
        
        return back()->with($notification);
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
        $data = BookingTime::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:booking_times,name,'.$data->id,
        ]);

        $data->update($request->all());

        $notification = array(
            'message'    => 'Successfully Updated',
            'alert-type' => 'success',
        );
        
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = BookingTime::findOrFail($id);
        $data->delete();
        $notification = array(
            'message'    => 'Successfully Delete',
            'alert-type' => 'success',
        );
        
        return back()->with($notification);
    }
}
