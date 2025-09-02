<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\CatalougeBook;
use Illuminate\Http\Request;

class CatalougeBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CatalougeBook::all();
        return view('admin.product.catalouge.book.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catalouge = Catalogue::where('status',1)->get();
        return view('admin.product.catalouge.book.create', compact('catalouge'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:catalouge_books',
        ]);


        CatalougeBook::create([
            'name'   => $request->name,
            'catalouge_id'   => $request->catalouge_id,
            'width'   => $request->width,
            'number'   => $request->number,
            'email'   => $request->email,
            'status' => $request->status,
        ]);

        $notification = array(
            'message'    => 'Create Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
        // return redirect()->route('admin.catalogue-books.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = CatalougeBook::findOrFail($id);
        $catalouge = Catalogue::where('status',1)->get();
        return view('admin.product.catalouge.book.view', compact('data','catalouge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = CatalougeBook::findOrFail($id);
        $catalouge = Catalogue::where('status',1)->get();
        return view('admin.product.catalouge.book.edit', compact('data','catalouge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = CatalougeBook::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:catalouge_books,name,'.$data->id,
        ]);

        $input = $request->all();
        $data->update($input);

        $notification = array(
            'message'    => 'Updated Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.catalogue-books.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = CatalougeBook::findOrFail($id);
        $data->delete();
        $notification = array(
            'message'    => 'Delete Successfully !!!',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }
}
