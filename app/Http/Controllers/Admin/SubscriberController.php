<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Subscriber::latest()->get();
        return view('admin.subscriber.index',compact('data'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Subscriber::findOrFail($id);
        $data->delete();
        $notification = array(
            'message' => 'Subscriber Delete Successfully !!!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function status(Request $request,$id)
    {
        $subscriber = Subscriber::find($id);
        if ($subscriber) {
            $subscriber->status = $request->status;
            $subscriber->save();

            return response()->json([
                'success' => true,
                'message' => 'Subscriber Status Change Successfully !!!',
                'alert_type' => 'success'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Subscriber not found',
            'alert_type' => 'error'
        ]);
    }
}
