<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'name'   => 'required|unique:coupons',
                'amount' => 'required',
                'status' => 'required',
            ]
        );

        $coupon = Coupon::create([
            'name'   => $request->name,
            'amount' => $request->amount,
            'status' => $request->status,
        ]);

        $notification = array(
            'message'    => 'Coupon Create Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.coupon.index')->with($notification);
    }

    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.view', compact('coupon'));
    }

    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, string $id)
    {
        $data = Coupon::findOrFail($id);

        $request->validate(
            [
                'name'   => 'required|unique:coupons,name,'.$data->id,
                'amount' => 'required',
                'status' => 'required',
            ]
        );

        $input = $request->all();
        $data->update($input);

        $notification = array(
            'message'    => 'Coupon Updated Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.coupon.index')->with($notification);
    }

    public function destroy(string $id)
    {
        $data = Coupon::findOrFail($id);
        $data->delete();
        $notification = array(
            'message'    => 'Coupon Delete Successfully !!!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

}
