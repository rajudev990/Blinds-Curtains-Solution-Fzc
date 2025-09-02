<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CacheManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cache-management.index');
    }


    public function clearRoute()
    {
        Artisan::call('route:clear');

        $notification = array(
            'message' => 'Route Clear Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }
    public function clearView()
    {
        Artisan::call('view:clear');
        $notification = array(
            'message' => 'View Clear Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    public function clearConfig()
    {
        Artisan::call('config:clear');
        $notification = array(
            'message' => 'Config Clear Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    public function clearCache()
    {
        Artisan::call('cache:clear');
        $notification = array(
            'message' => 'Cache Clear Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    public function clearOptimize()
    {
        Artisan::call('optimize:clear');
        $notification = array(
            'message' => 'Optimize Clear Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }

    public function clearStorage()
    {
        Artisan::call('storage:link');
        $notification = array(
            'message' => 'Storage Create Successfully !!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

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
        //
    }
}
