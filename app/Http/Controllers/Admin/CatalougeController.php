<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use Illuminate\Http\Request;

class CatalougeController extends Controller
{
    public function index()
    {
        $data = Catalogue::all();
        return view('admin.product.catalouge.index', compact('data'));
    }

    public function create()
    {
        return view('admin.product.catalouge.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:catalogues',
        ]);


        Catalogue::create([
            'name'   => $request->name,
            'status' => $request->status,
        ]);

        $notification = array(
            'message'    => 'Create Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.catalogues.index')->with($notification);
    }

    public function show($id)
    {
        $data = Catalogue::findOrFail($id);
        return view('admin.product.catalouge.view', compact('data'));
    }

    public function edit(string $id)
    {
        $data = Catalogue::findOrFail($id);
        return view('admin.product.catalouge.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $data = Catalogue::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:catalogues,name,'.$data->id,
        ]);

        $input = $request->all();
        $data->update($input);

        $notification = array(
            'message'    => 'Updated Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.catalogues.index')->with($notification);
    }

    public function destroy(string $id)
    {
        $data = Catalogue::findOrFail($id);
        $data->delete();
        $notification = array(
            'message'    => 'Delete Successfully !!!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
