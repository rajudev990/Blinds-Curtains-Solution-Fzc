<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::with('orderDetails')->where('status','complete')
        ->get()
        ->filter(function($order){
            $detailsTotal = $order->orderDetails->sum('amount');
            return $order->order_total == $detailsTotal;
        });
        return view('admin.statement.index',compact('data'));
    }

    public function print($code)
    {
        // Order টা খুঁজে আনবো order_code দিয়ে
        $order = Order::with('orderDetails')
                    ->where('order_code', $code)
                    ->firstOrFail();


        $order = Order::with('book', 'orderDetails')->where('order_code', $code)->first();
        $setting = Setting::first();
    
        // Convert logo to base64
        $logoPath = public_path('storage/' . $setting->header_logo);
        $logo = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
    
        $pdf = Pdf::loadView('invoice.payment-invoice', compact('order', 'setting', 'logo'));
        // return $pdf->stream();
        return $pdf->download('invoice-' . $order->order_code . '.pdf');

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
