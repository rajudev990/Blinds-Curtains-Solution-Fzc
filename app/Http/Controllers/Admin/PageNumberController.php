<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageNumber;
use App\Models\CatalougeBook;
use Illuminate\Http\Request;

class PageNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PageNumber::all();
        return view('admin.product.catalouge.page.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $book = CatalougeBook::where('status',1)->get();
        return view('admin.product.catalouge.page.create', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required|unique:page_numbers',
            'name' => 'required|string',
        ]);
        

        // Split the 'name' input by commas to get individual page numbers
        $pageNumbers = explode(',', $request->name);

        foreach ($pageNumbers as $pageNumber) {
            PageNumber::create([
                'name' => trim($pageNumber),  // Trim to remove any whitespace
                'catalouge_book_id' => $request->catalouge_book_id,
                'status' => $request->status,
            ]);
        }

        $notification = array(
            'message'    => 'Create Successfully !!!',
            'alert-type' => 'success',
        );

        // return redirect()->back()->with($notification);
        return redirect()->route('admin.page-numbers.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PageNumber::findOrFail($id);
        $book = CatalougeBook::where('status',1)->get();
        return view('admin.product.catalouge.page.view', compact('data','book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = PageNumber::findOrFail($id);
        $book = CatalougeBook::where('status',1)->get();
        return view('admin.product.catalouge.page.edit', compact('data','book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = PageNumber::findOrFail($id);

        $request->validate([
            // 'name' => 'required|unique:catalouge_books,name,'.$data->id,
            'name' => 'required|'
        ]);

        $input = $request->all();
        $data->update($input);

        $notification = array(
            'message'    => 'Updated Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.page-numbers.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = PageNumber::findOrFail($id);
        $data->delete();
        $notification = array(
            'message'    => 'Delete Successfully !!!',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }
}
